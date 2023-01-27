@extends('layouts.app')

@section('content')

 <div class="alert alert-success" id="alert" style="display:none;" >
  <strong>{{$mensaje}}</strong> 
</div>

<div class="container">
  <div class="row">

    <div class="col-12 align-self-center" style="background:black;">
         <h3 class="text-center" style="color:white;">PRODUCTO</h3>
    </div>
    <div class="col-12 align-self-center" style="background:rgba(0,0,0,.5);">
    	
			<div class="row">
				@foreach($carta as $car)
				<div class=" col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="border:solid red 2px;">
						<div class="card bg-dark text-white">
							<img src="{{ asset('img/carta/carta1.jpg') }}" class="card-img" >
							<div class="card-img-overlay" style="padding:1px;">
								<div class="rows">
									<div class="col-12" >
										<h7 class="card-title col-12"style="background:rgba(255,255,255,.5);border-radius:10px;">{{$car->nombre}}
										</h7>
									</div>
									<div class="col-12">
										<a href="#" class="btn btn-success 
										"style="border-radius:50%;">+</a>
									</div>
								
								</div>
							</div>
						</div>
				</div>
				@endforeach
				</div>

    </div>
  </div>
</div>


<?php
$mensaje=$mensaje;
?>
<script type="text/javascript">
  $(document).ready(function(){

    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

    @if($mensaje==null)
 $("#alert").hide();
 @else
 $("#alert").fadeIn( 2000 );
 $("#alert").slideUp( 4000 );
 @endif

 });
  </script>

@endsection