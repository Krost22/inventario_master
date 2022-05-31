<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'REPORTE INVENTARIO',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$query = "SELECT * FROM products";
$resultado = $mysqli->query($query);



$pdf = new PDF();
$pdf->AliasNbpages();
$pdf->AddPage();
$pdf->Image('img/volante.png',160,0,30);
$pdf->Image('img/sumi.png', 10,5,60);
$pdf->SetFillColor(232,232,232);

	$pdf->SetFont('Arial','B',6);

	$pdf->Cell(30,6,'FECHA',1,0,'C',1);
	$pdf->Cell(10,6,'ID',1,0,'C',1);
	$pdf->Cell(30,6,'PROVEEDOR',1,0,'C',1);
    $pdf->Cell(30,6,'PRODUCTO',1,0,'C',1);
    $pdf->Cell(15,6,'PLACA',1,0,'C',1);
    $pdf->Cell(10,6,'PESO',1,0,'C',1);
    $pdf->Cell(15,6,'UNIDADES',1,0,'C',1);
    $pdf->Cell(50,6,'OBSERVACIONES',1,1,'C',1);



$pdf->SetFont('Arial','',8);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(30, 6, $row['date_added'], 1, 0, 'c', 0);
    $pdf->Cell(10, 6, $row['id_producto'], 1, 0, 'c', 0);
    $pdf->Cell(30, 6, $row['codigo_producto'], 1, 0, 'c', 0);
    $pdf->Cell(30, 6, $row['nombre_producto'], 1, 0, 'c', 0);
    $pdf->Cell(15, 6, $row['placa'], 1, 0, 'c', 0);
    $pdf->Cell(10, 6, $row['peso'], 1, 0, 'c', 0);
    $pdf->Cell(15, 6, $row['stock'], 1, 0, 'c', 0);
    $pdf->Cell(50, 6, $row['observaciones'], 1, 1, 'c', 0);
}

$pdf->Output();
?>