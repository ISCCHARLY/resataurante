<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Mesas;
class MesasController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas=DB::select("select*from mesas");
       
        return view('admin.Agregarmesas',compact('mesas'));
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
        if($request->ajax())
        {
        $numero_de_mesas=DB::selectOne("select count(mesas.id_mesa)numero from mesas");
        $numero=$numero_de_mesas->numero+1;
        
           $datos=array(


                'numero'=>$numero,
                'estado'=>0    
                
                
               );
             Mesas::create($datos);
        
             return response()->json([
          
            'Mensage'=>'MESA CREADA CORRECTAMENTE',
            'objeto'=>'<div class="col-md-3" style="margin-top:2em;" id="card'.$numero.'">
                      <div class="card text-white bg-dark" style="border:solid red 2px;" >
                        <div class="card-header">MESA:</div>
                    <div class="card-body">
                     <h5 class="card-title text-center" style="font-size:36px;">'.$numero.'</h5>
                      <p class="card-text"></p>
                     </div>
                 <div class="card-footer ">
                        <button type="button" class="btn btn-danger elimina " data-toggle="tooltip" data-placement="top" title="Eliminar"
                        style="border-radius: 50%;" data-toggle="modal" data-target="" value="'.$numero.'">
                        <i class="material-icons">
                        delete_forever
                        </i>
                        </button > 

                 </div>
                </div>
             </div>'
             ]);


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
        $numeroactua=DB::selectOne("select count(mesas.id_mesa)numero from mesas"); 
        DB::table('mesas')->truncate();

        for ($i=0; $i <$numeroactua->numero-1 ; $i++) { 
            # code...
        
         $datos=array(


                'numero'=>$i+1,
                'estado'=>0    
                
                
               );
             Mesas::create($datos);
        
       }
               

    }
    }
     public function mesacue()
    {
       

    }
}
