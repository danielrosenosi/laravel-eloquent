<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use App\Scopes\YearScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = [
        'title',
        'body',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime:d/m/Y',
        'data_criacao' => 'date',
        'active' => 'boolean'
    ]; // Casting de dados, garante que o dado seja sempre o padrão definido.

    protected static function booted()
    {
        // static::addGlobalScope('year', function (Builder $builder) {
        //     $builder->whereYear('date', now()->year);
        // });

        static::addGlobalScope(new YearScope);
    }

    public function scopeLastWeek($query)
    {
        return $this->whereDate('date', '>=', now()->subDays(4))
                    ->whereDate('date', '>=', now()->subDays(1));
    }

    public function scopeToday($query)
    {
        return $this->whereDate('date', now());
    }

    public function scopeBetween($query, $firstDate, $lastDate)
    {
        $firstDate = Carbon::parse($firstDate)->format('Y-m-d');
        $lastDate = Carbon::parse($lastDate)->format('Y-m-d');

        return $this->whereDate('date', '>=', $firstDate)->whereDate('date', '<=', $lastDate);
    }

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

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
