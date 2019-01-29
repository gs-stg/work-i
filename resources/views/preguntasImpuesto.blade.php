@extends('layouts.app')
@section('content')
<div class="alert alert-success" id="alert" style="display:none;"></div>
    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container" style="padding-top: 0px;">
                    <div class=" wizard-card" data-color="DarkBlue" id="wizardProfile" style="padding: 0px 0 0px;">
                        {!! Form::open(['action' => 'ImpuestoController@store','id'=> 'formPreguntasImpuesto']) !!}
                        <input name="borrador"  id="borrador" type="hidden" value="1" />
                        <input name="editando_borrador"  id="editando_borrador" type="hidden" value="0" />
                        <input name="d1"  id="d1" type="hidden" value="0" />
                        <input name="d2"  id="d2" type="hidden" value="0" />

                                                                
                    <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                            <div class="wizard-header" style="padding: 3px 0 3px;">
                                <h3 style=" margin-top: 0px;font-weight: 400;">
                                    <?php $year = date('Y'); $year = ($year-1); ?>
                                 Cuestionario Renta
                                 
                                    <select class="selectSimple" name="year">
                                        <?php
                                            for ($y = $year; $y > ($year-4); $y--) {
                                                echo '<option value="'.$y.'">'.$y.'</option>';
                                            }
                                        ?>
                                    </select>
                                 
                                </h3>
                                
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#paso1" data-toggle="tab">Datos</a></li>
                                    <li><a href="#paso2" data-toggle="tab">Filtros</a></li>
                                    <li><a href="#paso3" data-toggle="tab">Declarante</a></li>
                                    <li><a href="#paso4" data-toggle="tab">Observaciones</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="paso1">
                                         <div class="row">
                                                <h5 style=" width: 100%;">Declarante 1</h5>
                                                <div class="col-sm-6">
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">NIF *</label>
                                                                <input name="t_clientesNif_1"  id="t_clientesNif_1" type="text" value="{{$autocomplete['nif_1']}}" class="form-control" maxlength="9" />
                                                                </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="form-group label-floating">
                                                            <label class="control-label">Nombre *</label>
                                                            <input name="t_clientesNombre_1" id="t_clientesNombre_1" type="text" class="form-control" value="{{$autocomplete['nombre_1']}}">
                                                            </div>
                                                        </div>

                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                <label class="control-label">Apellidos *</label>
                                                                <input name="t_clientesApellido_1" id="t_clientesApellido_1" type="text" class="form-control" value="{{$autocomplete['apellido_1']}}">
                                                                </div>
                                                            </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                       
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Telefono *</label>
                                                                    <input name="t_clientesTelefono_1" type="text"  class="form-control" value="{{$autocomplete['telefono_1']}}"/>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Email </label>
                                                                    <input name="t_clientesEmail_1" type="text"  class="form-control" value="{{$autocomplete['email_1']}}"/>
                                                                </div>
                                                        </div>
                                                        @if(Session::get('mode_system') == "TURNO")
                                                            <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Sede</label>
                                                                    <input name="t_clientesEmpresa_1" type="text"  class="form-control" value="{{$autocomplete['empresa_1']}}"/>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if(Session::get('mode_system') != "TURNO")
                                                            <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Empresa</label>
                                                                    <input name="t_clientesEmpresa_1" type="text" class="form-control" value="{{$autocomplete['empresa_1']}}"/>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        
                                                </div>
                                            </div>
                                             <div class="row">
                                                <h5 style=" width: 100%;margin-top: 30px;">Declarante 2</h5>
                                                <div class="col-sm-6">
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">NIF *</label>
                                                                    <input name="t_clientesNif_2" id="t_clientesNif_2" type="text"  class="form-control" maxlength="9"  value="{{$autocomplete['nif_2']}}"/>
                                                                </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="form-group label-floating">
                                                            <label class="control-label">Nombre *<small></small></label>
                                                            <input  id="t_clientesNombre_2" name="t_clientesNombre_2" type="text" class="form-control" value="{{$autocomplete['nombre_2']}}">
                                                            </div>
                                                        </div>
        
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                <label class="control-label">Apellidos *<small></small></label>
                                                                <input id="t_clientesApellido_2" name="t_clientesApellido_2" type="text" class="form-control" value="{{$autocomplete['apellido_2']}}">
                                                                </div>
                                                            </div>
                                                        
                                                        
                                                </div>
                                             
                                                <div class="col-sm-6">
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Telefono *<small></small></label>
                                                                    <input name="t_clientesTelefono_2" type="text"  class="form-control" value="{{$autocomplete['telefono_2']}}"/>
                                                                </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label">Email </label>
                                                                    <input name="t_clientesEmail_2" type="text"  class="form-control" value="{{$autocomplete['email_2']}}"/>
                                                                </div>
                                                        </div>
        
                                                        @if(Session::get('mode_system') == "TURNO")
                                                        <div class="input-group">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Sede</label>
                                                                <input name="t_clientesEmpresa_2" type="text"  class="form-control" value="{{$autocomplete['empresa_2']}}"/>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if(Session::get('mode_system') != "TURNO")
                                                        <div class="input-group">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Empresa</label>
                                                                <input name="t_clientesEmpresa_2" type="text" class="form-control" value="{{$autocomplete['empresa_2']}}" />
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                </div><!-- paso 1 -->
                                
                                <div class="tab-pane" id="paso2">
                                    <div class="row">
                                        <h5>Tipo de Cliente</h5>
                                        <?php
                                        $deshabilitar = '';
                                        $checked = '';
                                        if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
                                            
                                            $deshabilitar = 'disabled';
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <div class="input-group">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="impuestoTipoCliente" value="Cliente del año anterior" {{$deshabilitar}}>
                                                    Cliente del año anterior 
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label > 
                                                <input type="radio" name="impuestoTipoCliente" value="Cliente Nuevo" {{$checked}}>
                                                    Cliente Nuevo
                                                </label>
                                            </div>

                                            <div class="radio">
                                                    <label>
                                                        <input type="radio" name="impuestoTipoCliente" value="Cliente Mensual" {{$deshabilitar}}>
                                                        Cliente Mensual
                                                    </label>
                                            </div>
                                        </div>

                                       

                                        <h5>Tiene hijos < 25 años </h5>
                                        <div class="input-group">
                                                
                                            <div class="radio">
                                            <label>
                                                    <input type="radio" name="impuestoHijos25" value="SI">
                                                   SI
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="impuestoHijos25" value="NO">
                                                    NO
                                                </label>
                                            </div>
                                        </div>



                                        <h5>Es una declaración para Jubilado </h5>
                                        <div class="input-group">
                                                
                                            <div class="radio">
                                            <label>
                                                    <input type="radio" name="impuestoDeclaracionJubilado" value="SI" >
                                                   SI
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="impuestoDeclaracionJubilado" value="NO">
                                                    NO
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div><!-- paso 2 -->
                                
                                <div class="tab-pane" id="paso3">
                                    
                                        <input type="hidden" id="mode" name="mode">
                                        @foreach ($preguntas_control as $pc)
                                    
                                            <?php
                                            if (!isset($pc_class[$pc -> t_impuestoPreguntas_idt_impuestoPreguntas])) {
                                            $pc_class[$pc -> t_impuestoPreguntas_idt_impuestoPreguntas] = 'class_'.$pc -> t_opcionesPreguntasReferencia;
                                            } else {
                                            $pc_class[$pc -> t_impuestoPreguntas_idt_impuestoPreguntas] = $pc_class[$pc -> t_impuestoPreguntas_idt_impuestoPreguntas].' class_'.$pc -> t_opcionesPreguntasReferencia;
                                            }
                                            ?>
                                        @endForeach
                                        <h4 style="display: table;float: left;margin-right: 10px;"  id="declarante1_h3_title" class="declarante1_h3">Declarante 1</h3>
                                        <h4 style="display: table;float: left;"  id="declarante2_h3_title"></h3>
                                        <h5 style="display:none;width: 100%;  color: #f44336;font-style: italic;font-size: 14px;" id="notification_h5_2"  >* Las Respuestas Seleccionadas son Válidas y comunes para los dos Declarantes a menos que se indique lo contrario.</h5>
                                        @foreach ($preguntas as $p)
                                            
                                            <?php
                                                $onclik_si = '';
                                                $onclik_no = '';
                                                $class = '';
                                                if (isset($pc_class[$p -> idt_impuestoPreguntas])) {
                                                    $class = $pc_class[$p -> idt_impuestoPreguntas];
                                                }
                                            ?>
                                            @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' || $p -> t_impuestoPreguntasRespuestasObservacion != '')
                                                <?php
                                                    $onclik_si = 'showOb(\'div_ob_'.$p -> idt_impuestoPreguntas.'\');';
                                                    $onclik_no = 'hideOb(\'div_ob_'.$p -> idt_impuestoPreguntas.'\');';
                                                ?>
                                            @endif

                                            <div class="all_questions {{$class}}" style="display:none;">
                                                
                                                
                                                <h5 id="p_{{$p -> idt_impuestoPreguntas}}_title" style=" margin-top: 25px;margin-bottom: 5px;display: table;width: 100%; font-weight: 400; ">
                                                    {{$p -> t_impuestoPreguntasTitulo}} 
                                                    @if ( $p -> t_impuestoPreguntasAyuda != '')
                                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"  data-toggle="tooltip" data-placement="bottom" title="{{$p -> t_impuestoPreguntasAyuda }}"></span>
                                                    @endif
                                                </h5>
                                                <h6 style="display:none;width: 100%;color: cadetblue;font-weight: 400;" class="declarante1_h3 " id="div_nombre_{{$p -> idt_impuestoPreguntas}}_1">Declarante 1</h6>
                                                <div class="input-group">
                                                    <div class="radio" style=" float: left;margin-right: 50px;">
                                                        <label  style=" margin-right: 60px;">
                                                            <input type="radio" name="p_{{$p -> idt_impuestoPreguntas}}" value="SI" onclick="{{$onclik_si}} removeRed('p_{{$p -> idt_impuestoPreguntas}}_title'); duplicateRadio('{{$p -> idt_impuestoPreguntas}}','SI')">
                                                            SI
                                                        </label>
                                                        <label>
                                                                <input type="radio" name="p_{{$p -> idt_impuestoPreguntas}}" value="NO" onclick="{{$onclik_no}} removeRed('p_{{$p -> idt_impuestoPreguntas}}_title'); duplicateRadio('{{$p -> idt_impuestoPreguntas}}','NO')">
                                                                 NO
                                                            </label>
                                                    </div>
                                                    
                                                    <div   onclick="$('#div_p_{{$p -> idt_impuestoPreguntas}}_2').toggle('slow');$('#div_nombre_{{$p -> idt_impuestoPreguntas}}_1').toggle('slow');showOb_2({{$p -> idt_impuestoPreguntas}});" style="display:none;" class="button_questions_2   declarante2_show_question declarante2_button" >
                                                       DECLAR. 2
                                                    </div>
                                                        
                                                    
                                                </div>

                                                <div id="div_ob_{{$p -> idt_impuestoPreguntas}}" style=" margin-bottom: 60px;display:none;">
                                                    @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' || $p -> t_impuestoPreguntasRespuestasObservacion != '')
                                                        <label class="control-label" style=" font-size: 15px;">{{$p -> t_impuestoPreguntasTituloObservacion}}</label>
                                                        <textarea id="ob_{{$p -> idt_impuestoPreguntas}}" name="ob_{{$p -> idt_impuestoPreguntas}}" class="form-control" rows="5"></textarea>
                                                        <div>
                                                            <div class="col-sm-6">
                                                                <h6>Preguntas</h6>
                                                                @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' )
                                                                    <?php
                                                                        $array_preguntas_ob = explode('@', $p -> t_impuestoPreguntasPreguntasObservacion);
                                                                        echo '<ol>';
                                                                        foreach ($array_preguntas_ob  as $preguntas_ob) {
                                                                            echo '<li>';
                                                                            echo $preguntas_ob;
                                                                            echo '</li>';
                                                                        }
                                                                        echo '</ol>';
                                                                    ?>
                                                                @endif
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <h6>Respuestas Sugeridas</h6>
                                                                @if ($p -> t_impuestoPreguntasRespuestasObservacion != '' )
                                                                    <?php
                                                                        $array_respuestas_ob = explode('@', $p -> t_impuestoPreguntasRespuestasObservacion);
                                                                        echo '<ol>';
                                                                        foreach ($array_respuestas_ob  as $respuesta_ob) {
                                                                            echo '<li class="li_repuestas_sugeridas" onclick="addAnswer(\'ob_'.$p -> idt_impuestoPreguntas.'\',\''.$respuesta_ob.'\')">';
                                                                            echo $respuesta_ob;
                                                                            echo '</li>';
                                                                        }
                                                                        echo '</ol>';
                                                                    ?>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                        
                                        
                                            @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' || $p -> t_impuestoPreguntasRespuestasObservacion != '')
                                            <?php
                                                $onclik_si = 'showOb(\'div_ob_'.$p -> idt_impuestoPreguntas.'_2\');';
                                                $onclik_no = 'hideOb(\'div_ob_'.$p -> idt_impuestoPreguntas.'_2\');';
                                            ?>
                                            @endif

                                            <div class="all_questions all_questions_2  {{$class}}" style="display:none;">
                                                <div id="div_p_{{$p -> idt_impuestoPreguntas}}_2"  style="display:none;">
                                                    <h6 style="display: table;width: 100%;color: cadetblue;font-weight: 400;" class="declarante2_h3">Declarante 2</h6>
                                            
                                                    {{-- <h5  id="p_{{$p -> idt_impuestoPreguntas}}_title" style=" margin-top: 25px;margin-bottom: 5px;display: table;width: 100%;">{{$p -> t_impuestoPreguntasTitulo}} 
                                                        @if ( $p -> t_impuestoPreguntasAyuda != '')
                                                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"  data-toggle="tooltip" data-placement="bottom" title="{{$p -> t_impuestoPreguntasAyuda }}"></span>
                                                        @endif
                                                    </h5> --}}

                                                    <div class="input-group">
                                                        
                                                        <div class="radio">
                                                            <label style=" margin-right: 60px;">
                                                                <input type="radio" name="p_{{$p -> idt_impuestoPreguntas}}_2" value="SI" onclick="{{$onclik_si}} removeRed('p_{{$p -> idt_impuestoPreguntas}}_title');">
                                                                SI
                                                            </label>
                                                            <label>
                                                                    <input type="radio" name="p_{{$p -> idt_impuestoPreguntas}}_2" value="NO" onclick="{{$onclik_no}} removeRed('p_{{$p -> idt_impuestoPreguntas}}_title');">
                                                                    NO
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div id="div_ob_{{$p -> idt_impuestoPreguntas}}_2" style=" margin-bottom: 60px;display:none;">
                                                        @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' || $p -> t_impuestoPreguntasRespuestasObservacion != '')
                                                            <label class="control-label" style=" font-size: 15px;">{{$p -> t_impuestoPreguntasTituloObservacion}}</label>
                                                            <textarea id="ob_{{$p -> idt_impuestoPreguntas}}_2" name="ob_{{$p -> idt_impuestoPreguntas}}_2" class="form-control" rows="5"></textarea>
                                                            <div style=" display: table;">
                                                                <div class="col-sm-6">
                                                                    <h6>Preguntas</h6>
                                                                    @if ($p -> t_impuestoPreguntasPreguntasObservacion != '' )
                                                                        <?php
                                                                            $array_preguntas_ob = explode('@', $p -> t_impuestoPreguntasPreguntasObservacion);
                                                                            echo '<ol>';
                                                                            foreach ($array_preguntas_ob  as $preguntas_ob) {
                                                                                echo '<li>';
                                                                                echo $preguntas_ob;
                                                                                echo '</li>';
                                                                            }
                                                                            echo '</ol>';
                                                                        ?>
                                                                    @endif
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <h6>Respuestas Sugeridas</h6>
                                                                    @if ($p -> t_impuestoPreguntasRespuestasObservacion != '' )
                                                                        <?php
                                                                            $array_respuestas_ob = explode('@', $p -> t_impuestoPreguntasRespuestasObservacion);
                                                                            echo '<ol>';
                                                                            foreach ($array_respuestas_ob  as $respuesta_ob) {
                                                                                echo '<li class="li_repuestas_sugeridas" onclick="addAnswer(\'ob_'.$p -> idt_impuestoPreguntas.'_2\',\''.$respuesta_ob.'\')">';
                                                                                echo $respuesta_ob;
                                                                                echo '</li>';
                                                                            }
                                                                            echo '</ol>';
                                                                        ?>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        
                                        
                                        @endforeach
                                    
                                </div><!-- paso 3 -->




                               


                                <div class="tab-pane" id="paso4">
                                        <div class="row">
                                    <div class="input-group">
                                        <h5>Observaciones Finales. No incluidas en ningún apartado</h5>
                                        <div class="form-group label-floating">
                                            <textarea  name="t_impuestoDeclaracionObservacion"  palceHolder="observación" class="form-control"  rows="7"></textarea>
                                        </div>
                                    </div>
                                        </div>
                                </div>

                                
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn  btn-fill btn-warning btn-wd'   id="end_late" value='Continuar más tarde' style="display:none;" onclick="endLate();"/>
                                    <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Siguiente' />
                                    <input type="submit" class='btn btn-finish btn-fill btn-info btn-wd' name='finish' value='Guardar' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! Form::close() !!}
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div><!-- end row -->
       
    </div> <!--  big container -->

@endsection
@section('js')
<script>

        var searchVisible = 0;
        var transparent = true;
        var mobile_device = false;
        
        $(document).ready(function(){
            $.material.init();
        
            /*  Activate the tooltips      */
            $('[rel="tooltip"]').tooltip();
        
            // Code for the Validator
            //number: true
            var $validator = $('.wizard-card form').validate({
                  rules: {
                    t_clientesNif_1:{
                    required: true,
                    minlength: 9
                    },
                    t_clientesNif_2:{
                    minlength: 9
                    },
                    t_clientesNombre_1: {
                    required: true,
                    minlength: 3
                    },
                    t_clientesTelefono_1: {
                    required: true,
                    minlength: 3
                    },
                    t_clientesApellido_1: {
                    required: true,
                    minlength: 3
                    }
                    ,
                    t_clientesEmail_1: {
                    email: true
                    },
                    t_clientesEmail_2: {
                    email: true
                    },
                    impuestoTipoCliente: {
                      required: true
                    },
                    
                    impuestoHijos25: {
                      required: true
                    },
                    
                    impuestoDeclaracionJubilado: {
                      required: true
                    }
                    <?php
                    foreach ($preguntas as $p) {
                        echo ', p_'.$p -> idt_impuestoPreguntas.':{required: true}';
                    }
                    ?>

                    <?php
                    foreach ($preguntas as $p) {
                        echo ', p_'.$p -> idt_impuestoPreguntas.'_2:{required: true}';
                    }
                    ?>

                    
                },
        
                errorPlacement: function(error, element) {
                    $(element).parent('div').addClass('has-error');
                    //alert($(element).attr('name'));
                    
                 }
            });
        
            // Wizard Initialization
              $('.wizard-card').bootstrapWizard({
                'tabClass': 'nav nav-pills',
                'nextSelector': '.btn-next',
                'previousSelector': '.btn-previous',
        
                onNext: function(tab, navigation, index) {
                    var $valid = $('.wizard-card form').valid();
                    if(!$valid) {
                        
                        $validator.focusInvalid();
                        gotoErrorRadio();
                        return false;
                    }
                },
        
                onInit : function(tab, navigation, index){
                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    var $wizard = navigation.closest('.wizard-card');
        
                    $first_li = navigation.find('li:first-child a').html();
                    $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                    $('.wizard-card .wizard-navigation').append($moving_div);
        
                    refreshAnimation($wizard, index);
        
                    $('.moving-tab').css('transition','transform 0s');
               },
        
                onTabClick : function(tab, navigation, index){
                    var $valid = $('.wizard-card form').valid();
        
                    if(!$valid){
                        return false;
                    } else{
                        return true;
                    }
                },
        
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
        
                    var $wizard = navigation.closest('.wizard-card');
        
                    // If it's the last tab then hide the last button and show the finish instead
                   
                    

                    if($current >= $total) {
                        $($wizard).find('.btn-next').hide();
                        $($wizard).find('.btn-finish').show();
                        document.getElementById("borrador").value  = 0;
                        
                        if($('form').attr('id') == 'formPreguntasImpuesto'){
                                // alert('acultar');
                                //ultimo paso
                        }
                       
                    } else {
                        $($wizard).find('.btn-next').show();
                        $($wizard).find('.btn-finish').hide();
                        document.getElementById("borrador").value  = 1;
                    }
        
                   

                    button_text = navigation.find('li:nth-child(' + $current + ') a').html();
        
                    setTimeout(function(){
                        $('.moving-tab').text(button_text);
                    }, 150);
        
                    var checkbox = $('.footer-checkbox');
        
                    if( !index == 0 ){
                        $(checkbox).css({
                            'opacity':'0',
                            'visibility':'hidden',
                            'position':'absolute'
                        });
                    } else {
                        $(checkbox).css({
                            'opacity':'1',
                            'visibility':'visible'
                        });
                    }
        
                    refreshAnimation($wizard, index);
                    if($current == 3){
                       
                        showQuestions();
                        $('#end_late').show();
                    } else {
                        $('#end_late').hide();
                    }


                   

                    if ($current == 4) {
                        // if (document.getElementById('t_clientesNombre_2').value == '') {
                        //     $($wizard).find('.btn-next').click();
                            
                        // }
                        // duplicateData();
                    }
                }
              });
        
        
            // Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
                readURL(this);
            });
        
            $('[data-toggle="wizard-radio"]').click(function(){
                wizard = $(this).closest('.wizard-card');
                wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                $(this).addClass('active');
                $(wizard).find('[type="radio"]').removeAttr('checked');
                $(this).find('[type="radio"]').attr('checked','true');
            });
        
            $('[data-toggle="wizard-checkbox"]').click(function(){
                if( $(this).hasClass('active')){
                    $(this).removeClass('active');
                    $(this).find('[type="checkbox"]').removeAttr('checked');
                } else {
                    $(this).addClass('active');
                    $(this).find('[type="checkbox"]').attr('checked','true');
                }
            });
        
            $('.set-full-height').css('height', 'auto');
        
        });
        
        
        
         //Function to show image before upload
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $(window).resize(function(){
            $('.wizard-card').each(function(){
                $wizard = $(this);
        
                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimation($wizard, index);
        
                $('.moving-tab').css({
                    'transition': 'transform 0s'
                });
            });
        });
        
        function refreshAnimation($wizard, index){
            $total = $wizard.find('.nav li').length;
            $li_width = 100/$total;
        
            total_steps = $wizard.find('.nav li').length;
            move_distance = $wizard.width() / total_steps;
            index_temp = index;
            vertical_level = 0;
        
            mobile_device = $(document).width() < 600 && $total > 3;
        
            if(mobile_device){
                move_distance = $wizard.width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }
        
            $wizard.find('.nav li').css('width',($li_width-1 )+ '%');
        
            step_width = move_distance;
            move_distance = move_distance * index_temp;
        
            $current = index + 1;
        
            if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
                move_distance -= 8;
            } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
                move_distance += 8;
            }
        
            if(mobile_device){
                vertical_level = parseInt(index / 2);
                vertical_level = vertical_level * 38;
            }
        
            $wizard.find('.moving-tab').css('width', step_width);
            $('.moving-tab').css({
                'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
        
            });
        }
        
        materialDesign = {
        
            checkScrollForTransparentNavbar: debounce(function() {
                        if($(document).scrollTop() > 260 ) {
                            if(transparent) {
                                transparent = false;
                                $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                            }
                        } else {
                            if( !transparent ) {
                                transparent = true;
                                $('.navbar-color-on-scroll').addClass('navbar-transparent');
                            }
                        }
                }, 17)
        
        }
        
        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                }, wait);
                if (immediate && !timeout) func.apply(context, args);
            };
        };
        

        function showQuestions() {
            console.log('showQuestions Start');
            var cliente =  $("input[name=impuestoTipoCliente]:checked").val();
            var hijos =  $("input[name=impuestoHijos25]:checked").val();
            var jubilados =  $("input[name=impuestoDeclaracionJubilado]:checked").val();
            var mode_value = 0

            document.getElementById('t_clientesNombre_1').value = capitalLetter(document.getElementById('t_clientesNombre_1').value);
            document.getElementById('t_clientesApellido_1').value = capitalLetter(document.getElementById('t_clientesApellido_1').value);
            document.getElementById('t_clientesNombre_2').value = capitalLetter(document.getElementById('t_clientesNombre_2').value);
            document.getElementById('t_clientesApellido_2').value = capitalLetter(document.getElementById('t_clientesApellido_2').value);
            
            if (cliente == "Cliente del año anterior") {
            mode_value =  mode_value + 10;
            }

            if (cliente == "Cliente Nuevo") {
            mode_value =  mode_value + 20;
            }

            if (cliente == "Cliente Mensual") {
            mode_value =  mode_value + 30;
            }

            if (hijos == "SI") {
                mode_value =  mode_value + 1;
            } 

            if (jubilados == "SI") {
                mode_value =  mode_value + 2;
            } 
            document.getElementById("mode").value = mode_value;

            console.log(mode_value);

            var y = document.getElementsByClassName('all_questions');
            var i;
            for (i = 0; i < y.length; i++) {
                y[i].style.display = "none";
            }

            var x = document.getElementsByClassName("class_"+mode_value);
            var i;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "";
                if ($(x[i]).children('h5').html()) {
                    console.log($(x[i]).children('h5').html()); 
                }
                

                
            }

            //
            if (document.getElementById('t_clientesNombre_2').value != '') {
                var y = document.getElementsByClassName('button_questions_2');
                var i;
                for (i = 0; i < y.length; i++) {
                    y[i].style.display = "";
                }
            }

            if (document.getElementById('t_clientesNombre_2').value == '') {
                var y = document.getElementsByClassName('all_questions_2');
                var i;
                for (i = 0; i < y.length; i++) {
                    y[i].style.display = "none";
                }
            }


            var x = document.getElementsByClassName("declarante1_h3");
            var i;
            for (i = 0; i < x.length; i++) {
                //var str_n = document.getElementById('t_clientesNombre_1').value;
                //var res_n = str_n.split(" ", 1);
                x[i].innerHTML = document.getElementById('t_clientesNombre_1').value;
            }

            var x = document.getElementsByClassName("declarante2_h3");
            var i;
            for (i = 0; i < x.length; i++) {
                //var str_n = document.getElementById('t_clientesNombre_2').value;
                //var res_n = str_n.split(" ", 1);
                x[i].innerHTML = document.getElementById('t_clientesNombre_2').value;
            }

            // var x = document.getElementsByClassName("declarante2_button");
            // var i;
            // for (i = 0; i < x.length; i++) {
            //     x[i].innerHTML = document.getElementById('t_clientesNombre_2').value + ' ' + document.getElementById('t_clientesApellido_2').value;  
            // }

            if (document.getElementById('t_clientesNombre_2').value != '') {
                // var str_n = document.getElementById('t_clientesNombre_2').value;
                // var res_n = str_n.split(" ", 1);
                // var str_a = document.getElementById('t_clientesApellido_2').value;
                // var res_a = str_a.split(" ", 1);
                // document.getElementById('declarante2_h3_title').innerHTML = '   - '+res_n 

                document.getElementById('declarante2_h3_title').innerHTML = '   - '+document.getElementById('t_clientesNombre_2').value
                document.getElementById('notification_h5_2').style.display = "table";
            }

            // var str_n = document.getElementById('t_clientesNombre_1').value;
            // var res_n = str_n.split(" ", 1);
            // var str_a = document.getElementById('t_clientesApellido_1').value;
            // var res_a = str_a.split(" ", 1);
            //document.getElementById('declarante1_h3_title').innerHTML = res_n 
            
            document.getElementById('declarante1_h3_title').innerHTML = document.getElementById('t_clientesNombre_1').value
            
            console.log('showQuestions End');    

        }

        function showOb(id){
           // alert(id);
            //div_ob_3
            document.getElementById(id).style.display = "";
            //document.getElementById(name+"_2").value = value;
        }
        
        function showOb_2(id){
            if (document.getElementById("ob_"+id+"_2").value == '') {
                document.getElementById("ob_"+id+"_2").value = document.getElementById("ob_"+id).value;
            }
           
        }

        function hideOb(id){
            document.getElementById(id).style.display = "none";
        }

        function addAnswer(id,text){
           if ( document.getElementById(id).value == "") {
                document.getElementById(id).value = text;
           } else {
                document.getElementById(id).value = document.getElementById(id).value + "\n" +text;
           }
        }

        function duplicateData() {
            //$("input[name=p_1_2][value='NO']").attr('checked', 'checked');
            var elements = document.getElementById("formPreguntasImpuesto").elements;
            for (i=0; i<elements.length; i++){
                var name = elements[i].name;
                var value = elements[i].value;
                if (elements[i].type == 'radio') {
                    
                    if ( elements[i].checked) {
                        if( $('input[name="'+name+'_2"]').length ) {
                            $("input[name="+name+"_2][value='"+value+"']").attr('checked', 'checked');
                            $("input[name="+name+"_2][value='"+value+"']").click();
                        }
                    }
                } else {
                    var n = name.search("ob_");
                    if (n != -1) {
                        value = elements[i].value;
                        if( document.getElementById(name+"_2")) {
                            if (value != "") {
                                value = "El Declarante 1 Manifestó: \n" + value + "\n El Declarante 2 Manifestó: \n ";
                                document.getElementById(name+"_2").value = value;
                            }
                        }
                    }
                }
            }
            $("html, body").animate({ scrollTop: 0 }, "slow");

        }

        function removeRed(id){
            $("#"+id).removeClass('red');
        }

        function gotoErrorRadio(){

            //.removeClass()
            var y = document.getElementsByClassName("red");
            var i;
            if(y.length > 0) {
                for (i = 0; i < y.length; i++) {
                    if ( $("#"+y[i].id).length ) {
                        $("#"+y[i].id).removeClass('red');
                    }
                }
            }

            var x = document.getElementsByClassName("error");
            
            if(x.length > 0) {
              
                $('html, body').animate({
                        scrollTop: ($(x[0]).offset().top-70)
                });

                 for (i = 0; i < x.length; i++) {
                    if ( $("#"+x[i].name+"_title").length ) {
                        $("#"+x[i].name+"_title").addClass('red');
                    }
                }
                
            }
            
        }

        function duplicateRadio(name,value){
            $("input[name=p_"+name+"_2][value='"+value+"']").attr('checked', 'checked');
            $("input[name=p_"+name+"_2][value='"+value+"']").click();
            // if  (value == 'SI') { 
            //     if  (document.getElementById("ob_"+name)) { 
            //         $('#div_p_'+name+'_2').show('slow');
            //         $('#div_nombre_'+name+'_1').show('slow');
            //     }
            // }
        }

        function endLate(){

            
            document.getElementById("formPreguntasImpuesto").submit();
        }

        function fillForm(result,mode){

            if (result.alert != '') {
                $('#alert').html(result.alert);
                $( "#alert" ).addClass( "alert-danger" );
                $('#alert').show();
                $("input[name=t_clientesNif_1]").val("");
                $("input[name=t_clientesNif_2]").val("");
            } else {
            
                
                var d2 = null;
                if (mode == 1 ) {
                    $("input[name=t_clientesNif_1]").val(result.declarante_1.t_clientesNif);
                    if(result.declarante_1.t_clientesNif != '') {  $("input[name=t_clientesNif_1]").parent('div').removeClass('is-empty'); }
                    $("input[name=t_clientesNombre_1]").val(result.declarante_1.t_clientesNombre);
                    if(result.declarante_1.t_clientesNombre != '') {  $("input[name=t_clientesNombre_1]").parent('div').removeClass('is-empty'); }
                    $("input[name=t_clientesApellido_1]").val(result.declarante_1.t_clientesApellido);
                    if(result.declarante_1.t_clientesApellido != '') {  $("input[name=t_clientesApellido_1]").parent('div').removeClass('is-empty'); }
                    $("input[name=t_clientesTelefono_1]").val(result.declarante_1.t_clientesTelefono);
                    if(result.declarante_1.t_clientesTelefono != '') {  $("input[name=t_clientesTelefono_1]").parent('div').removeClass('is-empty'); }
                    $("input[name=t_clientesEmail_1]").val(result.declarante_1.t_clientesEmail);
                    if(result.declarante_1.t_clientesEmail != '') {  $("input[name=t_clientesEmail_1]").parent('div').removeClass('is-empty'); }
                    $("input[name=t_clientesEmpresa_1]").val(result.declarante_1.t_clientesEmpresa);
                    if(result.declarante_1.t_clientesEmpresa != '') {  $("input[name=t_clientesEmpresa_1]").parent('div').removeClass('is-empty'); }
                
                    
                    if (result.declarante_2 != null) {
                        $("input[name=t_clientesNif_2]").val(result.declarante_2.t_clientesNif);
                        if(result.declarante_2.t_clientesNif != '') {  $("input[name=t_clientesNif_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesNombre_2]").val(result.declarante_2.t_clientesNombre);
                        if(result.declarante_2.t_clientesNombre != '') {  $("input[name=t_clientesNombre_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesApellido_2]").val(result.declarante_2.t_clientesApellido);
                        if(result.declarante_2.t_clientesApellido != '') {  $("input[name=t_clientesApellido_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesTelefono_2]").val(result.declarante_2.t_clientesTelefono);
                        if(result.declarante_2.t_clientesTelefono != '') {  $("input[name=t_clientesTelefono_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmail_2]").val(result.declarante_2.t_clientesEmail);
                        if(result.declarante_2.t_clientesEmail != '') {  $("input[name=t_clientesEmail_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmpresa_2]").val(result.declarante_2.t_clientesEmpresa);
                        if(result.declarante_2.t_clientesEmpresa != '') {  $("input[name=t_clientesEmpresa_2]").parent('div').removeClass('is-empty'); }
                        d2 = result.declarante_2.idt_clientes;
                    }
                } else {
                    if (result.declarante_2 == null) {
                        $("input[name=t_clientesNif_2]").val(result.declarante_1.t_clientesNif);
                        if(result.declarante_1.t_clientesNif != '') {  $("input[name=t_clientesNif_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesNombre_2]").val(result.declarante_1.t_clientesNombre);
                        if(result.declarante_1.t_clientesNombre != '') {  $("input[name=t_clientesNombre_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesApellido_2]").val(result.declarante_1.t_clientesApellido);
                        if(result.declarante_1.t_clientesApellido != '') {  $("input[name=t_clientesApellido_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesTelefono_2]").val(result.declarante_1.t_clientesTelefono);
                        if(result.declarante_1.t_clientesTelefono != '') {  $("input[name=t_clientesTelefono_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmail_2]").val(result.declarante_1.t_clientesEmail);
                        if(result.declarante_1.t_clientesEmail != '') {  $("input[name=t_clientesEmail_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmpresa_2]").val(result.declarante_1.t_clientesEmpresa);
                        if(result.declarante_1.t_clientesEmpresa != '') {  $("input[name=t_clientesEmpresa_2]").parent('div').removeClass('is-empty'); }
                        d2 = result.declarante_2.idt_clientes;

                    } else {


                        $("input[name=t_clientesNif_1]").val(result.declarante_1.t_clientesNif);
                        if(result.declarante_1.t_clientesNif != '') {  $("input[name=t_clientesNif_1]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesNombre_1]").val(result.declarante_1.t_clientesNombre);
                        if(result.declarante_1.t_clientesNombre != '') {  $("input[name=t_clientesNombre_1]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesApellido_1]").val(result.declarante_1.t_clientesApellido);
                        if(result.declarante_1.t_clientesApellido != '') {  $("input[name=t_clientesApellido_1]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesTelefono_1]").val(result.declarante_1.t_clientesTelefono);
                        if(result.declarante_1.t_clientesTelefono != '') {  $("input[name=t_clientesTelefono_1]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmail_1]").val(result.declarante_1.t_clientesEmail);
                        if(result.declarante_1.t_clientesEmail != '') {  $("input[name=t_clientesEmail_1]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmpresa_1]").val(result.declarante_1.t_clientesEmpresa);
                        if(result.declarante_1.t_clientesEmpresa != '') {  $("input[name=t_clientesEmpresa_1]").parent('div').removeClass('is-empty'); }
                
                        $("input[name=t_clientesNif_2]").val(result.declarante_2.t_clientesNif);
                        if(result.declarante_2.t_clientesNif != '') {  $("input[name=t_clientesNif_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesNombre_2]").val(result.declarante_2.t_clientesNombre);
                        if(result.declarante_2.t_clientesNombre != '') {  $("input[name=t_clientesNombre_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesApellido_2]").val(result.declarante_2.t_clientesApellido);
                        if(result.declarante_2.t_clientesApellido != '') {  $("input[name=t_clientesApellido_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesTelefono_2]").val(result.declarante_2.t_clientesTelefono);
                        if(result.declarante_2.t_clientesTelefono != '') {  $("input[name=t_clientesTelefono_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmail_2]").val(result.declarante_2.t_clientesEmail);
                        if(result.declarante_2.t_clientesEmail != '') {  $("input[name=t_clientesEmail_2]").parent('div').removeClass('is-empty'); }
                        $("input[name=t_clientesEmpresa_2]").val(result.declarante_2.t_clientesEmpresa);
                        if(result.declarante_2.t_clientesEmpresa != '') {  $("input[name=t_clientesEmpresa_2]").parent('div').removeClass('is-empty'); }
                        d2 = result.declarante_2.idt_clientes;
                    }
                }

                if (result.declaracion != null) {

                    $("select[name=year]").val(result.declaracion.t_impuestoDeclaracionYear);
                        $('#alert').html('Respuestas Cargadas en el Cuestionario');
                        $( "#alert" ).addClass( "alert-info" );
                        $('#alert').show();
                
                    
                    var i;
                    var x = result.respuestas;
                    var d1 = result.declarante_1.idt_clientes;
                

                    $("#editando_borrador").val(result.declaracion.idt_impuestoDeclaracion);
                    
                    $("input[name=impuestoTipoCliente][value='"+result.declaracion.t_impuestoDeclaracionTipoCliente+"']").attr('checked', 'checked');
                    $("input[name=impuestoHijos25][value='"+result.declaracion.t_impuestoDeclaracionTieneHijo25+"']").attr('checked', 'checked');
                    $("input[name=impuestoDeclaracionJubilado][value='"+result.declaracion.t_impuestoDeclaracionEsJubilado+"']").attr('checked', 'checked');
                    
                    
                    
                    for (i = 0; i < x.length; i++) {
                        
                        var name =  x[i].t_impuestoPreguntas_idt_impuestoPreguntas;
                        var value = x[i].t_impuestoDeclaracionRespuestaRespuesta;
                        if (x[i].t_impuestoDeclaracionRespuestaIdDeclarante == d1) {
                            $("input[name=p_"+name+"][value='"+value+"']").attr('checked', 'checked');
                            $("input[name=p_"+name+"][value='"+value+"']").click();

                            if (value == 'SI') { 
                                if (document.getElementById("ob_"+name)) { 
                                    $('#div_p_'+name+'_2').show('slow');
                                    $('#div_nombre_'+name+'_1').show('slow');
                                    $("#ob_"+name).val(x[i].t_impuestoDeclaracionRespuestaObservacion);
                                }
                            }

                        } else {
                            $("input[name=p_"+name+"_2][value='"+value+"']").attr('checked', 'checked');
                            $("input[name=p_"+name+"_2][value='"+value+"']").click();
                            if (value == 'SI') { 
                                if (document.getElementById("ob_"+name+"_2")) { 
                                    $("#ob_"+name+"_2").val(x[i].t_impuestoDeclaracionRespuestaObservacion);

                                }
                            }
                        }   
                    }
                }
            }
        }

        function capitalLetter(str) 
        {
            if(str != ''){
                str = str.toLowerCase();
                str = str.split(" ");

                for (var i = 0, x = str.length; i < x; i++) {
                    str[i] = str[i][0].toUpperCase() + str[i].substr(1);
                }
                return str.join(" ");
            }
            return '';

            
        }
        
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
            
            $('#t_clientesNif_1').blur(
                function(e){
                    e.preventDefault();
                    var form = $(this).parents('form');
                    var url = '/api/impuesto/nif';
                    $( "#alert" ).removeClass( "alert-info" );
                    $( "#alert" ).removeClass( "alert-danger" );

                    
                    $('#alert').hide();
                    $.post(url,form.serialize(),function(result){
                        if (result.message == 'Found') {
                            fillForm(result,1);
                        }
                            
                    });
                }
            );

            $('#t_clientesNif_2').blur(
                function(e){
                    e.preventDefault();
                    var form = $(this).parents('form');
                    var url = '/api/impuesto/nif';
                    $( "#alert" ).removeClass( "alert-info" );
                    $( "#alert" ).removeClass( "alert-danger" );
                
                
                    
                    $('#alert').hide();
                    $.post(url,form.serialize()+ "&mode_search=2",function(result){
                        if (result.message == 'Found') {
                            fillForm(result,2);
                        }
                            
                    });
                }
            );
        });

        </script>
        <style>
            .li_repuestas_sugeridas{
                cursor: pointer;
            }
            .li_repuestas_sugeridas:hover{
                background-color: rgb(255, 218, 5);
                font-weight: 400;
            }
            
        </style>
@endsection

