<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cuentas;
use App\Ventas;
use App\Ordenes;


class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function Guarda(Request $request, $id)
    {
       

          //  dd($request->get('id_pago'));

        $datos = array(
                    
                    'estado'=>1,
                    'forma_pago'=>$request->get('id_pago')
                    );
        Cuentas::find($id)->update($datos);
        return redirect('/home');


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
     public function agrega(Request $request)
    {
        if($request->ajax())
        {





            $total_total=$request->get('total');

            $existe=DB::selectOne('select ventas.id_venta, ventas.cantidad,ventas.precio_v from ventas, cuentas, carta where ventas.id_cuenta=cuentas.id_cuenta
and ventas.id_carta=carta.id_carta 
and carta.id_carta='.$request->get('id_carta').'
and ventas.id_cuenta='.$request->get('id_cuenta').'');



            $ordenes = array(
                'idcuenta' =>$request->get('id_cuenta') ,
                'idcarta'=>$request->get('id_carta'),
                'cantidad'=>$request->get('cantidad'),
                'estatus'=>0
            );


           Ordenes::create($ordenes);


            if($existe==null)
            {
            $precio=DB::selectOne('select carta.precio_publico,carta.nombre from carta where carta.id_carta='.$request->get('id_carta').'');
            $datos = array(
                'id_cuenta' =>$request->get('id_cuenta') ,
                'id_carta'=>$request->get('id_carta'),
                'cantidad'=>$request->get('cantidad'),
                'precio_v'=>$precio->precio_publico, );
           Ventas::create($datos);
            $existe=DB::selectOne('select ventas.id_venta, ventas.cantidad,ventas.precio_v from ventas, cuentas, carta where ventas.id_cuenta=cuentas.id_cuenta
            and ventas.id_carta=carta.id_carta 
            and carta.id_carta='.$request->get('id_carta').'
            and ventas.id_cuenta='.$request->get('id_cuenta').'');

            $total=$precio->precio_publico*$request->get('cantidad');
            round($total,2);
            $total_total=$total_total+$total;
            round($total_total,2);
           
            return response()->json([
                'mensaje'=>'AGREGADO',
                'opcion'=>0,
                'total_total'=>$total_total,
                'objeto'=>'<tr id="tr'.$existe->id_venta.'">
                 <td id="td_cantidad_'.$existe->id_venta.'"scope="col-1">'.$request->get('cantidad').'</td>
                 <td scope="col-8">'.$precio->nombre.'</th>
                    <td scope="col-1">$ '.$precio->precio_publico.'</td>
                 <td id="td_total_'.$existe->id_venta.'"scope="col-1">$ '.$total.'</td>
                 <td scope="col-1" style="color:white">
                    
                    <a class="btn btn-danger elimina_uno"style="border-radius: 50%;" value="'.$existe->id_venta.'"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="material-icons">
                        delete_forever</i>
                    </a>
                    
                </td>
                </tr>',
                ]);

            }
            else
            {

                $total_total=$total_total+($request->get('cantidad')*$existe->precio_v);
                round($total_total,2);

                $cantidad=$request->get('cantidad');
                $cantidad=$cantidad+$existe->cantidad;
                $precio_v=$existe->precio_v*$cantidad;
                $datos = array(
                'cantidad'=>$cantidad);

                Ventas::find($existe->id_venta)->update($datos);

                return response()->json([
                'mensaje'=>'AGREGADO',
                'objeto'=>'',
                'opcion'=>1,
                'total_total'=>$total_total,
                'cantidad'=>$cantidad,
                'total'=>$precio_v,
                'id_venta'=>$existe->id_venta]);


            }
        }
    }
    public function crea(Request $request)
    {
        if($request->ajax())
        {

                if($request->get('id_mesero')==null){
                     return response()->json([
                'mensaje'=>'SELECCIONA EL PERSONAL',
                'opcion'=>1]);
                }
                else
                {
                $datos = array(
                    'id_mesero'=>$request->get('id_mesero'),
                    'id_mesa'=>$request->get('id_mesa'),
                    'forma_pago'=>0,
                    'estado'=>0,
                    'extra'=>0 );

                Cuentas::create($datos);

                $id_cuenta=DB::selectOne('select cuentas.id_cuenta from cuentas where cuentas.id_mesero='.$request->get('id_mesero').'
                     and cuentas.id_mesa='.$request->get('id_mesa').' and cuentas.estado=0');
                $mesero=DB::selectOne('select meseros.nombre,meseros.ap from meseros where meseros.id_mesero='.$request->get('id_mesero').'');

             return response()->json([
                'mensaje'=>'CUENTA CREADA CON EXITO',
                'id_mesa'=>$request->get('id_mesa'),
                'opcion'=>0,
                'objeto'=>'
                <div id="cardhijo'.$request->get('id_mesa').'">
                   
          <div class="card text-black bg-white"id="card'.$request->get('id_mesa').'" style="width: 251px; box-shadow: 5px 10px 18px #888888; border-top: 3px solid red;">       
                <div class="card-header"style=" background:white;" >Mesa:'.$request->get('id_mesa').'</div>
                <div class="card-body" id="body'.$request->get('id_mesa').'" style="height: 97px;">
                     <h5 class="card-title text-center" id="h5'.$request->get('id_mesa').'"style="font-size:19px;">'.$mesero->nombre.' '.$mesero->ap.'</h5>
                  
                      <p class="card-text"></p>
                </div>

                 <div class="card-footer text-right" id="card_footer_'.$request->get('id_mesa').'" style=" background:white;">
                  
                      <button type="button"id="b_cuenta_'.$id_cuenta->id_cuenta.'" class="btn btn-success cuenta " data-toggle="tooltip" data-placement="top" title="Cuenta"
                      style="border-radius: 50%;" data-toggle="modal" data-target="" value="'.$id_cuenta->id_cuenta.'">
                      <i class="material-icons">
                      description
                      </i>
                      </button > 

                      <button type="button"id="bcambio" class="btn btn-danger bcambiar " data-toggle="tooltip" data-placement="top" title="Cambiar"
                      style="border-radius: 50%;" data-toggle="modal_cambio" data-target="" value="'.$id_cuenta->id_cuenta.'">
                      <i class="material-icons">loop</i></button>

                    
                 </div>
            </div>
          </div> 
          '
                
           
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
     public function ver($id)
    {
        $carta=DB::select('select*from carta where estado=1');

        $id_cuenta=$id;
        $id_mesa=DB::selectOne('select cuentas.id_mesa from cuentas where cuentas.id_cuenta='.$id_cuenta.'');
        $id_mesa=$id_mesa->id_mesa; 
        $id_mesero=DB::selectOne('select cuentas.id_mesero from cuentas where cuentas.id_cuenta='.$id_cuenta.'');
        $id_mesero=$id_mesero->id_mesero;      


        $pedidos=DB::select('select carta.nombre,ventas.cantidad,ventas.precio_v,ventas.id_venta,ventas.id_venta total from carta,ventas where 
            ventas.id_carta=carta.id_carta and
            ventas.id_cuenta='.$id_cuenta.'');

        $total_total=0;
        foreach ($pedidos as $t)
         {
            $t->total=$t->precio_v*$t->cantidad;
            $total_total=$total_total+$t->total;
         }

        return view('admin.Cuenta_admin',compact('total_total','carta','id_cuenta','id_mesero','id_mesa','pedidos'));
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
    public function imprime($id)
    {
    
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
    public function eliminass(Request $request)
    {
       // dd($request);
        if ($request->ajax()){
         

            $menosorden =DB::selectOne('select sum(ordenes.cantidad) sumordenes from ordenes
INNER join ventas v on v.id_cuenta=ordenes.idcuenta and v.id_carta=idcarta
where v.id_venta='.$request->get('id_eli').' and ordenes.estatus=1');


            $datoss =DB::select('select  idorden from ordenes
INNER join ventas v on v.id_cuenta=ordenes.idcuenta and v.id_carta=idcarta
where v.id_venta='.$request->get('id_eli').' and ordenes.estatus=1');

            $totalorden=DB::selectOne('select cantidad,precio_v from ventas where id_venta='.$request->get('id_eli').'');

            if($menosorden->sumordenes==$totalorden->cantidad)
            {


            $total_total=$request->get('total');
            $menos=DB::selectOne('select *from ventas where ventas.id_venta='.$request->get('id_eli').'');
            
            $menos=$menos->cantidad*$menos->precio_v;
            round($menos,2);
            $total_total=$total_total-$menos;
            round($total_total,2);

            Ventas::destroy($request->get('id_eli'));

             foreach ($datoss as $dat ) 
                  {
                      $data = array(
                    'estatus'=>5
                    );
                      Ordenes::find($dat->idorden)->update($data);
                  }
            return response()->json([
                'mensaje'=>'ELIMINADO',
                'id_venta'=>$request->get('id_eli'),
                'total_total'=>$total_total,
                'eliminatodo'=>1]);
            }
            else 
            {
                 $total_total=$request->get('total');
                 $menos=DB::selectOne('select *from ventas where ventas.id_venta='.$request->get('id_eli').'');
            
                 $menos=$menosorden->sumordenes*$menos->precio_v;
                  round($menos,2);
                 $total_total=$total_total-$menos;
                  round($total_total,2);

                  foreach ($datoss as $dat ) 
                  {
                      $data = array(
                    'estatus'=>5
                    );
                      Ordenes::find($dat->idorden)->update($data);
                  }

                   $datos = array(
                    'cantidad'=>$menosorden->sumordenes
                    );

                   ventas::find($request->get('id_eli'))->update($datos);
                 $saber=DB::selectOne('select *from ventas where ventas.id_venta='.$request->get('id_eli').'');

                   if($saber->cantidad==0)
                   {
                     Ventas::destroy($request->get('id_eli'));
                   }




                 return response()->json([
                'mensaje'=>'ELIMINADO',
                'id_venta'=>$request->get('id_eli'),
                'total_total'=>$total_total,
                'eliminatodo'=>0]);


            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        cuentas::destroy($id);

        return redirect('/home');

    }

     public function cambia( Request $request )
    {
       
       //dd( $id=$request->get('id_cuentacambio'));
       // $total_total=$request->get('total');

            $datos = array(
                    
                   'id_mesa'=>$request->get('id_mesanu')
                    );
//dd($datos);
        Cuentas::find($request->get('id_cuentacambio'))->update($datos);
        return redirect('/home');




       // dd($request);

    }





     public function elimina(Request $request)
    {
       // dd($request);
        if ($request->ajax()){
         

            $menosorden =DB::selectOne('select sum(ordenes.cantidad) sumordenes from ordenes
INNER join ventas v on v.id_cuenta=ordenes.idcuenta and v.id_carta=idcarta
where v.id_venta='.$request->get('id_eli').' and ordenes.estatus=1 or ordenes.estatus=0');


            $datoss =DB::select('select  idorden from ordenes
INNER join ventas v on v.id_cuenta=ordenes.idcuenta and v.id_carta=idcarta
where v.id_venta='.$request->get('id_eli').' and ordenes.estatus=1 or ordenes.estatus=0');

            $totalorden=DB::selectOne('select cantidad,precio_v from ventas where id_venta='.$request->get('id_eli').'');

           
if($menosorden->sumordenes==0)
{
         return response()->json([
                'mensaje'=>'SIN ORDENES PARA ELIMINAR',
                'id_venta'=>0,
                'total_total'=>$request->get('total'),
                'eliminatodo'=>0,
                'error'=>1]);
}
else
{

            if ($menosorden->sumordenes==$totalorden->cantidad) 
            {
                
                 $total_total=$request->get('total');
            
                 $menos=$menosorden->sumordenes*$totalorden->precio_v;
                  round($menos,2);
                 $total_total=$total_total-$menos;
                  round($total_total,2);



                Ventas::destroy($request->get('id_eli'));
                foreach ($datoss as $dat ) 
                  {
                    $data = array(
                    'estatus'=>5
                    );
                      Ordenes::find($dat->idorden)->update($data);
                  }


                 return response()->json([
                'mensaje'=>'ELIMINADO',
                'id_venta'=>$request->get('id_eli'),
                'total_total'=>$total_total,
                'eliminatodo'=>1,
                'error'=>0]);
            }
            else
            {

                $total_total=$request->get('total');
                 $menos=DB::selectOne('select *from ventas where ventas.id_venta='.$request->get('id_eli').'');
            
                 $menos=$menosorden->sumordenes*$menos->precio_v;
                  round($menos,2);
                 $total_total=$total_total-$menos;
                  round($total_total,2);


                    foreach ($datoss as $dat ) 
                  {
                    $data = array(
                    'estatus'=>5
                    );
                      Ordenes::find($dat->idorden)->update($data);
                  }

                   $cantidadanterior=DB::selectOne('select cantidad from ventas where ventas.id_venta='.$request->get('id_eli').'');
                  $dataventa = array(
                    'cantidad'=>$cantidadanterior->cantidad-$menosorden->sumordenes
                  );


                      ventas::find($request->get('id_eli'))->update($dataventa);

                 $nuevo=DB::selectOne('select *from ventas where ventas.id_venta='.$request->get('id_eli').'');
                 $total=round($nuevo->cantidad*$nuevo->precio_v,2);
                 $nuevo=$nuevo->cantidad*$nuevo->precio_v;
                 

                 return response()->json([
                'mensaje'=>'ELIMINADO',
                'id_venta'=>$request->get('id_eli'),
                'total_total'=>$total_total,
                'eliminatodo'=>0,
                'error'=>0,
                'total'=>$total,
                'cantidad'=>$cantidadanterior->cantidad-$menosorden->sumordenes
                    ]);
            }

          




}
         


            
        }
    }

}
