<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    //
    public $table = 't_permisos';
    public $primaryKey = 'idt_permisos';
    
    function usuariosPermisos()
    {
        return $this -> hasMany('App\UsuariosPermisos', 't_permisos_idt_permisos');
    }    
}
