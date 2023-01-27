@extends('layouts.app')

@section('content')

<?php  $notification = Session::get('notification');?>
<?php  $color = Session::get('colormen');?>




<script type="text/javascript">
$( document ).ready(function() {


  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      console.log(e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});




 function readURL2(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#imge').attr('src', e.target.result);
      console.log(e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp2").change(function() {
  readURL2(this);
});


@if($notification==null)
 $("#alert").hide();
 @else
 $("#alert").fadeIn( 1000 );
 $("#alert").slideUp( 1000 );

 <?php
 Session::put('notification',null);
?>
 @endif
 



});
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script>


  @if($color==1)
    <div class="alert alert-success" id="alert" style="display:none;position: fixed;top: 80px;right: 0;z-index: 10;">
  @else
     <div class="alert alert-danger" id="alert" style="display:none;position: fixed;top: 80px;right: 0;z-index: 10;">
  @endif
     <strong id="mensaje" value="">{{$notification}}</strong> 
    </div>


       <div class="alert alert-danger" id="alertd" style="display:none;position: fixed;top: 80px;right: 0;z-index: 10;">
  
     <strong id="mensajed" value="">FALTAN DATOS</strong> 
    </div>

<div class="container">
<div class="row">

                <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px;">
                     <h3 class="text-center" style="color:white;">CATEGORIA </h3>
                </div>

  <div class="col-12 align-self-center" style="background:rgba(249,249,249,.9);">
  </br>
              <button type="button" class="btn btn-success " style="border-radius: 50%;box-shadow: 5px 10px 18px #888888;" data-toggle="modal" data-target="#agregarmenu"><i class="material-icons">add</i></button >
				</br></br>


        <div class="container" style="background: white; border-radius: 5px;box-shadow: 5px 10px 18px #888888;">
        <table class="table table-light table-striped "id="example" style="color:black;">
					<thead class="thead-dark">
						<tr>
							<th scope="col-5">NOMBRE</th>
							<th scope="col-1">PRECIO ENTRADA</th>
							<th scope="col-1">PRECIO PUBLICO</th>
              <th scope="col-1">EXISTENCIAS</th>
							<th scope="col-1">VISIBLE</th>
              <th scope="col-1">EDITAR</th>
							<th scope="col-1">ELIMINAR</th>
						</tr>
					</thead>
					<tbody>
						@foreach($carta as $car)
						<tr id="tr{{$car->id_carta}}" >
							<td>{{$car->nombre}}</td>
							<td>$ {{$car->precio_entrada}}</td>
							<td>$ {{$car->precio_publico}}</td>
              <td> {{$car->cantidad}} 
                
              </td>
							<td id="tdestado{{$car->id_carta}}">
                <button type="button" id="estado{{$car->id_carta}}"class="btn btn-info estado" value="{{$car->estado}}" idd="{{$car->id_carta}}"data-toggle="tooltip" data-placement="top" title="Cambiar"
                    style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
                
                @if($car->estado==1)

                    <i class="material-icons"  id="imgestado{{$car->id_carta}}">
                    visibility
                    </i>
                  @else
                    <i class="material-icons" id="imgestado{{$car->id_carta}}">
                    visibility_off
                    </i>
                  @endif
                </button>
              </td>
							<td> 
								<button type="button" class="btn btn-warning editar" value="{{$car->id_carta}}"data-toggle="tooltip" data-placement="top" title="Editar"
        						style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
        						<i class="material-icons">
          						create
        						</i>
      							</button >   
      						</td>
							<td> 
                @if($car->isdelete>0)
								<button value="{{$car->id_carta}}"type="button" class="btn btn-danger elimina " data-toggle="tooltip" data-placement="top" title="Eliminar"
      							style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" disabled="disabled">
      							<i class="material-icons">
      							delete
      							</i>
      							</button >
                  @else
                  <button value="{{$car->id_carta}}"type="button" class="btn btn-danger elimina " data-toggle="tooltip" data-placement="top" title="Eliminar"
                    style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu" >
                    <i class="material-icons">
                    delete
                    </i>
                    </button >

                  @endif

      						</td>
						</tr>
						@endforeach
					</tbody>
					
				</table>

				</div>
				</br></br>

    </div>
  </div>
</div>





<!-- Modal agrega-->
<div class="modal fade " id="agregarmenu">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">   
           <!-- <div align="center">
              <img class="card-img-top col-md-10"  id="blah" src="{{ asset('img/carta/carta0.png') }}"style="height:16em;">
            </div>-->
            <div class="card-body">       

                <form method="POST" action="/Agrega_carta" id="formagrega" enctype="multipart/form-data" >
                 {{ csrf_field()}}
     
              <!--<div class="Uploadbtn form-group" style=" position: relative;overflow: hidden;padding:5px 5px;
                text-transform: uppercase;color:#fff;background: #000066;
                -webkit-border-radius: 4px;-moz-border-radius: 4px;-ms-border-radius: 4px;-o-border-radius: 4px;
                 border-radius: 4px;width:50px;text-align:center;cursor: pointer;">
               <input  type="file" id="imgInp" name="imagen" class="form-group" accept="image/x-png,image/gif,image/jpeg" style="
                position: absolute;top: 0;right: 0;margin: 0;padding: 0;opacity: 0;height:50%;width:50%;"/>
                <span><i class="material-icons">add_a_photo</i></span>
              </div>  -->

            
          <div class="row">
           <div class="col-md-12">
              <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_menu" name="id_menu" style="text-transform:uppercase;" value="{{$id_menu}}">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE:</strong></label>
                      <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform:uppercase;" required >
                    </div>
              </div>

            </div>
              <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>PRECIO ENTRADA:</strong></label>
                      <input type="number"  min='0' class="form-control" placeholder="0.00" id="descripcion" name="descripcion"></input>
                    </div>
              </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>PRECIO PUBLICO:</strong></label>
                      <input type="number" min='0' class="form-control" placeholder="0.00" id="precio" name="precio" style="" required >
                    </div>
                </div>
              </div> 
               <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>CANTIDAD:</strong></label>
                      <input type="number" min='0' class="form-control" id="cantidad" name="cantidad" style=" text-transform:uppercase;" required >
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>TIPO:</strong></label>
                      <select type="text" class="form-control" id="tipo" name="tipo" style="text" required >
                      <option disabled="disabled" selected="selected">SELECCIONA UNA OPCION</option>
                      <option value="1">PLATILLO</option>
                      <option value="2">BEBIDAS</option>
                      <option value="3">PAQUETES</option></select>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>STOCK MINIMO:</strong></label>
                      <input type="number" class="form-control" min='0' id="stock" name="stock" style="text-transform:uppercase;" required >
                    </div>
                </div>

              </div>
                        
                    </form>    
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

<form method="POST" action="/Edita_carta" id="formedita" enctype="multipart/form-data" >
                   {{ csrf_field()}}
                   <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id" name="id" style="text-transform:uppercase;" value="" required >
                    </div>
</form>


<!-- Modal agrega-->
<div class="modal fade" id="editarmodal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">EDITAR </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">   

              <div id="divimagen"></div>
              <div class="card-body">
                <form method="POST" action="/Modifica_carta" id="formodifica" enctype="multipart/form-data" >
                  {{ csrf_field()}}
                  
          <div class="row">
           <div class="col-md-12">
             <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_carta" name="id_carta" style="text-transform:uppercase;" value="">
                    </div>
              <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_menue" name="id_menu" style="text-transform:uppercase;" value="{{$id_menu}}">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>NOMBRE:</strong></label>
                      <input type="text" class="form-control" id="nombree" name="nombre" style="text-transform:uppercase;" required >
                    </div>
              </div>
            </div>
                <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>PRECIO ENTRADA:</strong></label>
                      <input type="number" min='0' class="form-control" id="descripcione" name="descripcion"></input>
                    </div>
              </div>
           
             
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>PRECIO PUBLICO:</strong></label>
                      <input type="number" class="form-control" id="precioe" name="precio" style="text-transform:uppercase;" required >
                    </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>EXISTENCIAS:</strong></label>
                      <input type="number" min='0' class="form-control" id="existencias" name="existencias" style="text-transform:uppercase;" required >
                    </div>
                </div>

                <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>TIPO:<strong></label>
                      <select type="text" class="form-control" id="tipoe" name="tipo" style="" required >
                      <option disabled="disabled" selected="selected">SELECCIONA UNA OPCION</option>
                      <option value="1">PLATILLO</option>
                      <option value="2">BEBIDAS</option>
                      <option value="3">PAQUETES</option></select>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>STOCK:</strong></label>
                      <input type="number" min='0' class="form-control" id="stocke" name="stocke" style="text-transform:uppercase;" required >
                    </div>
                </div>
                    </form>
           </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="yano" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="btn_edita" class="btn btn-success">GUARDAR</button>

      </div>
    </div>
  </div>
</div>






<!-- Modal agrega-->
<div class="modal fade" id="modalconfirma">
  <div class="modal-dialog" role="document">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="sielimina" class="btn btn-success">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>








<script type="text/javascript">
  $(document).ready(function(){
let table = new DataTable('#example', {
    // options
});

   $("#agrega").click(function(e)
    {

        if(
            $("#nombre").val()=='' ||
           $("#descripcion").val()==''||
           $("#precio").val()==''||
           $("#cantidad").val()==''||
            $("#tipo").val()==''||
            $("#stock").val()==''
          )
        {
          
            $("#alertd").fadeIn( 1000 );
            $("#alertd").slideUp( 1000 );

        }
else

{
       $("#formagrega").submit();
     }
    });

     $("#btn_edita").click(function(e)
    {

if(
            $("#nombree").val()=='' ||
           $("#descripcione").val()==''||
           $("#precioe").val()==''||
           $("#existencias").val()==''||
            $("#tipoe").val()==''||
            $("#stocke").val()==''
          )
        {
          
            $("#alertd").fadeIn( 1000 );
            $("#alertd").slideUp( 1000 );

        }
else

{



       $("#formodifica").submit();
     }
    });

var id_elimina=0;
   
       $(document).on('click', '.elimina', function (e) 

  {
  
      id_elimina=$(this).val();
      $("#id").val($(this).val());
       $("#modalconfirma").modal('show');
    });
 $("#sielimina").click(function(e)
    {
         url="/Elimina_carta";
        form=$("#formedita");
        
      $.post(url,form.serialize(),function(result)
      {
        $("#tr"+id_elimina).remove();
        $("#mensaje").html(result['mensaje']);
        $("#alert").fadeIn(1000);
        $("#alert").slideUp(1000);       
        $("#modalconfirma").modal('hide');




      });

    });




      $(document).on('click', '.estado', function (e) 

  {
  
       var estado=$(this).attr('value');
       var id=$(this).attr('idd');

       $("#imgestado"+id).remove();

       if (estado==0)
       {
       $("#estado"+id).append('<i class="material-icons" id="imgestado'+id+'"> visibility </i>')
       $("#estado"+id).val(1);
       }
       else
       {
        $("#estado"+id).append('<i class="material-icons" id="imgestado'+id+'"> visibility_off</i>')
      $("#estado"+id).val(0);
      }
      
      url="/Visible";
      $("#id").val(id);
      form=$("#formedita");
     
      $.post(url,form.serialize(),function(result)
      {

      });



    });

  $(document).on('click', '.editar', function (e) 

  {
  


 

      var id=$(this).attr('value');
      url="/Edita_carta";
      $("#id").val(id);
      form=$("#formedita");
     $("#imge").remove();
      $.post(url,form.serialize(),function(result)
      {
          //console.log(result["imag"]);
          $("#id_carta").val(id);
          $("#nombree").val(result["nombre"]);
           $("#descripcione").val(result["precio_entrada"]);
           $("#precioe").val(result["precio_publico"]);
           $("#existencias").val(result["existencias"]);
            $("#tipoe").val(result["tipoe"]);
            $("#stocke").val(result["stocke"]);
           
       
            $("#editarmodal").modal('show');

      });

    });





 });
  </script>

@endsection