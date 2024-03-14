<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoConta extends Model
{
    use HasFactory; // padrão laravel: criar o nome da Model:"conta" e da tabela "contas" no plural não é obrigatorio indicar o nome da tabela
    //Indicar o nome da tabela
    protected $table = 'situacoes_contas';

    //Indicar quais colunas podem ser cadastrada 
    protected $fillable = ['nome', 'cor'];

    // acrecsenta o relacionamento um para muitos
    public function conta()
    {
        return $this->hasMany(Conta::class);
    }
}
