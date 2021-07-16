<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Seguro;
use App\TipoCoche;
use App\Transformers\AgenciaTransformer;
use App\Coche;

class Agencia extends Model
{
    use SoftDeletes;

    public $transformer= AgenciaTransformer::class;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'NIF', 'nombre', 'Localidad_id',
      ];

    public function seguros(){
        return $this->hasMany(Seguro::class);
    }

    public function tipo_coches(){
        return $this->hasMany(TipoCoche::class);
    }

    public function coches(){
        return $this->hasMany(Coche::class);
    }

    public function fechas(){
        return $this->hasMany(Fecha::class);
    }

    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}
