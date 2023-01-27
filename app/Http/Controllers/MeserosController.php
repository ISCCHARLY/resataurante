<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Meseros;
class MeserosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meseros=DB::select('select (select count(id_mesero) from cuentas where cuentas.id_mesero=meseros.id_mesero) isdelete,id_mesero,nombre,ap,am,telefono,estado,ip,created_at,updated_at from meseros');
        return view('admin.meseros',compact('meseros'));
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

      public function estado(Request $request,$id)
    {
        if($request->ajax())
        {
            $mesero=DB::selectOne('select*from meseros where meseros.id_mesero='.$id.'');

            $estado=0;
            if ($mesero->estado==1) 
            {
                $estado=0;
            }
            else{
                $estado=1;
            }

            $datos = array(
            'estado' =>$estado 
            );
         Meseros::find($id)->update($datos);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {


             $existe=DB::selectOne('select*from meseros where meseros.nombre="'.$request->get("nombre").'"
                and meseros.ap="'.$request->get("ap").'" and meseros.am="'.$request->get("am").'"');
             if($existe==null)
             {

            $datos=array(
                'nombre'=>strtoupper($request->get('nombre')),
                'ap'=>strtoupper($request->get('ap')),
                'am'=>strtoupper($request->get('am')),
                'telefono'=>$request->get('telefono'),
                'estado'=>1,
                'ip'=>$request->get('ip')    
                
                
               );
             Meseros::create($datos);

             $nuevo=DB::selectOne('select*from meseros where meseros.nombre="'.$request->get("nombre").'"
                and meseros.ap="'.$request->get("ap").'" and meseros.am="'.$request->get("am").'"');
        
             return response()->json([
          
            'Mensage'=>'MESERO AGREGADO CORRECTAMENTE',
            'objeto'=>'
                <tr id="tr'.$nuevo->id_mesero.'">
      <td id="'.$nuevo->id_mesero.'tnombre" style="text-transform:uppercase;">'.$nuevo->nombre.'</td>
      <td id="'.$nuevo->id_mesero.'tao" style="text-transform:uppercase;">'.$nuevo->ap.'</td>
      <td id="'.$nuevo->id_mesero.'tam" style="text-transform:uppercase;">'.$nuevo->am.'</td>
      <td id="'.$nuevo->id_mesero.'ttelofono" style="text-transform:uppercase;">'.$nuevo->telefono.'</td>
      <td >
         <button type="button" class="btn btn-primary estado" value="'.$nuevo->id_mesero.'" estado="'.$nuevo->estado.'" data-toggle="tooltip" data-placement="top" title="Cambiar"
                    style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
              
                    <i class="material-icons" style="color:white;" id="'.$nuevo->estado.'" >
                    visibility
                    </i>
                  
                </button>

      </td>
      <td>
        <button type="button" class="btn btn-warning editar" value="'.$nuevo->id_mesero.'"data-toggle="tooltip" data-placement="top" title="Editar"
            style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
            <i class="material-icons">
            create
            </i>
        </button >  
      </td>
      <td>
        
        <button type="button" class="btn btn-danger elimina " value="'.$nuevo->id_mesero.'" data-toggle="tooltip" data-placement="top" title="Eliminar"
            style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
            <i class="material-icons">
            delete_forever
            </i>
        </button >

      </td>

    </tr>
            ','opcion'=>1
            
            ]);
        
        }
             
             else
             {
                return response()->json([
          
            'Mensage'=>'YA EXISTE UN REGISTRO CON ESOS DATOS',
            'objeto'=>'',
            'opcion'=>2
            
            ]);
             }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax())
        {

            $mesero=DB::selectOne('select*from meseros where meseros.id_mesero='.$request->get("id").'');

             return response()->json([
          
            'nombre'=>$mesero->nombre,
            'ap'=>$mesero->ap,
            'am'=>$mesero->am,
            'telefono'=>$mesero->telefono,
            'ip'=>$mesero->ip,
         
            
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax())
         {

             $existe=DB::selectOne('select*from meseros where meseros.nombre="'.$request->get("nombree").'" and meseros.ap="'.$request->get("ape").'" and meseros.am="'.$request->get("ame").'" and id_mesero!='.$request->get("ide").'');
             if($existe==null)
             {


            $datos = array(
            'nombre' =>strtoupper($request->get('nombree')),
            'ap'=>strtoupper($request->get('ape')), 
            'am'=>strtoupper($request->get('ame')), 
            'telefono'=>$request->get('telefonoe'),
            'ip'=>$request->get('ipe'),

            );

       

         Meseros::find($request->get('ide'))->update($datos);
             return response()->json([
            'nombre'=>strtoupper($request->get('nombree')),
            'ap'=>strtoupper($request->get('ape')),
            'am'=>strtoupper($request->get('ame')),
            'telefono'=>strtoupper($request->get('telefonoe')),
            'opcion'=>1
            ]);
         }
         else
         {
             return response()->json([
            'mensaje'=>'YA EXISTE UN REGISTRO CON ESOS DATOS',
            'opcion'=>2
            ]);
         }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
         {
            Meseros::destroy($request->get('id'));
             return response()->json([
          
            'mensaje'=>'ELIMINADO',
         
            
            ]);
        }
    }
}
