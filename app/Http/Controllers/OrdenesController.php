<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Cuentas;
use App\Ventas;
use App\meseros;
use App\carta;
use App\Ordenes;



class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('hhhhhh');




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



      if($id==1)
{


        $ordenes=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=1 and carta.medida in (1,3)');

        // dd($ordenes);
   $ordenespre=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=2 and carta.medida in (1,3)');
}
if($id==2)

{

        $ordenes=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=1 and carta.medida in (2)');

        // dd($ordenes);
   $ordenespre=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=2 and carta.medida in (2)');

}


          return view('admin.Ordenes',compact('ordenes','ordenespre','id'));
    


    }

      public function cambio(Request $request)
    {
        
         if ($request->ajax()){
            $objeto ='';

                $status=DB::selectOne('select estatus from ordenes where idorden='.$request->get('idorden'));


                 $orden=DB::selectOne('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where idorden='.$request->get('idorden'));
          if($status->estatus==1)

          {
                    $datos = array(
                    
                    'estatus'=>2
                    
                    );
                  Ordenes::find($request->get('idorden'))->update($datos);
                  $objeto='<div class="alert alert-secondary alert-dismissible fade show row" role="alert" id="remove'.$request->get('idorden').'">
              <div class="col-md-9" >
              <div>
                <strong style="color :red;font-size: 1.5em;">'.$orden->cantidad.'     </strong> <strong> '.$orden->nombre.'</strong> 
              </div>
               <div>No. Mesa: '.$orden->id_mesa.'</div>
              </div>
              <div class="col-md-3">
                  <button type="button "  value="'.$orden->idorden.'" class="btn btn-light cambio "id="cambio" style="border-radius: 50%;color:blue" data-toggle="modal" data-target="#fechas" data-placement="top" title="Regresar"><i class="material-icons" >
                   autorenew</i>
                 </button >
                  <button type="button" class="btn btn-light fin "id="fin" style="border-radius: 50%;color:green;" data-toggle="modal" data-target="#fechas" data-placement="top" title=""><i class="material-icons">
                   
                    thumb_up

                   </i>
                 </button >
               </div>
            </div>';

 return response()->json([
                'repuesta'=>2,
                'objeto'=>$objeto
            ]);
          }
        else
        {
            $datos = array(
                    
                    'estatus'=>1
                    
                    );
                  Ordenes::find($request->get('idorden'))->update($datos);
                   $objeto='<div class="alert alert-secondary alert-dismissible fade show row" role="alert" id="remove'.$request->get('idorden').'">

              <div class="col-md-9" >
              <div>
                <strong style="color :red;font-size: 1.5em;">'.$orden->cantidad.'     </strong> <strong> '.$orden->nombre.'</strong> 
              </div>
               <div>No. Mesa: '.$orden->id_mesa.'</div>
              </div>
                 <div class="col-md-1 offset-md-2 ">
                 <button type="button" value="'.$orden->idorden.'" class="btn btn-light cambio "id="cambio" style="border-radius: 50%;;color:blue;" data-toggle="modal" data-target="#fechas" data-placement="top" title="En Preparacion"><i class="material-icons" >
                   autorenew</i>
                 </button >
               
               </div>
            </div>';
 return response()->json([
                'repuesta'=>1,
                'objeto'=>$objeto
            ]);
           

        }



           


         }
       





    }
    public function Ordenesajax(Request $request)
    {
        
         if ($request->ajax()){
           
                

$objetosnuevos='<div class="" id="conatinerorden">';


                if($request->get('ajax')==1)
                {
                 $ordeness=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=0 or estatus=1 and carta.medida in (1,3)');
                }
                if($request->get('ajax')==2)
                {
                 $ordeness=DB::select('select idorden ,carta.nombre ,ordenes.cantidad ,estatus, cuentas.id_mesa from ordenes inner join carta on carta.id_carta=ordenes.idcarta inner join cuentas on cuentas.id_cuenta=ordenes.idcuenta where estatus=0 estatus=1 and carta.medida in (2)');
                }


                 foreach ($ordeness as $or ) 


                 {


                  $objetosnuevos=$objetosnuevos.' <div class="alert alert-secondary alert-dismissible fade show row" role="alert" id="remove'.$or->idorden.'">

              <div class="col-md-9" >
              <div>
                <strong style="color :red;font-size: 1.5em;">'.$or->cantidad.'       </strong> <strong>    '.$or->nombre.'</strong> 
              </div>
               <div>No. Mesa: '.$or->id_mesa.'</div>
              </div>
              <div class="col-md-1 offset-md-2">
                  <button type="button" value="'.$or->idorden.'" class="btn btn-light cambio "id="cambio" style="border-radius: 50%;color:blue;" data-toggle="modal" data-target="#fechas" data-placement="top" title="En Preparacion"><i class="material-icons" >
                   autorenew</i>
                 </button >
                
               </div>
            </div>

            ';

                    $datos = array(
                    'estatus'=>1
                    );
                  Ordenes::find($or->idorden)->update($datos);
                 }



 $objetosnuevos=$objetosnuevos.'</div>';
               return response()->json([
                'consultaajax'=>$objetosnuevos





            ]);

         }
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

    public function Ordenfinjax(Request $request)
    {
        

         if ($request->ajax()){


               $datos = array(
                    'estatus'=>4
                    );
                  Ordenes::find($request->get('ajaxfin'))->update($datos);
                 
           
               return response()->json([
              'respuesta'=>1]);

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
        //
    }
}
