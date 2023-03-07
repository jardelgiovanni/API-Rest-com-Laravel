<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Turma extends Model
{
    use HasFactory;

    /**
     * Define a relação entre turma e alunos
     *
     * @return HasMany
     */
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }
}
