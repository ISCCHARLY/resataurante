@extends('layouts.app')

@section('content')


<div class="row">

<div class="col-6 "> 


    <div class="col-12 " style="background:black;border-radius:  5px;">
         <h3 class="text-center" style="color:white;">ENTRADAS</h3>
    </div>


     <div class="col-12 align-self-center" style="background:rgba(0,0,0,.5);border-radius:  5px;">

      </br>
        
      <div class="col-md-12 "  id="padreordenes"> 

        <div class='' id='conatinerorden'>
         @foreach($ordenes as $or)
            
          <div class="alert alert-secondary alert-dismissible fade show row" role="alert" id="remove{{$or->idorden}}">

              <div class="col-md-9" >
              <div>
                <strong style="color :red;font-size: 1.5em;">{{$or->cantidad}}       </strong> <strong>    {{$or->nombre}}</strong> 
              </div>
               <div>No. Mesa: {{$or->id_mesa}}</div>
              </div>
              <div class="col-md-1 offset-md-2 ">
                  <button type="button" value="{{$or->idorden}}" class="btn btn-light cambio "id="cambio" style="border-radius: 50%;;color:blue;" data-toggle="modal" data-target="#fechas" data-placement="top" title="En Preparacion"><i class="material-icons" >
                   autorenew</i>
                 </button >
               
               </div>
            </div>
          @endforeach

        </div>
      </div>
      </br>
    </div>

</div>
<!--..................................................................................................................................................................................-->
<div class="col-6 ">
  

    <div class="col-12 " style="background:black; border-radius:  5px;">
         <h3 class="text-center" style="color:white;">EN PREPARACIÓN</h3>
    </div>



     <div class="col-12 align-self-center" style="background:rgba(0,0,0,.5);border-radius:  5px;">

      </br>
        
      <div class="col-md-12 "  id="padrepreparacion"> 


         @foreach($ordenespre as $or)
            
          <div class="alert alert-secondary alert-dismissible fade show row" role="alert" id="remove{{$or->idorden}}">

              <div class="col-md-9" >
              <div>
                <strong style="color :red;font-size: 1.5em;">{{$or->cantidad}}       </strong> <strong>    {{$or->nombre}}</strong> 
              </div>
               <div>No. Mesa: {{$or->id_mesa}}</div>
              </div>
              <div class="col-md-3 ">
                  <button type="button "  value="{{$or->idorden}}" class="btn btn-light cambio "id="cambio" style="border-radius: 50%;color:blue" data-toggle="modal" data-target="#fechas" data-placement="top" title="Regresar"><i class="material-icons" >
                   autorenew</i>
                 </button >
                  <button type="button" value="{{$or->idorden}}" class="btn btn-light fin "id="fin" style="border-radius: 50%;color:green;" data-toggle="modal" data-target="#fechas" data-placement="top" title=""><i class="material-icons">
                   
                    thumb_up

                   </i>
                 </button >
               </div>
            </div>
          @endforeach


      </div>
      </br>
    </div>









</div> 

</div>


<form class="form"  method="POST" action="/OrdenChange" id="formconsulta" enctype="multipart/form-data" style="display:none;">
       {{ csrf_field()}}
    
     
     
         
           <div class="col-md-6">
             
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="idorden" name="idorden" style="text-transform:uppercase;" required  value=''>
                    </div>
              </div>
              
            
              
                 
                


 

      </form>


<form class="form"  method="POST" action="/ConsultaOrdenjax" id="formconsultaajax" enctype="multipart/form-data" style="display:none;">
       {{ csrf_field()}}
    
     
     
         
           <div class="col-md-6">
             
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="ajax" name="ajax" style="text-transform:uppercase;" required  value='{{$id}}'>
                    </div>
              </div>
              
            
      


 

      </form>

      <form class="form"  method="POST" action="/OrdenFinjax" id="formconsultafinajax" enctype="multipart/form-data" style="display:none;">
       {{ csrf_field()}}
    
     
     
         
           <div class="col-md-6">
             
                   <div class="form-group">
                      <label for="exampleInputPassword1"><strong>DESDE:</strong></label>
                      <input type="text" class="form-control" id="ajaxfin" name="ajaxfin" style="text-transform:uppercase;" required  value=''>
                    </div>
              </div>
              
            
      


 

      </form>


<script type="text/javascript">
  
  $(document).ready( function () {


$(document).on('click', '.cambio', function (e) {


  
     id=$(this).val()
//alert (id)
     $("#idorden").val(id);

        var form=$("#formconsulta");
         var url="/OrdenChange";
     $('#remove'+id).remove();
          $.post(url,form.serialize(),function(result)
          { 

              if (result['repuesta']==2)
             {
               $("#padrepreparacion").append(''+result['objeto']+'');
             }

             if (result['repuesta']==1)
             {
              $("#conatinerorden").append(''+result['objeto']+'');
             }

          });


});
$(document).on('click', '.eliminar', function (e) {


  alert('eliminar')
});

$(document).on('click', '.fin', function (e) {


 id=$(this).val();
  $("#ajaxfin").val(id);

        var form=$("#formconsultafinajax");
         var url="/OrdenFinjax";

     
          $.post(url,form.serialize(),function(result)
          { 

              
              if(result['respuesta']==1)
              {
            $('#remove'+id).remove();
              }
             
             

          });
});






function changeColor() {
       

 var form=$("#formconsultaajax");
         var url="/ConsultaOrdenjax";
   // $('#conatinerorden').remove();
          $.post(url,form.serialize(),function(result)
          { 
                      $('#conatinerorden').remove();

               $("#padreordenes").append(''+result['consultaajax']+'');

          });




    }
    setInterval(changeColor, 10000);



  });
</script>
@endsection