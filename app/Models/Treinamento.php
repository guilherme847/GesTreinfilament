<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treinamento extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idTreinamento',
        'Nome',
        'Descricao',
        'Carga_horaria',
        'Tipo',
        'Modalidade',
        'Validade_meses',
        'requer_validacao_pratica',
        'Data_da_criacao',
        'Status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'idTreinamento' => 'integer',
            'requer_validacao_pratica' => 'integer',
            'Data_da_criacao' => 'timestamp',
        ];
    }

    public function etapaTurmaCalendarios(): HasMany
    {
        return $this->hasMany(EtapaTurmaCalendario::class);
    }

    public function idTreinamento(): BelongsTo
    {
        return $this->belongsTo(IdTreinamento::class);
    }
}
