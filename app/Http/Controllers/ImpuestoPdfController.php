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
use App\Mail\ImpuestoMail;
use Illuminate\Support\Facades\Mail;
use App\Usuarios;
use URL;
use Codedge\Fpdf\Fpdf\Fpdf;
date_default_timezone_set("Europe/Madrid");

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
    public $day;
    public $month;
    public $year;
    public $on1 = '';
    public $onif1 = '';
    public $on2 = '';
    public $onif2 = '';
    public $rn = '';
    public $rnif = '';
    public $doc = '';
    public $sede = '';
    //variables of html parser
   
    public function Header()
    {
        
         $this->Image(URL::asset('/img/logo_impuesto.jpg'), 10, 6, 40);
         $this ->SetFont('Times', '', 12);
         $this ->SetY(8);
         $this ->Cell(182, 5, utf8_decode('Documento Nro:  '.$this -> doc), 0, 1, 'R');
        if ($this -> sede != '') {
            $this ->Cell(150, 5, 'Sede:', 0, 0, 'R');
            $this ->Cell(0, 5, utf8_decode(' '.$this -> sede), 0, 0, 'L');
        }
        if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
            $this->Ln(15);
        } else {
            $this->Ln(25);
        }
    }

    public function Footer()
    { 
        $this->SetXY(0, 260);
        $this-> SetDrawColor(167, 167, 167);
        $this->Line(10, 260, 205, 260);
        $this->SetX(10);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(183, 6, utf8_decode('En MADRID, a '.$this -> day.' de '.$this -> month.' de '.$this -> year), 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', 'B', 10);
        $this->Cell(120, 6, utf8_decode('OTORGANTE(S)'), 0, 0, 'L');
        $this->Cell(100, 6, utf8_decode('REPRESENTANTE'), 0, 1, 'C');
        $this->Ln(10);
        $this->SetFont('Times', '', 8);
        $this->Cell(40, 6, $this -> on1, 0, 0, 'L');
        $this->Cell(25, 6, $this -> onif1, 0, 0, 'L');
        $this->Cell(40, 6, $this -> on2, 0, 0, 'C');
        $this->Cell(25, 6, $this -> onif2, 0, 0, 'C');
        $this->Cell(40, 6, $this -> rn, 0, 0, 'C');
        $this->Cell(25, 6, $this -> rnif, 0, 0, 'C');

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

        $s = sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', $txt_dx, $txt_dy, $font_dx, $font_dy, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }

    function drawTextBox($strText, $w, $h, $align='L', $valign='T', $border=true)
    {
        $xi=$this->GetX();
        $yi=$this->GetY();
        
        $hrow=$this->FontSize;
        $textrows=$this->drawRows($w,$hrow,$strText,0,$align,0,0,0);
        $maxrows=floor($h/$this->FontSize);
        $rows=min($textrows,$maxrows);

        $dy=0;
        if (strtoupper($valign)=='M')
            $dy=($h-$rows*$this->FontSize)/2;
        if (strtoupper($valign)=='B')
            $dy=$h-$rows*$this->FontSize;

        $this->SetY($yi+$dy);
        $this->SetX($xi);

        $this->drawRows($w,$hrow,$strText,0,$align,false,$rows,1);

        if ($border)
            $this->Rect($xi,$yi,$w,$h);
    }

    function drawRows($w, $h, $txt, $border=0, $align='J', $fill=false, $maxline=0, $prn=0)
    {
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $b=0;
        if($border)
        {
            if($border==1)
            {
                $border='LTRB';
                $b='LRT';
                $b2='LR';
            }
            else
            {
                $b2='';
                if(is_int(strpos($border,'L')))
                    $b2.='L';
                if(is_int(strpos($border,'R')))
                    $b2.='R';
                $b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
            }
        }
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $ns=0;
        $nl=1;
        while($i<$nb)
        {
            //Get next character
            $c=$s[$i];
            if($c=="\n")
            {
                //Explicit line break
                if($this->ws>0)
                {
                    $this->ws=0;
                    if ($prn==1) $this->_out('0 Tw');
                }
                if ($prn==1) {
                    $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
                }
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border && $nl==2)
                    $b=$b2;
                if ( $maxline && $nl > $maxline )
                    return substr($s,$i);
                continue;
            }
            if($c==' ')
            {
                $sep=$i;
                $ls=$l;
                $ns++;
            }
            $l+=$cw[$c];
            if($l>$wmax)
            {
                //Automatic line break
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                    if($this->ws>0)
                    {
                        $this->ws=0;
                        if ($prn==1) $this->_out('0 Tw');
                    }
                    if ($prn==1) {
                        $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
                    }
                }
                else
                {
                    if($align=='J')
                    {
                        $this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                        if ($prn==1) $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                    }
                    if ($prn==1){
                        $this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
                    }
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border && $nl==2)
                    $b=$b2;
                if ( $maxline && $nl > $maxline )
                    return substr($s, $i);
            }
            else
                $i++;
        }
        //Last chunk
        if ($this->ws>0) {
            $this->ws=0;
            if ($prn==1) $this->_out('0 Tw');
        }
        if($border && is_int(strpos($border, 'B')))
            $b.='B';
        if ($prn==1) {
            $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
        }
        $this->x=$this->lMargin;
        return $nl;
    }




var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=8*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        //$this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,8,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
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
class ImpuestoPdfController extends Controller
{

    public $team;
    /**
     * Store a newly created resource in storage.
     *
     * @param int $id   numero
     * @param int $mode mode
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


        $declaracion = DB::select("SELECT * FROM `t_impuestoDeclaracion`, `t_clientes` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?", [$id]);
        $declarante_2 = '';
        if ($declaracion[0] -> declarante_2 != 0) {
            $declarante_2 = DB::select("SELECT * FROM `t_clientes` WHERE idt_clientes = ?", [$declaracion[0] -> declarante_2]);
            $declarante_2 =  $declarante_2[0];
        }
        $declaracion = $declaracion[0];
        $respuestas = DB::select("SELECT * FROM `t_impuestoDeclaracionRespuesta` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND t_impuestoDeclaracionRespuestaIdDeclarante = ?  ORDER BY `t_impuestoDeclaracionRespuesta`.`t_impuestoPreguntas_idt_impuestoPreguntas` ASC", [$id, $declaracion -> declarante_1]);
        if ($declarante_2 != '') {
            $respuestas_2 = DB::select("SELECT * FROM `t_impuestoDeclaracionRespuesta` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND t_impuestoDeclaracionRespuestaIdDeclarante = ?  ORDER BY `t_impuestoDeclaracionRespuesta`.`t_impuestoPreguntas_idt_impuestoPreguntas` ASC", [$id, $declaracion -> declarante_2]);
        }
        $usuario_create = Usuarios::find($declaracion -> t_usuarios_idt_usuarios);
      

        $fecha = explode('-', $declaracion -> t_impuestoDeclaracionFecha);
        $day = $fecha[2];
        $mes = $MESCOMPLETO[$fecha[1]];
        $ano =  $fecha[0];
        $cliente = utf8_decode($declaracion -> t_clientesNombre).' '.utf8_decode($declaracion  -> t_clientesApellido);

        $pdf = new Pdf();
        $pdf -> doc = $declaracion -> t_impuestoDeclaracionReferencia;
        $pdf -> day = $day;
        $pdf -> month = $mes;
        $pdf -> year = $ano;
        $pdf -> on1 =  utf8_decode($declaracion -> t_clientesNombre).' '.utf8_decode($declaracion -> t_clientesApellido);
        $pdf -> onif1 = utf8_decode($declaracion -> t_clientesNif);
        if ($declaracion -> t_clientesTipoCliente == 'TURNO') {
            $pdf -> sede = $declaracion -> t_clientesEmpresa;
        }
       
        if ($declarante_2 != '') {
            $pdf -> on2 = utf8_decode($declarante_2 -> t_clientesNombre).' '.utf8_decode($declarante_2 -> t_clientesApellido);
            $pdf -> onif2 = utf8_decode($declarante_2 -> t_clientesNif);
        }

        $representante = '';
        if ($usuario_create  -> t_usuariosNombreCompletoPDF == '') {
            $pdf -> rn = utf8_decode($usuario_create  -> t_usuariosNombre).' '.utf8_decode($usuario_create  -> t_usuariosApellido);
            $pdf -> rnif = $usuario_create  -> t_usuariosNif;
            $representante = utf8_decode($usuario_create  -> t_usuariosNombre).' '.utf8_decode($usuario_create  -> t_usuariosApellido);
        } else {
            $pdf -> rn = utf8_decode($usuario_create  -> t_usuariosNombreCompletoPDF);
            $pdf -> rnif = $usuario_create  -> t_usuariosNifPDF;
            $representante = utf8_decode($usuario_create  -> t_usuariosNombreCompletoPDF);
        }
        $representante_email = $usuario_create -> t_usuariosEmail;


        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf -> SetAutoPageBreak(true, 40);

       
         
        $pdf->SetFont('Times', 'B', 14);
        if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
            $pdf->SetY(25);
        } else {
            $pdf->SetY(34);
        }
        
        $pdf->SetX(10);
        $year_declaracion = $declaracion -> t_impuestoDeclaracionYear; 
        $pdf->Cell(0, 10, utf8_decode('Control de Documentación para la Declaración de la Renta del Ejercicio '.$declaracion -> t_impuestoDeclaracionYear), 0, 1, 'C');
     
        $pdf->Cell(100, 10, utf8_decode('Declarante 1'), 0, 0, 'L');
        if ($declarante_2 != '') {
            $pdf->Cell(25, 10, utf8_decode('Declarante 2'), 0, 0, 'L');
        }
        $pdf ->Ln();
        $pdf->Cell(25, 6, utf8_decode('NIF:'), 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(75, 6, utf8_decode($declaracion -> t_clientesNif), 0, 0, 'L');
        
        if ($declarante_2 != '') {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(25, 6, utf8_decode('NIF:'), 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(55, 6, utf8_decode($declarante_2 -> t_clientesNif), 0, 0, 'L');
        }
       
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(25, 6, utf8_decode('NOMBRE:'), 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(75, 6, utf8_decode($declaracion -> t_clientesNombre.' '.$declaracion -> t_clientesApellido), 0, 0, 'L');
        
        if ($declarante_2 != '') {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(25, 6, utf8_decode('NOMBRE:'), 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(55, 6, utf8_decode($declarante_2 -> t_clientesNombre).' '. utf8_decode($declarante_2 -> t_clientesApellido), 0, 0, 'L');
        }

        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(25, 6, utf8_decode('EMAIL:'), 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(75, 6, utf8_decode($declaracion -> t_clientesEmail), 0, 0, 'L');

        if ($declarante_2 != '') {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(25, 6, utf8_decode('EMAIL:'), 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(55, 6, utf8_decode($declarante_2 -> t_clientesEmail), 0, 0, 'L');
        }

        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(25, 6, utf8_decode('TELEFONO:'), 0, 0, 'L');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(75, 6, utf8_decode($declaracion -> t_clientesTelefono), 0, 0, 'L');

        if ($declarante_2 != '') {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(25, 6, utf8_decode('TELEFONO:'), 0, 0, 'L');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(55, 6, utf8_decode($declarante_2 -> t_clientesTelefono), 0, 0, 'L');
        }

       
        // $pdf -> SetDrawColor(167, 167, 167);
        // $pdf ->Line(10, 100, 205, 100);
        $pdf ->Ln(10);
        $declarante_n = 0; 
        $n = 1;
        $y = $pdf->GetY();
        $pdf-> SetFillColor(216, 216, 216);
        if ($declarante_2 != '') {
            $pdf->Cell(195, 8, 'D1: '.utf8_decode($declaracion -> t_clientesNombre).' '.utf8_decode($declaracion -> t_clientesApellido).' |  D2: '. utf8_decode($declarante_2 -> t_clientesNombre).' '. utf8_decode($declarante_2 -> t_clientesApellido), 0, 'L', '', true);
            $y2 = $pdf->GetY();
            $pdf->SetY($y);
            $pdf->Cell(195, 8, 'D1     D2', 0, 0, 'R');
            $pdf->SetY($y2);
           
        } else {
            $pdf->Cell(195, 8, utf8_decode($declaracion -> t_clientesNombre).' '.utf8_decode($declaracion -> t_clientesApellido), 0, 0, 'L', true);
        
        }
        $pdf ->Ln();
       

        $tam = count($respuestas);
       
        for ($i = 0; $i < $tam; $i++) {
            
            $pdf->SetFont('Times', 'B', 12);
           
            $r1 = utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaRespuesta);
            $r2 = '';
            if ($declarante_2 != '') {
                $pdf->SetWidths(array(177, 10, 10));
                $r2 = utf8_decode($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaRespuesta);
                $pdf->Row(array(utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaPregunta), $r1, $r2));
            } else {
                $pdf->SetWidths(array(186, 10));
                $pdf->Row(array(utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaPregunta), $r1));

            }
            
            if ($respuestas[$i] -> t_impuestoDeclaracionRespuestaRespuesta == 'SI') {
                
                if ($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion != '') {
                
                    $pdf->SetFont('Times', '', 12);
                    $pdf->SetX(15);
                    $pdf->SetWidths(array(189));
                    if ($declarante_2 != '') {
                        $pdf->Row(array('Declarante 1: '.utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                    } else {
                        $pdf->Row(array(utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                    }
                } else {
                    if ($declarante_2 != '') {
                        if ($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaObservacion != '') {
                
                            $pdf->SetFont('Times', '', 12);
                            $pdf->SetX(15);
                            $pdf->SetWidths(array(189));
                            if ($declarante_2 != '') {
                                $pdf->Row(array('Declarante 1: '.utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                            } else {
                                $pdf->Row(array(utf8_decode($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                            }
                        }
                    
                    }

                }

                
            }
            if ($declarante_2 != '') {
                if ($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaRespuesta == 'SI') {
                    if ($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaObservacion != '') {
                    
                        $pdf->SetFont('Times', '', 12);
                        $pdf->SetX(15);
                        $pdf->SetWidths(array(189));
                        $pdf->Row(array('Declarante 2: '.utf8_decode($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                    } else {
                        if ($respuestas[$i] -> t_impuestoDeclaracionRespuestaObservacion != '') {
                            $pdf->SetFont('Times', '', 12);
                            $pdf->SetX(15);
                            $pdf->SetWidths(array(189));
                            $pdf->Row(array('Declarante 2: '.utf8_decode($respuestas_2[$i] -> t_impuestoDeclaracionRespuestaObservacion)));
                        }
                    }
                }
            }
        }
        $pdf->SetX(10);
        $pdf->SetFont('Times', 'B', 12);
        $pdf ->Ln();
        $pdf->Cell(183, 4, utf8_decode('OBSERVACIONES / CONTINGENCIAS FISCALES'), 0, 0, 'L');
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        //$pdf -> drawTextBox(utf8_decode($declaracion -> t_impuestoDeclaracionObservacion), 190, 40, 'L');
        $pdf -> MultiCell(190, 5, utf8_decode($declaracion -> t_impuestoDeclaracionObservacion));
        
        $pdf ->Ln(10);
        $pdf -> MultiCell(190, 5, utf8_decode('El Cliente manifiesta haber aportado los Datos Fiscales Actualizados y TODOS los documentos que reflejan TODOS sus ingresos percibidos durante el ejercicio anterior, tanto los contenidos en la Información Fiscal como los respondidos en este Documento, acreditando la veracidad de las manifestaciones aqui recogidas y actuando en nombre propio y en el nombre de los miembros de su Unidad Familiar.'));
        // $pdf ->Ln();
        // $pdf->Cell(183, 6, utf8_decode('En MADRID, a '.$day.' de '.$mes.' de '.$ano), 0, 0, 'L');
        // $pdf ->Ln();
        // $pdf->Cell(150, 4, utf8_decode('OTORGANTES'), 0, 0, 'L');
        // $pdf->Cell(55, 4, utf8_decode('REPRESENTANTE'), 0, 0, 'L');

        $pdf ->Ln(8);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(185, 6, utf8_decode('CLÁUSULA LEGAL DE INFORMACIÓN DE PROTECCIÓN DE DATOS'), 0, 0, 'C');
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('Usted queda informado y presta su consentimiento para la incorporación de sus datos en los ficheros del Gestor Administrativo  para la ejecución de los encargos de servicios realizados por usted, así como posteriores que pudiera encomendarnos. Asimismo, le informamos de que la información por usted facilitada podrá ser cedida a las Administraciones Públicas relacionadas con su encargo. Salvo que marque esta casilla ___, le podremos remitir información de su interés. Si para ello nos autoriza a utilizar su e-mail, marque aquí___ '));
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('En caso de que el interesado facilitase datos de terceras personas, quien lo haga deberá previamente, bajo su responsabilidad, solicitarles el consentimiento para ello e informarles de todo lo establecido en esta cláusula.'));
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('Finalmente, informarle de que puede ejercer sus derechos de acceso, rectificación, oposición y cancelación dirigiéndose por escrito a la dirección del Gestor Administrativo situada en: '.utf8_decode($usuario_create->t_usuariosDireccion)));
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('MODELO DE REPRESENTACIÓN PARA LA PRESENTACIÓN POR MEDIOS ELECTRÓNICOS DE AUTOLIQUIDACIONES, DECLARACIONES Y COMUNICACIONES TRIBUTARIAS'),'C');
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(185, 6, utf8_decode('OTORGAMIENTO DE LA REPRESENTACIÓN'), 0, 0, 'L');
        
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('OTORGAN SU REPRESENTACIÓN al Gestor Administrativo  con NIF  '.$pdf -> rnif.', como firmante o adherido al Convenio de Colaboración entre la Agencia Estatal de Admininistración Tributaria y el Ilustre Colegio de Gestores Administrativos de Madrid para presentar por vía electrónica la declaración o comunicación tributaria correspondiente al Impuesto Sobre la Renta de las Personas Físicas del Ejercicio '.$declaracion -> t_impuestoDeclaracionYear));
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('La presente Autorización se circunscribe a la mencionada presentación por vía electrónica sin que confiera al presentador la condición de representante para intervenir en otros actos o para recibir todo tipo de comunicaciones de la Administración Tributaria en nombre del obligado tributario o interesado, aún cuando éstas fueran consecuencia del documento presentado.'));
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('Asimismo, el/los otorgantes autoriza/n a que sus datos personales sean tratados de manera automatizada a los exclusivos efectos de la presentación de la declaración o comunicación por medios electrónicos.'));
        $pdf ->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(185, 8, utf8_decode('ACEPTACIÓN DE LA REPRESENTACIÓN'), 0, 0, 'L');
        $pdf ->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf -> MultiCell(190, 5, utf8_decode('Con la firma del presente escrito el representante acepta la representación conferida y responde de la autencidad de la fima del/de los otorgante/s, así como de la/s copia/s del DNI del/de los mismo/s que acompaña/n a este/estos documento/s. Sólo se acreditará esta representación ante la Administración Tributaria cuando ésta lo inste al representante.'));
       
        //$pdf ->Ln();
        //$pdf->Cell(183, 6, utf8_decode('En MADRID, a '.$day.' de '.$mes.' de '.$ano), 0, 0, 'L');
        // $pdf ->Ln();
        // $pdf->Cell(150, 4, utf8_decode('OTORGANTES'), 0, 0, 'L');
        // $pdf->Cell(55, 4, utf8_decode('REPRESENTANTE'), 0, 0, 'L');

        if ($mode == 'a') {
            
            if ($declaracion -> t_clientesEmail != '') {
                $pdf->Output('F', 'pdf/Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf');
                $objDemo = new \stdClass();
                $objDemo -> to = $declaracion -> t_clientesEmail;
                $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                $objDemo -> vista = 'mails.impuesto';
                $objDemo -> cliente = $cliente;
                $objDemo -> representante = $representante;
                $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
        
                Mail::to($declaracion -> t_clientesEmail)->send(new ImpuestoMail($objDemo));
            }

            if ($declarante_2 != '') {
                if ($declarante_2 -> t_clientesEmail != '') {
                    
                    $objDemo = new \stdClass();
                    $objDemo -> to = $declarante_2-> t_clientesEmail;
                    $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                    $objDemo -> vista = 'mails.impuesto';
                    $objDemo -> cliente = utf8_decode($declarante_2 -> t_clientesNombre).' '. utf8_decode($declarante_2 -> t_clientesApellido);
                    $objDemo -> representante = $representante;
                    $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
             
                    Mail::to($declarante_2 -> t_clientesEmail)->send(new ImpuestoMail($objDemo));
                   
                }
            }

            
            if ($representante_email != '') {
                 $objDemo = new \stdClass();
                $objDemo -> to = $representante_email;
                $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                $objDemo -> vista = 'mails.impuesto';
                $objDemo -> cliente = $cliente;
                $objDemo -> representante = $representante;
                $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
             
                Mail::to($representante_email)->send(new ImpuestoMail($objDemo));
                  
            }

            

            return redirect('/impuesto/'.$id) -> with('success', 'Declaración enviada al cliente');
        }

        if ($mode == 'b') {
            $pdf -> Output('D', utf8_decode('Declaración '.$declaracion -> t_clientesNombre.' '.$declaracion -> t_clientesApellido.' '.$ano.' '.$id).'.pdf');
            //return redirect('/presupuesto/'.$presupuestos[0] -> t_presupuestosNumero);
        }

        if ($mode == 'c') {
            //impuestoAnotaciones
            $notes_e = DB::select("SELECT * FROM `tb_anotaciones` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND tb_anotacionesIE = 'E' ORDER BY `tb_anotaciones`.`idtb_anotaciones` DESC", [$id]);
           
            if ($declaracion -> t_clientesEmail != '') {
                $pdf->Output('F', 'pdf/Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf');
                $objDemo = new \stdClass();
                $objDemo -> to = $declaracion -> t_clientesEmail;
                $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                $objDemo -> vista = 'mails.impuestoAnotaciones';
                $objDemo -> cliente = $cliente;
                $objDemo -> mode = $mode;
                $objDemo -> note = $notes_e;
                $objDemo -> representante = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
        
                Mail::to($declaracion -> t_clientesEmail)->send(new ImpuestoMail($objDemo));
            }

            if ($declarante_2 != '') {
                if ($declarante_2 -> t_clientesEmail != '') {
                    
                    $objDemo = new \stdClass();
                    $objDemo -> to = $declarante_2-> t_clientesEmail;
                    $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                    $objDemo -> vista = 'mails.impuestoAnotaciones';
                    $objDemo -> cliente = utf8_decode($declarante_2 -> t_clientesNombre).' '. utf8_decode($declarante_2 -> t_clientesApellido);
                    $objDemo -> representante = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                    $objDemo -> note = $notes_e;
                    $objDemo -> mode = $mode;
                    $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
             
                    Mail::to($declarante_2 -> t_clientesEmail)->send(new ImpuestoMail($objDemo));
                   
                }
            }
            return redirect('/impuesto/'.$id) -> with('success', 'Declaración con Anotaciones enviada al cliente');
        }

        if ($mode == 'd') { 
            $notes_i = DB::select("SELECT * FROM `tb_anotaciones` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND tb_anotacionesIE = 'I' ORDER BY `tb_anotaciones`.`idtb_anotaciones` DESC", [$id]);
           

            foreach ($this -> team as $t) {
                $pdf->Output('F', 'pdf/Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf');
                $objDemo = new \stdClass();
                $objDemo -> to = $t['email'];
                $objDemo -> pdf = 'Cuestionario '.$declaracion -> t_impuestoDeclaracionReferencia.'.pdf';
                $objDemo -> vista = 'mails.impuestoAnotaciones';
                $objDemo -> cliente = $cliente;
                $objDemo -> note = $notes_i;
                $objDemo -> mode = $mode;
                $objDemo -> team_member =  $t['name'];
                $objDemo -> representante = Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido;
                $objDemo -> year = $declaracion -> t_impuestoDeclaracionYear;
        
                Mail::to($t['email'])->send(new ImpuestoMail($objDemo));
            }
           
            return redirect('/impuesto/'.$id) -> with('success', 'Declaración con Anotaciones enviada a Compañeros');
        }
       
        exit;
    }
}
