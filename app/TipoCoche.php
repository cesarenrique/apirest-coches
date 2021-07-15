<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Coche;
use App\Transformers\TipoCocheTransformer;

class TipoCoche extends Model
{
    use SoftDeletes;

    //basicos
    const COCHE_NORMAL="normal";
    const COCHE_SIMPLE="simple";
    const COCHE_DEPORTIVO="deportivo";
    const COCHE_FAMILIAR="familiar";
    public $transformer= TipoCocheTransformer::class;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $dates=['deleted_at'];
    protected $fillable = [
      'tipo',
      'Agencia_id',
    ];

    public function Coches(){
      return $this->hasMany(Coche::class);
    }

    public function alojamientos(){
      return $this->hasMany(Alojamiento::class);
    }
}
