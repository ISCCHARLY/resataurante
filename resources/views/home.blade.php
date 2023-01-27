@extends('layouts.app')
@section('content')


<?php  $IPHOST = Session::get('IPHOST');?>
<?php  $IPCLIENT = Session::get('IPCLIENT');?>
<div class="container">
  <div class="alert alert-success" id="mensaje" style="display:none;;position: fixed; top: 80px;right: 0;z-index: 10;"  >
  <strong id="men">
  
  </strong> 
</div>

<div class="alert alert-danger" id="alertmal" style="display:none;position: fixed; top: 80px;right: 0;z-index: 10;"  >
  <strong id="mal">
   
  </strong> 
</div>
  <div class="row">

    <div class="col-12 align-self-center" style="background:gray;border-top-left-radius:  5px;border-top-right-radius:  5px;">
         <h3 class="text-center" style="color:white;">CUENTAS</h3>
    </div>
    <div class="col-12 align-self-center" style="background:rgba(249,249,249,0.9);">

		</br>

  <div class="row" id="padre">




	@foreach($mesas as $me)


    <div class="col-md-3" style="margin-top:2em; " id="cardpadre{{$me->id_mesa}}" >
      <div id="cardhijo{{$me->id_mesa}}" >
                   @if($me->estado==0)
          <div class="card text-black bg-white"id="card{{$me->id_mesa}}" style=" width: 251px; box-shadow: 5px 10px 18px #888888; border-top: 3px solid green;" >       
                <div class="card-header" style=" background:white;">Mesa:</div>
                <div class="card-body" id="body{{$me->id_mesa}}" style="height: 97px;">
                    <h5 class="card-title text-center" id="h5{{$me->id_mesa}}" style="font-size:36px;">{{$me->numero}}</h5>
          
                   @else
          <div class="card text-black bg-white"id="card{{$me->id_mesa}}" style="width: 251px; box-shadow: 5px 10px 18px #888888; border-top: 3px solid red;" >       
                <div class="card-header"  style=" background:white;">Mesa: {{$me->numero}}
                  
                </div>
                <div class="card-body" id="body{{$me->id_mesa}}" style="height: 97px;">
                     <h5 class="card-title text-center" id="h5{{$me->id_mesa}}"style="font-size:19px;">{{$me->mesero}}</h5>
                    @endif
                      <p class="card-text"></p>
                </div>
                 <div class="card-footer text-right " id="card_footer_{{$me->id_mesa}}" style=" background:white;">
                   @if($me->estado==0)
                      <button type="button"id="b_crea_{{$me->id_mesa}}" class="btn btn-success crear " data-toggle="tooltip" data-placement="top" title="Crear"
                      style="border-radius: 50%;" data-toggle="modal" data-target="" value="{{$me->id_mesa}}">
                      <i class="material-icons">
                      create
                      </i>
                      </button > 
                   @else
                      <button type="button"id="b_cuenta_{{$me->id_cuenta}}" class="btn btn-success cuenta " data-toggle="tooltip" data-placement="top" title="Cuenta"
                      style="border-radius: 50%;" data-toggle="modal" data-target="" value="{{$me->id_cuenta}}">
                      <i class="material-icons">
                      description
                      </i>
                      </button > 
                    @endif
@if($IPHOST==$IPCLIENT)
@if($me->id_cuenta>0)
                    <button type="button"id="bcambio" class="btn btn-danger bcambiar " data-toggle="tooltip" data-placement="top" title="Cambiar"
                      style="border-radius: 50%;" data-toggle="modal_cambio" data-target="" value="{{$me->id_cuenta}}">
                      <i class="material-icons">loop</i></button>
@endif
@endif




                 </div>
            </div>
          </div>  
    </div>
          
  @endforeach
  </div>

<form class="form" role="form" method="POST" id="form_crea" action="/Crea_cuenta">

  {{ csrf_field()}}
<!-- Modal agrega-->
<div class="modal fade" id="modal_crea">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CREAR CUENTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   

          
                <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1">Mesero:</label>
                      <select type="text" class="form-control" id="id_mesero" name="id_mesero" style="text-transform:uppercase;" required >
                      <option disabled selected>Selecciona una opcion</option>
                      @foreach($meseros as $me)
                      <option value="{{$me->id_mesero}}">{{$me->nombre}} {{$me->ap}}</option>
                      @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">mesa</label>
                      <input type="text" class="form-control" id="id_mesa" name="id_mesa" style="text-transform:uppercase;" value="">
                    </div>
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="btn_crea" class="btn btn-success">CREAR</button>

      </div>
    </div>
  </div>
</div>
</br>
</br>
</form>
  </div>


  </div>









<form class="form" role="form" method="POST" id="form_cambio" action="/Cambio_cuenta">

  {{ csrf_field()}}
<!-- Modal agrega-->
<div class="modal fade" id="modal_cambio">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CAMBIO DE CUENTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

             

        <div class="container-fluid">
          <div class="row">   

          
                <div class="col-md-12">
                   <div class="form-group">
                      <label for="exampleInputPassword1">MESA:</label>
                      <select type="text" class="form-control " id="id_mesanu" name="id_mesanu" style="text-transform:uppercase;" required >
                      <option disabled selected value=''>Selecciona una opcion</option>
                      @foreach($mesas as $me)
                         @if($me->estado==0)
                      <option value="{{$me->id_mesa}}">{{$me->id_mesa}}</option>
                      @endif 
                      @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">mesa</label>
                      <input type="text" class="form-control" id="id_cuentacambio" name="id_cuentacambio" style="text-transform:uppercase;" value="">
                    </div>
                   
          </div>
   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="button" id="btn_cambia" class="btn btn-success">CAMBIAR</button>

      </div>
    </div>
  </div>
</div>
</br>
</br>
</form>






























</div>



<script type="text/javascript">
$( document ).ready(function() {

function refresca()
{
$(function () {
  $('[data-toggle="tooltip"]').tooltip('hide')
})
}
//$(".crear").click(function(e)

  $(document).on('click', '.crear', function (e) 

  {
  //  alert($(this).val());
      $("#id_mesa").val($(this).val());
      $("#modal_crea").modal('show');

  });

//$('#btn_crea').click(function (e) {
  $(document).on('click', '#btn_crea', function (e) {

       var form=$("#form_crea");
       var url="/Crea_cuenta";
     
      $.post(url,form.serialize(),function(result)
      {

        if(result['opcion']==0)
        {
        $("#modal_crea").modal('hide');
          $("#men").html(result['mensaje']);
          $("#mensaje").fadeIn( 1000 );
          $("#mensaje").slideUp( 1000 );

           var nuevoCSS = { "border": 'solid red 1px'};
            $("#card"+result['id_mesa']+"").css(nuevoCSS);
            $("#cardhijo"+result['id_mesa']).remove();
           
             $('#cardpadre'+result['id_mesa']).append(''+result["objeto"]+'');
           refresca();
         }
         else{
          $("#mal").html(result['mensaje']);
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );


         }

        //alert(result['mensaje']);
      });
    });
/*refresca();
function refresca()
{*/
//$('.cuenta').click(function (e) {
    $(document).on('click', '.cuenta', function (e) {

  window.location.assign("/Cuenta/"+$(this).val());
});
//}


var idmesaante 




$(document).on('click', '.bcambiar', function (e) {
      

//$('.bcambiar').click(function (e) {
  idmesaante=$(this).val();
 // window.location.assign("/Cuenta/"+$(this).val());
$('#id_cuentacambio').val(idmesaante)
  $("#modal_cambio").modal('show');
});

$('#btn_cambia').click(function (e) {
  
  if($('#id_mesanu').val()==null)
{
          $("#mal").html('Selecciona una opcion');
          $("#alertmal").fadeIn( 1000 );
          $("#alertmal").slideUp( 1000 );
}
else
{

  $("#form_cambio").submit();
}
});


refresca();
});
</script>
@endsection
