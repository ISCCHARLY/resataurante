<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\FPDF as FPDF;
use Illuminate\Support\Facades\DB;

class PDF extends FPDF
    {
    
        //CABECERA DE LA PAGINA
        function Header()
        { 
     // $this->Image('img/gobi.png',132,2,29);
            $this->Image('img/logoencanto.jpg',0,2,106);
         
        }
        //PIE DE PAGINA 
        function Footer()
        {
              }
       
    }

class ImprimeCuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $pdf=new PDF($orientation='P',$unit='mm',$format='Letter');
        $pdf->SetMargins(10, 25 , 0);
        $pdf->SetAutoPageBreak(true,25);
        $pdf->AddPage();
        $pdf->SetDrawColor(164,164,164);
        $pdf->SetLineWidth(1.0);
      //  $pdf->Line(0, 30,107, 30);
        $pdf->SetFont('Arial','','11');
        $x=2;
        $x2=106;
        $y=$pdf->GetY()+3;
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('Arial','','6');



$tiempo=DB::selectOne('select DATE_FORMAT(cuentas.updated_at,"%Y/%m/%d") fecha from cuentas where
     cuentas.id_cuenta='.$id.'');
$nomesa=DB::selectOne('select id_mesa Mesa from cuentas where
     cuentas.id_cuenta='.$id.'');
$nomesero=DB::selectOne('select CONCAT(Nombre, " ", ap) mesero from cuentas,meseros where
      meseros.id_mesero=cuentas.id_mesero and
     cuentas.id_cuenta='.$id.'');

        $y=45;
       
$pdf->SetFont('Arial','','9');       
$pdf->Text(3, 35,"NO. MESA: ". $nomesa->Mesa);
$pdf->Text(77, 35,"FECHA: ". $tiempo->fecha);
$pdf->Text(3, 40,"MESERO: ". $nomesero->mesero);

  $pdf->SetFont('Arial','','6');

//$pdf->Text(176, 60,$id);

$pdf->SetXY($x,$y);
        
       $pdf->Line($x, $y,106, $y);

        $pdf->MultiCell(10,5,utf8_decode("CAN."),0,'L',0,0);
        $pdf->SetXY(12,$y);
        $pdf->MultiCell(60,5,utf8_decode("DESCRIPCION"),0,'C',0,0);
        $pdf->SetXY(72,$y);
$pdf->MultiCell(18,5,utf8_decode("PRECIO UN."),0,'C',0,0);
$pdf->SetXY(90,$y);
$pdf->MultiCell(20,5,utf8_decode("IMPORTE"),0,'C',0,0);



////////////////////////////////////////////////////////////////////////////////////////



  $ordenp=DB::select('select ventas.cantidad cantidad, carta.nombre producto, ventas.precio_v precio,ventas.precio_v*ventas.cantidad totalv from ventas, carta, cuentas 
where ventas.id_cuenta='.$id.'
and ventas.id_cuenta=cuentas.id_cuenta
and ventas.id_carta=carta.id_carta order by carta.nombre asc');
    //dd($ordenp);
   $y=$pdf->GetY()+2; 
   $x=2;
   $x2=106;
   $yinicio=$y;
  // dd($y);
   $pdf->SetXY($x,$y);
   // $pdf->Line($x, $y,$x2, $y);//comentar
$TOTAL_TOTAL=0;
    $Total=0;
    foreach ($ordenp as $key)
    {
        // $pdf->Line($x, $y-2,106, $y-2);
        $pdf->SetXY(12,$y);
       //  dd($y);

        if( $yinicio>250)
                  {

    $pdf->AddPage();
   $pdf->Ln(75);
   $y=$pdf->GetY();
    $yinicio=$y;
}
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','','8');
        $pdf->MultiCell(60,3,utf8_decode($key->producto),0,'L',0);
        $y=$pdf->GetY(); 
        $yvertcalf=$y;

        $pdf->SetXY($x,$y-3);
        $pdf->SetFont('Arial','','8');
        $pdf->MultiCell(10,3,utf8_decode($key->cantidad),0,'C',0);
        $pdf->SetXY($x+72,$y-3);
        $pdf->MultiCell(18,3,utf8_decode("$ ".$key->precio.""),0,'C',0);     
        $pdf->SetXY($x+90,$y-3);
        $pdf->MultiCell(16,3,utf8_decode("$ ".$key->totalv.""),0,'C',0);
        $Total=round($Total+($key->totalv),2);
        
         $yvertcalf=$pdf->GetY();
       // $pdf->Line($x, $y,$x, $yvertcalf);//comentar
         $y=$pdf->GetY()+2; 
         $yinicio=$y-2;
    }


    

    $pdf->SetXY($x+72,$y);
        $pdf->SetFillColor(100,200,3);
  $pdf->SetDrawColor(255,255,255);
        $pdf->SetFont('Arial','B','7');
  $pdf->MultiCell(12,4,utf8_decode("TOTAL: "),1,'C',1);   
  $pdf->SetXY($x+84,$y);  
  $pdf->MultiCell(20,4,utf8_decode("$ ".$Total.""),1,'C',1);
       




        
      $pdf->Output();
      exit();
    }

}
