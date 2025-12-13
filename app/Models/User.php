<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'setor',
        'funcao',
        'ativo',
        'data_cadastro',
        'data_desligamento',
        'empresa_id',
        'setor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ativo' => 'boolean',
            'data_cadastro' => 'datetime',
            'data_desligamento' => 'date',
        ];
    }

    /**
     * Relacionamento: User pertence a uma Empresa
     */
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    /**
     * Relacionamento: User pertence a um Setor
     */
    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    /**
     * Relacionamento: User tem muitas Notificações
     */
    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'user_id');
    }

    /**
     * Relacionamento: User tem muitos Certificados
     */
    public function certificados(): HasMany
    {
        return $this->hasMany(Certificado::class, 'user_id');
    }

    /**
     * Relacionamento: User (como aluno) tem muitas Turmas
     */
    public function turmasComoAluno(): HasMany
    {
        return $this->hasMany(Turma::class, 'aluno_id');
    }

    /**
     * Relacionamento: User (como instrutor) tem muitas Turmas
     */
    public function turmasComoInstrutor(): HasMany
    {
        return $this->hasMany(Turma::class, 'instrutor_id');
    }
}
