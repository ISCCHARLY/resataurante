@extends('layouts.app')

@section('content')






<div class="alert alert-success" id="mensaje" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;" 
    >
  <strong id="smen"></strong> 
</div>
<div class="alert alert-danger" id="mensaje_mal" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;" 
    >
  <strong id="menmal"></strong> 
</div>
<div class="alert alert-success" id="mensajeu" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;" 
    >
  <strong>DATOS MODIFICADOS</strong> 
</div>




<div class="container">
  <div class="row">

    <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px;">
         <h3 class="text-center" style="color:white;">REPORTE DE VENTAS  ({{$mensaje}})</h3>
    </div>


    <div class="col-12 align-self-center" style="background:rgba(249,249,249,.9);">

      </br>
        

<div class="row">

   <div class="col-md-1">
 
          <a type="button" class="btn btn-success" href="/ReporteGeneral" style="border-radius: 50%; box-shadow: 5px 10px 18px #888888; " data-toggle="tooltip" data-placement="top" title="Reporte del dia">
                       <i class="material-icons" >
          autorenew</i>             
                                    </a>
         
 
  </div>
  <div class="col-md-2">
    <button type="button" class="btn btn-primary "id="fecha" style="border-radius: 50%; box-shadow: 5px 10px 18px #888888; " data-toggle="modal" data-target="#fechas" data-placement="top" title="Reporte por echas"><i class="material-icons">
          date_range</i>
         </button >
 
  </div>
  

  <div class="col-md-3">
    <div class="alert alert-dark text-center" role="alert" style=" background:white; box-shadow: 5px 10px 18px #888888;">

      Efectivo:<strong>$ {{$totale_e}}    </strong> 
   </div>
   </div>

  <div class="col-md-3">
    <div class="alert alert-dark text-center" role="alert" style=" background:white; box-shadow: 5px 10px 18px #888888;">

       </strong> Tarjeta:<strong>$ {{$totalf_f}}</strong> 
   </div>
  </div>

  
  <div class="col-md-3">
      <div class="alert alert-dark text-center" role="alert" style=" background:white; box-shadow: 5px 10px 18px #888888;">

         Total:      <strong>$ {{$total_total}}</strong> 
      </div>
  </div>
  

</div>

<div style="background-color:white; border-radius: 10px;box-shadow: 5px 10px 18px #888888; "> 


  <div class="col-md-12 "> 


<table class="table" id="example">
  <thead class="thead-dark">
    <tr>
      <th scope="col-1">No. CUENTA</th>
      <th scope="col-4">MESERO</th>
      <th scope="col-1">MESA</th>
      <th scope="col-1">TIPO PAGO:</th>
      <th scope="col-1">TOTAL:</th>
      <th scope="col-1">CUENTA:</th>


    </tr>
  </thead>
 
   <tbody class="busqueda" >
         @foreach($reportecuentas as $rep)
          <tr>
           <td scope="col-1">{{$rep->id_cuenta}}</td>
           <td scope="col-4">{{$rep->nombre}} {{$rep->ap}} {{$rep->am}} </td>
          <td scope="col-9">{{$rep->id_mesa}}</td>
          @if($rep->forma_pago==1)
          <td scope="col-9">EFECTIVO</td>
          @ELSE
          <td scope="col-9">TARJETA</td>
          @endif
           <td scope="col-1">$ {{$rep->total}}</td>
            <td scope="col-1" style="font-size: 5px;">
              
       
      <button class=" btn btn-info  evaluate" id="val1" value="{{$rep->id_cuenta}}" style="border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Detalle">
           <i class="material-icons"  >
          content_paste</i>
       </button>

            </td>

            </tr>
        @endforeach  
       
  </tbody>
</table>
</div>
 
</div>
   

    
</br>




     
<!-- Modal agrega-->
<div class="modal fade" id="fechas">
  <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">CONSULTAR POR FECHAS</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">

            

       <div class="container-fluid">
         <div class="row">   


       <div class="card-body">



<form class="form"  method="POST" action="/Reporte_fecha" id="formconsulta" enctype="multipart/form-data" >
       {{ csrf_field()}}
    
     
     
          <div class="row">
           <div class="col-md-6">
             
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="desde" name="desde" style="text-transform:uppercase;" required  value='' placeholder="dd/MM/yyyy">
                    </div>
              </div>
              
            
              
                 <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>HASTA:</strong></label>
                      <input type="text" class="form-control" id="hasta" name="hasta"style="text-transform:uppercase;" required value="" placeholder="dd/MM/yyyy">
                    </div>
              </div>
             <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker"style="display:none;" inline="true">
  <input placeholder="Select date" type="text" id="example" class="form-control">
  <label for="example">Try me...</label>
  <i class="fas fa-calendar input-prefix"></i>
</div>
                
              </div>
        
                


 






              
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="submit" id="consulta" class="btn btn-success">CONSULTAR</button>

      </div>
      </form>
    </div>
  </div>
</div>
</div>















<!-- Modal agrega-->
<div class="modal fade" id="reporte">
  <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">DETALLE</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">

            

       <div class="container-fluid">
         <div class="row">   


       <div class="card-body">


 <table class="tabletable-striped table-bordered" id="tplatillos">
  
    <tbody id="tableplatillos">
      <tr>
          <td colspan="6" class="text-center" Style="color:black;">PLATILLOS</td>
      </tr>
     
    </tbody>
  </table>  

   <table class="tabletable-striped table-bordered" id="tbebidas">
  
    <tbody id="tablebebidas">
      <tr>
          <td colspan="6" class="text-center" Style="color:black;">BEBIDAS</td>
      </tr>
      
    </tbody>
  </table> 


  <table class="tabletable-striped table-bordered" id="tpaquetes">
   <tbody id="tablepaquetes">
      <tr>
          <td colspan="6" class="text-center" Style="color:black;">PAQUETES</td>
      </tr>
     
    </tbody>
  </table>  








              
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

      </div>
      </form>
    </div>
  </div>
</div>
</div>



      </br>
    
    </div>

      </br>
    
      </br>
    
      </br>
    
		</div>
  </div>


  <form class="form" role="form" method="POST" id="formdetalle" action="/DetalleCuenta" enctype="multipart/form-data" >
       {{ csrf_field()}}

  

  <div class="form-group" style="display: none;">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="id_cuenta" name="id_cuenta" style="text-transform:uppercase;" required  value=''>
                    </div>
                    <div class="form-group" style="display: none;">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="id_ra" name="id_ra" style="text-transform:uppercase;" required  value=''>
                    </div>
</form>

</div>



   
 <script type="text/javascript">

  $(document).ready( function () {


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

let table = new DataTable('#example', {
    // options
});



$("#consulta").click(function(e){

if($("#desde").val()=='')
{


          $("#menmal").html('EL CAMPO DESDE ES OBLIGATORIO');
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );

}
else
{
    tam=$("#desde").val()
    if(tam.length>10 || tam.length<10 )
    {
      $("#menmal").html('FORMATO DE FECHA INCORRECTO CAMPO DESDE');
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );
    }
    else
    {
      tam=$("#hasta").val()
      if (tam=='') 

      {
        $("#formconsulta").submit();
         
       }
       else
       {

           if(tam.length>10 || tam.length<10 )
         {
          $("#menmal").html('FORMATO DE FECHA INCORRECTO CAMPO HASTA ');
              $("#mensaje_mal").fadeIn( 1000 );
              $("#mensaje_mal").slideUp( 1000 );
         }
         else
         {
          $("#formconsulta").submit();
         }
       }
    }

  
}



 
});

//  $(".evaluat").click(function(){
    $(document).on('click', '.evaluate', function (e) {



        $("#id_cuenta").val($(this).val());

         var form=$("#formdetalle");
         var url="/DetalleCuenta";
     
          $.post(url,form.serialize(),function(result)
          { 
             

            $('#tableplatillos').remove();
            $('#tablebebidas').remove();
            $('#tablepaquetes').remove();

            $("#tplatillos").append('<tbody id="tableplatillos"><tr><td colspan="6" class="text-center" Style="color:black;">PLATILLOS</td></tr></tbody>');

             $("#tbebidas").append('<tbody id="tablebebidas"><tr><td colspan="6" class="text-center" Style="color:black;">BEBIDAS</td></tr></tbody>');
             
$("#tpaquetes").append('<tbody id="tablepaquetes"><tr><td colspan="6" class="text-center" Style="color:black;">PAQUETES</td></tr></tbody>');
             

             $("#reporte").modal('show');

              $("#tableplatillos").append(''+result['repuesta']+'');
                $("#tablebebidas").append(''+result['repuesta2']+'');
                $("#tablepaquetes").append(''+result['repuesta3']+'');

          //console.log(result["total"]);
           //var nuevoCSS = { "background": 'rgba(0,255,100,0.5)'};
        //    alert(result['repuesta']);
          });
          
  });

 


  });






</script>
 

@endsection

