<?php
require_once APPPATH."/third_party/fpdf/fpdf.php";

class Pdf extends FPDF
{
// Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('http://insous.es/servicios/images/logomovilinsous.png',10,5,15);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(20);
        // Título
        $this->SetTextColor(0,154,195);
        $this->SetFont('Times','B',22);
        $this->Cell(10,10,'Tu Tienda Online',0,0,'L');
        
        $this->Line(1,25,200,25);
        $this->Line(1,25,200,25);
        // Salto de línea
        $this->Ln(20);
        //barra 
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        //linea
        $this->Line(1,280,200,280);
        $this->Line(1,280,200,280);

        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


?>