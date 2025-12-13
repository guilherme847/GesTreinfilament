<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SetorResource\Pages;
use App\Filament\Resources\SetorResource\RelationManagers;
use App\Models\Setor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SetorResource extends Resource
{
    protected static ?string $model = Setor::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Setores';

    protected static ?string $modelLabel = 'Setor';

    protected static ?string $pluralModelLabel = 'Setores';

    protected static ?string $navigationGroup = 'Cadastros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Nome_setor')
                    ->label('Nome do Setor')
                    ->required()
                    ->maxLength(45)
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Nome_setor')
                    ->label('Nome do Setor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('usuarios_count')
                    ->label('Colaboradores')
                    ->counts('usuarios')
                    ->sortable(),
            ])
            ->filters([
                //
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
            ->defaultSort('Nome_setor');
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
            'index' => Pages\ListSetors::route('/'),
            'create' => Pages\CreateSetor::route('/create'),
            'view' => Pages\ViewSetor::route('/{record}'),
            'edit' => Pages\EditSetor::route('/{record}/edit'),
        ];
    }
}
