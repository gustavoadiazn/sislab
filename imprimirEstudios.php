<?php
setlocale(LC_ALL, 'es_MX');
require('fpdf184/fpdf.php');

class PDF extends FPDF
{
    //Cabecera de página
   function Header()
   {
    //Logo
    $this->Image("images/original.jpg" , 10 ,8, 35 , 38 , "JPG");
    //Arial bold 15
    $this->SetFont('Arial','B',18);
    //Movernos a la derecha
    $this->Cell(100);
    //Título
    $this->Cell(60,10,'Laboratorio',0,0,'C');
    //Salto de línea
    $this->Ln(20);
      
   }

    //Pie de p�gina
    function Footer()
    {
        //Posici�n: a 1,5 cm del final
        $this->SetY(-25);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //N�mero de p�gina
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ColorRow()
    {
        //Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        //Arial bold 15
    }

    function ColorRest(){
        //Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
    }
}

//Creaci�n del objeto de la clase heredada
$pdf = new PDF('P');
$pdf->AliasNbPages();
$pdf->AddPage();
include("conectarsislab.php");
$ids = $_POST["ids"];

$sql = "SELECT count(distinct pacientes_idpaciente) as numpac FROM servicios s where fecha between '$fechaI' and '$fechaT';";
$result = mysqli_query($db, $sql);
if ($row = mysqli_fetch_array($result)) {    
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(80);
        $pdf->Cell(100, 5, 'Reporte de Pacientes, Servicios y Estudios', 0, 1, 'C');        
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(100);
        $pdf->Cell(100, 5, 'Fechas: ' . $fechaI. ' a '. $fechaT, 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->ColorRow();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(100);
        $pdf->Cell(60, 5, 'Pacientes atendidos', 1, 1, 'C',1);
        $numpac = $row["numpac"]; 
        $pdf->ColorRest();     
        $pdf->Cell(100);
        $pdf->Cell(60, 5, $numpac, 1, 1, 'C',1);                    
}

$sql2 = "SELECT count(idservicio) as num, tipoServicios_idtipoServicio, nombre
FROM servicios s, tiposervicios ts
where fecha between '$fechaI' and '$fechaT' and s.tipoServicios_idtipoServicio=ts.idtipoServicio
group by tipoServicios_idtipoServicio;";
$result2 = mysqli_query($db, $sql2);
if ($row2 = mysqli_fetch_array($result2)) { 
    $i=0;
    do{
        $idt[$i]=$row2["tipoServicios_idtipoServicio"];
        $num[$i]=$row2["num"];
        $nombre[$i]=$row2["nombre"];
        $i++;
    } while ($row2 = mysqli_fetch_array($result2));
}

$sql3 = "SELECT count(idestudiosxServicio) as numest
FROM servicios s,estudiosxservicio es, tiposervicios ts
where s.idservicio=es.servicios_idservicio and s.tipoServicios_idtipoServicio=ts.idtipoServicio and fecha between '$fechaI' and '$fechaT'
group by s.tipoServicios_idtipoServicio
order by s.tipoServicios_idtipoServicio;";
$result3 = mysqli_query($db, $sql3);
if ($row3 = mysqli_fetch_array($result3)) { 
    $i=0;
    do{        
        $numest[$i]=$row3["numest"];        
        $i++;
    } while ($row3 = mysqli_fetch_array($result3));
}
$pdf->Ln(5);
$pdf->ColorRow();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30);
$pdf->Cell(15, 5, "ID", 1, 0, 'C',1);
$pdf->Cell(80, 5, "Tipo de Servicio", 1, 0, 'C',1);
$pdf->Cell(60, 5, "Numero de Servicios", 1, 0, 'C',1);
$pdf->Cell(60, 5, "Numero de Estudios", 1, 1, 'C',1);

$pdf->ColorRest();
$fill=false;
for($j=0;$j<$i;$j++){    
    $pdf->Cell(30);
    $pdf->Cell(15, 5, $idt[$j], 1, 0, 'L',$fill);
    $pdf->Cell(80, 5, $nombre[$j], 1, 0, 'L',$fill);
    $pdf->Cell(60, 5, $num[$j], 1, 0, 'C',$fill);
    $pdf->Cell(60, 5, $numest[$j], 1, 1, 'C',$fill);
    $fill=!$fill;
}
//$pdf->Output('../sicaa2/documentos/pdfRecibos/prueba2.pdf', 'F');
$pdf->Output();
