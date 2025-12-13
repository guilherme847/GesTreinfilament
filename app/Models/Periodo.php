<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periodo extends Model
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
        'idperiodo',
        'Nome',
        'Data_inicio',
        'Data_fim',
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
            'idperiodo' => 'integer',
            'Data_inicio' => 'date',
            'Data_fim' => 'date',
        ];
    }

    public function calendarios(): HasMany
    {
        return $this->hasMany(Calendario::class);
    }

    public function idperiodo(): BelongsTo
    {
        return $this->belongsTo(Idperiodo::class);
    }
}
