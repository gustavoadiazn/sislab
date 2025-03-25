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
include("conectarsislab.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ids = $_POST['ids'];
} else {
    $ids = $_GET['ids'];
}
$sql = "SELECT * FROM estudiosxservicio es, estudios e where servicios_idservicio='$ids' AND es.estudios_idestudio=e.idestudio;";
$result = mysqli_query($db, $sql);
while($row = mysqli_fetch_array($result)){
    $pdf->AddPage();
    $idesxs = $row["idestudiosxServicio"];
    $idest = $row["estudios_idestudio"];
    $nomest = utf8_decode($row["nombre"]);
    $descest = utf8_decode($row["desc"]);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(80);
    $pdf->Cell(100, 5, 'Estudio: ' . $nomest, 0, 1, 'C');
    $pdf->Ln(10);
    //buscar datosporestudio
    $sql2 = "SELECT * FROM datosxestudiosxservicio des,datos d where des.estudiosxServicio_idestudiosxServicio='$idesxs' AND des.datos_iddato=d.iddato;";
    $result2 = mysqli_query($db, $sql2);
    if($row2=mysqli_fetch_array($result2)){                
        $pdf->Ln(5);
        $pdf->ColorRow();
        $pdf->SetFont('Arial','B',8);        
        $pdf->Cell(50, 5, "Estudio", 1, 0, 'C',1);
        $pdf->Cell(25, 5, "Dato", 1, 0, 'C',1);
        $pdf->Cell(50, 5, "Observaciones", 1, 0, 'C',1);
        $pdf->Cell(20, 5, "Indicadores", 1, 0, 'C',1);
        $pdf->Cell(40, 5, utf8_decode("Descipción"), 1, 1, 'C',1);
        $pdf->ColorRest();
        $fill=false;
        do{   
            $nombre = $row2["nombre"];
            $num = $row2["dato"];
            $obs=$row2["observaciones"];
            $ind=$row2["indicadores"];
            $des=$row2["desc"];             
            $pdf->Cell(50, 5, utf8_decode($nombre), 1, 0, 'L',$fill);
            $pdf->Cell(25, 5, utf8_decode($num), 1, 0, 'L',$fill);
            $pdf->Cell(50, 5, utf8_decode($obs), 1, 0, 'C',$fill);
            $pdf->Cell(20, 5, utf8_decode($ind), 1, 0, 'C',$fill);
            $pdf->Cell(40, 5, utf8_decode($des), 1, 1, 'C',$fill);
            $fill=!$fill;
        }while($row2=mysqli_fetch_array($result2));
    }

}

//$pdf->Output('../sicaa2/documentos/pdfRecibos/prueba2.pdf', 'F');
$pdf->Output();
