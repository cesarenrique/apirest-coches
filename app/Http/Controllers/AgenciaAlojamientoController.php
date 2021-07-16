<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use App\Agencia;
use App\Alojamiento;
use App\Seguro;
use Illuminate\Support\Collection;

class AgenciaAlojamientoController extends ApiController
{

    public function __construct(){
      $this->middleware('client.credentials');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *   path="/Agencias/{Agencia_id}/alojamientos",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Get Agenciaes table Alojamientos",
     *		  @SWG\Parameter(
     *          name="Agencia_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="un numero id"
     *      ),
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *   @SWG\Response(response=200, description="successful operation",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Alojamiento")
     *     )
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(response=500, description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   ),
     *)
     *
     **/
    public function index($Agencia_id)
    {
      $Agencia=Agencia::findOrFail($Agencia_id);
      $seguros=$Agencia->seguros;
      $previo=collect();
      foreach($seguros as $seguro){
        $previo->push($seguro->alojamientos);
      }
      $alojamientos=$previo->collapse();
      return $this->showAll($alojamientos);
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
    public function show($Agencia_id,$id)
    {
        $Agencia=Agencia::findOrFail($Agencia_id);
        $alojamiento=Alojamiento::findOrFail($id);
        $seguro=Seguro::findOrFail($alojamiento->Seguro_id);
        if($Agencia->id!=$seguro->Agencia_id){
            return $this->errorResponse("Agencia debe coincidir con Alojamiento del mismo sitio",404);
        }
        return $this->showOne($alojamiento);
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
     * Genera tabla de precios
     *
     * @return \Illuminate\Http\Response
     */
    public function generar($Agencia_id)
    {
        $Agencia=Agencia::findOrFail($Agencia_id);
        $alojamientos=DB::select("select p.id 'Seguro_id',th.id 'tipo_coche_id',t.id 'Temporada_id', p.Agencia_id
            from seguros p, tipo_coches th, temporadas t
              where p.Agencia_id =t.Agencia_id and th.Agencia_id=t.Agencia_id and p.Agencia_id =th.Agencia_id  and p.Agencia_id=".$Agencia->id);



        foreach ($alojamientos as $alojamiento) {
            $cantidad=DB::select("select count(*) as 'cantidad' from alojamientos a where a.Seguro_id=".$alojamiento->Seguro_id." and a.tipo_coche_id=".$alojamiento->tipo_coche_id." and a.Temporada_id=".$alojamiento->Temporada_id." and a.deleted_at is null");

            if($cantidad[0]->cantidad==0){
                $cantidad=DB::select("select count(*) as 'cantidad' from alojamientos a where a.Seguro_id=".$alojamiento->Seguro_id." and a.tipo_coche_id=".$alojamiento->tipo_coche_id." and a.Temporada_id=".$alojamiento->Temporada_id);

                $precio="99.99";
                if($cantidad[0]->cantidad==0){


                  DB::statement(' Insert into alojamientos (Seguro_id,tipo_coche_id,Temporada_id,precio) values ('.$alojamiento->Seguro_id.','.$alojamiento->tipo_coche_id.','.$alojamiento->Temporada_id.','.$precio.')');

                }else{
                  $cantidad=DB::select("select a.id from alojamientos a where a.Seguro_id=".$alojamiento->Seguro_id." and a.tipo_coche_id=".$alojamiento->tipo_coche_id." and a.Temporada_id=".$alojamiento->Temporada_id);
                  Alojamiento::withTrashed()->find($cantidad[0]->id)->restore();
                  $encontrado=Alojamiento::findOrFail($cantidad[0]->id);
                  $encontrado->precio=$precio;
                  $encontrado->save();
                }
            }
         }
         return response()->json(['data'=>'tabla precios actualizada'],200);
    }


    public function descriptivo($Agencia_id){
       $Agencia=Agencia::findOrFail($Agencia_id);
       $alojamientos=DB::select("select a.id 'identificador', precio 'precio', p2.tipo 'seguro',
          th.tipo 'tipoCoche', t.tipo 'temporada', t.fecha_desde, t.fecha_hasta
          from alojamientos a, seguros p2 ,tipo_coches th ,temporadas t
          where  p2.Agencia_id=th.Agencia_id  and p2.Agencia_id =t.Agencia_id
          and a.Seguro_id =p2.id
          and a.tipo_coche_id =th.id and t.id =a.Temporada_id
          and p2.Agencia_id =".$Agencia->id );
       $collection = new Collection();
       foreach($alojamientos as $alojamiento){
          $collection->push($alojamiento);
       }
       return $this->showAll2($collection);
    }
}
