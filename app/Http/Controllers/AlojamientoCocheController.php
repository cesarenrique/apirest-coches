<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Alojamiento;
use App\TipoCoche;
use App\Coche;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class AlojamientoCocheController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alojamiento_id)
    {
        $alojamiento=Alojamiento::findOrFail($alojamiento_id);
        $tipo=TipoCoche::findOrFail($alojamiento->tipo_Coche_id);
        $Cochees=$tipo->Coches;
        return $this->showAll($Cochees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$Coche_id)
    {

      $alojamiento=Alojamiento::findOrFail($id);
      $tipo=TipoCoche::findOrFail($alojamiento->tipo_Coche_id);
      $Coche=Coche::findOrFail($Coche_id);
      if($tipo->id!=$Coche->tipo_Coche_id){
        return $this->errorResponse('La Coche no se corresponde con el tipo',404);
      }
      return $this->showOne($Coche);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fechas(Request $request,$alojamiento_id)
    {
        $rules=[
          'fecha_desde'=> 'required',
          'fecha_hasta'=> 'required',
        ];

        $this->validate($request,$rules);
        $fecha_desde=(string)$request->fecha_desde;
        if(!(preg_match_all('/^(\d{4})(-)(0[1-9]|1[0-2])(-)([0-2][0-9]|3[0-1])$/',$fecha_desde))){
           return $this->errorResponse("la fecha tiene que ser formato yyyy-MM-dd y una fecha valida",401);
        }

        $fecha_hasta=(string)$request->fecha_hasta;
        if(!(preg_match_all('/^(\d{4})(-)(0[1-9]|1[0-2])(-)([0-2][0-9]|3[0-1])$/',$fecha_hasta))){
           return $this->errorResponse("la fecha tiene que ser formato yyyy-MM-dd y una fecha valida",401);
        }
        $fecha_desde_porcion=explode("-",$fecha_desde);
        $fecha_hasta_porcion=explode("-",$fecha_hasta);

        $fechaDesde=Carbon::createFromDate($fecha_desde_porcion[0],$fecha_desde_porcion[1],$fecha_desde_porcion[2]);
        $fechaHasta=Carbon::createFromDate($fecha_hasta_porcion[0],$fecha_hasta_porcion[1],$fecha_hasta_porcion[2]);

        if($fechaHasta<$fechaDesde){
           return $this->errorResponse("fecha_desde no puede ser mayor fecha_hasta",404);
        }

        $dias=$fechadesde->diffInDays($fechaHasta);
        $alojamiento=Alojamiento::findOrFail($alojamiento_id);
        $tipo=TipoCoche::findOrFail($alojamiento->tipo_Coche_id);
        $Cochees=$tipo->Coches;
        $collection=new Collection();
        foreach($Cochees as $Coche){
          $cantidad=DB::select("select count(f.id) 'cantidad' from fechas f  Coches h
           where f.Hotel_id=h.Agencia_id
           and f.Hotel_id =".$Coche->Hotel_id." and '".$fechadesde."'<=f.abierto
           and f.abierto<= '".$fechaHasta."' and h.id =".$Coche->id);
           $cantidad2=select("select count(f.id) 'cantidad' from fechas f , Coches h,reservas r
           where f.Hotel_id=h.Agencia_id
           and f.Hotel_id =".$Coche->Hotel_id." and '".$fechadesde."'<=f.abierto and r.Coche_id =h.id
           and f.id=r.Fecha_id
           and f.abierto<= '".$fechaHasta."' and h.id =".$Coche->id);
          if($dias==($cantidad[0]->cantidad-$cantidad2[0]->cantidad)){
            $collection->push($Coche);
          }
        }
        return $this->showAll($collection);
    }
}
