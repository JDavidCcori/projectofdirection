<?php

require('./fpdf.php');

require_once('../../controlador/secretario/actasControlador.php');

$resultado = actasControlador::verPDFC();
$datos = mysqli_fetch_array($resultado);

$numero = $datos['numero_acta'];
$asunto = $datos['asunto_acta'];
$fecha = $datos['fecha'];
$acuerdo = $datos['acuerdo_acta'];
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        global $numero;
        $this->SetFont('Times', 'B', 19);
        $this->Cell(0, 15, utf8_decode('ACTA COMUNITARIA N° ' . $numero), 0, 1, 'C');
        $this->Ln(10);
    }

    // Contenido de página
    function Content()
    {
        global $asunto, $acuerdo, $fecha;

        $this->SetFont('Times', '', 12);

        // Definir márgenes
        $marginLeft = 24;
        $marginTop = 30;
        $marginRight = 24;
        $marginBottom = 24;

        $this->SetAutoPageBreak(true, $marginBottom);

        // Establecer márgenes
        $this->SetMargins($marginLeft, $marginTop, $marginRight);

        $this->SetXY($marginLeft, $marginTop); // Restablecer la posición actual al comienzo del contenido

        $this->MultiCell(0, 10, utf8_decode('En la comunidad de Pallaccocha, distrito de Turpo, provincia de Andahuaylas, departamento de Apurímac, siendo la fecha: '.$fecha.' , se llevó a cabo una reunión comunitaria con el fin de discutir y llegar a acuerdos respecto a:  ' .$asunto. ' en beneficio de nuestra comunidad. '), 0, 'L');
      
        $this->Ln(8);

        // Título "Acuerdo de la reunión" en negrita
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Acuerdo de la reunión:'), 0, 1, 'L');
        $this->SetFont('Times', '', 12);
        $this->MultiCell(0, 10, utf8_decode($acuerdo), 0, 'L');

        $this->Ln(8);

        // Título "Participantes" en negrita
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Participantes:'), 0, 1, 'L');
        $this->SetFont('Times', '', 12);

        // Obtener la lista completa de participantes
        $resultado2 = actasControlador::participantesC();
        while ($datoss = mysqli_fetch_array($resultado2)) {
            $nombres = $datoss['nombres'];
            $apellidos = $datoss['apellidos'];
            $dni = $datoss['dni'];

            // Agregar cada participante al contenido del acta
            $this->MultiCell(0, 10, utf8_decode($nombres . ' ' . $apellidos . '  ----->  ' . $dni), 0, 'L');
        }

        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        global $acuerdo, $fecha;
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 10);
        $this->Cell(0, 10, utf8_decode('Pallaccocha,  ' . $fecha), 0, 1, 'R');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output('Acta_comunitaria_N' . $numero . '.pdf', 'I');
?>