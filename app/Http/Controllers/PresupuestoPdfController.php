<?php
/**
 * Short description for file
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use URL;
use Codedge\Fpdf\Fpdf\Fpdf;


date_default_timezone_set("Europe/Madrid");
//use Fpdf;
/**
 * Short description for file
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class Pdf extends Fpdf
{
    public $img_pie;
    //variables of html parser
   
    public function Header()
    {
        //$this->Image(storage_path().'/sampablo.jpg',10,6,30);
         $this->Image(URL::asset('/img/sampablo.jpg'), 10, 6, 40);
         $this->Image(URL::asset('/img/garantiaprofecional.jpg'), 150, 5, 50);
        // $this->Image('/img/logo.png',10,6,30);
        // $this->SetFont('Arial','B',15);
        //$this->Cell(80);
        // $this->Cell(30,10,'title',1,0,'C');
        $this->SetFont('Times', '', 7);
        $this->TextWithRotation(5,240,utf8_decode('MARTÍN HERRERA & FRAGA, S.L.P. - Sociedad Inscrita en el R.M. de Madrid, Tomo: 16.480, Libro: 0, Folio: 23, Secc.: 8, Hoja: M-280492, Inscr. 1ª  -  CIF: B-82.875.840'),90,0);

         $this->Ln(30);
    }

    public function Footer()
    {

        //$this -> SetY(-10);
       
        // $img = URL::asset('/img/pie_pagina_officina1.jpg');
       
        // you will probably want to swap the width/height
        // around depending on the page's orientation
        //$this->Image( $img, ((self::A4_HEIGHT - $width) / 2)-50, 240,$width, $height);
        $this -> Image(URL::asset('/img/'.$this -> img_pie), 8, 254, 195);
    }

   
function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
{
    $font_angle+=90+$txt_angle;
    $txt_angle*=M_PI/180;
    $font_angle*=M_PI/180;

    $txt_dx=cos($txt_angle);
    $txt_dy=sin($txt_angle);
    $font_dx=cos($font_angle);
    $font_dy=sin($font_angle);

    $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}


}

/**
 * Short description for file
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class PresupuestoPdfController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $id nuemro de presupuesto 
     * 
     * @return \Illuminate\Http\Response
     */
    function descargar($id,$mode)
    {   
        $MESCOMPLETO['01'] = 'Enero';
        $MESCOMPLETO['02'] = 'Febrero';
        $MESCOMPLETO['03'] = 'Marzo';
        $MESCOMPLETO['04'] = 'Abril';
        $MESCOMPLETO['05'] = 'Mayo';
        $MESCOMPLETO['06'] = 'Junio';
        $MESCOMPLETO['07'] = 'Julio';
        $MESCOMPLETO['08'] = 'Agosto';
        $MESCOMPLETO['09'] = 'Septiembre';
        $MESCOMPLETO['10'] = 'Octubre';
        $MESCOMPLETO['11'] = 'Noviembre';
        $MESCOMPLETO['12'] = 'Diciembre';

        $presupuestos = DB::select("SELECT * FROM `t_presupuestos`,`t_clientes` where  sha1(md5(`t_presupuestos`.`idt_presupuestos`)) = ? AND `t_clientes`.`idt_clientes` = `t_presupuestos`.`t_clientes_idt_clientes`", [$id]);
        $id_presupuesto = $presupuestos[0] -> idt_presupuestos;
        $oficina = DB::table('t_oficinas')->where('idt_oficinas', $presupuestos[0] -> t_oficinas_idt_oficinas)->first();
        $presupuestos_repuestas = DB::select("SELECT * FROM `t_presupuestoRepuesta`,`t_preguntas` where `t_presupuestoRepuesta`.`t_presupuestos_idt_presupuestos` = ? AND `t_preguntas`.`idt_preguntas` = `t_presupuestoRepuesta`.`t_preguntas_idt_preguntas`", [$id_presupuesto]);
        $presupuestos_conceptos = DB::select("SELECT * FROM `t_presupuestosConceptos` where `t_presupuestosConceptos`.`t_presupuestos_idt_presupuestos` = ? ORDER BY `t_presupuestosConceptos`.`t_presupuestosConceptosOrden` ASC", [$id_presupuesto]);
       

        $pdf = new Pdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf -> SetAutoPageBreak(true, 40);

        $pdf -> img_pie = $oficina -> t_oficinasUrlPiePresupuesto;
        $empresa = $presupuestos[0] -> t_clientesEmpresa;
        $nombre_oficina = utf8_decode($oficina -> t_oficinasNombre);
        $fecha = explode('-', $presupuestos[0] -> t_presupuestosDate);
        $day = $fecha[2];
        $mes = $MESCOMPLETO[$fecha[1]];
        $ano =  $fecha[0];
        $cliente = utf8_decode($presupuestos[0] -> t_clientesNombre.' '.$presupuestos[0] -> t_clientesApellido);
        

        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetY(40);
        $pdf->SetX(110);
        $pdf->Cell(55, 10, 'Presupuesto', 0, 0, 'R');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, $presupuestos[0] -> t_presupuestosNumero, 0, 0, 'R');
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, $empresa, 0, 0, 'R');
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 10, 'En '.$nombre_oficina.' a '.$day.' de '.$mes.' del '.$ano, 0, 0, 'L');
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, 'Estimado(a) '.ucfirst($cliente), 0, 0, 'L');
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(0, 5, utf8_decode('Le agradecemos de antemano que nos permita darle a conocer nuestros servicios como Gestoría, actividad que venimos desarrollando desde el año 1997.

Podríamos decir y enumerar todo lo somos o lo que hacemos, pero no tiene sentido sobre todo cuando nos dirigimos a alguien como usted que no nos conoce todavía, por ello como responsable de esta Gestoría, lo único que puedo garantizarle es que formamos un grupo humano que trabaja cada día con el único objetivo de hacer que los problemas administrativos de nuestros clientes sean los nuestros, porque sólo de esta manera se puede conseguir la solución que cada cliente necesita. 

Según la información que nos ha facilitado y para que valore nuestra propuesta, hemos elaborado para usted este presupuesto que cubriría los siguientes servicios:'));
        // $pdf->writeHTML('This is my disclaimer. <b>THESE WORDS NEED TO BE BOLD.</b> These words do not need to be bold.');

       
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, 'PRIMERO.- Servicios Profesionales', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
       
        if (count($presupuestos_conceptos) > 0) {
            $indice = 1;
            foreach ($presupuestos_conceptos as $concepto) {
                $pdf->SetFont('Times', 'B', 12);
                $pdf->SetX(15);
                $pdf->Cell(0, 10, $indice.'.- '.utf8_decode($concepto -> t_presupuestosConceptosNombres), 0, 1);
                $pdf->SetFont('Times', '', 12);
                $pdf->SetX(15);
                $pdf -> MultiCell(185, 5, utf8_decode($concepto -> t_presupuestosConceptosDescripcion),0,'J');
               
                $pdf ->Ln();
                
                if ($indice == 1) {
                    $pdf ->Ln();
                    $pdf ->Ln();
                    $pdf ->Ln();
                    $pdf ->Ln();
                }
                $indice++;
            }
        }
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('SEGUNDO.- Valoración Económica de las Servicios Ofertados'), 0, 1);
        $pdf->SetFont('Times', 'B', 12);

        if (count($presupuestos_conceptos) > 0) {
            $indice = 1;
            foreach ($presupuestos_conceptos as $concepto) {
                $pdf->SetFont('Times', 'B', 12);
                $pdf->SetX(15);
                $pdf->Cell(0, 10, $indice.'.- '.utf8_decode($concepto -> t_presupuestosConceptosNombres), 0, 1);
                $pdf->SetFont('Times', '', 12);
                $pdf->SetX(15);
                $pdf -> MultiCell(185, 5, utf8_decode($concepto -> t_presupuestosConceptoCuota),0,'J');
                $indice++;
                $pdf ->Ln();
            }
        }
        $pdf ->Ln();
        $pdf ->Ln();
        $pdf -> MultiCell(185, 5, utf8_decode('Espero que este presupuesto sea lo suficientemente claro y conciso sobre el alcance de los servicios que le ofrecemos y sobre el importe de dichos trabajos, y le rogamos que valore nuestra oferta más allá del importe económico, que a pesar de ser uno de los elementos más destacados, desde nuestro punto de vista no es el más importante.

En cualquier ámbito de la vida, tener a tu lado a alguien con experiencia, conocimiento y capacidad para ayudarte y entregarse totalmente siempre que lo necesites, es algo que no tiene precio, se lo digo por experiencia.

Me llamo José Antonio Martín Herrera y tengo el gran honor de representar al grupo de trabajo que hoy pongo totalmente a su disposición, por lo que si desea vivir esta experiencia de trabajo con nosotros estaremos encantados de ser su aliado en el día a día de su empresa.

En cualquier caso y con independencia de la decisión que tome, le deseo lo mejor en el ámbito personal y profesional.
        
Un saludo'),0,'J');

        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 5, utf8_decode('Fdo. José Antonio Martín Herrera'), 0, 1);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 5, utf8_decode('Gestor Colegiado desde 1997'), 0, 1);
        $pdf->Cell(0, 5, utf8_decode('Asesor Fiscal'), 0, 1);
       

        if ($mode == 'a') {
            
            $pdf->Output('F', 'pdf/'.$presupuestos[0] -> t_presupuestosNumero.'.pdf');
            $objDemo = new \stdClass();
            $objDemo -> to = $presupuestos[0] -> t_clientesEmail;
            $objDemo -> pdf = $presupuestos[0] -> t_presupuestosNumero.'.pdf';
            $objDemo -> vista = 'mails.demo';
            $objDemo -> cliente = $cliente;

            //$objDemo->sender = 'SenderUserName';
            // $objDemo->receiver = 'ReceiverUserName';
     
            Mail::to($presupuestos[0] -> t_clientesEmail)->send(new DemoEmail($objDemo));

            // $data = array(
            //     'cliente' => $cliente,
            //      'email' => $presupuestos[0] -> t_clientesEmail
            // );
            // // // $email = $presupuestos[0] -> t_clientesEmail;
            // // // $message = new DemoEmail($data);
            // Mail::send('mails.demo',$data, function($message) {
            //     $message->subject('Presupuesto');
            // });
             
             
             
             
             return redirect('/presupuesto/'.$presupuestos[0] -> t_presupuestosNumero) -> with('success', 'Presupuesto Nro.'.$presupuestos[0] -> t_presupuestosNumero.' enviado al cliente');
        }

        if ($mode == 'b') {
            $pdf->Output('D',$presupuestos[0] -> t_presupuestosNumero.'.pdf');
            return redirect('/presupuesto/'.$presupuestos[0] -> t_presupuestosNumero);
        }
       
        exit;

        // Fpdf::AddPage();
        // Fpdf::SetFont('Courier', 'B', 18);
        // Fpdf::Cell(50, 25, 'Hello World!');
        // Fpdf::Output('D', 'filename.pdf');
       
        // I: send the file inline to the browser. The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
        // D: send to the browser and force a file download with the name given by name.
        // F: save to a local file with the name given by name (may include a path).
        // S: return the document as a string. name is ignored.
        // return view('pdfPresupuesto');
        // $pdf->MultiCell(40, 10, '2018090909090', 0, 'C');
        //$pdf->SetY(20); /* Set 20 Eje Y */
        //$pdf->Cell(40,10,'Columna3',1,0,'C');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param int $id nuemro de presupuesto 
     * 
     * @return \Illuminate\Http\Response
     */
    function guardar($id) 
    {

    }
}
