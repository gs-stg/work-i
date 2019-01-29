<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosPermisos extends Model
{
    //
    public $table = 't_usuarios_has_t_permisos';
    public $primaryKey = 't_permisos_idt_permisos';
    
    // function usuario() 
    // {
    //     return $this -> belongsTo('App\Usuarios','idt_usuarios');  
    // } 

    function permisosName()
    { 
         return $this -> belongsTo('App\Permisos', 't_permisos_idt_permisos');
    }
}
