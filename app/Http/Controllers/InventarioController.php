<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Inventario;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventario=DB::select('select* from inventario');

        return View('admin.Inventario',compact('inventario'));
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
        if ($request->ajax())
         {

            $datos = array(
             'producto' =>strtoupper($request->get('producto')) ,
             'cantidad'=>$request->get('cantidad'),
             'minimo'=>$request->get('minimo'),
             'medida'=>$request->get('medida')
             );
            Inventario::create($datos);

            $id=DB::selectOne('select* from inventario where inventario.producto="'.$request->get('producto').'"');
           if ($id->medida==1) 
           {
               $cantidadl="Pz.";
           }
           if ($id->medida==2) 
           {
               $cantidadl="Kg.";
           }
           if ($id->medida==3) 
           {
               $cantidadl="L.";
           }
           return response()->json([
                'mensaje'=>'PRODUCTO AGREGADO CORRECTAMENTE',
                'opcion'=>1,
                'objeto'=>'
                <tr id="tr'.$id->id_inventario.'">
                            <td>'.$id->producto.'</td>
                            <td>'.$id->cantidad.' '.$cantidadl.'</td>
                            <td>'.$id->minimo.'</td>
                            <td>salida</td>
                            <td>entradas</td>
                            <td>modificar</td>
                            <td>eliminar</td>
                        </tr>'
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
        //
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
}
