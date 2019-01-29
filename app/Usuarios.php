<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Usuarios extends Model
{
    public $table = 't_usuarios';
    public $primaryKey = 'idt_usuarios';

    function permisos()
    {
        return $this -> hasMany('App\UsuariosPermisos', 't_usuarios_idt_usuarios');
    }

    function getUserPermisos($id)
    {
        $permisos= DB::select('SELECT * FROM `t_permisos` ,`t_usuarios_has_t_permisos` WHERE `t_permisos`.`idt_permisos` = `t_usuarios_has_t_permisos`.`t_permisos_idt_permisos` AND `t_usuarios_has_t_permisos`.`t_usuarios_idt_usuarios` = ?', [$id]);
    
        
        if (count($permisos) > 0) {
            foreach ($permisos as $p) {
                $array_permisos[$p -> t_permisosReferencia] = $p -> t_permisosReferencia;
            }
            return $array_permisos;
        }
        return null;
    }
}
