<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\TipoCoche;

class TipoCocheTransformer extends TransformerAbstract
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
    public function transform(TipoCoche $tipohab)
    {
        return [
          'identificador'=>(int)$tipohab->id,
          'tipo'=> (string)$tipohab->tipo,
          'HotelIdentificador'=>(int)$tipohab->Hotel_id,
          'fechaCreacion'=>(string)$tipohab->created_at,
          'fechaActualizacion'=>(string)$tipohab->updated_at,
          'fechaEliminacion'=>isset($tipohab->deleted_at) ?(string)$tipohab->deteted_at: null,
          'links'=>[
              [
                  'rel'=>'self',
                  'href'=> route('tipo_coches.show',$tipohab->id),
              ],

              [
                  'rel'=>'tipo_coches.coches',
                  'href'=> route('tipo_coches.coches.index',$tipohab->id),
              ],
            ],
        ];
    }
}
