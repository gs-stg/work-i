<?php
/**
 * LoginController
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
use App\Usuarios;
/**
 * LoginController
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        //Session::get('user') -> idt_usuarios;
        // Session::flush();
        if (isset(Session::get('user') -> idt_usuarios)) {
            
            return view('main');
        } else {
            Session::flush();
            return redirect('/login/');
        }
        
    }

    public function show()
    {
        return view('login');
    }

    public function end()
    {
        Session::flush();
        return redirect('/login/');
    }


    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        $user = Usuarios::where('t_usuariosLogin', $request -> usuario)->where('t_usuariosPassword', $request -> password)->first();

        if (isset($user -> t_oficinas_idt_oficinas)) { 
            if (isset(Session::get('user') -> idt_usuarios) ) {
                if ($user -> idt_usuarios == Session::get('user') -> idt_usuarios) {
                    $user_class =  new Usuarios();
                    $permisos = $user_class -> getUserPermisos($user -> idt_usuarios);
                    Session::put('permisos', $permisos);
                    if (isset(Session::get('permisos')['menu_task'])) { 
                        return redirect('/task');
                    } 
                    return view('main');
                }
            
            } else {
                Session::flush();
                $oficina = DB::table('t_oficinas')->where('idt_oficinas', $user -> t_oficinas_idt_oficinas)->first();
                Session::put('user', $user);
                Session::put('oficina', $oficina);
                Session::put('mode_system', $request -> mode_system);
                
                $user_class =  new Usuarios();
                $permisos = $user_class -> getUserPermisos($user -> idt_usuarios);
                Session::put('permisos', $permisos);
                if (isset(Session::get('permisos')['menu_task'])) { 
                    return redirect('/task');
                } 
                return view('main');
            
            }
        } else {
            Session::flush();
            return redirect('/login/');
            
        }

        return $request;
    }



    /**
     * Start Session
     *
     * @param \Illuminate\Http\Request $request  
     * 
     * @return \Illuminate\Http\Response
     */
    public function startSimple($user_name)
    {
       
        $user = Usuarios::where('t_usuariosReferencia', $user_name)->first();
        
        if (isset($user -> t_oficinas_idt_oficinas)) { 
            Session::flush();
            $oficina = DB::table('t_oficinas')->where('idt_oficinas', $user -> t_oficinas_idt_oficinas)->first();
            Session::put('user', $user);
            Session::put('oficina', $oficina);
            Session::put('mode_system', '');
            $user_class =  new Usuarios();
            $permisos = $user_class -> getUserPermisos($user -> idt_usuarios);
            Session::put('permisos', $permisos);
            if (isset(Session::get('permisos')['menu_task'])) { 
                return redirect('/task');
            } 
            
            return redirect('/');
            
            
        } else {
            Session::flush();
            return redirect('/login/');
            
        }
        
    }


    public function startSimpleParametes($user_name)
    {
       
        $user = Usuarios::where('t_usuariosReferencia', $user_name)->first();
        
        if (isset($user -> t_oficinas_idt_oficinas)) { 
            Session::flush();
            $oficina = DB::table('t_oficinas')->where('idt_oficinas', $user -> t_oficinas_idt_oficinas)->first();
            Session::put('user', $user);
            Session::put('oficina', $oficina);
            Session::put('mode_system', '');
            $user_class =  new Usuarios();
            $permisos = $user_class -> getUserPermisos($user -> idt_usuarios);
            Session::put('permisos', $permisos);
           
        } else {
            Session::flush();
            return redirect('/login/');
            
        }
        
    }
}
