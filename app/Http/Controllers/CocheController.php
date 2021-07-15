<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Coche;
use App\TipoCoche;

class CocheController extends ApiController
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
     *   path="/Coches",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Get Cochees",
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
     *         @SWG\Items(ref="#definitions/Coche")
     *     )
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=500, description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   ),
     *)
     *
     **/
    public function index()
    {
        $Coche=Coche::all();
        return $this->showAll($Coche);
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

     /**
     * @SWG\Post(
     *   path="/Coches",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Create Coche for store",
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *		  @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(
     *            @SWG\Property(property="numero", type="string", example="120"),
     *            @SWG\Property(property="Agencia_id", type="integer", example=1),
     *            @SWG\Property(property="tipo_Coches", type="integer", example=1)
     *          ),
     *      ),
     *   @SWG\Response(
     *      response=201,
     *      description="Create successful operation",
     *      @SWG\Schema(ref="#definitions/Coche")
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(response=406, description="Not Aceptable",
     *      @SWG\Schema(ref="#definitions/Errors406")
     *   ),
     *   @SWG\Response(
     *      response=500,
     *      description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   )
     *)
     *
     **/
    public function store(Request $request)
    {
        $rules=[
          'numero'=> 'required',
          'Agencia_id'=> 'required|exists:Agencias,id',
          'tipo_coche_id'=> 'required|exists:tipo_Coches,id',
        ];

        $this->validate($request,$rules);
        $campos=$request->all();
        $tipohab=TipoCoche::findOrFail($request->tipo_Coche_id);
        if($tipohab->Agencia_id!=$request->Agencia_id){
           return $this->errorResponse('El id de Agencia del tipo de habitación
           debe ser mismo Agencia que se desea crear la habitación',406);
        }
        $Coche=Coche::create($campos);
        return $this->showOne($Coche,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * @SWG\Get(
     *   path="/Coches/{Coche_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Get Coche",
     *		  @SWG\Parameter(
     *          name="Coche_id",
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
     *         @SWG\Items(ref="#definitions/Coche")
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
    public function show($id)
    {
        $Coche=Coche::findOrFail($id);
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

     /**
     * @SWG\Put(
     *   path="/Coches/{Coche_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update Coche",
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *		  @SWG\Parameter(
     *          name="Coche_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="un numero id"
     *      ),
     *		  @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(
     *            @SWG\Property(property="numero", type="string", example="120"),
     *            @SWG\Property(property="Agencia_id", type="integer", example=1),
     *            @SWG\Property(property="tipo_Coches", type="integer", example=1),
     *          ),
     *      ),
     *   @SWG\Response(
     *      response=200,
     *      description="Create successful operation",
     *      @SWG\Schema(ref="#definitions/Coche")
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(response=406, description="Not Aceptable",
     *      @SWG\Schema(ref="#definitions/Errors406")
     *   ),
     *   @SWG\Response(
     *      response=500,
     *      description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   )
     *)
     *
     **/
    public function update(Request $request, $id)
    {
        $Coche=Coche::findOrFail($id);
        $rules=[
          'Agencia_id'=> 'exists:Agencias,id',
          'tipo_Coches'=> 'exists:tipo_Coches,id',
        ];

        $this->validate($request,$rules);


        if($request->has('numero')){
          $Coche->numero=$request->numero;
        }

        if($request->has('Agencia_id') && $request->has('tipo_Coche_id')){
            $tipohab=TipoCoche::findOrFail($request->tipo_Coche_id);
            if($tipohab->Agencia_id!=$request->Agencia_id){
               return $this->errorResponse('El id de Agencia del tipo de habitación debe ser mismo Agencia que se desea crear la habitación',401);
            }
            $Coche->Agencia_id=$request->Agencia_id;
            $Coche->tipo_Coche_id=$request->tipo_Coche_id;
        }else if($request->has('Agencia_id') && !$request->has('tipo_Coche_id')){

            $tipohab=TipoCoche::findOrFail($Coche->tipo_Coche_id);
            if($tipohab->Agencia_id!=$request->Agencia_id){
               return $this->errorResponse('El id de Agencia del tipo de habitación debe ser mismo Agencia que se desea crear la habitación',401);
            }
            //este caso no pasara nunca con configuracion actual
            $Coche->Agencia_id=$request->Agencia_id;
        }else if(!$request->has('Agencia_id') && $request->has('tipo_Coche_id')){
            $tipohab=TipoCoche::findOrFail($request->tipo_Coche_id);
            if($tipohab->Agencia_id!=$Coche->Agencia_id){
               return $this->errorResponse('El id de Agencia del tipo de habitación debe ser mismo Agencia que se desea crear la habitación',401);
            }
            $Coche->tipo_Coche_id=$request->tipo_Coche_id;
        }

        if(!$Coche->isDirty()){
           return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
        }

        $Coche->save();
        return $this->showOne($Coche);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Delete(
     *   path="/Coches/{Coche_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Delete Coche",
     *		  @SWG\Parameter(
     *          name="Coche_id",
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
     *         @SWG\Items(ref="#definitions/Coche")
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
    public function destroy($id)
    {
      $Coche=Coche::findOrFail($id);
      $Coche->delete();
      return $this->showOne($Coche);
    }
}
