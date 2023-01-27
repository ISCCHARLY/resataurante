@extends('layouts.app')
@section('title', 'Agregar Mesas')
@section('content')



<div id="accordion">
 @foreach($menus as$me) 
  <div class="card" style="background-color:rgba(0,0,0,.1);">
    <div class="card-header" id="headingOne" style="background-color:rgb(0,255,150);">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#{{$me["nombre_menu"]}}" aria-expanded="true" aria-controls="collapseOne">
          MENU {{$me["nombre_menu"]}}
        </button>
      </h5>
    </div>

    <div id="{{$me["nombre_menu"]}}" class="collapse show " aria-labelledby="headingOne" data-parent="#accordion" style="background-color:rgba(0,0,0,.1);">
   
      <div class="card-body row">
      	 @foreach($me["carta"] as $car)
			<div class="card" style="width: 18rem;margin:1em;">
  <img class="card-img-top" src="Carta/carta{{$car["id_carta"]}}" alt="Card image cap" style="height: 370px;">
<div style="position:absolute;"><h6 style="padding-top:10px;background-color:rgba(255,255,255,.8);border-radius:3px;">{{$car["Nombre"]}}</h6></div>
<div class="row" style="position:absolute;left:40%;top:84%;">
	<h4 style="width: 80px;padding-top:10px;">$ {{$car["Precio"]}}</h4>
	<button type="button" class="btn btn-secondary"style="border-radius: 50%;"  ><i class="material-icons">
more
</i></button>

   <button type="button" class="btn btn-success" style="border-radius: 50%;" ><i class="material-icons">
shopping_cart
</i></button>
</div>
   
  <img>
</div>

@endforeach

      
     </div> 
    </div>
  </div>



@endforeach
</div>





@endsection