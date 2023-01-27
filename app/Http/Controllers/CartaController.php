<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Controller;
use App\Carta;

class CartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carta=DB::select('select id_carta,nombre,descripcion,precio,img,calificacion,estado,id_menu,tipo_carta,created_at,updated_at,precio_entrada,precio_publico,medida,cantidad,stock,(select count(id_carta) from ventas where ventas.id_carta=carta.id_carta) isdelete from carta');
        $mensaje="";
        $color=1;
        return view('admin.carta',compact('carta','mensaje','color'));

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
       $existe=DB::selectOne('select carta.nombre from carta where carta.nombre="'.$request->get('nombre').'"');
//dd($request);
       if ($existe==null)
        {
        
           # code...
           //$imgnom="".$request->nombre;
        
            $datos = array(
                'nombre' => strtoupper($request->get('nombre')), 
                'precio_entrada' => $request->get('descripcion') , //precio entrada
                'precio_publico' => $request->get('precio') , 
               
                'medida'=>$request->get('tipo'), //tipo producto
                'estado'=> 1,
                'id_menu'=>  $request->get('id_menu'),
                'cantidad'=>$request->get('cantidad'),
                'stock'=>$request->get('stock'));

            Carta::create($datos);

            $consulta=DB::selectOne('select carta.id_carta from carta where carta.nombre="'.$request->get('nombre').'" and carta.id_menu='.$request->get('id_menu').'');
           
                $color=1;
                $notification="AGREGADO CORRECTAMENTE";
                Session::put('notification',$notification);
                Session::put('colormen',$color);
       
                return redirect("/Carta/".$request->get('id_menu')."");
        }
        else
        {
            $color=2;
                $notification="YA EXISTE UN REGISTRO CON EL MISMO NOMBRE";
                Session::put('notification',$notification);
                Session::put('colormen',$color);
       
                return redirect("/Carta/".$request->get('id_menu')."");
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
        //dd("listo");
        //$carta=DB::select("select*from carta  where carta.id_menu=".$id."");

        $carta=DB::select("select id_carta,nombre,descripcion,precio,img,calificacion,estado,id_menu,tipo_carta,created_at,updated_at,precio_entrada,precio_publico,medida,cantidad,stock,(select count(id_carta) from ventas where ventas.id_carta=carta.id_carta) isdelete from carta  where carta.id_menu=".$id."");
        //dd($carta);
        $id_menu=$id;
        $mensaje="";
         return view('admin.cartaadmin',compact('carta','mensaje','id_menu'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edita(Request $request )
    {
        
  if($request->ajax())
        {


           $consulta=DB::selectOne("select*from carta where carta.id_carta=".$request->id."");

         // dd($consulta);
             return response()->json([
          
            'id'=>$request->id,
            'nombre'=>$consulta->nombre,
            'precio_entrada'=>$consulta->precio_entrada,
            'precio_publico'=>$consulta->precio_publico,
            'existencias'=>$consulta->cantidad,
            'tipoe'=>$consulta->medida,
            'stocke'=>$consulta->stock]);
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
       // dd($request);
        

 $consulta=DB::selectOne('select*from carta where carta.id_carta='.$request->get("id_carta").'');
          
          $datos = array(
                'nombre' => strtoupper($request->get('nombre')), 
                'precio_entrada' => $request->get('descripcion') , 
                'precio_publico' => $request->get('precio') , 
              
                'cantidad'=>$request->get('existencias'),
                'estado'=> 1,
                'medida'=>$request->get('tipo'),
                'id_menu'=>  $request->get('id_menu'),
                'stock'=>$request->get('stocke'));


$notification="MODIFICACION EXITOSA";
    Session::put('notification',$notification);
    $color=1;
     Session::put('colormen',$color);  
           Carta::find($request->get("id_carta"))->update($datos);
             return redirect("/Carta/".$request->get('id_menu')."");


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

            Carta::destroy($request->get('id'));
             return response()->json([
            'mensaje'=>'ELIMINADO' ]);
        }
        
    }
    public function estado(Request $request )
    {

  if($request->ajax())
        {
$es=0;
            $estado=DB::selectOne('select carta.estado from carta where carta.id_carta='.$request->id.'');
            if($estado->estado==1)
            {
                $es=0;
            }
            else{
                $es=1;
            }

        $datos = array(
            'estado' =>$es
            
            );

         Carta::find($request->id)->update($datos);  
        }
    }
}
