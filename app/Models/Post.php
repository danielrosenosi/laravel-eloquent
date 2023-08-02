<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use Carbon\Carbon;
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

    protected $casts = [
        'date',
        'data_criacao' => 'date',
        'active' => 'boolean'
    ]; // Casting de dados, garante que o dado seja sempre o padrão definido.

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

    // public function getDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d-m-Y'); // alterando formato da data utilizando Accessor
    // }
}
