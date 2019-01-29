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
date_default_timezone_set("Europe/Madrid");   
/**
 * PresupuestosController
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class PresupuestosController extends Controller
{


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (isset(Session::get('user') -> idt_usuarios) && isset(Session::get('permisos')['menu_crearPresupuesto'])) {
            $preguntas = DB::select('SELECT * FROM `t_preguntas` ');
            foreach ($preguntas as $pregunta) {
                $p[$pregunta->idt_preguntas]['precio'] = $pregunta -> t_preguntasPrecio;
                $p[$pregunta->idt_preguntas]['opcion'] = $pregunta -> t_preguntasOpcion;

            }
            $data = array(
                        'preguntas' => $p            
                    );
            return view('presupuesto') -> with($data);
        }
        return redirect('/login/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return phpinfo();
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
        // return $request;
        // $this -> validate($request, ['t_clientesEmpresa' => 'required']);
        // $users = DB::select('SELECT * FROM `t_usuarios` WHERE t_usuariosReferencia = ?', [$user_name]);

        $id_cliente = DB::table('t_clientes') -> insertGetId(['t_clientesNombre' => $request -> t_clientesNombre ,'t_clientesApellido' => $request -> t_clientesApellido, 't_clientesTelefono' => $request -> t_clientesTelefono,'t_clientesEmail' => $request -> t_clientesEmail , 't_clientesNif' => $request -> t_clientesNif, 't_clientesEmpresa' => $request -> t_clientesEmpresa, 't_usuarios_idt_usuarios_CreadoPor' => Session::get('user') -> idt_usuarios, 't_clientesDate' => date('Y-m-d')]);
        $codigo_presupuesto = date('YmHi');   
        $id_presupuesto = DB::table('t_presupuestos') -> insertGetId(['t_presupuestosValor' => $request -> resultadoCalculo,'t_clientes_idt_clientes' => $id_cliente,'t_presupuestosObservacion' => $request -> t_presupuestosObservacion,'t_oficinas_idt_oficinas' => Session::get('user') -> t_oficinas_idt_oficinas, 't_presupuestosNumero' => $codigo_presupuesto,'t_usuarios_idt_usuarios' => Session::get('user') -> idt_usuarios,'t_presupuestosDate' => date('Y-m-d')]);  
        
        
        if ($request ->  tipoDeCliente == 1) {
            DB::table('t_presupuestoRepuesta')->insert([['t_presupuestos_idt_presupuestos' => $id_presupuesto ,'t_preguntas_idt_preguntas' => $request -> tipoDeCliente,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op1Antiguedad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op1Actividad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op1SeguridadSocial,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op1ProcedimientosTributarios,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => 12 ,'t_presupuestoRepuestaValor' => $request -> op1NTrabajadores12] ]);
        }

        if ($request ->  tipoDeCliente == 2) {
            DB::table('t_presupuestoRepuesta')->insert([['t_presupuestos_idt_presupuestos' => $id_presupuesto ,'t_preguntas_idt_preguntas' => $request -> tipoDeCliente,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op2Antiguedad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op2Actividad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op2SeguridadSocial,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op2ProcedimientosTributarios,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => 23 ,'t_presupuestoRepuestaValor' => $request -> op2NTrabajadores23],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op2FacturacionAnual,'t_presupuestoRepuestaValor' => ""] ]);
        }

        if ($request ->  tipoDeCliente == 3) {
            DB::table('t_presupuestoRepuesta')->insert([['t_presupuestos_idt_presupuestos' => $id_presupuesto ,'t_preguntas_idt_preguntas' => $request -> tipoDeCliente,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op3Antiguedad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op3Actividad,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op3SeguridadSocial,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op3ProcedimientosTributarios,'t_presupuestoRepuestaValor' => ""],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => 38 ,'t_presupuestoRepuestaValor' => $request -> op3NTrabajadores38],['t_presupuestos_idt_presupuestos' => $id_presupuesto, 't_preguntas_idt_preguntas' => $request -> op3FacturacionAnual,'t_presupuestoRepuestaValor' => ""] ]);
        }

        if ($request ->  tipoDeCliente == 4) {
            DB::table('t_presupuestoRepuesta')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto ,'t_preguntas_idt_preguntas' => 53,'t_presupuestoRepuestaValor' => $request -> op4NLocales53]);
        }

        if ($request ->  tipoDeCliente == 5) {
            DB::table('t_presupuestoRepuesta')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto ,'t_preguntas_idt_preguntas' => 54,'t_presupuestoRepuestaValor' => $request -> op5NEmpleados54]);
        }


        if (isset($request -> checkConcepto1)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto1, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto1, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto1,'t_presupuestosConceptosOrden' => 1 ]);
        }
        if (isset($request -> checkConcepto2)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto2, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto2, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto2,'t_presupuestosConceptosOrden' => 2 ]);
        }
        if (isset($request -> checkConcepto3)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto3, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto3, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto3,'t_presupuestosConceptosOrden' => 3 ]);
        }
        if (isset($request -> checkConcepto4)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto4, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto4, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto4,'t_presupuestosConceptosOrden' => 4 ]);
        }
        if (isset($request -> checkConcepto5)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto5, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto5, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto5,'t_presupuestosConceptosOrden' => 5 ]);
        }
        if (isset($request -> checkConcepto6)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto6, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto6, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto6,'t_presupuestosConceptosOrden' => 6 ]);
        }
        if (isset($request -> checkConcepto7)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto7, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto7, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto7,'t_presupuestosConceptosOrden' => 7 ]);
        }
        if (isset($request -> checkConcepto8)) {
            DB::table('t_presupuestosConceptos')->insert(['t_presupuestos_idt_presupuestos' => $id_presupuesto , 't_presupuestosConceptosNombres' => $request -> nombreConcepto8, 't_presupuestosConceptosDescripcion' =>  $request -> textConcepto8, 't_presupuestosConceptoCuota' => $request -> cuotaConcepto8,'t_presupuestosConceptosOrden' => 8 ]);
        }

    

        
        //return $id;
        return redirect('/presupuesto/'.$codigo_presupuesto) -> with('success', 'Presupuesto Nro.'.$codigo_presupuesto);
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {  
       
        if (isset(Session::get('user') -> idt_usuarios) && isset(Session::get('permisos')['menu_consultarPresupuestos'])) {
            $presupuestos = DB::select("SELECT *, DATE_FORMAT(`t_presupuestos`.`t_presupuestosDate`, '%d-%m-%Y') as fecha FROM `t_presupuestos`,`t_clientes` where  `t_presupuestos`.`t_usuarios_idt_usuarios` = ? AND `t_clientes`.`idt_clientes` = `t_presupuestos`.`t_clientes_idt_clientes` ORDER BY `t_presupuestos`.`t_presupuestosDate` DESC", [Session::get('user') -> idt_usuarios]);
           
            $data = array(
                'presupuestos' => $presupuestos 
            );
            return view('consulta') -> with($data);
        } else {
            return view('NoUser') -> with('user_name', '');
        }
        
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id estimate number 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        //  $_SESSION['user_name'] = $user_name;
        // $_SESSION['user_id'] = $user -> idt_usuarios;
        // $_SESSION['user_oficina'] = $user -> t_oficinas_idt_oficinas;
        // $_SESSION['oficina_name'] = $oficina -> t_oficinasNombre;

        
        if (isset(Session::get('user') -> idt_usuarios) && isset(Session::get('permisos')['menu_consultarPresupuestos'])) {
           
            $presupuestos = DB::select("SELECT * FROM `t_presupuestos`,`t_clientes` where  `t_presupuestos`.`t_presupuestosNumero` = ? AND `t_clientes`.`idt_clientes` = `t_presupuestos`.`t_clientes_idt_clientes`", [$id]);
           
            if (count($presupuestos) > 0) {
                $id_presupuesto = $presupuestos[0] -> idt_presupuestos;
                $presupuestos_repuestas = DB::select("SELECT * FROM `t_presupuestoRepuesta`,`t_preguntas` where `t_presupuestoRepuesta`.`t_presupuestos_idt_presupuestos` = ? AND `t_preguntas`.`idt_preguntas` = `t_presupuestoRepuesta`.`t_preguntas_idt_preguntas`", [$id_presupuesto]);
                $presupuestos_conceptos = DB::select("SELECT * FROM `t_presupuestosConceptos` where `t_presupuestosConceptos`.`t_presupuestos_idt_presupuestos` = ? ORDER BY `t_presupuestosConceptos`.`t_presupuestosConceptosOrden` ASC", [$id_presupuesto]);
           
                $data = array(
                    'nro' => $id,
                    'presupuestos' => $presupuestos,   
                    'presupuestos_repuestas' => $presupuestos_repuestas,
                    'presupuestos_conceptos' => $presupuestos_conceptos   
                );
                
                return view('detallesPresupuesto') -> with($data);
            } else {
                return 'Presupuesto No Encontrado';
            }
        } else {
            return view('NoUser') -> with('user_name', '');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     * @param int                      $id      id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
