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

//use App\Http\Controllers\Session;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
use Session;
use Illuminate\Support\Facades\DB;
use App\T_Usuarios;
date_default_timezone_set("Europe/Madrid");   
/**
 * PagesController
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class PagesController extends Controller
{

    /**
     * Index
     * 
     * @param string $user_name User Name
     * 
     * @return string
     */
    public function index() 
    {
        //return view('noUser') -> with('user_name', $user_name);
        //$users = DB::select('SELECT * FROM `t_usuarios` WHERE t_usuariosReferencia = ?', [$user_name]);
        //$user = DB::table('t_usuarios')->where('t_usuariosReferencia', $user_name)->first();
        // return $user -> idt_usuarios;
        //$value = session(‘mensaje’); //usando el helper
        
        
        if (isset(Session::get('user') -> idt_usuarios)) {
            // Session::flush();
            // $oficina = DB::table('t_oficinas')->where('idt_oficinas', $user -> t_oficinas_idt_oficinas)->first();

            $preguntas = DB::select('SELECT * FROM `t_preguntas` ');
            // $_SESSION['user_name'] = $user_name;
            // $_SESSION['user_id'] = $user -> idt_usuarios;
            // $_SESSION['user_oficina'] = $user -> t_oficinas_idt_oficinas;
            // $_SESSION['oficina_name'] = $oficina -> t_oficinasNombre;
            // $_SESSION['t_usuariosNombre'] = $user -> t_usuariosNombre;
            // $_SESSION['t_usuariosApellido'] = $user -> t_usuariosApellido;
            // Session::put('user', $user);
            // Session::put('oficina', $oficina);

            foreach ($preguntas as $pregunta) {
                $p[$pregunta->idt_preguntas]['precio'] = $pregunta -> t_preguntasPrecio;
                $p[$pregunta->idt_preguntas]['opcion'] = $pregunta -> t_preguntasOpcion;

            }
            //'user' => $user,
            $data = array(
                        'preguntas' => $p            
                    );
            return view('presupuesto') -> with($data);
            //return view('index') -> with('user', $user);
        } else {
            return view('NoUser') -> with('user_name', $user_name);
        }
        // foreach ($users as $user) {
        //     echo $user->t_usuariosNombre;
        // }
        // return $users;
        //
        //return view('index') -> with('user_name', $user_name);   
    }

}
