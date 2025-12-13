<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpresaResource\Pages;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use App\Models\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Empresas';

    protected static ?string $modelLabel = 'Empresa';

    protected static ?string $pluralModelLabel = 'Empresas';

    protected static ?string $navigationGroup = 'Cadastros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados da Empresa')
                    ->schema([
                        Forms\Components\TextInput::make('Nome')
                            ->label('Nome da Empresa')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('Cnpj')
                            ->label('CNPJ')
                            ->required()
                            ->maxLength(18)
                            ->mask('99.999.999/9999-99')
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('Endereco')
                            ->label('Endereço')
                            ->maxLength(45),
                        Forms\Components\TextInput::make('Cidade')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('Estado')
                            ->label('UF')
                            ->maxLength(2)
                            ->placeholder('SP'),
                        Forms\Components\TextInput::make('Cep')
                            ->label('CEP')
                            ->maxLength(10)
                            ->mask('99999-999'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Contato')
                    ->schema([
                        Forms\Components\TextInput::make('Telefone')
                            ->maxLength(20)
                            ->mask('(99) 99999-9999'),
                        Forms\Components\TextInput::make('Email_contato')
                            ->label('E-mail de Contato')
                            ->email()
                            ->maxLength(225),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('Ativo')
                            ->label('Empresa Ativa')
                            ->default(true)
                            ->required(),
                        Forms\Components\TextInput::make('Numero_colaboradores')
                            ->label('Número de Colaboradores')
                            ->numeric()
                            ->default(0)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('Data_cadastrado')
                            ->label('Data de Cadastro')
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('Cnpj')
                    ->label('CNPJ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Cidade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Estado')
                    ->label('UF')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Email_contato')
                    ->label('E-mail')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Numero_colaboradores')
                    ->label('Colaboradores')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('Ativo')
                    ->label('Ativa')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Data_cadastrado')
                    ->label('Data Cadastro')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('Ativo')
                    ->label('Status')
                    ->placeholder('Todas')
                    ->trueLabel('Ativas')
                    ->falseLabel('Inativas'),
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
            ->defaultSort('Nome');
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
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'view' => Pages\ViewEmpresa::route('/{record}'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }
}
