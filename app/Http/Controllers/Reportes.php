<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cuentas;
use App\Ventas;
use App\meseros;
use App\carta;


class Reportes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


 $dia=DATE('d');
    $mes=DATE('m');
    $año=DATE('Y');

$fecha1=$año.'/'.$mes.'/'.$dia;
$mensaje=' HOY: '.$dia.'/'.$mes.'/'.$año;
        
$total_total=0;
$totale_e=0;
$totalf_f=0;


$totale=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'" 
    and cuentas.created_at<="'.$fecha1.' 23:59:59" and cuentas.forma_pago=1');



$totalf=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'" 
    and cuentas.created_at<="'.$fecha1.' 23:59:59" and cuentas.forma_pago=2');



foreach ($totale as $t) 
{
    //dd($t->total);
   $totale_e=$totale_e+$t->total;
}

foreach ($totalf as $t) 
{
    //dd($t->total);
   $totalf_f=$totalf_f+$t->total;
}

$total_total=$totalf_f+$totale_e;

            $reportecuentas=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total,cuentas.forma_pago from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'"

                and cuentas.created_at<="'.$fecha1.' 23:59:59" and cuentas.estado=1');

//dd($reportecuentas);
 


 return view('admin.ReporteGeneral',compact('reportecuentas','total_total','mensaje','totale_e','totalf_f'));

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
     public function porfechas(Request $request)
    {
        //dd($request);

$dia=substr($request->desde,0,2);
$mes=substr($request->desde,3,2);
$año=substr($request->desde,6,4);

$fecha1=$año.'/'.$mes.'/'.$dia;
$mensaje=' DESDE: '.$dia.'/'.$mes.'/'.$año;


if($request->hasta=='')
{
    $dia=DATE('d');
    $mes=DATE('m');
    $año=DATE('Y');
    $fecha2=$año.'/'.$mes.'/'.$dia;

    $mensaje=$mensaje.'';

}
else
{
    $dia=substr($request->hasta,0,2);
    $mes=substr($request->hasta,3,2);
    $año=substr($request->hasta,6,4);
    $fecha2=$año.'/'.$mes.'/'.$dia;

    $mensaje=$mensaje.' HASTA: '.$dia.'/'.$mes.'/'.$año;

}


$total_total=0;
$totale_e=0;
$totalf_f=0;


$totale=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'" 
    and cuentas.created_at<="'.$fecha2.' 23:59:59" and cuentas.forma_pago=1');



$totalf=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'" 
    and cuentas.created_at<="'.$fecha2.' 23:59:59" and cuentas.forma_pago=2');




foreach ($totale as $t) 
{
    //dd($t->total);
   $totale_e=$totale_e+$t->total;
}

foreach ($totalf as $t) 
{
    //dd($t->total);
   $totalf_f=$totalf_f+$t->total;
}

$total_total=$totalf_f+$totale_e;


            $reportecuentas=DB::select('select meseros.nombre,meseros.ap,meseros.am,cuentas.id_cuenta,cuentas.id_mesa, convert(IFNULL((select sum(precio_v*cantidad)from ventas where id_cuenta=cuentas.id_cuenta),0),decimal(18,2)) total,cuentas.forma_pago from cuentas,meseros where meseros.id_mesero=cuentas.id_mesero and cuentas.created_at>="'.$fecha1.'"

                and cuentas.created_at<="'.$fecha2.' 23:59:59" and cuentas.estado=1');

//dd($reportecuentas);



 return view('admin.ReporteGeneral',compact('reportecuentas','total_total','mensaje','totale_e','totalf_f'));








    }

  
     
     public function DetalleCuentaajax(Request $request)
    {
        if ($request->ajax()){
         
            
$productos=DB::select('select  ventas.cantidad,convert((ventas.cantidad*ventas.precio_v),decimal(18,2))total,carta.nombre ,carta.medida tipocarta from ventas,carta
where
carta.id_carta =ventas.id_carta
and id_cuenta='.$request->get('id_cuenta').'
 order by carta.medida asc');


$platillos ='';
$bebidas ='';
$packetes ='';
foreach ($productos as $key) 
{
    if($key->tipocarta==1)
    {
    $platillos=$platillos.'<tr>
        <td class="col-md-2">'.$key->cantidad.'</td>
        <td class="col-md-8">'.$key->nombre.'</td>
        <td class="col-md-2">'.$key->total.'</td>
        </tr>';
    }
    if($key->tipocarta==2)
    {
    $bebidas=$bebidas.'<tr>
        <td class="col-md-2">'.$key->cantidad.'</td>
        <td class="col-md-8">'.$key->nombre.'</td>
        <td class="col-md-2">'.$key->total.'</td>
        </tr>';
    }
    if($key->tipocarta==3)
    {
    $packetes=$packetes.'<tr>
        <td class="col-md-2">'.$key->cantidad.'</td>
        <td class="col-md-8">'.$key->nombre.'</td>
        <td class="col-md-2">'.$key->total.'</td>
        </tr>';
    }
}




            return response()->json([
                'repuesta'=>$platillos,
                'repuesta2'=>$bebidas,
                'repuesta3'=>$packetes
            ]);
            
        }



    }
}
