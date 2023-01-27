@extends('layouts.app')
@section('content')


<?php  $IPHOST = Session::get('IPHOST');?>
<?php  $IPCLIENT = Session::get('IPCLIENT');?>
<style type="">
	
</style>
<div class="" style="padding: 1%;">
  
              <div class="alert alert-danger" id="alertmal" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
                 <strong id="mal"></strong> 
              </div>
              <div class="alert alert-success" id="alertbien" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
                  <strong id="bien"></strong> 
              </div>
 
       <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px; padding: 0px;">     
        <h3 class="text-center" style="color:white;padding: 0px;">CUENTA NO.  {{$id_cuenta}}</h3>
       </div>
       <div class="col-12 align-self-center " style="background:rgba(249,249,249,.9)">
         	</br>
         	 	<p>
 					      <a class="btn btn-success"style="border-radius: 50%;  box-shadow: 5px 10px 18px #888888; "  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" data-toggle="tooltip" data-placement="top" title="Agregar">
    				        <i class="material-icons">
          			     add</i>
  					    </a>
				    </p>
 
<div class="row">

<div class="collapse col-md-5 col-sm-12" id="collapseExample" >
  <div class="card card-body overflow-auto " style="padding: 1%; box-shadow: 5px 10px 18px #888888; ">

  	<div class="col-12">
      <label for="validationTooltipUsername"></label>
      <div class="input-group">
        
        <input type="text" class="form-control" id="entradafilter" placeholder="Buscar"  value="">
        <div class="invalid-tooltip">
         
        </div>
        <div class="input-group-prepend">
          	<a class="btn btn-secundary borrar"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample">
    			<i class="material-icons">
          		clear</i>
  			</a>
        </div>
      </div>
    </div>


<div  style="width: 100%; height: 400px; overflow-y: scroll;" >



    	<table class="table" style=" font-size: 10px;">
  			<thead class=" bg-success">
   			 <tr>
     			 <th scope="col-10 ">PRODUCTO</th>
           <th scope="col-1">PRECIO</th>
      			<th scope="col-1">OPCION</th>
    		</tr>
  			</thead>
  			<tbody class="busqueda">
  			 @foreach($carta as $car)
    			<tr>
     			 <td scope="col-10">{{$car->nombre}}</th>

           <td scope="col-1">$ {{$car->precio_publico}}</th>
     			 <td scope="col-1">
      				<button class="btn btn-success ordenar" value="{{$car->id_carta}}" style="border-radius: 50%;"   role="button" aria-expanded="false" aria-controls="collapseExample" data-toggle="tooltip" data-placement="top" title="Agregar">
    					<i class="material-icons" >
          				local_grocery_store</i>
  					</button>
      			</td>
      			</tr>
    		@endforeach  
  			</tbody>
		</table>
  </div>

  </div>
</div>
</br>
</br>
</br>
</br>
</br>
</br>


        <div class=" col-md-7 col-sm-12"  style="padding: 1%; ">
              <div class="card" style="padding: 1%; box-shadow: 5px 10px 18px #888888; ">
                @if($IPHOST==$IPCLIENT)

                    <div clas="card-head">
                            <h5 class="card-title" align="center" style="color:white">
                                <a class="btn btn-info imprime" value="{{$id_cuenta}}"style="border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Imprimir Cuenta"  role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="material-icons">print</i>
                                </a>
                                <a class="btn btn-primary guardar"style="border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Guardar Cuenta" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="material-icons">save</i>
                                </a>
                                <a class="btn btn-danger eliminar"style="border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Eliminar Cuenta" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="material-icons">delete_forever</i>
                                </a>
                           </h5>
                    </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-responsive-sm table-responsive-md table-responsive-lg" style="font-size: 10px;">
  			                     <thead class=" bg-success" >
   			                            <tr>
   			                 	            <th scope="col-1">CANT.</th>
     		               	              <th scope="col-8">PRODUCTO</th>
      	               		            <th scope="col-1">PRECIO.U.</th>
      	               		            <th scope="col-1">TOTAL</th>
      	               		            <th scope="col-1">OPCION</th>
    		                            </tr>
  			                     </thead>
  			                     <tbody id="tablabody">
  			                          @foreach($pedidos as $car)
    		                	          <tr id="tr{{$car->id_venta}}">
    		                	            <td id="td_cantidad_{{$car->id_venta}}"scope="col-1">{{$car->cantidad}}</td>
     		               	              <td scope="col-8">{{$car->nombre}}</th>
				                	            <td scope="col-1">$ {{$car->precio_v}}</td>
    		                	            <td id="td_total_{{$car->id_venta}}"scope="col-1">$ {{$car->total}}</td>
     		               	              <td scope="col-1" style="color:white">	
  			               		              <a class="btn btn-danger elimina_uno"style="border-radius: 50%;"  value="{{$car->id_venta}}" data-toggle="tooltip" data-placement="top" title="Eliminar"  role="button" aria-expanded="false" aria-controls="collapseExample">
    		                			             <i class="material-icons">
                          				          delete_forever</i>
  			               		              </a>
      	               		            </td>
      	               		          </tr>
    		                          @endforeach  
  			                      </tbody>
		                    </table>
                    </div>
                    <div calss="card-footer">
                        <table class="table">
                              <thead class=" bg-success">
                                    <tr>
                                        <th scope="col-9">TOTAL:</th>
                                        <th id="th_total_total"scope="col-3" style="font-size:20px;">$ {{$total_total}}</th>    
                                    </tr>
                              </thead>
                        </table>
                    </div>
                </div>
            </div>
      
</div>


</br></br>







<div class="modal " id="modal_elimina">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ELIMINAR CUENTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" >
      	 <div class="col-md-12" style="">
                   <div class="form-group">
                      <label for="exampleInputPassword1">CONTRASEÑA:</label>
                      <input type="password" class="form-control" id="contrasena" value="">
                    </div>
           </div> 
        <p style="color:red;">Nota: Una vez eliminada la cuenta no se podran recuperar los datos</p>
      </div>
      <div class="modal-footer">

<form class="form" role="form" method="POST" id="formelimina" action="/Elimina_cuenta/{{$id_cuenta}}">
  {{ csrf_field()}}
     <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_elimina" name="id_elimina"style="text-transform:uppercase;" required  >
                    </div>
              </div>  


        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success " id="si_elimina">ELIMINAR</button>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal " id="modal_elimina_uno">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ELIMINAR </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" >
         <div class="col-md-12" style="">
                   <div class="form-group">
                      <label for="exampleInputPassword1">CONTRASEÑA:</label>
                      <input type="password" class="form-control" id="contrasena_uno" value="">
                    </div>
           </div> 

        <p style="color:red;">NOTA: SOLO SE ELIMINARA LO QUE NO ESTE EN PREPARACION </p>
      </div>
      <div class="modal-footer">

<form class="form" role="form" method="POST" id="formelimina_uno" >
  {{ csrf_field()}}
     <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_eli" value="" name="id_eli"style="text-transform:uppercase;" required >
                    </div>
              </div>  
               <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="text" class="form-control" id="total_uno" name="total" step="any" required value="{{$total_total}}" >
                    </div>
              </div>  


        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success " id="si_elimina_uno">ELIMINAR</button>
        </form>
      </div>
    </div>
  </div>
</div>





<div class="modal " id="modal_agrega">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">AGREGAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<form class="form" role="form" method="POST" id="form_crea" action="/Agregar_Producto">
      <div class="modal-body text-center" >
      	 <div class="col-md-12" style="">
                   <div class="form-group">
                      <label for="exampleInputPassword1">CANTIDAD:</label>
                      <input type="number"min="1" class="form-control" id="cantidad" name="cantidad" value="1">
                    </div>
           </div> 
        </div>
      <div class="modal-footer">

  {{ csrf_field()}}
           <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="text" class="form-control" id="id_cuenta" name="id_cuenta"style="text-transform:uppercase;" required value="{{$id_cuenta}}" >
                    </div>
              </div>
               <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="text" class="form-control" id="id_carta" name="id_carta"style="text-transform:uppercase;" required value="" >
                    </div>
              </div>  
              <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="text" class="form-control" id="total" name="total"style="text-transform:uppercase;" required value="{{$total_total}}" >
                    </div>
              </div>   
              
         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success " id="si_agrega">AGREGAR</button>
      
      </div>
        </form>
    </div>
  </div>
</div>






<div class="modal " id="modal_guarda">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">GUARDAR CUENTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <div class="modal-body " >

             

        <div class="container-fluid">
          <div class="row">   

<form class="form" role="form" method="POST" id="formguarda" action="/Guarda_cuenta/{{$id_cuenta}}">

  {{ csrf_field()}}

                  <div class="form-group">
                      <label for="exampleInputPassword1"><STRONG>TIPO DE PAGO:</STRONG></label>
                      <select type="text" class="form-control " id="id_pago" name="id_pago" style="text-transform:uppercase;" required >
                      <option disabled selected value=''>Selecciona una opcion</option>
                      <option value="1">Efectivo</option>
                      <option value="2">Tarjeta</option>

                      </select>
                    </div>




             </div>
             </div>         



         <div class="text-center"><p style="color:red;">Nota: Una vez Guardada la cuenta no se podra realizar ningun cambio</p></div>
        
      </div>
      <div class="modal-footer">

     <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_guarda" name="id_guarda"style="text-transform:uppercase;" required >
                    </div>
              </div>  


        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success " value="{{$id_cuenta}}" id="si_guarda">GUARDAR</button>
        </form>
      </div>
    </div>
  </div>
</div>
















	</div>



  </div>
</div>  	


<script type="text/javascript">

$( document ).ready(function() {

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

	$('#entradafilter').keyup(function () {
      
      var rex = new RegExp($(this).val(), 'i');
        $('.busqueda tr').hide();
        $('.busqueda tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        });

//$(".borrar").click(function(e)
  $(document).on('click', '.borrar', function (e) {

  
  	$("#entradafilter").val("");
  	$('.busqueda tr').show();

  });

//$(".ordenar").click(function(e)
$(document).on('click', '.ordenar', function (e) {

  
  	$("#cantidad").val(1)
  	$("#id_carta").val($(this).val());
  	$("#modal_agrega").modal('show');
  });

//$("#si_agrega").click(function(e)
$(document).on('click', '#si_agrega', function (e) {


if($("#cantidad").val()==0 || $("#cantidad").val()=='')
{
    $("#mal").html('CANTIDAD INCORRECTA');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
}
else
{
	     var form=$("#form_crea");
       var url="/Agregar_Producto";
     
      $.post(url,form.serialize(),function(result)
      { 
        
        if(result['opcion']==0)
        {
      	$("#tablabody").append(''+result['objeto']+'');
      	$("#modal_agrega").modal('hide');
      	$("#bien").html(''+result['mensaje']+'');

        $("#th_total_total").html('$ '+result['total_total']+'');
          $("#alertbien").fadeIn( 1000 );
          $("#alertbien").slideUp( 1000 );
          $("#total").val(result['total_total']);

          $("#total_uno").val(result['total_total']);
         
        }
        else
        {

          $("#bien").html(''+result['mensaje']+'');
          $("#alertbien").fadeIn( 1000 );
          $("#alertbien").slideUp( 1000 );
            $("#modal_agrega").modal('hide');
 $("#total").val(result['total_total']);

          $("#total_uno").val(result['total_total']);
        
        $("#th_total_total").html('$ '+result['total_total']+'');
            $("#td_total_"+result["id_venta"]).html("$ "+result["total"]);
            $("#td_cantidad_"+result["id_venta"]).html(""+result["cantidad"]);
            
            var nuevoCSS = { "background": 'rgba(0,255,100,0.5)'};
            $("#tr"+result["id_venta"]+"").css(nuevoCSS);
            nuevoCSS = { "background": 'rgb(255,255,255)'};
            setTimeout(myFunction, 3000); 
            function myFunction()
            {
                $("#tr"+result["id_venta"]+"").css(nuevoCSS);
            }
             
   
        }


      });
    }/////else
});

//$(".eliminar").click(function(e)
$(document).on('click', '.eliminar', function (e) {

   $("#contrasena").val('');
  	$("#modal_elimina").modal('show');
        $("#contrasena").val('');


  });

//$("#si_elimina").click(function(e)
$(document).on('click', '#si_elimina', function (e) {

  
  	var desicion=$("#contrasena").val();

  	if(desicion=="")
  	{

  		$("#mal").html('INTRODUCE UNA CONTRASEÑA');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );

  	}
  	else
  	{
  		var contra="eliminar";
  		if(contra==desicion)
  		{
 		$("#formelimina").submit();
 		}
 		else
 		{
 			$("#mal").html('CONTRASEÑA INCORRECTA');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
 		}
  	}

  });

//$(".imprime").click(function(e)
$(document).on('click', '.imprime', function (e) {

  
  	id=$(this).attr('value');

  window.open("/Imprime/cuenta/"+id,"_blank");

  });

//$(".guardar").click(function(e)
$(document).on('click', '.guardar', function (e) {

  
  	$("#id_pago").val(null);
    $("#modal_guarda").modal('show');

  });

//$("#si_guarda").click(function(e)
$(document).on('click', '#si_guarda', function (e) {

  

      if($("#id_pago").val()==null)
{

 $("#mal").html('Selecciona el tipo de pago');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
}
          
else{


    id=$(this).attr('value');
    $("#formguarda").submit();
   // window.location.assign("/Guarda/"+id);
     
  }   


  });


//$(".elimina_uno").click(function(e)
$(document).on('click', '.elimina_uno', function (e) {

  
    $("#id_eli").val($(this).attr('value'));
    $("#modal_elimina_uno").modal('show');
    $("#contrasena_uno").val('');

    

  });
    $(document).on('click', '#si_elimina_uno', function (e) {
    //$("#si_elimina_uno").click(function(e)
  
    var desicion=$("#contrasena_uno").val();

    if(desicion=="")
    {

      $("#mal").html('INTRODUCE UNA CONTRASEÑA');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );

    }
    else
    {
      var contra="eliminar";
      if(contra==desicion)
      {
        var form=$("#formelimina_uno");
         var url="/Elimina_uno";
     
          $.post(url,form.serialize(),function(result)
          { 

            if(result["error"]==1)
            {
             $("#modal_elimina_uno").modal("hide");

          $("#mal").html('TODAS LAS ORDENES ESTAN EN PREPARACION O YA HAN SIDO ENTREGADAS');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );

            }

            else
            {

              if(result["eliminatodo"]==1)
              {

                   $("#modal_elimina_uno").modal("hide");
                //console.log(result["total"]);
                 //var nuevoCSS = { "background": 'rgba(0,255,100,0.5)'};
                  $("#tr"+result['id_venta']+"").hide();
                  $("#th_total_total").html("$ "+result["total_total"]);

                  $("#total").val(""+result["total_total"]);

                  $("#total_uno").val(""+result["total_total"]);


                  $("#contrasena_uno").val("");
                }

                else
                {


             $("#modal_elimina_uno").modal("hide");



                        $("#bien").html(''+result['mensaje']+'');
            $("#alertbien").fadeIn( 1000 );
            $("#alertbien").slideUp( 1000 );
            $("#modal_agrega").modal('hide');
             $("#total").val(result['total_total']);

          $("#total_uno").val(result['total_total']);
        
        $("#th_total_total").html('$ '+result['total_total']+'');
            $("#td_total_"+result["id_venta"]).html("$ "+result["total"]);
            $("#td_cantidad_"+result["id_venta"]).html(""+result["cantidad"]);
            
            var nuevoCSS = { "background": 'rgba(0,255,100,0.5)'};
            $("#tr"+result["id_venta"]+"").css(nuevoCSS);
            nuevoCSS = { "background": 'rgb(255,255,255)'};
            setTimeout(myFunction, 3000); 
            function myFunction()
            {
                $("#tr"+result["id_venta"]+"").css(nuevoCSS);
            }







                }
               }
          });

    }
    else
    {
      $("#mal").html('CONTRASEÑA INCORRECTA');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
    }
    }


  });

  });

 

</script>
@endsection