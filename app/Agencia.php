<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pension;
use App\TipoCoche;
use App\Transformers\AgenciaTransformer;

class Agencia extends Model
{
    use SoftDeletes;

    public $transformer= AgenciaTransformer::class;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'NIF', 'nombre', 'Localidad_id',
      ];

    public function pensions(){
        return $this->hasMany(Pension::class);
    }

    public function tipo_coches(){
        return $this->hasMany(TipoCoche::class);
    }

    public function habitacions(){
        return $this->hasMany(Habitacion::class);
    }

    public function fechas(){
        return $this->hasMany(Fecha::class);
    }

    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}
