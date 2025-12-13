<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreinamentoResource\Pages;
use App\Filament\Resources\TreinamentoResource\RelationManagers;
use App\Models\Treinamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TreinamentoResource extends Resource
{
    protected static ?string $model = Treinamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Treinamentos';

    protected static ?string $modelLabel = 'Treinamento';

    protected static ?string $pluralModelLabel = 'Treinamentos';

    protected static ?string $navigationGroup = 'Gestão';

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        // RN01 e RN03: Admin, Técnico de Segurança e RH podem visualizar
        return $user && in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh']);
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        // RN01: Apenas admin e técnico podem editar treinamentos obrigatórios
        // RN03: RH pode editar apenas treinamentos não-obrigatórios
        if (!$user) {
            return false;
        }
        
        if (in_array($user->tipo, ['admin', 'tecnico_seguranca'])) {
            return true;
        }
        
        if ($user->tipo === 'rh') {
            // RH só pode editar treinamentos não-obrigatórios
            return $record->Tipo !== 'obrigatorio';
        }
        
        return false;
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        // RN01 e RN03: Admin, Técnico de Segurança e RH podem criar
        return $user && in_array($user->tipo, ['admin', 'tecnico_seguranca', 'rh']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações Básicas')
                    ->schema([
                        Forms\Components\TextInput::make('Nome')
                            ->label('Nome do Treinamento')
                            ->required()
                            ->maxLength(225)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('Descricao')
                            ->label('Descrição')
                            ->rows(4)
                            ->maxLength(3000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Detalhes do Treinamento')
                    ->schema([
                        Forms\Components\Select::make('Tipo')
                            ->label('Tipo')
                            ->options([
                                'obrigatorio' => 'Obrigatório',
                                'opcional' => 'Opcional',
                                'reciclagem' => 'Reciclagem',
                                'inicial' => 'Inicial',
                            ])
                            ->required()
                            ->native(false)
                            ->disabled(fn ($get, $livewire) => Auth::user()?->tipo === 'rh')
                            ->helperText(fn () => Auth::user()?->tipo === 'rh' 
                                ? 'RN01: Apenas o Técnico de Segurança pode cadastrar treinamentos obrigatórios. RH pode criar apenas treinamentos opcionais, reciclagem ou iniciais.' 
                                : null),
                        Forms\Components\Select::make('Modalidade')
                            ->label('Modalidade')
                            ->options([
                                'presencial' => 'Presencial',
                                'online' => 'Online',
                                'hibrido' => 'Híbrido',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('Carga_horaria')
                            ->label('Carga Horária (horas)')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\TextInput::make('Validade_meses')
                            ->label('Validade (meses)')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Período de validade do treinamento em meses'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Configurações')
                    ->schema([
                        Forms\Components\Toggle::make('requer_validacao_pratica')
                            ->label('Requer Validação Prática')
                            ->default(false)
                            ->helperText('Marque se o treinamento requer validação prática'),
                        Forms\Components\Select::make('Status')
                            ->label('Status')
                            ->options([
                                'ativo' => 'Ativo',
                                'inativo' => 'Inativo',
                                'arquivado' => 'Arquivado',
                            ])
                            ->default('ativo')
                            ->required()
                            ->native(false),
                        Forms\Components\DateTimePicker::make('Data_da_criacao')
                            ->label('Data de Criação')
                            ->default(now())
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('Tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'obrigatorio' => 'danger',
                        'opcional' => 'info',
                        'reciclagem' => 'warning',
                        'inicial' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'obrigatorio' => 'Obrigatório',
                        'opcional' => 'Opcional',
                        'reciclagem' => 'Reciclagem',
                        'inicial' => 'Inicial',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('Modalidade')
                    ->label('Modalidade')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'presencial' => 'Presencial',
                        'online' => 'Online',
                        'hibrido' => 'Híbrido',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('Carga_horaria')
                    ->label('Carga Horária')
                    ->numeric()
                    ->suffix(' horas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Validade_meses')
                    ->label('Validade')
                    ->numeric()
                    ->suffix(' meses')
                    ->sortable(),
                Tables\Columns\IconColumn::make('requer_validacao_pratica')
                    ->label('Prática')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('Status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ativo' => 'success',
                        'inativo' => 'warning',
                        'arquivado' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                        'arquivado' => 'Arquivado',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('Data_da_criacao')
                    ->label('Data de Criação')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Tipo')
                    ->label('Tipo')
                    ->options([
                        'obrigatorio' => 'Obrigatório',
                        'opcional' => 'Opcional',
                        'reciclagem' => 'Reciclagem',
                        'inicial' => 'Inicial',
                    ]),
                Tables\Filters\SelectFilter::make('Modalidade')
                    ->label('Modalidade')
                    ->options([
                        'presencial' => 'Presencial',
                        'online' => 'Online',
                        'hibrido' => 'Híbrido',
                    ]),
                Tables\Filters\SelectFilter::make('Status')
                    ->label('Status')
                    ->options([
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                        'arquivado' => 'Arquivado',
                    ]),
                Tables\Filters\TernaryFilter::make('requer_validacao_pratica')
                    ->label('Requer Validação Prática')
                    ->placeholder('Todos')
                    ->trueLabel('Sim')
                    ->falseLabel('Não'),
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
            ->defaultSort('Data_da_criacao', 'desc');
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
            'index' => Pages\ListTreinamentos::route('/'),
            'create' => Pages\CreateTreinamento::route('/create'),
            'view' => Pages\ViewTreinamento::route('/{record}'),
            'edit' => Pages\EditTreinamento::route('/{record}/edit'),
        ];
    }
}
