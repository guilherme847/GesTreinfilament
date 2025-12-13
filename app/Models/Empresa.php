<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
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
        'idEmpresa',
        'Nome',
        'Cnpj',
        'Endereco',
        'Cidade',
        'Estado',
        'Cep',
        'Telefone',
        'Email_contato',
        'Ativo',
        'Numero_colaboradores',
        'Data_cadastrado',
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
            'idEmpresa' => 'integer',
            'Ativo' => 'integer',
            'Data_cadastrado' => 'timestamp',
        ];
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'empresa_id');
    }
}
