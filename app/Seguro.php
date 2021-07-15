<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\SeguroTransformer;

class Seguro extends Model
{
    use SoftDeletes;
    //
    const SIN_SEGURO="seguro cargo cliente";
    const SEGURO_TERCEROS="solo terceros";
    const SEGURO_TODORIESGO="daños del coche y terceros";
    const SEGURO_TODORIESGOPLUS="daños del coche, tercero y servicios";

    public $transformer= SeguroTransformer::class;
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

    public function alojamientos(){
        return $this->hasMany(Alojamiento::class);
    }


}
