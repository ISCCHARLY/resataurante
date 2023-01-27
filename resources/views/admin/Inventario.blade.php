@extends('layouts.app')
@section('content')

 <div class="alert alert-success" id="alert" style="display:none;position: fixed;
    top: 80px;
    right: 0;
    z-index: 10;"  >
  <strong id="bien"></strong> 
</div>

<div class="container">
<div class="row">

                <div class="col-12 align-self-center" style="background:black;">
                     <h3 class="text-center" style="color:white;">CARTA</h3>
                </div>

  			<div class="col-12 align-self-center" style="background:rgba(0,0,0,.5);">
  			</br>
              <button type="button" class="btn btn-success " style="border-radius: 50%;" data-toggle="modal" data-target="#agregarinventario"><i class="material-icons">add</i></button >
			</br></br>

<div style="background-color:white;">
				<table class="table">
 					 <thead class="thead-dark">
  	
  						  <tr>
      							<th scope="col-2">PRODUCTO</th>
      							<th scope="col-2">CANTIDAD</th>
      							<th scope="col-2">STOCK MINIMO</th>
      							<th scope="col-2">SALIDAS</th>
      							<th scope="col-2">ENTRADAS</th>
      							<th scope="col-2">EDITAR</th>
      							<th scope="col-1">ELIMINAR</th>
    					  </tr>
   
  					</thead>
  					<tbody id="cuerpo">
  						@foreach($inventario as $in)
    					<tr id="tr{{$in->id_inventario}}">
    						<td>{{$in->producto}}</td>
    						<td>{{$in->cantidad}} {{$in->medida}}</td>
    						<td>{{$in->minimo}}</td>
    						<td>salida</td>
    						<td>entradas</td>
    						<td>modificar</td>
    						<td>eliminar</td>
      					</tr>
     					@endforeach
  					</tbody>
				</table>	
</div>				
			</div>
</div>
</div>		









<!-- Modal agrega-->
<div class="modal fade" id="agregarinventario">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">   
            
            <div class="card-body">              
                <form method="POST" action="/Agrega_carta" id="formagrega" enctype="multipart/form-data" >
                 {{ csrf_field()}}
     
          <div class="row">
           <div class="col-md-12">
              <div class="form-group" style="display:none;">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="id_inventario" name="id_inventario" style="text-transform:uppercase;" value="">
                    </div>
                   <div class="form-group">
                      <label for="exampleInputPassword1">NOMBRE</label>
                      <input type="text" class="form-control" id="producto" name="producto" style="text-transform:uppercase;" required >
                    </div>
              </div>
          </div>
               <div class="row">
               <div class="col-md-4">
                   <div class="form-group">
                      <label for="exampleInputPassword1">CANTIDAD:</label>
                      <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" value="1">
                    </div>
               </div>
            
             
                <div class="col-md-4">
                   <div class="form-group">
                      <label for="exampleInputPassword1">STOCK:</label>
                      <input type="number" min="1"class="form-control" id="minimo" name="minimo" style="text-transform:uppercase;" required value="1">
                    </div>
                </div>
            
				
                <div class="col-md-4">
                   <div class="form-group">
                      <label for="exampleInputPassword1">MEDIDA:</label>
                      <select type="text" class="form-control" id="medida" name="medida" style="text-transform:uppercase;" required >
                      <option value="1">PZ.</option>
                      <option value="2">Kg</option>
                      <option value="3">L.</option>
                  </select>
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
        <button type="button" id="agregar" class="btn btn-success">AGREGAR</button>

      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
$( document ).ready(function() {

	 $("#agregar").click(function(e)
    {
    	//alert('hola');
         url="/Agrega_inventario";
        form=$("#formagrega");
        
      $.post(url,form.serialize(),function(result)
      {
      	if (result['opcion']==1) 
      	{
      		$("#cuerpo").append(result['objeto']); 
      		$("#bien").html(result['mensaje']);
      		$("#alert").fadeIn(1000);
      		$("#alert").slideUp(1000); 
      		$("#producto").val("");
      		$("#cantidad").val(1);
      		$("#minimo").val(1);
      		$("#agregarinventario").modal('hide');
      	}
      	
      });
    });
});
</script>

@endsection