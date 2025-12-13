<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Turma extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aluno_id',
        'instrutor_id',
        'treinamento_id',
        'Data_vinculo',
        'Data_prevista_conclusao',
        'Data_conclusao',
        'Etapa_teorica_status',
        'Etapa_teorica_data',
        'Etapa_pratica_data',
        'Status_geral',
        'Forma_realizacao',
        'Observacao',
        'nota',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'Data_vinculo' => 'datetime',
            'Data_prevista_conclusao' => 'date',
            'Data_conclusao' => 'date',
            'Etapa_teorica_data' => 'date',
            'Etapa_pratica_data' => 'datetime',
            'nota' => 'decimal:2',
        ];
    }

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function instrutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instrutor_id');
    }

    public function treinamento(): BelongsTo
    {
        return $this->belongsTo(Treinamento::class, 'treinamento_id');
    }

    public function etapas(): BelongsToMany
    {
        return $this->belongsToMany(Etapa::class, 'cronograma_etapas', 'turma_id', 'etapa_id');
    }
}
