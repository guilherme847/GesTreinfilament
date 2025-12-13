<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calendario extends Model
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
        'Treinamento_idTreinamento',
        'periodo_idperiodo',
        'setor_idsetor',
        'data_prevista',
        'descricao',
        'treinamento_periodo_setor_id',
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
            'data_prevista' => 'timestamp',
            'treinamento_periodo_setor_id' => 'integer',
        ];
    }

    public function treinamentoPeriodoSetor(): BelongsTo
    {
        return $this->belongsTo(TreinamentoPeriodoSetor::class);
    }
}
