@extends('layouts.app')
@section('title', 'Agregar Mesas')
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

    <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px;" >
         <h3 class="text-center" style="color:white;">PERSONAL</h3>
    </div>
    <div class="col-12 align-self-center" style="background:rgba(249,249,249,.9);">
</br>

    	 <button type="button" class="btn btn-success "id="mas" style="border-radius: 50%; box-shadow: 5px 10px 18px #888888; " data-toggle="modal" data-target="#agregarmesero"><i class="material-icons" data-placement="top" title="Agregar">
          add</i>
         </button >


</br></br>
<div style="background-color:white; border-radius: 5px;  box-shadow: 5px 10px 18px #888888; ">
  <div>
	<table class="table" id="example">
  <thead class="thead-dark">
  	
    <tr>
      <th scope="col-2">NOMBRE</th>
      <th scope="col-2">APELLIDO PATERNO</th>
      <th scope="col-2">APELLIDO MATERNO</th>
      <th scope="col-2">TELEFONO</th>
      <th scope="col-1">ESTADO</th>
      <th scope="col-1">EDITAR</th>
      <th scope="col-1">ELIMINAR</th>


    </tr>
   
  </thead>
  <tbody id="cuerpo">
  	@foreach($meseros as $me)
    <tr id="tr{{$me->id_mesero}}">
      
      <td id="{{$me->id_mesero}}tnombre" style="text-transform:uppercase;">{{$me->nombre}}</td>
      <td id="{{$me->id_mesero}}tap" style="text-transform:uppercase;">{{$me->ap}}</td>
      <td id="{{$me->id_mesero}}tam" style="text-transform:uppercase;"> {{$me->am}}</td>
      <td id="{{$me->id_mesero}}ttelefono" style="text-transform:uppercase;">{{$me->telefono}}</td>
      <td>
      	 <button type="button" class="btn btn-primary estado" value="{{$me->id_mesero}}" estado="{{$me->estado}}" data-toggle="tooltip" data-placement="top" title="Cambiar"
                    style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
                
                @if($me->estado==1)

                    <i class="material-icons" style="color:white;" id="imgestado{{$me->id_mesero}}">
                    visibility
                    </i>
                  @else
                    <i class="material-icons" id="imgestado{{$me->id_mesero}}">
                    visibility_off
                    </i>
                  @endif
                </button>

      </td>
      <td>
      	<button type="button" class="btn btn-warning editar" value="{{$me->id_mesero}}"data-toggle="tooltip" data-placement="top" title="Editar"
        	style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
        	<i class="material-icons">
          	create
        	</i>
      	</button >  
      </td>
      <td>
      	
        @if($me->isdelete>0)
      	<button type="button" class="btn btn-danger elimina " value="{{$me->id_mesero}}" data-toggle="tooltip" data-placement="top" title="Eliminar"
      		style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" disabled="disabled">
      		<i class="material-icons">
      		delete_forever
      		</i>
      	</button >
        @else
          <button type="button" class="btn btn-danger elimina " value="{{$me->id_mesero}}" data-toggle="tooltip" data-placement="top" title="Eliminar"
          style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
          <i class="material-icons">
          delete_forever
          </i>
        </button >
        @endif

      </td>

    </tr>
     @endforeach
   
  </tbody>
</table>	
</div>
</div>

</br></br>




<!-- Modal agrega-->
<div class="modal fade" id="modalconfirma">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ALERTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   


        <div class="card-body text-center">
          
 
              <h6 style="color:red; text-center " >REALMENTE DESEAS ELIMINAR ESTE ELEMENTO ?</h6>
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="sielimina" class="btn btn-success">ACEPTAR</button>

      </div>
    </div>
  </div>
</div>
</div>







<!-- Modal agrega-->
<div class="modal fade" id="agregarmesero">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR PERSONAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   


        <div class="card-body">
          
              
<form method="POST" action="/Agrega_mesero" id="formagrega" enctype="multipart/form-data" >
       {{ csrf_field()}}
     
     
          <div class="row">
           <div class="col-md-12">
             
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE(S):</strong></label>
                      <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform:uppercase;" required >
                    </div>
              </div>
              
            </div>
              <div class="row">
              	 <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>APELLIDO PATERNO:</strong></label>
                      <input type="text" class="form-control" id="ap" name="ap"style="text-transform:uppercase;" required value="">
                    </div>
              </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>APELLIDO MATERNO:</strong></label>
                      <input type="text" class="form-control" id="am" name="am" style="text-transform:uppercase;" required value="">
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>No.TELEFONO:</strong></label>
                      <input type="number"  class="form-control" id="telefono" name="telefono" style="text-transform:uppercase;" required value="">
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>CORREO:</strong></label>
                      <input type="text" class="form-control" id="ip" name="ip" style="text-transform:uppercase;" required value="">
                    </div>
                </div>

                
              </div>
				
                
</form>

              
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="agrega" class="btn btn-success">AGREGAR</button>

      </div>
    </div>
  </div>
</div>
</div>



<!-- Modal EDITA-->
<div class="modal fade" id="medita">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   


        <div class="card-body">
          
              
<form method="POST" action="/Updated_mesero" id="formUpd" enctype="multipart/form-data" >
       {{ csrf_field()}}
     
     
          <div class="row">
           <div class="col-md-12">
             		<div class="form-group"style="display:none;color: black;">
                      <label for="exampleInputPassword1">NOMBRE(S)</label>
                      <input type="text" class="form-control" id="ide" name="ide" style="text-transform:uppercase; " required value="">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE(S):</strong></label>
                      <input type="text" class="form-control" id="nombree" name="nombree" style="text-transform:uppercase;" required value="">
                    </div>
              </div>
              
            </div>
              <div class="row">
              	 <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>APELLIDO PATERNO:</strong></label>
                      <input type="text" class="form-control" id="ape" name="ape"style="text-transform:uppercase;" required value="">
                    </div>
              </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>APELLIDO MATERNO:</strong></label>
                      <input type="text" class="form-control" id="ame" name="ame" style="text-transform:uppercase;" required value="" >
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>No.TELEFONO:</strong></label>
                      <input type="number" class="form-control" id="telefonoe" name="telefonoe" style="text-transform:uppercase;" required value="">
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>CORREO:</strong></label>
                      <input type="text" class="form-control" id="ipe" name="ipe" style="text-transform:uppercase;" required value="">
                    </div>
                </div>

                
              </div>
				
                
</form>

              
          </div>
   
        </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="updated" class="btn btn-success">GUARDAR</button>

      </div>
    </div>
  </div>
</div>
</div>



    </div>



<form method="POST"  id="formid" enctype="multipart/form-data" >
       {{ csrf_field()}}
     
     
    
             
                   <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE(S)</label>
                      <input type="text" class="form-control" id="id" name="id"  required value="">
                    </div>

</form>    		

   </div>
 </div>   

 

<script type="text/javascript">
$( document ).ready(function() {


let table = new DataTable('#example', {
    // options
});


  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

 var vnombre="";
 var vap="";
 var vam="";
 var vtelefono="";

var ide=0;


function re_elimina()
{
  $(".elimina").click(function(e)
  {
    $("#modalconfirma").modal('show');
     $("#id").val($(this).val());
    ide=$(this).val();
  });
}
$("#sielimina").click(function(e)
  {
   
     url="/Elimina_mesero";
      
      form=$("#formid");
     
      $.post(url,form.serialize(),function(result)
      {

        $("#tr"+ide).remove();
         $("#smen").html(result["mensaje"]);
         $("#mensaje").fadeIn( 1000 );
        $("#mensaje").slideUp( 1000 );
        $("#modalconfirma").modal('hide');
          
      });

  });

re_elimina();

$(".estado").click(function(e)
  {
       var estado=$(this).attr('estado');
       var id=$(this).attr('value');

       $("#imgestado"+id).remove();

       if (estado==0)
       {
        
       $(this).append('<i class="material-icons" style="color:white;"id="imgestado'+id+'"> visibility </i>')
       $(this).attr('estado',1);
       }
       else
       {
        $(this).append('<i class="material-icons" id="imgestado'+id+'"> visibility_off</i>')
      $(this).attr('estado',0);
      }
      
      url="/Editar_mesero/"+id+"";
      $("#id").val(id);
      form=$("#formid");
     
         $.post(url,form.serialize(),function(result)
      {

      });


    });





	$('#agrega').click(function (e) {
 

      if ($("#nombre").val()==''|| $("#ap").val()==''||$("#am").val()=='' ||$("#ip").val()=='')
{
          



          $("#menmal").html('Algunos datos son bligatorios');
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );
}
else
{




	  url="/Agrega_mesero";
      
      form=$("#formagrega");
     
      $.post(url,form.serialize(),function(result)
      {

        if(result['opcion']==1)
        {

          $("#smen").html(result['Mensage']);
        $("#mensaje").fadeIn( 1000 );
        $("#mensaje").slideUp( 1000 );
        $('#cuerpo').append(''+result["objeto"]+'');
         // console.log(result);
         $("#agregarmesero").modal('hide');
            $('#id').val("");
            $('#nombre').val("");
            $('#ap').val("");
            $('#am').val("");
            $('#telefono').val("");
            $('#ip').val("");
      recargaedita();
      re_elimina();
        }
        else
        {
          $("#menmal").html(result['Mensage']);
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );
        }

      });
    }
   });


	$('#updated').click(function (e) {

   if ($("#nombree").val()==''|| $("#ape").val()==''||$("#ame").val()=='' ||$("#ipe").val()=='')
{
          



          $("#menmal").html('Algunos datos son bligatorios');
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );
}
else
{

    id=$("#ide").val();

   // alert(id);
   
	  url="/Updated_mesero";
      
      form=$("#formUpd");
     
      $.post(url,form.serialize(),function(result)
      {
         if(result['opcion']==1)
        {

           $("#"+id+"tnombre").html(result['nombre']);
    $("#"+id+"tap").html(result['ap']);
    $("#"+id+"tam").html(result['am']);
    $("#"+id+"ttelefono").html(result['telefono']);
 
        $("#mensajeu").fadeIn( 1000 );
        $("#mensajeu").slideUp(1000);
        
         $('#medita').modal('hide');

         var nuevoCSS = { "background": 'rgba(0,255,100,0.5)'};
            $("#tr"+id+"").css(nuevoCSS);
            nuevoCSS = { "background": 'rgb(255,255,255)'};
            setTimeout(myFunction, 2000); 
            function myFunction()
            {
                $("#tr"+id+"").css(nuevoCSS);
            }





          }
          else
          {
             $("#menmal").html(result['mensaje']);
          $("#mensaje_mal").fadeIn( 1000 );
          $("#mensaje_mal").slideUp( 1000 );
          }
 
      });
    }
   });

recargaedita();
function recargaedita()
{
$('.editar').click(function (e) {

	var id=$(this).attr('value');
	$('#id').val(id);

 
	  url="/Editar_mesero";
      
      form=$("#formid");
     
      $.post(url,form.serialize(),function(result)
      {
        
          console.log(result);

          	$('#ide').val(id);
          	$('#nombree').val(result['nombre']);
          	$('#ape').val(result['ap']);
          	$('#ame').val(result['am']);
          	$('#telefonoe').val(result['telefono']);
            $('#ipe').val(result['ip']);
          	$('#medita').modal('show');
      
 
      });
   });

}

});
</script>


@endsection