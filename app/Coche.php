<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Alojamiento;
use App\Transformers\CocheTransformer;

class Coche extends Model
{
    use SoftDeletes;


    public $transformer= CocheTransformer::class;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'id',
        'numero',
        'Agencia_id',
        'tipo_coche_id',

    ];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

}
