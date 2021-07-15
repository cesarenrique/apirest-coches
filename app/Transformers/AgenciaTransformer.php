<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Agencia;

class AgenciaTransformer extends TransformerAbstract
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
    public function transform(Agencia $agencia)
    {
        return [
          'identificador'=>(int)$agencia->id,
          'NIF'=>(string)$agencia->NIF,
          'nombre'=> (string)$agencia->nombre,
          'LocalidadIdentificador'=>(int)$agencia->Localidad_id,
          'fechaCreacion'=>(string)$agencia->created_at,
          'fechaActualizacion'=>(string)$agencia->updated_at,
          'fechaEliminacion'=>isset($agencia->deleted_at) ?(string)$agencia->deteted_at: null,
          'links'=>[
              [
                  'rel'=>'self',
                  'href'=> route('agencias.show',$agencia->id),
              ],
              [
                  'rel'=>'agencias.alojamientos',
                  'href'=> route('agencias.alojamientos.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.fechas',
                  'href'=> route('agencias.fechas.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.coches',
                  'href'=> route('agencias.coches.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.seguros',
                  'href'=> route('agencias.seguros.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.reservas',
                  'href'=> route('agencias.reservas.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.tipo_coches',
                  'href'=> route('agencias.tipo_coches.index',$agencia->id),
              ],
              [
                  'rel'=>'agencias.alojamientos.generar',
                  'href'=> route('agencias.alojamientos.generar',$agencia->id),
              ],
          ],
        ];
    }
}
