<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TurmaResource\Pages;
use App\Filament\Resources\TurmaResource\RelationManagers;
use App\Models\Turma;
use App\Models\User;
use App\Models\Treinamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TurmaResource extends Resource
{
    protected static ?string $model = Turma::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Participações';

    protected static ?string $modelLabel = 'Participação em Treinamento';

    protected static ?string $pluralModelLabel = 'Participações em Treinamentos';

    protected static ?string $navigationGroup = 'Gestão';

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        // RN02: Admin, Instrutor, Técnico de Segurança e RH podem visualizar
        return $user && in_array($user->tipo, ['admin', 'instrutor', 'tecnico_seguranca', 'rh']);
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        // Apenas admin pode criar novas participações
        return $user && $user->tipo === 'admin';
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        // RN02: Admin, Instrutor, Técnico de Segurança e RH podem editar (registrar presença e notas)
        return $user && in_array($user->tipo, ['admin', 'instrutor', 'tecnico_seguranca', 'rh']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações da Participação')
                    ->schema([
                        Forms\Components\Select::make('treinamento_id')
                            ->label('Treinamento')
                            ->relationship('treinamento', 'Nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $treinamento = Treinamento::find($state);
                                    if ($treinamento) {
                                        $set('Forma_realizacao', $treinamento->Modalidade);
                                    }
                                }
                            }),
                        Forms\Components\Select::make('aluno_id')
                            ->label('Colaborador/Aluno')
                            ->relationship('aluno', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->getSearchResultsUsing(fn (string $search) => 
                                User::where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->pluck('name', 'id')
                            ),
                        Forms\Components\Select::make('instrutor_id')
                            ->label('Instrutor')
                            ->relationship('instrutor', 'name', fn (Builder $query) => 
                                $query->where('tipo', 'instrutor')
                            )
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Select::make('Forma_realizacao')
                            ->label('Forma de Realização')
                            ->options([
                                'presencial' => 'Presencial',
                                'online' => 'Online',
                                'hibrido' => 'Híbrido',
                            ])
                            ->native(false)
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Datas')
                    ->schema([
                        Forms\Components\DateTimePicker::make('Data_vinculo')
                            ->label('Data de Vínculo')
                            ->default(now())
                            ->required(),
                        Forms\Components\DatePicker::make('Data_prevista_conclusao')
                            ->label('Data Prevista de Conclusão')
                            ->nullable(),
                        Forms\Components\DatePicker::make('Data_conclusao')
                            ->label('Data de Conclusão')
                            ->nullable(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Status do Treinamento')
                    ->schema([
                        Forms\Components\Select::make('Status_geral')
                            ->label('Status Geral')
                            ->options([
                                'pendente' => 'Pendente',
                                'em_andamento' => 'Em Andamento',
                                'concluida' => 'Concluída',
                                'cancelada' => 'Cancelada',
                            ])
                            ->default('pendente')
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('Etapa_teorica_status')
                            ->label('Status Etapa Teórica')
                            ->options([
                                'pendente' => 'Pendente',
                                'em_andamento' => 'Em Andamento',
                                'concluida' => 'Concluída',
                                'cancelada' => 'Cancelada',
                            ])
                            ->nullable()
                            ->native(false),
                        Forms\Components\DatePicker::make('Etapa_teorica_data')
                            ->label('Data Etapa Teórica')
                            ->nullable(),
                        Forms\Components\DateTimePicker::make('Etapa_pratica_data')
                            ->label('Data Etapa Prática')
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Avaliação e Resultados')
                    ->schema([
                        Forms\Components\TextInput::make('nota')
                            ->label('Nota/Resultado')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->helperText('Nota ou resultado da avaliação (0-100)')
                            ->nullable(),
                        Forms\Components\Textarea::make('Observacao')
                            ->label('Observações')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('RN02: Registro de presença e observações sobre o treinamento')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('aluno.name')
                    ->label('Colaborador')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('treinamento.Nome')
                    ->label('Treinamento')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('instrutor.name')
                    ->label('Instrutor')
                    ->searchable()
                    ->sortable()
                    ->default('Não definido'),
                Tables\Columns\TextColumn::make('Status_geral')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendente' => 'gray',
                        'em_andamento' => 'warning',
                        'concluida' => 'success',
                        'cancelada' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'em_andamento' => 'Em Andamento',
                        'concluida' => 'Concluída',
                        'cancelada' => 'Cancelada',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('Etapa_teorica_status')
                    ->label('Teórica')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'em_andamento' => 'Em Andamento',
                        'concluida' => 'Concluída',
                        'cancelada' => 'Cancelada',
                        default => '-',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('Data_vinculo')
                    ->label('Data Vínculo')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Data_prevista_conclusao')
                    ->label('Prevista')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Data_conclusao')
                    ->label('Conclusão')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nota')
                    ->label('Nota/Resultado')
                    ->numeric(
                        decimalPlaces: 2,
                    )
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('treinamento_id')
                    ->label('Treinamento')
                    ->relationship('treinamento', 'Nome'),
                Tables\Filters\SelectFilter::make('Status_geral')
                    ->label('Status')
                    ->options([
                        'pendente' => 'Pendente',
                        'em_andamento' => 'Em Andamento',
                        'concluida' => 'Concluída',
                        'cancelada' => 'Cancelada',
                    ]),
                Tables\Filters\SelectFilter::make('instrutor_id')
                    ->label('Instrutor')
                    ->relationship('instrutor', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('Data_vinculo', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTurmas::route('/'),
            'create' => Pages\CreateTurma::route('/create'),
            'view' => Pages\ViewTurma::route('/{record}'),
            'edit' => Pages\EditTurma::route('/{record}/edit'),
        ];
    }
}
