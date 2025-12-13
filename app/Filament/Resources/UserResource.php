<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Setor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Colaboradores';

    protected static ?string $modelLabel = 'Colaborador';

    protected static ?string $pluralModelLabel = 'Colaboradores';

    protected static ?string $navigationGroup = 'Gestão';

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        // RN03: Admin e RH podem visualizar colaboradores
        return $user && in_array($user->tipo, ['admin', 'rh']);
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        // RN03: Admin e RH podem criar colaboradores
        return $user && in_array($user->tipo, ['admin', 'rh']);
    }
    
    public static function canEdit($record): bool
    {
        $user = Auth::user();
        // RN03: Admin e RH podem editar colaboradores
        return $user && in_array($user->tipo, ['admin', 'rh']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações Pessoais')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome Completo')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('id')
                            ->label('Matrícula')
                            ->disabled()
                            ->dehydrated(false)
                            ->default(fn ($record) => $record?->id ?? 'Será gerada automaticamente')
                            ->helperText('RN03: Matrícula do colaborador (ID do sistema)')
                            ->visibleOn(['view', 'edit']),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->disabled(fn () => Auth::user()?->tipo === 'rh')
                            ->helperText(fn () => Auth::user()?->tipo === 'rh' 
                                ? 'RN03: RH pode editar apenas nome, matrícula, setor e função.' 
                                : null),
                        Forms\Components\Select::make('tipo')
                            ->label('Tipo de Usuário')
                            ->options([
                                'admin' => 'Administrador',
                                'tecnico_seguranca' => 'Técnico de Segurança',
                                'rh' => 'Recursos Humanos',
                                'instrutor' => 'Instrutor',
                                'colaborador' => 'Colaborador',
                            ])
                            ->required()
                            ->default('colaborador')
                            ->native(false)
                            ->disabled(fn () => Auth::user()?->tipo === 'rh'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informações Profissionais')
                    ->schema([
                        Forms\Components\Select::make('empresa_id')
                            ->label('Empresa')
                            ->relationship('empresa', 'Nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('Nome')
                                    ->label('Nome da Empresa')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('Cnpj')
                                    ->label('CNPJ')
                                    ->required()
                                    ->maxLength(18),
                            ]),
                        Forms\Components\Select::make('setor_id')
                            ->label('Setor')
                            ->relationship('setor', 'Nome_setor')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('Nome_setor')
                                    ->label('Nome do Setor')
                                    ->required()
                                    ->maxLength(45),
                            ]),
                        Forms\Components\TextInput::make('funcao')
                            ->label('Função')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('setor')
                            ->label('Setor (Legado)')
                            ->maxLength(100)
                            ->helperText('Campo legado - use o campo Setor acima')
                            ->visible(fn ($record) => !$record || $record->setor),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Segurança')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create' && Auth::user()?->tipo !== 'rh')
                            ->disabled(fn () => Auth::user()?->tipo === 'rh')
                            ->dehydrated(fn ($state) => filled($state))
                            ->rule(Password::default())
                            ->maxLength(255)
                            ->helperText(fn (string $operation): string => 
                                Auth::user()?->tipo === 'rh' 
                                    ? 'RN03: RH não pode alterar senhas.' 
                                    : ($operation === 'edit' ? 'Deixe em branco para manter a senha atual' : '')
                            ),
                        Forms\Components\DateTimePicker::make('data_cadastro')
                            ->label('Data de Cadastro')
                            ->default(now())
                            ->required()
                            ->visibleOn('create')
                            ->disabled(fn () => Auth::user()?->tipo === 'rh'),
                    ])
                    ->columns(2)
                    ->visibleOn(['create', 'edit']),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('ativo')
                            ->label('Ativo')
                            ->default(true)
                            ->required()
                            ->disabled(fn () => Auth::user()?->tipo === 'rh')
                            ->helperText(fn () => Auth::user()?->tipo === 'rh' 
                                ? 'RN03: RH não pode alterar status de ativação.' 
                                : null),
                        Forms\Components\DatePicker::make('data_desligamento')
                            ->label('Data de Desligamento')
                            ->visible(fn (Forms\Get $get) => !$get('ativo'))
                            ->disabled(fn () => Auth::user()?->tipo === 'rh'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'tecnico_seguranca' => 'warning',
                        'rh' => 'info',
                        'instrutor' => 'success',
                        'colaborador' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Administrador',
                        'tecnico_seguranca' => 'Técnico Segurança',
                        'rh' => 'RH',
                        'instrutor' => 'Instrutor',
                        'colaborador' => 'Colaborador',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('empresa.Nome')
                    ->label('Empresa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('setor.Nome_setor')
                    ->label('Setor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('funcao')
                    ->label('Função')
                    ->searchable(),
                Tables\Columns\IconColumn::make('ativo')
                    ->label('Ativo')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_cadastro')
                    ->label('Data Cadastro')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('data_desligamento')
                    ->label('Data Desligamento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                    ->label('Tipo de Usuário')
                    ->options([
                        'admin' => 'Administrador',
                        'tecnico_seguranca' => 'Técnico de Segurança',
                        'rh' => 'Recursos Humanos',
                        'instrutor' => 'Instrutor',
                        'colaborador' => 'Colaborador',
                    ]),
                Tables\Filters\SelectFilter::make('empresa_id')
                    ->label('Empresa')
                    ->relationship('empresa', 'Nome'),
                Tables\Filters\SelectFilter::make('setor_id')
                    ->label('Setor')
                    ->relationship('setor', 'Nome_setor'),
                Tables\Filters\TernaryFilter::make('ativo')
                    ->label('Status')
                    ->placeholder('Todos')
                    ->trueLabel('Ativos')
                    ->falseLabel('Inativos'),
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
            ->defaultSort('name');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
