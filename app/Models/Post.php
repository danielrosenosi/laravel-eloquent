<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'date',
    ];

    // protected $table = 'nome_da_tabela'; define o nome da tabela, se não for o nome da model no plural
    // protected $timestamps = false; desabilita as colunas timestamps
    // protected $connection = 'pgsql';  altera a conexão à nível de model
    // protected $primaryKey = 'nome_da_chave_primaria'; por default o laravel busca por id
    // protected $keyType = 'string'; altera o tipo da chave primária, se caso não for integer
    // protected $incrementing = false; desabilita incrementação no id
    // const CREATED_AT = 'data_criacao';
    // const UPDATED_AT = 'data_atualizacao';
    // protected $dateFormat = 'd/m/y';
    // protected $attributes = ['coluna' => 'valor'];
}
