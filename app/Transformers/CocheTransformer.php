<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Coche;

class CocheTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Coche $Coche)
    {
        return [
          'identificador'=>(int)$Coche->id,
          'numero'=> (string)$Coche->numero,
          'AgenciaIdentificador'=>(int)$Coche->Agencia_id,
          'fechaCreacion'=>(string)$Coche->created_at,
          'fechaActualizacion'=>(string)$Coche->updated_at,
          'fechaEliminacion'=>isset($Coche->deleted_at) ?(string)$Coche->deteted_at: null,
          'links'=>[
              [
                  'rel'=>'self',
                  'href'=> route('coches.show',$Coche->id),
              ],

              [
                  'rel'=>'coches.alojamientos',
                  'href'=> route('coches.alojamientos.index',$Coche->id),
              ],
              [
                  'rel'=>'coches.fechas',
                  'href'=> route('coches.fechas.index',$Coche->id),
              ],
              [
                  'rel'=>'coches.reservas',
                  'href'=> route('coches.reservas.index',$Coche->id),
              ],
            ],
        ];
    }
}
