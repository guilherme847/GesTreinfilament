<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Etapa extends Model
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
        'idetapa',
        'Nome',
        'Descricao',
        'Ordem',
        'Treinamento_idTreinamento',
        'treinamento_id',
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
            'idetapa' => 'integer',
            'treinamento_id' => 'integer',
        ];
    }

    public function treinamento(): BelongsTo
    {
        return $this->belongsTo(Treinamento::class);
    }

    public function idetapa(): BelongsTo
    {
        return $this->belongsTo(Idetapa::class);
    }

    public function cronogramaEtapas(): BelongsToMany
    {
        return $this->belongsToMany(TurmaThrough::class);
    }
}
