@extends('layouts.app')
@section('content')
<div class="alert alert-success" id="alert" style="display:none;">
    
</div>
<div class="container">
    <div class="tab-content">
            <h3 style="margin-top: 0px;">Cuestionarios Renta </h3>
        <?php
            if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
                $remoto = 1;

            }else {
                $remoto = 0;
            }
        ?>
       
        <div><input class="pre_search pre_search_a"   placeholder="Buscar Cuestionario ..." id="shearch_impuesto"></div>
        <h6 id="total">Total:</h6>
        <div style="overflow:  auto;">
            <table style="width: 100%;min-width: 1000px;" id="table_impuesto">
                    <thead>
                    <tr>
                        {{-- <th class="pre_t_th" style=" width: 150px; cursor: pointer;" onclick="sortTable('table_impuesto',0)">Numero</th> --}}
                    
                    
                    <?php
                        if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'t_impuestoDeclaracionFecha\')" >Fecha</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'t_impuestoDeclaracionNombreD1\')">Declarante 1</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'t_impuestoDeclaracionNombreD2\')">Declarante 2</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'t_clientesEmpresa\')">Sede</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer; text-align: center;" onclick="sortImpuesto(\'t_oficinasNombre\')">Coleg</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer; text-align: center;" onclick="sortImpuesto(\'t_clientesTipoCliente\')">T/D</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer; text-align: center;" onclick="sortImpuesto(\'t_impuestoDeclaracionEstatus\')">Estado</th>';
                           
                        
                        }else {
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Declarante 1</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Declarante 2</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Oficina</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Iniciado</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">En Tramitación</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Tramitado</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;" onclick="sortImpuesto(\'\')">Comprobado</th>';
                            echo '<th class="pre_t_th" style="cursor: pointer;text-align: center;" onclick="sortImpuesto(\'\')">Estado</th>';
                        }
                    ?>
                       
                    </tr>
                    </thead>
                    <tbody>
                  
                    </tbody>
            </table>
           
            {{-- {!! Form::open(['id'=>'get_token']) !!}
            {!! Form::close() !!} --}}
            <div id="pagination_1">
            </div>
 {{-- {!! $declaraciones -> links(); !!}   --}}
        </div>
    </div>
</div>
@endsection
@section('js')


<script>

  // onkeyup="mySearchImpuesto('impuesto','{{$remoto}}')" 
$(document).ready(
    
   
    function(){
        $('#shearch_impuesto').keyup(
            function(e){
                search();
               
            }
        );
    }
    
);
$(document).ready( function(){
    search();
}
);
var orden = 'DESC';//DESC  ASC  
var p = 1; 
var f = 't_impuestoDeclaracionFecha';
var s_value = '';
function changePage(page){
    //var s =  $('#shearch_impuesto').val();
    p = page;
    search();
}
function sortImpuesto(field){
    f = field;
    p = 1;
    if(orden == 'DESC') { orden = 'ASC';  } else {  orden = 'DESC'; }
    search();

}

function search(){
    // search  page field
   
    var tbody = "";
    s = $('#shearch_impuesto').val();
    if (s_value != s) {
        s_value = s;
        p = 1;
    }
     

    var url = '/impuesto/search?page='+p+'&_token={{ csrf_token() }}';
    
    $.post(url,{'search':s,'orden':orden, 'field':f},function(r){
        console.log(r);
        var dec = r.declaraciones;
        if (r.declaraciones) {  } else { dec = r;  }
        
            $('#total').html('Total: '+ dec.total);
            if (dec.total > 0) {
                var ini;
                for (ini = 0; ini < dec.data.length; ini++) { 
                    var row = dec.data[ini];
                    // if(row.t_clientesEmpresa === undefined) { row.t_clientesEmpresa = ""; }
                    if(row.t_clientesTipoCliente === null) {
                        row.t_clientesTipoCliente = ""; 
                    } else {
                        row.t_clientesTipoCliente = row.t_clientesTipoCliente.substring(0, 1);
                    }

                    if(row.t_clientesEmpresa === null) {
                        row.t_clientesEmpresa = ""; 
                    }

                    if(row.t_oficinasNombre === null) {
                        row.t_oficinasNombre= ""; 
                    }

                    if(row.t_impuestoDeclaracionEnTramitacion === null) {
                        row.t_impuestoDeclaracionEnTramitacion = ""; 
                        row.t_impuestoDeclaracionEnTramitacionU = "";
                    }
                    if(row.t_impuestoDeclaracionIniciada === null) {
                        row.t_impuestoDeclaracionIniciada = ""; 
                        row.t_impuestoDeclaracionIniciadaU = "";
                    }
                    if(row.t_impuestoDeclaracionTramitado === null) {
                        row.t_impuestoDeclaracionTramitado = ""; 
                        row.t_impuestoDeclaracionTramitadoU = "";
                    }
                    if(row.t_impuestoDeclaracionComprobado === null) {
                        row.t_impuestoDeclaracionComprobado = ""; 
                        row.t_impuestoDeclaracionComprobadoU = "";
                    }

                    var i = '';
                    var e = '';
                    var t = '';
                    var c = '';
                    if(row.t_impuestoDeclaracionEstatus == 'Iniciado'){
                        i = 'selected="selected"';
                    }
                    if(row.t_impuestoDeclaracionEstatus == 'En Tramitación'){
                        e = 'selected="selected"';
                    }
                    if(row.t_impuestoDeclaracionEstatus == 'Tramitado'){
                        t = 'selected="selected"';
                    }
                    if(row.t_impuestoDeclaracionEstatus == 'Comprobado'){
                        c = 'selected="selected"';
                    }


                    if (r.server == 'renta.somostuwebmaster.es') {
                        tbody += '<tr class="pre_t_tr">';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionFecha +'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionNombreD1+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionNombreD2+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_clientesEmpresa+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_oficinasNombre+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_clientesTipoCliente+'</td>';
                            tbody += '<td class="pre_t_td"><form method="POST" action="/impuesto/estado"  accept-charset="UTF-8"> @csrf<input type="hidden" name="control_id" value="'+row.n+'"><input type="hidden" name="cuestionario" value="'+row.t_impuestoDeclaracionReferencia+'"><select class="change_state_tax" name="status" id="select_td_'+row.n+'"><option value="Iniciado" '+i+'>Iniciado</option><option value="En Tramitación" '+e+'>En Tramitación</option> <option value="Tramitado" '+t+'>Tramitado</option><option value="Comprobado" '+c+'>Comprobado</option></select> </form></td>';
                        tbody += '</tr>';
                    } else {
                        tbody += '<tr class="pre_t_tr">';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionNombreD1+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionNombreD2+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_oficinasNombre+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionIniciada+'<br>'+row.t_impuestoDeclaracionIniciadaU+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionEnTramitacion+'<br>'+row.t_impuestoDeclaracionEnTramitacionU+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionTramitado+'<br>'+row.t_impuestoDeclaracionTramitadoU+'</td>';
                            tbody += '<td class="pre_t_td" onclick="location.href=\''+row.n+'\';">'+row.t_impuestoDeclaracionComprobado+'<br>'+row.t_impuestoDeclaracionComprobadoU+'</td>';
                            tbody += '<td class="pre_t_td"><form method="POST" action="/impuesto/estado" accept-charset="UTF-8"> @csrf<input type="hidden" name="control_id" value="'+row.n+'"><input type="hidden" name="mode" value="simple"><input type="hidden" name="cuestionario" value="'+row.t_impuestoDeclaracionReferencia+'"><select class="change_state_tax" name="status" id="select_td_'+row.n+'"><option value="Iniciado" '+i+'>Iniciado</option><option value="En Tramitación" '+e+'>En Tramitación</option> <option value="Tramitado" '+t+'>Tramitado</option><option value="Comprobado" '+c+'>Comprobado</option></select> </form></td>';
                        tbody += '</tr>';

                    }
                }
                
                $('tbody').html(tbody);
//current_page  last_pag
                var pagination = ' ';
                var prev = '';
                var next = '';
                if ((dec.current_page-1) != 0 ) {
                    prev = 'changePage('+(dec.current_page-1)+')';
                }
               
                if (parseInt(dec.current_page) < parseInt(dec.last_page) ) {
                    next = 'changePage('+(dec.current_page+1)+')';
                   
                }
                pagination += '<ul class="pagination">'
                if (prev != '') {
                    pagination += '<li class="page-item"><a class="page-link" onclick=" '+prev+' " rel="prev">Anterior</a></li>';
                }
                if (next != '') {
                    pagination += '<li class="page-item"><a class="page-link" onclick=" '+next+' "rel="next">Siguiente</a></li>';
                }
                pagination += '</ul>';
                 $('#pagination_1').html(pagination);

                
            } else {
                
                $('tbody').html('');
                $('#pagination_1').html('');
            }
            
       
        $('.change_state_tax').change(
            function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                form.submit();
                var url = '/impuesto/estado';
                
                // $.post(url,form.serialize(),function(result){
                //     console.log(result);
                //         $('#alert').html(result.message);
                //         if (result.status) {
                //             $( "#alert" ).removeClass( "alert-danger" );
                //             $( "#alert" ).addClass( "alert-success" );
                //         }else{
                //             $( "#alert" ).removeClass( "alert-success" );
                //             $( "#alert" ).addClass( "alert-danger" );
                            
                //         }
                //         $('#alert').show();
                // });
            }
        );
            
    });
}

function formattedDate(d) {
  d =   new Date(d);
  let month = String(d.getMonth() + 1);
  let day = String(d.getDate());
  const year = String(d.getFullYear());

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return `${day}/${month}/${year}`;
}
</script>

@endsection