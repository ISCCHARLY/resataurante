@extends('layouts.app')
@section('title', 'Agregar Mesas')
@section('content')

 <div class="alert alert-success" id="mensaje" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;" 
    >
  <strong>CUENTA CREADA CORRECTAMENTE</strong> 
</div>
 <div class="alert alert-success" id="mensajelimina" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;" 
    >
  <strong>CUENTA ELIMINADA CORECTAMENTE</strong> 
</div>
<div class="container">
  <div class="row">

    <div class="col-12 align-self-center" style="background:black;">
         <h3 class="text-center" style="color:white;">CUENTAS</h3>
    </div>
    <div class="col-12 align-self-center" style="background:rgba(0,0,0,.5);">
</br>
  <button type="button" class="btn btn-success "id="amesa" style="border-radius: 50%;" data-toggle="modal" data-target="#agregarmenu"><i class="material-icons">
        add</i>
        </button >
		</br>

  <div class="row" id="padre">
	@foreach($mesas as $me)


    <div class="col-md-3" style="margin-top:2em;" id="card{{$me->id_mesa}}">
       <div class="card text-white bg-dark" style="border:solid red 2px;" >
        <div class="card-header">CUENTA:</div>
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size:36px;">{{$me->numero}}</h5>
          <p class="card-text"></p>
        </div>
        <div class="card-footer ">
            <button type="button" class="btn btn-danger elimina " data-toggle="tooltip" data-placement="top" title="Eliminar"
      style="border-radius: 50%;" data-toggle="modal" data-target="" value="{{$me->id_mesa}}">
      <i class="material-icons">
      delete_forever
      </i>
      </button > 

        </div>
      </div>
    </div>
          
  @endforeach
</div>
  <form method="POST" action="/aumentamesa" id="formamesa" enctype="multipart/form-data" >
          {{ csrf_field()}}

          
        </form>
  




  </br> </br>


    </div>
    
   </div>

</div>

<script type="text/javascript">
$( document ).ready(function() {
  elimina();
$('#amesa').click(function (e) {
 
	  url="/aumentamesa";
      
      form=$("#formamesa");
     
      $.post(url,form.serialize(),function(result)
      {
         $("#mensaje").fadeIn( 1000 );
        $("#mensaje").slideUp( 1000 );
          $('#padre').append(''+result["objeto"]+'');
          
        elimina();
 
      });
   });

function elimina(){

$('.elimina').click(function (e) {
    var id=$(this).attr('value');
    $("#mensajelimina").fadeIn( 1000 );
        $("#mensajelimina").slideUp( 1000 );
        $("div").remove("#card"+id);
        $("#eliminauno").modal("hide");

        var form=$("#formamesa");
       var url="/eliminamesa";

      $.post(url,form.serialize(),function()
       {
       

     
     });

});
}
});


</script>

@endsection