<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ImpuestoDeclaracion extends Model
{
    public $table = 't_impuestoDeclaracion';
    public $primaryKey = 'idt_impuestoDeclaracion';

    public function oficina()
    {
        //return Oficinas::where('idt_oficinas', $this -> t_impuestoDeclaracionOficina)->first()->t_oficinasNombre;
        return $this -> belongsTo('App\Oficinas', 't_impuestoDeclaracionOficina');
    } 

    public function cliente()
    {
        return $this -> belongsTo('App\Clientes', 'declarante_1');
    }
     
    public function dateFormat($p)
    {
        return $this -> t_impuestoDeclaracionIniciada;
    }

    public function showId()
    {
        return $this -> t_impuestoDeclaracionOficina;
    }

}
