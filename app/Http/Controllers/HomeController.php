<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Session;
use App\Mesas;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


$mesero= Auth::user()->email;

     // dd($errors->has('email'));

$iplocal=$_SERVER["SERVER_NAME"];

$ip=$_SERVER["REMOTE_ADDR"];
//dd($ip);
Session::put('IPHOST',$iplocal);
Session::put('IPCLIENT',$ip);

if($_SERVER["REMOTE_ADDR"]==$iplocal)
{
 $mesas=DB::select("select mesas.id_mesa id_cuenta,mesas.id_mesa,mesas.numero,mesas.id_mesa mesero, mesas.id_mesa estado from mesas ");

   foreach ($mesas as $mesa)
            {
                ////obtiene el id de la cuenta de acuerdo al la mesa seleccionada si la mesa esta desocupa
               $mesero=DB::selectOne('select cuentas.id_cuenta id_cuenta,cuentas.id_mesa,meseros.nombre,meseros.ap from meseros, cuentas where cuentas.estado=0 
                and cuentas.id_mesa='.$mesa->id_mesa.' 
                and cuentas.id_mesero=meseros.id_mesero');
               if ($mesero==null)
                {
                    $mesa->id_cuenta=0;
                      $mesa->mesero="";
                    $mesa->estado=0;
                }
                else
                {
                    $mesa->id_cuenta=$mesero->id_cuenta;
                    $mesa->mesero=$mesero->nombre." ".$mesero->ap;
                    $mesa->estado=1;
                }

                       
            
            }
}
else
{

    
 $mesas=DB::select("select cuentas.id_cuenta id_cuenta,mesas.id_mesa,mesas.numero,'Mesa'+ mesas.numero mesero, mesas.id_mesa estado,meseros.ip from mesas,cuentas,meseros  where 
    mesas.id_mesa=cuentas.id_mesa
    and meseros.id_mesero=cuentas.id_mesero
    and meseros.ip='".$mesero."' and cuentas.estado!=1
    ");


}
      //  dd($_SERVER["REMOTE_ADDR"]);
       //$mesas=DB::select("select mesas.id_mesa id_cuenta,mesas.id_mesa,mesas.numero,mesas.id_mesa mesero, mesas.id_mesa estado from mesas ");
       // $mesas=DB::select("select mesas.id_mesa id_cuenta,mesas.id_mesa,mesas.numero,mesas.id_mesa mesero, mesas.id_mesa estado from mesas ");
           
      
            
        $meseros=DB::select("select*from meseros where meseros.estado=1");
        return view('home',compact('mesas','meseros'));
     
    }
}
