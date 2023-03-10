@extends('layouts.app')

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script>

<main>
 <div class="alert alert-success" id="mensaje" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
  <strong id="men">
    REGISTRO EXITOSO
  </strong> 
</div>
<div class="alert alert-success" id="eliminado" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
 <strong >
    ELIMINADO CORRECATAMENTE
  </strong> 
</div>
<div class="alert alert-danger" id="alertmal" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
  <strong id="mal">
   
  </strong> 
</div>

<div class="container">
  <div class="row">

    <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px;">
         <h3 class="text-center" style="color:white;">CATEGORIAS</h3>
    </div>


    <div class="col-12 align-self-center" style="background:rgba(249,249,249,.9);">

</br>
        <button type="button" class="btn btn-success " style="border-radius: 50%; box-shadow: 5px 10px 18px #888888;" data-toggle="modal" data-target="#agregarmenu"><i class="material-icons">
        add</i>
        </button >

</br>
		
  <div class="row" id="padre">

 		@foreach($menus as $me)
    <div class="col-md-4 divvv" style="margin-top:2em;" id="div{{$me->id_menu}}">
      
 
  		 <div class="card text-black bg-white" style="border-top: solid gray 5px;box-shadow: 5px 10px 18px #888888;" id="cardb{{$me->id_menu}}" >
  			     <div class="card-header" id="carnombre{{$me->id_menu}}"  style=" background:white;"><strong>{{$me->nombre}}</strong>
             </div>
  			     <div class="card-body">
    			       <h6 class="card-title" ><strong>Descripcion:</strong></h6>
    		        	<p class="card-text" id="cardescripcion{{$me->id_menu}}">{{$me->descripcion}}</p>
  			     </div>
  			     <div class="card-footer text-right"  style=" background:white;">
                <button type="button" class="btn btn-success ver"  data-toggle="tooltip" data-placement="top" title="lista"
                      style="border-radius: 50%;"  value="{{$me->id_menu}}">
                    <i class="material-icons">
                         view_list
                    </i>
                </button > 
                <button type="button" id="b_editar{{$me->id_menu}}" class="btn btn-warning editar" data-toggle="tooltip" data-placement="top" title="Editar"
                   style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" value="{{$me->nombre}}"descripcion="{{$me->descripcion}}" idd="{{$me->id_menu}}">
                       <i class="material-icons">
                         create
                       </i>
                </button >   
                <button type="button" class="btn btn-danger elimina align-right" data-toggle="tooltip" data-placement="top" title="Eliminar" id="elimina"
                        style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" value="{{$me->id_menu}}">
                       <i class="material-icons">
                         delete_forever
                       </i>
                </button > 
             </div>
		    </div>
      </div>
		@endforeach
  </div>

</br>
</br>

<div style="color:rgba(255,255,255,.5);">
  SOFTWARE JC
</div>
</div>



</div>
</div>

 <form class="form" role="form" method="POST" id="formagrega" action="/Agrega_menu">

  {{ csrf_field()}}
<!-- Modal agrega-->
<div class="modal fade" id="agregarmenu">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR CATEGORIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   

           <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE:</strong></label>
                      <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform:uppercase;" required >
                    </div>
              </div>
               <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESCRIPCI??N:</strong></label>
                      <textarea type="text-area" class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
              </div>
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
</form>




<form class="form" role="form" method="POST" id="formedita" action="/Edita_menu">
  {{ csrf_field()}}
<!-- Modal agrega-->
<div class="modal fade" id="editamenu">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR CATEGORIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">          

          <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="eid" name="id"style="text-transform:uppercase;" required >
                    </div>
              </div>   
           <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE:</strong></label>
                      <input type="text" class="form-control" id="enombre" name="enombre"style="text-transform:uppercase;" required >
                    </div>
              </div>
               <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESCRIPCI??N:</strong></label>
                      <textarea type="text-area" class="form-control" id="edescripcion" name="edescripcion"></textarea>
                    </div>
              </div>
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="siedita" class="btn btn-success">EDITAR</button>

      </div>
    </div>
  </div>
</div>
</form>


<div class="modal " id="eliminauno">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ALERTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" >
        <p style="color:red;">REALMENTE DESEAS ELIMINAR ESTE ELEMENTO?</p>
      </div>
      <div class="modal-footer">

<form class="form" role="form" method="POST" id="formelimina" action="/Elimina_menu">
  {{ csrf_field()}}
     <div class="col-md-12" style="display:none">
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="eliid" name="eliid"style="text-transform:uppercase;" required >
                    </div>
              </div>  


        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success" id="eacept">ACEPTAR</button>
        </form>
      </div>
    </div>
  </div>
</div>






</main>

<script type="text/javascript" >

$(document).ready(function(){

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
var id


$(document).on('click', '.ver', function (e) {
      
      id=$(this).val();
      //alert(id);
      window.location.assign("/Carta/"+id);
    });



$(document).on('click', '.elimina', function (e) {
        id=$(this).val();
        $("#eliid").val(id);
        $("#eliminauno").modal('show');






        return false;
    });
        

        $('#eacept').click(function () {
            var form=$("#formelimina");
            var url="/Elimina_menu";

            $.post(url,form.serialize(),function(result)
             {

             


                if (result['isdelete']==1) 
                  {

        
                    $("div").remove("#div"+id+"");
                    $("#eliminauno").modal("hide");

                    $("#eliminado").fadeIn( 1000 );
                    $("#eliminado").slideUp( 1000 );
                    $("div").remove("#eliminado");


                  
                    }
                    else
                     {
                        $("#eliminauno").modal("hide");
                        $("#mal").html('No es Posible eliminar elementos con registros');
                        $("#alertmal").fadeIn( 1000 );
                        $("#alertmal").slideUp( 1000 );

                     }

               });
            });



        $("#agrega").click(function(e)
        {

              e.preventDefault();
    
               var form=$("#formagrega");
               var url="/Agrega_menu";


                if($("#nombre").val()=='')
                    {
                  $("#mal").html('El campo nombre es obligatorio');
                  $("#alertmal").fadeIn( 1000 );
                  $("#alertmal").slideUp( 1000 );

                    }
                    else{
          $.post(url,form.serialize(),function(result)
          {
           if(result['opcion']==1)
           {
                $('#padre').append(''+result["objeto"]+'');
                $("#nombre").val("");
                $("#descripcion").val("")

                $("#agregarmenu").modal("hide");
                $("#mensaje").fadeIn( 1000 );
                $("#mensaje").slideUp( 1000 );
            }
            else
            {
                $("#mal").html(result['mensaje']);
                $("#alertmal").fadeIn( 1000 );
                $("#alertmal").slideUp( 1000 );
            }
           });
        }
        });

  
/////////////editar

var nombre="";
var descripcion="";
var id=0;


$(document).on('click', '.editar', function (e) {
 
  nombre=$(this).val();
   descripcion=$(this).attr("descripcion");
   id=$(this).attr("idd");

  $("#eid").val(id);
  $("#enombre").val(nombre);
  $("#edescripcion").val(descripcion);
  $("#editamenu").modal('show');
});



$('#siedita').click(function (e) {

if($("#enombre").val()=='')
{

          $("#mal").html("El campo Nombre es obligatorio");
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
}
else{

       var form=$("#formedita");
       var url="/Edita_menu";
     
      $.post(url,form.serialize(),function(result)
      {
        if (result['opcion']==1) 
        {
//alert($("#enombre").val());
          $("#carnombre"+id).html(result['nombre']);
          $("#cardescripcion"+id).html(result['descripcion']);
          $("#men").html(result['mensaje']);
          $("#mensaje").fadeIn( 1000 );
          $("#mensaje").slideUp( 1000 );
          $("#editamenu").modal('hide');

  //alert(id);

  $("#b_editar"+id).attr('value',result['nombre']);
  $("#b_editar"+id).attr('descripcion',result['descripcion']);
          var nuevoCSS = { "border-top": 'green solid 5px'};
           $("#cardb"+id).css(nuevoCSS);
            nuevoCSS = { "border-top": 'gray solid 5px'};
            setTimeout(myFunction, 2000); 
            function myFunction()
            {
               $("#cardb"+id).css(nuevoCSS);
            }

        }
        else
        {
          $("#mal").html(result['mensaje']);
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
        }
        
     });
    }
    });




 










});

</script>
@endsection

