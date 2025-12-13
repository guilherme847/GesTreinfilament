<?php

namespace App\Filament\Colaborador\Pages;

use App\Models\Turma;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MeusTreinamentos extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static string $view = 'filament.colaborador.pages.meus-treinamentos';
    
    protected static ?string $navigationLabel = 'Meus Treinamentos';
    
    protected static ?string $title = 'Meus Treinamentos';
    
    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        $colaboradorId = Auth::id();
        
        return $table
            ->query(
                Turma::query()
                    ->where('aluno_id', $colaboradorId)
                    ->with(['treinamento', 'instrutor'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('treinamento.Nome')
                    ->label('Treinamento')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('treinamento.Tipo')
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
                    }),
                Tables\Columns\TextColumn::make('treinamento.Carga_horaria')
                    ->label('Carga Horária')
                    ->numeric()
                    ->suffix(' horas'),
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
                    }),
                Tables\Columns\TextColumn::make('instrutor.name')
                    ->label('Instrutor')
                    ->default('Não definido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Data_vinculo')
                    ->label('Data de Vínculo')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Data_prevista_conclusao')
                    ->label('Prevista')
                    ->date('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Data_conclusao')
                    ->label('Conclusão')
                    ->date('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nota')
                    ->label('Nota/Resultado')
                    ->numeric(decimalPlaces: 2)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Status_geral')
                    ->label('Status')
                    ->options([
                        'pendente' => 'Pendente',
                        'em_andamento' => 'Em Andamento',
                        'concluida' => 'Concluída',
                        'cancelada' => 'Cancelada',
                    ]),
            ])
            ->actions([
                // RN04: Colaboradores podem apenas visualizar, não editar
            ])
            ->defaultSort('Data_vinculo', 'desc')
            ->emptyStateHeading('Nenhum treinamento encontrado')
            ->emptyStateDescription('Você ainda não está vinculado a nenhum treinamento.');
    }
}

