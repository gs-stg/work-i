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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\UsuariosPermisos;
use App\Usuarios;
use App\Permisos;
use App\ImpuestoDeclaracion;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImpuestoPdfController;
date_default_timezone_set("Europe/Madrid");   
/**
 * ImpuestoController
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $autocomplete['nif_1'] = '';
        $autocomplete['nombre_1'] = '';
        $autocomplete['apellido_1'] = '';
        $autocomplete['telefono_1'] = '';
        $autocomplete['email_1'] = '';
        $autocomplete['empresa_1'] = '';
        $autocomplete['nif_2'] = '';
        $autocomplete['nombre_2'] = '';
        $autocomplete['apellido_2'] = '';
        $autocomplete['telefono_2'] = '';
        $autocomplete['email_2'] = '';
        $autocomplete['empresa_2'] = '';

        if (isset($request -> u)) { 
            $login =  new LoginController();
            $a =  $login -> startSimpleParametes($request -> u);
            if (isset($request -> nif_1)) {
                $autocomplete['nif_1'] = $request -> nif_1;
            }
            if (isset($request -> nombre_1)) {
                $autocomplete['nombre_1'] = $request -> nombre_1;
            }
            if (isset($request -> apellido_1)) {
                $autocomplete['apellido_1'] = $request -> apellido_1;
            }
            if (isset($request -> telefono_1)) {
                $autocomplete['telefono_1'] = $request -> telefono_1;
            }
            if (isset($request -> email_1)) {
                $autocomplete['email_1'] = $request -> email_1;
            }
            if (isset($request -> empresa_1)) {
                $autocomplete['empresa_1'] = $request -> empresa_1;
            }

            if (isset($request -> nif_2)) {
                $autocomplete['nif_2'] = $request -> nif_2;
            }
            if (isset($request -> nombre_2)) {
                $autocomplete['nombre_2'] = $request -> nombre_2;
            }
            if (isset($request -> apellido_2)) {
                $autocomplete['apellido_2'] = $request -> apellido_2;
            }
            if (isset($request -> telefono_2)) {
                $autocomplete['telefono_2'] = $request -> telefono_2;
            }
            if (isset($request -> email_2)) {
                $autocomplete['email_2'] = $request -> email_2;
            }
            if (isset($request -> empresa_2)) {
                $autocomplete['empresa_2'] = $request -> empresa_2;
            }
           
            

        }
       
        if (isset(Session::get('user') -> idt_usuarios) && isset(Session::get('permisos')['menu_crearCustionarioRenta'])) {
            $preguntas = DB::select("SELECT * FROM `t_impuestoPreguntas`");
            $preguntas_control = DB::select("SELECT * FROM `t_opcionesPreguntas` ORDER BY `t_opcionesPreguntas`.`t_opcionesPreguntasReferencia` ASC");
            $data = array('preguntas' => $preguntas,'preguntas_control' => $preguntas_control , 'autocomplete' => $autocomplete);
            return view('preguntasImpuesto') -> with($data);
        } 
        return redirect('/login/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        //Comprobado
        //$request -> control_id.' '.$request -> status
     
       // return Session::get('user') -> idt_usuarios;
       // if ($request -> ajax()) {
           
        if (isset(Session::get('user') -> idt_usuarios)) {

            //return $request ->mode;
            if ($request -> status == 'Iniciado') {
                if (!$request -> ajax()) { 
                    return redirect('/impuesto/consultar') -> with('error', 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"');
                } else {
                    return response() -> json([ 'message' => 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"', 'status'=> false]);
                }
            } 
            
            if ($request -> status == 'Comprobado') {
                if (isset(Session::get('permisos')['cuestionarioRentaCambiarComprobado'])) {
                    $affected = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionEstatus` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [$request -> status,$request -> control_id]);
                    $status_0 = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionComprobado` = ?,`t_impuestoDeclaracionComprobadoU` = ?,`t_impuestoDeclaracionComprobadoUId` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [date('Y-m-d'),(Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido),Session::get('user') -> idt_usuarios,$request -> control_id]);
                
                    if ($affected) { 
                        if (!$request -> ajax()) { 
                            return redirect('/impuesto/consultar') -> with('success', 'Cuestionario Nro: '.$request -> cuestionario.' Actualizado');
                        } else {
                            return response() -> json([ 'message' => 'Cuestionario Nro: '.$request -> cuestionario.' Actualizado', 'status'=>$affected]);
                        }
                    } else {
                        if (!$request -> ajax()) { 
                            return redirect('/impuesto/consultar') -> with('error', 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"');
                        } else {
                            return response() -> json([ 'message' => 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"', 'status'=>false]);
                        }
                    }
                
                }
                if (!$request -> ajax()) { 
                    return redirect('/impuesto/consultar') -> with('error', 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"');
                } else {
                    return response() -> json([ 'message' => 'Usuario No Tiene Permiso Para Cambiar a  "'.$request -> status.'"', 'status'=>false]);
                }

            } else {
                $affected = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionEstatus` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [$request -> status,$request -> control_id]);
                
                if ($request -> status == 'En Tramitación') {
                    $status_1 = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionEnTramitacion` = ?,`t_impuestoDeclaracionEnTramitacionU` = ?,`t_impuestoDeclaracionEnTramitacionUId` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [date('Y-m-d'),(Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido),Session::get('user') -> idt_usuarios,$request -> control_id]);
                }
                if ($request -> status == 'Tramitado') {
                    $status_2 = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionTramitado` = ?,`t_impuestoDeclaracionTramitadoU` = ?,`t_impuestoDeclaracionTramitadoUId` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [date('Y-m-d'),(Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido),Session::get('user') -> idt_usuarios,$request -> control_id]);
                }
                if ($request -> status == 'Iniciado') {
                    $status_3 = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionIniciada` = ?,`t_impuestoDeclaracionIniciadaU` = ?,`t_impuestoDeclaracionIniciadaUId` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [date('Y-m-d'),(Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido),Session::get('user') -> idt_usuarios,$request -> control_id]);
                }
                
                
                if ($affected) {  
                    if (!$request -> ajax()) { 
                        return redirect('/impuesto/consultar') -> with('success', 'Cuestionario Nro: '.$request -> cuestionario.' Actualizado');
                    } else {
                        return response() -> json([ 'message' => 'Cuestionario Nro: '.$request -> cuestionario.' Actualizado', 'status'=>$affected]);
                    }
                    // 
                } else {
                    if (!$request -> ajax()) { 
                        return redirect('/impuesto/consultar') -> with('error', 'Cuestionario Nro: '.$request -> cuestionario.' No se Actualizo');
                    } else {
                        return response() -> json([ 'message' => 'Cuestionario Nro: '.$request -> cuestionario.' No se Actualizo', 'status'=>$affected]);
                    }
                    //

                }
            }
        }
        return redirect('/login/');

       // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (isset(Session::get('user') -> idt_usuarios)) {
            

            if ($request -> t_clientesNif_1 != '') {
                date_default_timezone_set("Europe/Madrid");   
                
                $codigo_declaracion = date('YmdHis'); 
                $preguntas = DB::select("SELECT * FROM `t_opcionesPreguntas`, `t_impuestoPreguntas` WHERE `t_opcionesPreguntas`.`t_opcionesPreguntasReferencia` = ? AND `t_impuestoPreguntas`.`idt_impuestoPreguntas` = `t_opcionesPreguntas`.`t_impuestoPreguntas_idt_impuestoPreguntas` ORDER BY `t_opcionesPreguntas`.`t_opcionesPreguntasOrden` ASC", [$request -> mode]);
            


                $continuar = false;
                foreach ($preguntas as $p) {
                    if ($request['p_'.$p -> idt_impuestoPreguntas] != '') {
                        $continuar = true;
                    }
                }
                if (!$continuar) {
                    return redirect('/impuesto/') -> with('error', 'Respuestas No Encontrada');
                }

                $id_declarante_1  = DB::table('t_clientes')->where('t_clientesNif', strtolower($request -> t_clientesNif_1))->first();
                if (isset($id_declarante_1 -> t_clientesNif)) {
                    DB::update('UPDATE `t_clientes` SET `t_clientesNombre` = ?,`t_clientesApellido` = ?,`t_clientesTelefono` = ?,`t_clientesEmail` = ?,`t_clientesEmpresa` = ? WHERE `t_clientes`.`idt_clientes` = ?', [$request -> t_clientesNombre_1,$request -> t_clientesApellido_1,$request -> t_clientesTelefono_1,$request -> t_clientesEmail_1,$request -> t_clientesEmpresa_1,$id_declarante_1 -> idt_clientes]);
                    $id_declarante_1 =  $id_declarante_1 -> idt_clientes;
                } else {
                    $id_declarante_1 = DB::table('t_clientes') -> insertGetId(['t_clientesNombre' => $request -> t_clientesNombre_1 ,'t_clientesApellido' => $request -> t_clientesApellido_1, 't_clientesTelefono' => $request -> t_clientesTelefono_1,'t_clientesEmail' => $request -> t_clientesEmail_1 , 't_clientesNif' => strtoupper($request -> t_clientesNif_1), 't_clientesEmpresa' => $request -> t_clientesEmpresa_1, 't_usuarios_idt_usuarios_CreadoPor' => Session::get('user') -> idt_usuarios, 't_clientesDate' => date('Y-m-d'), 't_clientesTipoCliente' => Session::get('mode_system')]);
                }
            
                
                $id_declarante_2 = '0';
                $t_impuestoDeclaracionNombreD2 = '';
                
                if ($request -> t_clientesNif_2 != '' ) {
                    $id_declarante_2  = DB::table('t_clientes')->where('t_clientesNif', strtolower($request -> t_clientesNif_2))->first();
                    if (isset($id_declarante_2 -> t_clientesNif)) {
                        DB::update('UPDATE `t_clientes` SET `t_clientesNombre` = ?,`t_clientesApellido` = ?,`t_clientesTelefono` = ?,`t_clientesEmail` = ?,`t_clientesEmpresa` = ? WHERE `t_clientes`.`idt_clientes` = ?', [$request -> t_clientesNombre_2,$request -> t_clientesApellido_2,$request -> t_clientesTelefono_2,$request -> t_clientesEmail_2,$request -> t_clientesEmpresa_2,$id_declarante_2 -> idt_clientes]);
                        $id_declarante_2 =  $id_declarante_2 -> idt_clientes;
                    } else {
                        $id_declarante_2 = DB::table('t_clientes') -> insertGetId(['t_clientesNombre' => $request -> t_clientesNombre_2 ,'t_clientesApellido' => $request -> t_clientesApellido_2, 't_clientesTelefono' => $request -> t_clientesTelefono_2,'t_clientesEmail' => $request -> t_clientesEmail_2 , 't_clientesNif' => strtoupper($request -> t_clientesNif_2), 't_clientesEmpresa' => $request -> t_clientesEmpresa_2, 't_usuarios_idt_usuarios_CreadoPor' => Session::get('user') -> idt_usuarios, 't_clientesDate' => date('Y-m-d'), 't_clientesTipoCliente' => Session::get('mode_system') ]);
                    }
                    
                    $t_impuestoDeclaracionNombreD2 = $request -> t_clientesNombre_2.' '.$request -> t_clientesApellido_2;
                }
                
                
                if ($request -> borrador == 1) {
                    
                    $id_impuesto_declaracion = DB::table('t_impuestoDeclaracion') -> insertGetId([
                        'declarante_1' => $id_declarante_1, 
                        'declarante_2' => $id_declarante_2, 
                        't_impuestoDeclaracionTipoCliente' => $request -> impuestoTipoCliente, 
                        't_impuestoDeclaracionTieneHijo25' => $request -> impuestoHijos25, 
                        't_impuestoDeclaracionEsJubilado' => $request -> impuestoDeclaracionJubilado, 
                        't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                        't_impuestoDeclaracionObservacion' => $request -> t_impuestoDeclaracionObservacion, 
                        't_impuestoDeclaracionFecha' => date('Y-m-d'), 
                        't_impuestoDeclaracionReferencia' => $codigo_declaracion,
                        't_impuestoDeclaracionOficina' => Session::get('user') -> t_oficinas_idt_oficinas,
                        't_impuestoDeclaracionEstatus' => 'Esperando Datos',
                        't_impuestoDeclaracionNombreD1' => $request -> t_clientesNombre_1.' '.$request -> t_clientesApellido_1,
                        't_impuestoDeclaracionNombreD2' => $t_impuestoDeclaracionNombreD2,
                        't_impuestoDeclaracionYear' => $request -> year
                    ]);

                    

                } else {
                    $id_impuesto_declaracion = DB::table('t_impuestoDeclaracion') -> insertGetId([
                        'declarante_1' => $id_declarante_1, 
                        'declarante_2' => $id_declarante_2, 
                        't_impuestoDeclaracionTipoCliente' => $request -> impuestoTipoCliente, 
                        't_impuestoDeclaracionTieneHijo25' => $request -> impuestoHijos25, 
                        't_impuestoDeclaracionEsJubilado' => $request -> impuestoDeclaracionJubilado, 
                        't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 
                        't_impuestoDeclaracionObservacion' => $request -> t_impuestoDeclaracionObservacion, 
                        't_impuestoDeclaracionFecha' => date('Y-m-d'), 
                        't_impuestoDeclaracionReferencia' => $codigo_declaracion,
                        't_impuestoDeclaracionOficina' => Session::get('user') -> t_oficinas_idt_oficinas,
                        't_impuestoDeclaracionEstatus' => 'Iniciado',
                        't_impuestoDeclaracionNombreD1' => $request -> t_clientesNombre_1.' '.$request -> t_clientesApellido_1,
                        't_impuestoDeclaracionNombreD2' => $t_impuestoDeclaracionNombreD2,
                        't_impuestoDeclaracionIniciada' => date('Y-m-d'),
                        't_impuestoDeclaracionIniciadaU' => Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido,
                        't_impuestoDeclaracionIniciadaUId' => Session::get('user') -> idt_usuarios,
                        't_impuestoDeclaracionYear' => $request -> year
                    ]);
        
                }
                
            
                foreach ($preguntas as $p) {
                    //return $request['p_'.$p -> idt_impuestoPreguntas];
                    $observacion = '';
                    if (isset($request['ob_'.$p -> idt_impuestoPreguntas])) {
                        if ($request['p_'.$p -> idt_impuestoPreguntas] == 'SI') {
                            $observacion = $request['ob_'.$p -> idt_impuestoPreguntas];
                        }
                    }
                    DB::table('t_impuestoDeclaracionRespuesta') -> insertGetId(['t_impuestoDeclaracion_idt_impuestoDeclaracion' => $id_impuesto_declaracion, 't_impuestoDeclaracionRespuestaPregunta' => $p -> t_impuestoPreguntasTitulo, 't_impuestoDeclaracionRespuestaRespuesta' => $request['p_'.$p -> idt_impuestoPreguntas], 't_impuestoDeclaracionRespuestaTituloObser' => $p -> t_impuestoPreguntasTituloObservacion, 't_impuestoDeclaracionRespuestaObservacion' => $observacion, 't_impuestoPreguntas_idt_impuestoPreguntas' => $p -> idt_impuestoPreguntas, 't_impuestoDeclaracionRespuestaIdDeclarante' => $id_declarante_1]);
                }

                if ($id_declarante_2 != 0) {
                    foreach ($preguntas as $p) {
                        //return $request['p_'.$p -> idt_impuestoPreguntas];
                        $observacion = '';
                        if (isset($request['ob_'.$p -> idt_impuestoPreguntas.'_2'])) {
                            if ($request['p_'.$p -> idt_impuestoPreguntas.'_2'] == 'SI') {
                                $observacion = $request['ob_'.$p -> idt_impuestoPreguntas.'_2'];
                            }
                        }
                        DB::table('t_impuestoDeclaracionRespuesta') -> insertGetId(['t_impuestoDeclaracion_idt_impuestoDeclaracion' => $id_impuesto_declaracion, 't_impuestoDeclaracionRespuestaPregunta' => $p -> t_impuestoPreguntasTitulo, 't_impuestoDeclaracionRespuestaRespuesta' => $request['p_'.$p -> idt_impuestoPreguntas.'_2'], 't_impuestoDeclaracionRespuestaTituloObser' => $p -> t_impuestoPreguntasTituloObservacion, 't_impuestoDeclaracionRespuestaObservacion' => $observacion, 't_impuestoPreguntas_idt_impuestoPreguntas' => $p -> idt_impuestoPreguntas, 't_impuestoDeclaracionRespuestaIdDeclarante' => $id_declarante_2]);
                    }
                }

                $codigo_impuesto = sha1(md5($id_impuesto_declaracion));

                if ($request -> editando_borrador != 0) {

                    $affected = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionEstatus` = ? WHERE `t_impuestoDeclaracion`.`idt_impuestoDeclaracion` = ?', ['Deleted',$request -> editando_borrador]);
                        
                }
                if ($request -> borrador == 1) {
                    return redirect('/impuesto/') -> with('success', 'Borrador Guardado, Para Continuar llenado ingresar NIF en Cuestionario.');
                } else {
                    return redirect('/impuesto/'.$codigo_impuesto) -> with('success', 'Declaración Guardada.');
                }
            }
            return redirect('/impuesto/') -> with('error', 'Error Nif.');
        }
        return redirect('/login/');
        
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id impuesto number 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        if (isset(Session::get('user') -> idt_usuarios)) {
            $declaracion = DB::select("SELECT * FROM `t_impuestoDeclaracion`, `t_clientes` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?", [$id]);
            $declarante_2 = '';
            if ($declaracion[0] -> declarante_2 != 0) {
                $declarante_2 = DB::select("SELECT * FROM `t_clientes` WHERE idt_clientes = ?", [$declaracion[0] -> declarante_2]);
            }
            $respuestas = DB::select("SELECT * FROM `t_impuestoDeclaracionRespuesta` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ?", [$id]);
            $files = DB::select("SELECT * FROM `t_impuestoHasFile`, `t_file` Where `t_file`.`idt_file` = `t_impuestoHasFile`.`t_file_idt_file` AND sha1(md5(`t_impuestoHasFile`.`t_impuestoDeclaracion_idt_impuestoDeclaracion`)) = ?", [$id]);
            $notes_i = DB::select("SELECT * FROM `tb_anotaciones` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND tb_anotacionesIE = 'I' ORDER BY `tb_anotaciones`.`idtb_anotaciones` DESC", [$id]);
            $notes_e = DB::select("SELECT * FROM `tb_anotaciones` where sha1(md5(t_impuestoDeclaracion_idt_impuestoDeclaracion)) = ? AND tb_anotacionesIE = 'E' ORDER BY `tb_anotaciones`.`idtb_anotaciones` DESC", [$id]);
            $team = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
            $data = array(
                'declaracion' => $declaracion[0],
                'declarante_2' => $declarante_2,
                'respuestas' => $respuestas,
                'files' => $files,
                'notes_i' => $notes_i,
                'notes_e' => $notes_e,
                'team' => $team
            );

            return view('detallesImpuesto') -> with($data);
        }
        return redirect('/login/');
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {  
        //if (isset(Session::get('user') -> idt_usuarios) && isset(Session::get('permisos')['menu_consultarCustionarioRenta'])) {

            if ($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
                //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha FROM `t_impuestoDeclaracion`, `t_clientes`, `t_oficinas`,`t_usuarios` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND `t_usuarios`.`idt_usuarios` = `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` AND  (`t_usuarios`.`idt_usuarios` =".Session::get('user') -> idt_usuarios." OR  `t_clientes`.`t_clientesTipoCliente` = 'TURNO' ) ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC");
                if (Session::get('mode_system') == "TURNO") {
                    $declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas`, `t_clientes` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND   `t_clientes`.`t_clientesTipoCliente` = 'TURNO'  AND `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted' ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
                } else {
                    $declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas`, `t_clientes` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND  `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` =".Session::get('user') -> idt_usuarios." AND `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted'  ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
            
                }
                
            } else {
                //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha FROM `t_impuestoDeclaracion`, `t_clientes`, `t_oficinas`,`t_usuarios` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND `t_usuarios`.`idt_usuarios` = `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC");
               // $declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted' ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
                //$declaraciones = ImpuestoDeclaracion::paginate(20);
                 $declaraciones = ImpuestoDeclaracion::with(['oficina'])->paginate(100);
            }

            // $permisos =  DB::select("SELECT * FROM `t_usuarios_has_t_permisos`, `t_permisos` WHERE `t_permisos`.`idt_permisos` = `t_usuarios_has_t_permisos`.`t_permisos_idt_permisos` AND `t_usuarios_has_t_permisos`.`t_usuarios_idt_usuarios` = ?", [Session::get('user') -> idt_usuarios]);
            // return $permisos;
            // $usuarios = new Usuarios();
            // $permisos = $usuarios -> getUserPermisos(1);

            // $permisos = Permisos::with(['usuariosPermisos']);
            
            //$groups  = Group::with(['contacts', 'contacts.phoneNumbers'])->get();
            // $permisos = Usuarios::with(['permisos', 'permisos.permisosName'])->get()->where('idt_usuarios', 1);
            // return   $permisos;
            //  $purchases = Purchase::with(['tupper', 'tupper.room'])->whereIn('tupper_id', $userTupperIds);

            // $permisos  = Usuarios::with(['t_permisos']);
            //$permisos =  UsuariosPermisos::find(1);
            // $permisos =  $permisos -> usuario;
            // $permisos =  Permisos::find(2);
          //
            //return $declaraciones -> links();
            //return request('orden');
            $data = array(
                'declaraciones' => $declaraciones
                
            );
            
            return view('consultarImpuesto') -> with($data);
       // }
        return redirect('/login/');
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {


       
        // $request -> idt_impuestoDeclaracion;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $filename = '';
            foreach ($files as $file) {
                // Get filename with the extension
                $filenameWithExt = $file-> getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);
                // Get just ext
                $extension = $file -> getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $file -> move('uploads', $fileNameToStore);

                $size = $file -> getClientSize();

                // $path = $request->file('image')->storeAs('/public/upload_files', $fileNameToStore);

                $id_file = DB::table('t_file') -> insertGetId(['t_fileName' => $filenameWithExt, 't_fileUrl' => $path, 't_fileFormat' =>  $ext, 't_fileSize' => $size]);
                $id_impuesto_has_file = DB::table('t_impuestoHasFile') -> insertGetId(['t_file_idt_file' => $id_file, 't_impuestoDeclaracion_idt_impuestoDeclaracion' => $request -> idt_impuestoDeclaracion]);
            }
            return redirect('/impuesto/'.sha1(md5($request -> idt_impuestoDeclaracion))) -> with('success', 'Archivo Guardado con exito.');;
        }


    }

    /**
     * Display the specified resource.
     * 
     * @param int $id nif
     * 
     * @return \Illuminate\Http\Response
     */
    public function nif(Request $request)
    {
        if (isset($request -> mode_search)) {
            if ($request -> mode_search == 2) {
                $request -> t_clientesNif_1 =  $request -> t_clientesNif_2;
            }

        }

        
        

        $cliente = DB::table('t_clientes')->where('t_clientesNif', strtolower($request -> t_clientesNif_1))->first();
        if (isset($cliente -> t_clientesNombre)) {
            $declarante_1 =  $cliente;
            $declarante_2 = null;
            $respuestas = null;
            $declaracion  = DB::select("SELECT * FROM `t_impuestoDeclaracion` WHERE (declarante_1 = ".$cliente -> idt_clientes." or declarante_2 = ".$cliente -> idt_clientes.") AND t_impuestoDeclaracionFecha like '".date('Y')."-%' AND t_impuestoDeclaracionEstatus = 'Esperando Datos'");
            if (count($declaracion) > 0 ) {
                $declaracion = $declaracion[0];
                if ($declaracion -> declarante_2 != 0 ) {
                    if ($declaracion -> declarante_1 != $cliente -> idt_clientes) {
                        $declarante_2 =  $cliente;
                        $declarante_1 = DB::table('t_clientes')->where('idt_clientes', $declaracion -> declarante_1)->first();
    
                    } else {
                        $declarante_2 = DB::table('t_clientes')->where('idt_clientes', $declaracion -> declarante_2)->first();
                    }
                }
                $respuestas = DB::select("SELECT * FROM `t_impuestoDeclaracionRespuesta` where t_impuestoDeclaracion_idt_impuestoDeclaracion = ?", [$declaracion -> idt_impuestoDeclaracion]);
            

            }

            $declaracion_actual = DB::select("SELECT * FROM `t_impuestoDeclaracion` WHERE (declarante_1 = ".$cliente -> idt_clientes." or declarante_2 = ".$cliente -> idt_clientes.") AND t_impuestoDeclaracionFecha like '".date('Y')."-%' AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted'");
            if (count($declaracion_actual) > 0) {
                $declaracion_actual  = $declaracion_actual[0];
                return response() -> json([ 'declarante_1' => $declarante_1, 'declarante_2' => null, 'declaracion' => null, 'respuestas' => null,  'message' => 'Found' , 'alert' => 'El Cliente ya ha llenado un Cuestionario.  Nro <a href="/impuesto/'.sha1(md5($declaracion_actual -> idt_impuestoDeclaracion)).'" style=" color: blue;"> '.$declaracion_actual -> t_impuestoDeclaracionReferencia.'</a>']);
            }

            return response() -> json([ 'declarante_1' => $declarante_1, 'declarante_2' => $declarante_2, 'declaracion' => $declaracion, 'respuestas' => $respuestas,  'message' => 'Found','alert' => '']);
        }

        return response() -> json([ 'message' => 'No_Found', 'alert' => '']);
                   

    }

    
    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function saveNote(Request $request) 
    {
        $affected = DB::update('UPDATE `t_impuestoDeclaracion` SET `t_impuestoDeclaracionNotes` = ? WHERE sha1(md5(`t_impuestoDeclaracion`.`idt_impuestoDeclaracion`)) = ?', [$request -> note,$request -> id]);
        return response() -> json([ 'message' => 'Nota Modificada' , 'class' => 'alert-success']);
    }


    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function addNote(Request $request) 
    {
        //$declarante_1 = DB::table('t_impuestoDeclaracion') -> where(DB::raw('sha1(md5(idt_impuestoDeclaracion))'), $request -> id)->first();
        $declaracion = DB::select("SELECT * FROM `t_impuestoDeclaracion` WHERE sha1(md5(idt_impuestoDeclaracion)) = ?", [$request -> id]);
        $id_note = DB::table('tb_anotaciones') -> insertGetId(['tb_anotacionesIE' => $request -> type,'t_impuestoDeclaracion_idt_impuestoDeclaracion' => $declaracion[0] -> idt_impuestoDeclaracion, 't_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios, 'tb_anotacionesUsuario' =>  Session::get('user') -> t_usuariosNombre.' '.Session::get('user') -> t_usuariosApellido, 'tb_anotacionesDate' => date('Y-m-d H:i:s')]);
        return response() -> json([ 'id_note' => sha1(md5($id_note))]);
    }

    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function deleteNote(Request $request) 
    {
        DB::select("DELETE  FROM `tb_anotaciones` WHERE sha1(md5(idtb_anotaciones)) = ?", [$request -> id]);   
        return response() -> json([ 'message' => 'Eliminado']);
    }


    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function updateNote(Request $request) 
    {
        $affected = DB::update('UPDATE `tb_anotaciones` SET `tb_anotacionesNotes` = ? WHERE sha1(md5(idtb_anotaciones)) = ?', [$request -> note,$request -> id]);
        return response() -> json([ 'message' => 'Nota Modificada' , 'class' => 'alert-success']);
    
    }

    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function sendTeam(Request $request) 
    {
        $team = DB::select("SELECT * FROM `t_usuarios` ORDER BY `t_usuarios`.`t_usuariosNombre` ASC");
        
        foreach ($team as $t) {
            $var = 'user_'.$t -> idt_usuarios;
            if (isset($request -> $var)) {
                if ($t -> t_usuariosEmail != '') {
                    $send[] = array('name' => $t -> t_usuariosNombre.' '.$t -> t_usuariosApellido, 'email' => $t -> t_usuariosEmail);
                }
            }

        }  
        if (isset($send)) {
            $impuesto_Pdf = new ImpuestoPdfController();
            $impuesto_Pdf -> team = $send;
            return $impuesto_Pdf -> descargar($request -> id, $request -> mode);
        } else {
            return redirect('/impuesto/'.$request -> id) -> with('error', 'Compañero no tiene email');
        }
        
       

        //return $request;
    }

    


    

    /**
     * Display the specified resource.
     * 
     * @param Request $request nif
     * 
     * @return \Illuminate\Http\Response
     */
    function deleteFile(Request $request) 
    {
        if (isset($request -> file)) {
            $respuestas = DB::select("SELECT t_impuestoHasFile.idt_impuestoHasFile, t_impuestoHasFile.t_file_idt_file, t_impuestoDeclaracion.t_usuarios_idt_usuarios, t_file.t_fileUrl FROM t_impuestoHasFile, t_impuestoDeclaracion, t_file WHERE t_file.idt_file = t_impuestoHasFile.t_file_idt_file AND t_impuestoDeclaracion.idt_impuestoDeclaracion = t_impuestoHasFile.t_impuestoDeclaracion_idt_impuestoDeclaracion AND sha1(md5(t_impuestoHasFile.t_file_idt_file))=?", [$request -> file]);
            if (count($respuestas) > 0) {
                ///return $respuestas;
                //return Session::get('user') -> idt_usuarios;
                 $id_creador = $respuestas[0]->t_usuarios_idt_usuarios;
                if (isset(Session::get('permisos')['deleteFileImpuesto']) || ( $id_creador == Session::get('user') -> idt_usuarios)) {
                    $unlink = unlink($respuestas[0] -> t_fileUrl);
                    if ($unlink) {
                        DB::select("DELETE FROM `t_impuestoHasFile` WHERE `t_impuestoHasFile`.`idt_impuestoHasFile` = ?", [$respuestas[0] -> idt_impuestoHasFile]);
                        DB::select("DELETE FROM `t_file` WHERE `t_file`.`idt_file` = ?", [$respuestas[0] -> t_file_idt_file]);
                        return response() -> json([ 'message' => 'Archivo Borrado' , 'class' => 'alert-success']);
                    }
                    return response() -> json([ 'message' => 'No se pudo borrar archivo' , 'class' => 'alert-danger']);
                }
                return response() -> json([ 'message' => 'Usuario no tiene permiso para borrar este archivo' , 'class' => 'alert-danger']);
                
            } else {
                return response() -> json([ 'message' => 'Archivo no Existe' , 'class' => 'alert-danger']);
            }
           
        }
    }
    
    /**
     * Display the specified resource.
     * 
     * @param int $id nif
     * 
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        if ($request -> field == '') {
            $request -> field = 't_impuestoDeclaracionFecha';
        }
        if ($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
            //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha FROM `t_impuestoDeclaracion`, `t_clientes`, `t_oficinas`,`t_usuarios` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND `t_usuarios`.`idt_usuarios` = `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` AND  (`t_usuarios`.`idt_usuarios` =".Session::get('user') -> idt_usuarios." OR  `t_clientes`.`t_clientesTipoCliente` = 'TURNO' ) ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC");
            if (Session::get('mode_system') == "TURNO") {
                //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas`, `t_clientes` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND   `t_clientes`.`t_clientesTipoCliente` = 'TURNO'  AND `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted' ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
            //`t_clientes`.`t_clientesTipoCliente` = 'TURNO' 

                if (isset($request -> search)) {
                    $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                    ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                    ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted')
                    ->where('t_clientesTipoCliente', '=', 'TURNO')
                    ->where(function ($query)  use ( $request ) {    
                        $query ->Where('t_impuestoDeclaracionNombreD1', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionFecha', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionNombreD2', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_oficinasNombre', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionEstatus', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesEmpresa', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionReferencia', 'LIKE', '%'.$request -> search.'%')
                        ->whereDate('t_impuestoDeclaracionFecha', '=',  $request -> search);
                    })
                    ->orderBy($request -> field, $request -> orden)
                    ->paginate(100);
                    
               
                } else {
                    $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted') 
                    ->where('t_clientesTipoCliente', '=', 'TURNO')
                    ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                    ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                    ->orderBy($request -> field, $request -> orden)
                    ->paginate(100);
                }
            
            } else {
               
                if (isset($request -> search)) {
                    $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                    ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                    ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                    ->where('t_usuarios_idt_usuarios', '=', Session::get('user') -> idt_usuarios) 
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted')
                    ->where(function ($query)  use ( $request ) {    
                        $query ->Where('t_impuestoDeclaracionNombreD1', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionFecha', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionNombreD2', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_oficinasNombre', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesTipoCliente', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionEstatus', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_clientesEmpresa', 'LIKE', '%'.$request -> search.'%')
                        ->orWhere('t_impuestoDeclaracionReferencia', 'LIKE', '%'.$request -> search.'%')
                        ->whereDate('t_impuestoDeclaracionFecha', '=',  $request -> search);
                    })
                   ->orderBy($request -> field, $request -> orden)
                    ->paginate(100);
                    
               
                } else {
                    $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                    ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted') 
                    ->where('t_usuarios_idt_usuarios', '=', Session::get('user') -> idt_usuarios) 
                    ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                    ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                    ->orderBy($request -> field, $request -> orden)
                    ->paginate(100);
                }
                //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas`, `t_clientes` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND  `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` =".Session::get('user') -> idt_usuarios." AND `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted'  ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
        
            }
            
        } else {
            //$declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha FROM `t_impuestoDeclaracion`, `t_clientes`, `t_oficinas`,`t_usuarios` Where `t_clientes`.`idt_clientes` = `t_impuestoDeclaracion`.`declarante_1` AND `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND `t_usuarios`.`idt_usuarios` = `t_impuestoDeclaracion`.`t_usuarios_idt_usuarios` ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC");
           // $declaraciones = DB::select("SELECT *, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionFecha, '%d-%m-%Y') as fecha, DATE_FORMAT(`t_impuestoDeclaracion`.t_impuestoDeclaracionIniciada, '%d-%m-%Y') as fecha_iniciada, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionEnTramitacion`, '%d-%m-%Y') as fecha_enTramitacion, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionTramitado`, '%d-%m-%Y') as fecha_tramitado, DATE_FORMAT(`t_impuestoDeclaracion`.`t_impuestoDeclaracionComprobado`, '%d-%m-%Y') as fecha_comprobado FROM `t_impuestoDeclaracion`, `t_oficinas` Where `t_oficinas`.`idt_oficinas` = `t_impuestoDeclaracion`.`t_impuestoDeclaracionOficina` AND t_impuestoDeclaracionEstatus != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted' ORDER BY `t_impuestoDeclaracion`.`t_impuestoDeclaracionFecha` DESC ");
            //$declaraciones = ImpuestoDeclaracion::paginate(20);
           
            if (isset($request -> search)) {
                
                
                //  $declaraciones = ImpuestoDeclaracion::with(['oficina','cliente'])->select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                //  ->where('t_impuestoDeclaracionFecha', 'LIKE', '%'.$request -> search.'%')
                //  ->orWhere('t_impuestoDeclaracionNombreD1', 'LIKE', '%'.$request -> search.'%')
                //  ->orWhere('t_impuestoDeclaracionNombreD2', 'LIKE', '%'.$request -> search.'%')
                //  ->orWhere('t_oficinasNombre', 'LIKE', '%'.$request -> search.'%')
                //  ->paginate(20);
                // != 'Esperando Datos' AND t_impuestoDeclaracionEstatus != 'Deleted'

                  $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                 ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                 ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted')
                 ->where(function ($query)  use ( $request ) {    
                    $query ->Where('t_impuestoDeclaracionNombreD1', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_impuestoDeclaracionFecha', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_impuestoDeclaracionNombreD2', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_oficinasNombre', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_clientesTipoCliente', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_impuestoDeclaracionEstatus', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_clientesEmpresa', 'LIKE', '%'.$request -> search.'%')
                    ->orWhere('t_impuestoDeclaracionReferencia', 'LIKE', '%'.$request -> search.'%')
                    ->whereDate('t_impuestoDeclaracionFecha', '=',  $request -> search);
                })
                 ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                 ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                 ->orderBy($request -> field, $request -> orden)
                 ->paginate(100);

                 
                
           
            } else {
                $declaraciones = ImpuestoDeclaracion::select('*', DB::raw('sha1(md5(idt_impuestoDeclaracion)) as n'))
                ->where('t_impuestoDeclaracionEstatus', '!=', 'Esperando Datos')
                ->where('t_impuestoDeclaracionEstatus', '!=', 'Deleted') 
                ->join('t_oficinas', 't_impuestoDeclaracion.t_impuestoDeclaracionOficina', '=', 't_oficinas.idt_oficinas')
                ->join('t_clientes', 't_impuestoDeclaracion.declarante_1', '=', 't_clientes.idt_clientes')
                ->orderBy($request -> field, $request -> orden)
                ->paginate(100);


            }
        }
         $l = $declaraciones -> links();
         $l =  str_replace("\n", "", $l);
        return response() -> json([ 'declaraciones' => $declaraciones,'l' => $l,'server' => $_SERVER['SERVER_NAME'], 'token' => '']);
    }



}
