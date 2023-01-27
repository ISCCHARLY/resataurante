<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=DB::select('select (select count(id_menu) from carta where carta.id_menu=menus.id_menu) isdelete ,id_menu,nombre,descripcion,created_at,updated_at from menus');
        $mensage="";
        return view('admin.menu',compact('menus','mensage'));
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
       // dd("llega");

  if($request->ajax())
        {
      // $nombre="".strtoupper($request->get('nombre')."";
        $existe=DB::selectOne('select menus.nombre from menus where menus.nombre="'.$request->get('nombre').'"');
            if ($existe==null)
            {
            
           
        $datos = array(
            'nombre' =>strtoupper($request->get('nombre')),
            'descripcion'=>strtoupper($request->get('descripcion'))
            );

       

        Menu::create($datos);
         $menus=DB::selectOne('select menus.id_menu from menus where menus.nombre="'.$request->nombre.'"');
         $mensage="MENU AGREGADO CORRECTAMENTE";
    return response()->json([
            'mensaje'=>'REGISTRO EXITOSO',
            'opcion'=>1,
           'objeto'=>' <div class="col-md-4" style="margin-top:2em;" id="div'.$menus->id_menu.'">
      
 
         <div class="card text-white bg-dark" style="border:solid gray 2px;" >
            <div class="card-header"><strong>'.strtoupper($request->nombre).'</strong></div>
            <div class="card-body">
                <h6 class="card-title"><strong>Descripcion:</strong></h6>
                <p class="card-text">'.strtoupper($request->descripcion).'</p>
            </div>
            <div class="card-footer">

             <button type="button" class="btn btn-success ver"  data-toggle="tooltip" data-placement="top" title="Ver Carta"
      style="border-radius: 50%;"  value="'.$menus->id_menu.'">
     <i class="material-icons">
view_list
</i>
</button>
          
        <button type="button" class="btn btn-warning editar" data-toggle="tooltip" data-placement="top" title="Editar"
        style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" value="'.$request->get("nombre").'" descripcion="'.$request->get("descripcion").'" idd="'.$menus->id_menu.'">
        <i class="material-icons">
          create
        </i>
      </button >   
      <button type="button" class="btn btn-danger elimina " data-toggle="tooltip" data-placement="top" title="Eliminar"
      style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" value="'.$menus->id_menu.'">
      <i class="material-icons">
      delete_forever
      </i>
      </button > 
        </div>
        </div>
       </div>',
       'mensaje'=>'AGREGADO CORRECTAMENTE '

           
           ]);
        
        //return view('admin.menu',compact('menus','mensage'));
        }
        else
        {
            return response()->json([
           'mensaje'=>'YA EXISTE UN REGISTRO CON ESE NOMBRE',
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
    public function update(Request $request)
    {
        if ($request->ajax()) 
        {

            $existe=DB::selectOne('select menus.nombre from menus where menus.nombre="'.$request->get('enombre').'" and id_menu!='.$request->get('id'));
            if($existe==null)
            {

                $datos = array(
                'nombre' =>strtoupper($request->get('enombre')) ,
                'descripcion'=>strtoupper($request->get('edescripcion'))
                 );
                Menu::find($request->get('id'))->update($datos);

                return response()->json([
                'mensaje'=>'MODIFICACION EXITOSA',
                'opcion'=>1,
                'nombre'=>strtoupper($request->get('enombre')),
                'descripcion'=>strtoupper($request->get('edescripcion'))
           
                ]);
             }
             else
             {

                $existe2=DB::selectOne('select menus.descripcion from menus where menus.descripcion="'.$request->get('edescripcion').'"');
                if($existe2==null)
                {
                    $datos2 = array(
                'descripcion'=>strtoupper($request->get('edescripcion'))
                 );
                Menu::find($request->get('id'))->update($datos2);

                 return response()->json([
                'mensaje'=>'MODIFICACION EXITOSA ddd',
                'opcion'=>1,
                'nombre'=>strtoupper($request->get('enombre')),
                'descripcion'=>strtoupper($request->get('edescripcion'))
           
           
                ]);
                }else
                {
                    return response()->json([
                'mensaje'=>'YA EXISTE UN REGISTRO CON LOS MISMOS DATOS',
                'opcion'=>2
           
                ]);
                }

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

  if($request->ajax())
        {


          $existe=DB::selectOne('select carta.id_menu dato from carta where id_menu='.$request->get('eliid').'');

            if ($existe==null) 

            {
                 Menu::destroy($request->get('eliid'));
                 return response()->json([
               // 'isdelete'=>$request->get('eliid')]);
                    'isdelete'=>1]);
            }
            else
            {

                  //  Menu::destroy($request->get('eliid'));
                  // $menus=DB::select('select*from menus');
                    //$mensage="ELEMENTO ELIMINADO";
                     return response()->json([
                'isdelete'=>0]);
            }
      
       // return view('admin.menu',compact('menus','mensage'));
        
        }
    }
}
