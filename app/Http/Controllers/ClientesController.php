<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=DB::select('select*from menus');

       

        $datos_menu=array();
foreach ($menus as $men)
{
    $menu_dat['id_menu']=$men->id_menu;
    $menu_dat['nombre_menu']=$men->nombre;
     
    $cartap=DB::select('select*from carta where carta.id_menu='.$men->id_menu.'');
    $carta_menup=array();
    foreach ($cartap as $ca)
    {
        $cartadatp['id_carta']=$ca->id_carta;
        $cartadatp['id_tipo_carta']=$ca->tipo_carta;
        $cartadatp['Nombre']=$ca->nombre;
        $cartadatp['Descripcion']=$ca->descripcion;
        $cartadatp['Precio']=$ca->precio;
        $cartadatp['Estado']=$ca->estado;
        $cartadatp['imagen']="carta".$ca->id_carta;
        array_push($carta_menup,$cartadatp);   
        //dd($carta_menu); 
    }
    
    $menu_dat['carta']=$carta_menup;
    array_push($datos_menu, $menu_dat);
}
        return view('cliente.clientes',compact('menus'))->with(['menus'=>$datos_menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
