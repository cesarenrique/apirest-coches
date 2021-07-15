<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\AlojamientoTransformer;
class Alojamiento extends Model
{
    use SoftDeletes;
    public $transformer= AlojamientoTransformer::class;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'id',
        'precio',
        'Pension_id',
        'tipo_coche_id',
        'Temporada_id',

    ];
}
