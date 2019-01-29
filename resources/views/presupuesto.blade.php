@extends('layouts.app')
@section('content')
    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container" style="padding-top: 10px;">
                    <div class=" wizard-card" data-color="DarkBlue" id="wizardProfile">
                        {!! Form::open(['action' => 'PresupuestosController@store','id'=> 'formPreguntasPresupuesto']) !!}
                    <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                            <div class="wizard-header">
                                <h2 style=" font-weight: 400;">
                                   Nuevo Presupuesto
                                </h2>
                                
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#paso1" data-toggle="tab">Paso 1</a></li>
                                    <li><a href="#paso2" data-toggle="tab">Paso 2</a></li>
                                    <li><a href="#paso3" data-toggle="tab">Paso 3</a></li>
                                    <li><a href="#paso4" data-toggle="tab">Guardar</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="paso1">
                                    <h5>Datos del Cliente</h5>
                                   <div class="col-sm-6">
												<div class="input-group">
											        <div class="form-group label-floating">
			                                          <label class="control-label">Nombre <small>(Requerido)</small></label>
			                                          <input name="t_clientesNombre" type="text" class="form-control">
			                                        </div>
												</div>

												
                                                
                                                <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Telefono <small>(Requerido)</small></label>
                                                            <input name="t_clientesTelefono" type="text" value="" class="form-control" />
                                                        </div>
                                                </div>

                                               

                                                <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Empresa</label>
                                                            <input name="t_clientesEmpresa" type="text" value="" class="form-control" />
                                                        </div>
                                                </div>

                                                
                                        </div>
                                        
                                        <div class="col-sm-6">
												<div class="input-group">
													<div class="form-group label-floating">
													  <label class="control-label">Apellido <small>(Requerido)</small></label>
													  <input name="t_clientesApellido" type="text" class="form-control">
													</div>
                                                </div>
                                                
                                                
                                                <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Email <small>(Requerido)</small></label>
                                                            <input name="t_clientesEmail" type="text" value="" class="form-control" />
                                                        </div>
                                                </div>

                                                <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">NIF</label>
                                                            <input name="t_clientesNif" type="text" value="" class="form-control" />
                                                        </div>
                                                </div>
		                                </div>

                                       
                                </div>
                                
                                <div class="tab-pane" id="paso2">
                                        <h5>Tipo de Cliente</h5>
                                        <div class="input-group">
                                                <label class="control-label"> <small>(Requerido)</small></label>
                                            <div class="radio">
                                               <label>
                                                    <input type="radio" name="tipoDeCliente" value="1" onclick="showOption('opcion1')">
                                                    <input type="hidden" id="p1"  value="{{$preguntas[1]['precio']}}">
                                                    <input type="hidden" id="p1_o"  value="{{$preguntas[1]['opcion']}}">
                                                    {{$preguntas[1]['opcion']}}
                                                </label>
                                            </div>
                                            <div class="radio">
                                               <label>
                                                    <input type="radio" name="tipoDeCliente" value="2" onclick="showOption('opcion2')">
                                                    <input type="hidden" id="p2"  value="{{$preguntas[2]['precio']}}">
                                                    <input type="hidden" id="p2_o" value="{{$preguntas[2]['opcion']}}">
                                                    {{$preguntas[2]['opcion']}}
                                                </label>
                                           </div>
                                           <div class="radio">
                                                <label>
                                                    <input type="radio" name="tipoDeCliente" value="3" onclick="showOption('opcion3')">
                                                    <input type="hidden" id="p3"  value="{{$preguntas[3]['precio']}}">
                                                    <input type="hidden" id="p3_o" value="{{$preguntas[3]['opcion']}}">
                                                    {{$preguntas[3]['opcion']}}
                                                 </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="tipoDeCliente" value="4" onclick="showOption('opcion4')">
                                                    <input type="hidden" id="p4"  value="{{$preguntas[4]['precio']}}">
                                                    <input type="hidden" id="p4_o" value="{{$preguntas[4]['opcion']}}">
                                                    {{$preguntas[4]['opcion']}}
                                                </label>
                                            </div>
                                             <div class="radio">
                                                <label>
                                                    <input type="radio" name="tipoDeCliente" value="5" onclick="showOption('opcion5')">
                                                    <input type="hidden" id="p5"  value="{{$preguntas[5]['precio']}}">
                                                    <input type="hidden" id="p5_o" value="{{$preguntas[5]['opcion']}}">
                                                    {{$preguntas[5]['opcion']}}
                                                </label>
                                            </div>     
                                        </div>

                                </div>
                                
                                <div class="tab-pane" id="paso3">
                                    <!-- Autonomo -->
                                    <div class="opcion1 opcion-all" style="display:none;">
                                        <div >
                                            <h5>Antigüedad</h5>
                                            <div class="input-group">
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                <div class="radio">
                                                <label>
                                                        <input type="radio" name="op1Antiguedad" value="6">
                                                        <input type="hidden" id="p6"  value="{{$preguntas[6]['precio']}}">
                                                        <input type="hidden" id="p6_o" value="{{$preguntas[6]['opcion']}}">
                                                        {{$preguntas[6]['opcion']}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="op1Antiguedad" value="7">
                                                        <input type="hidden" id="p7"  value="{{$preguntas[7]['precio']}}">
                                                        <input type="hidden" id="p7_o" value="{{$preguntas[7]['opcion']}}">
                                                        {{$preguntas[7]['opcion']}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div >
                                            <h5>Actividad</h5>
                                            <div class="input-group">
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                <div class="radio">
                                                <label>
                                                        <input type="radio" name="op1Actividad" value="8">
                                                        <input type="hidden" id="p8"  value="{{$preguntas[8]['precio']}}">
                                                        <input type="hidden" id="p8_o" value="{{$preguntas[8]['opcion']}}">
                                                        {{$preguntas[8]['opcion']}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                <label>
                                                        <input type="radio" name="op1Actividad" value="9">
                                                        <input type="hidden" id="p9"  value="{{$preguntas[9]['precio']}}">
                                                        <input type="hidden" id="p9_o" value="{{$preguntas[9]['opcion']}}">
                                                        {{$preguntas[9]['opcion']}}
                                                    </label>
                                            </div>
                                            <div class="radio">
                                                    <label>
                                                        <input type="radio" name="op1Actividad" value="10">
                                                        <input type="hidden" id="p10"  value="{{$preguntas[10]['precio']}}">
                                                        <input type="hidden" id="p10_o" value="{{$preguntas[10]['opcion']}}">
                                                        {{$preguntas[10]['opcion']}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op1Actividad" value="11">
                                                            <input type="hidden" id="p11"  value="{{$preguntas[11]['precio']}}">
                                                            <input type="hidden" id="p11_o" value="{{$preguntas[11]['opcion']}}">
                                                            {{$preguntas[11]['opcion']}}
                                                        </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div >
                                                <h5>Al corriente en la Seguridad Social</h5>
                                                <label class="control-label"> <small>(Requerido)</small></label>
                                                <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op1SeguridadSocial" value="13">
                                                            <input type="hidden" id="p13"  value="{{$preguntas[13]['precio']}}">
                                                            <input type="hidden" id="p13_o" value="{{$preguntas[13]['opcion']}}">
                                                            {{$preguntas[13]['opcion']}}
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op1SeguridadSocial" value="14">
                                                            <input type="hidden" id="p14"  value="{{$preguntas[14]['precio']}}">
                                                            <input type="hidden" id="p14_o" value="{{$preguntas[14]['opcion']}}">
                                                            {{$preguntas[14]['opcion']}}
                                                        </label>
                                                </div>
                                        </div>
                                        <div >
                                                <h5>Tiene Procedimientos Tributarios en Vigor</h5>
                                                <label class="control-label"> <small>(Requerido)</small></label>
                                                <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op1ProcedimientosTributarios" value="15">
                                                            <input type="hidden" id="p15"  value="{{$preguntas[15]['precio']}}">
                                                            <input type="hidden" id="p15_o" value="{{$preguntas[15]['opcion']}}">
                                                            {{$preguntas[15]['opcion']}}
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op1ProcedimientosTributarios" value="16">
                                                            <input type="hidden" id="p16"  value="{{$preguntas[16]['precio']}}">
                                                            <input type="hidden" id="p16_o" value="{{$preguntas[16]['opcion']}}">
                                                            {{$preguntas[16]['opcion']}}
                                                        </label>
                                                </div>
                                        </div>
                                        <div >
                                                <h5>Nro Trabajadores</h5>
                                                <div class="input-group">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"><small>(Requerido)</small></label>
                                                            <input type="hidden" id="p12"  value="{{$preguntas[12]['precio']}}">
                                                            <input name="op1NTrabajadores12" type="text" value="0" class="form-control" />
                                                        </div>
                                                </div>
                                        </div>

                                    </div>

                                   <!-- Sociedad -->
                                    <div  class="opcion2 opcion-all" style="display:none;">
                                         <div>
                                            <h5>Antigüedad</h5>
                                            <div class="input-group">
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                <div class="radio">
                                                <label>
                                                        <input type="radio" name="op2Antiguedad" value="17">
                                                        <input type="hidden" id="p17"  value="{{$preguntas[17]['precio']}}">
                                                        <input type="hidden" id="p17_o" value="{{$preguntas[17]['opcion']}}">
                                                        {{$preguntas[17]['opcion']}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="op2Antiguedad" value="18">
                                                        <input type="hidden" id="p18"  value="{{$preguntas[18]['precio']}}">
                                                        <input type="hidden" id="p18_o" value="{{$preguntas[18]['opcion']}}">
                                                        {{$preguntas[18]['opcion']}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                                <div >
                                                    <h5>Actividad</h5>
                                                    <div class="input-group">
                                                            <label class="control-label"> <small>(Requerido)</small></label>
                                                        <div class="radio">
                                                        <label>
                                                                <input type="radio" name="op2Actividad" value="19">
                                                                <input type="hidden" id="p19"  value="{{$preguntas[19]['precio']}}">
                                                                <input type="hidden" id="p19_o" value="{{$preguntas[19]['opcion']}}">
                                                                {{$preguntas[19]['opcion']}}
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                        <label>
                                                                <input type="radio" name="op2Actividad" value="20">
                                                                <input type="hidden" id="p20"  value="{{$preguntas[20]['precio']}}">
                                                                <input type="hidden" id="p20_o" value="{{$preguntas[20]['opcion']}}">
                                                                {{$preguntas[20]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op2Actividad" value="21">
                                                                <input type="hidden" id="p21"  value="{{$preguntas[21]['precio']}}">
                                                                <input type="hidden" id="p21_o" value="{{$preguntas[21]['opcion']}}">
                                                                {{$preguntas[21]['opcion']}}
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2Actividad" value="22">
                                                                    <input type="hidden" id="p22"  value="{{$preguntas[22]['precio']}}">
                                                                    <input type="hidden" id="p22_o" value="{{$preguntas[22]['opcion']}}">
                                                                    {{$preguntas[22]['opcion']}}
                                                                </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div >
                                                        <h5>Al corriente en la Seguridad Social</h5>
                                                        <label class="control-label"> <small>(Requerido)</small></label>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2SeguridadSocial" value="24">
                                                                    <input type="hidden" id="p24"  value="{{$preguntas[24]['precio']}}">
                                                                    <input type="hidden" id="p24_o" value="{{$preguntas[24]['opcion']}}">
                                                                    {{$preguntas[24]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2SeguridadSocial" value="25">
                                                                    <input type="hidden" id="p25"  value="{{$preguntas[25]['precio']}}">
                                                                    <input type="hidden" id="p25_o" value="{{$preguntas[25]['opcion']}}">
                                                                    {{$preguntas[25]['opcion']}}
                                                                </label>
                                                        </div>
                                                </div>
                                                <div >
                                                        <h5>Tiene Procedimientos Tributarios en Vigor</h5>
                                                        <label class="control-label"> <small>(Requerido)</small></label>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2ProcedimientosTributarios" value="26">
                                                                    <input type="hidden" id="p26"  value="{{$preguntas[26]['precio']}}">
                                                                    <input type="hidden" id="p26_o" value="{{$preguntas[26]['opcion']}}">
                                                                    {{$preguntas[26]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2ProcedimientosTributarios" value="27">
                                                                    <input type="hidden" id="p27"  value="{{$preguntas[27]['precio']}}">
                                                                    <input type="hidden" id="p27_o" value="{{$preguntas[27]['opcion']}}">
                                                                    {{$preguntas[27]['opcion']}}
                                                                </label>
                                                        </div>
                                                </div>
                                                <div >
                                                        <h5>Nro Trabajadores</h5>
                                                        <div class="input-group">
                                                                <div class="form-group label-floating">
                                                                    <label class="control-label"><small>(Requerido)</small></label>
                                                                    <input type="hidden" id="p23"  value="{{$preguntas[23]['precio']}}">
                                                                    <input name="op2NTrabajadores23" type="text" value="0" class="form-control" />
                                                                </div>
                                                        </div>
                                                </div>

                                                <div >
                                                        <h5>Facturación Anual</h5>
                                                        <label class="control-label"> <small>(Requerido)</small></label>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2FacturacionAnual" value="43">
                                                                    <input type="hidden" id="p43"  value="{{$preguntas[43]['precio']}}">
                                                                    <input type="hidden" id="p43_o" value="{{$preguntas[43]['opcion']}}">
                                                                    {{$preguntas[43]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2FacturacionAnual" value="44">
                                                                    <input type="hidden" id="p44"  value="{{$preguntas[44]['precio']}}">
                                                                    <input type="hidden" id="p44_o" value="{{$preguntas[44]['opcion']}}">
                                                                    {{$preguntas[44]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2FacturacionAnual" value="45">
                                                                    <input type="hidden" id="p45"  value="{{$preguntas[45]['precio']}}">
                                                                    <input type="hidden" id="p45_o" value="{{$preguntas[45]['opcion']}}">
                                                                    {{$preguntas[45]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2FacturacionAnual" value="46">
                                                                    <input type="hidden" id="p46"  value="{{$preguntas[46]['precio']}}">
                                                                    <input type="hidden" id="p46_o" value="{{$preguntas[46]['opcion']}}">
                                                                    {{$preguntas[46]['opcion']}}
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="op2FacturacionAnual" value="47">
                                                                    <input type="hidden" id="p47"  value="{{$preguntas[47]['precio']}}">
                                                                    <input type="hidden" id="p47_o" value="{{$preguntas[47]['opcion']}}">
                                                                    {{$preguntas[47]['opcion']}}
                                                                </label>
                                                        </div>
                                                </div>
                                    </div>
                                    
                                    <!-- CB/SC -->
                                    <div  class="opcion3 opcion-all" style="display:none;">
                                            <div>
                                                <h5>Antigüedad</h5>
                                                <div class="input-group">
                                                        <label class="control-label"> <small>(Requerido)</small></label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op3Antiguedad" value="32">
                                                            <input type="hidden" id="p32"  value="{{$preguntas[32]['precio']}}">
                                                            <input type="hidden" id="p32_o" value="{{$preguntas[32]['opcion']}}">
                                                            {{$preguntas[32]['opcion']}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op3Antiguedad" value="33">
                                                            <input type="hidden" id="p33"  value="{{$preguntas[33]['precio']}}">
                                                            <input type="hidden" id="p33_o" value="{{$preguntas[33]['opcion']}}">
                                                            {{$preguntas[33]['opcion']}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div >
                                                <h5>Actividad</h5>
                                                <div class="input-group">
                                                        <label class="control-label"> <small>(Requerido)</small></label>
                                                        <div class="radio">
                                                        <label>
                                                                <input type="radio" name="op3Actividad" value="34">
                                                                <input type="hidden" id="p34"  value="{{$preguntas[34]['precio']}}">
                                                                <input type="hidden" id="p34_o" value="{{$preguntas[34]['opcion']}}">
                                                                {{$preguntas[34]['opcion']}}
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                        <label>
                                                                <input type="radio" name="op3Actividad" value="35">
                                                                <input type="hidden" id="p35"  value="{{$preguntas[35]['precio']}}">
                                                                <input type="hidden" id="p35_o" value="{{$preguntas[35]['opcion']}}">
                                                                {{$preguntas[35]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="op3Actividad" value="36">
                                                            <input type="hidden" id="p36"  value="{{$preguntas[36]['precio']}}">
                                                            <input type="hidden" id="p36_o" value="{{$preguntas[36]['opcion']}}">
                                                            {{$preguntas[36]['opcion']}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3Actividad" value="37">
                                                                <input type="hidden" id="p37"  value="{{$preguntas[37]['precio']}}">
                                                                <input type="hidden" id="p37_o" value="{{$preguntas[37]['opcion']}}">
                                                                {{$preguntas[37]['opcion']}}
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div >
                                                    <h5>Al corriente en la Seguridad Social</h5>
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3SeguridadSocial" value="39">
                                                                <input type="hidden" id="p39"  value="{{$preguntas[39]['precio']}}">
                                                                <input type="hidden" id="p39_o" value="{{$preguntas[39]['opcion']}}">
                                                                {{$preguntas[39]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3SeguridadSocial" value="40">
                                                                <input type="hidden" id="p40"  value="{{$preguntas[40]['precio']}}">
                                                                <input type="hidden" id="p40_o" value="{{$preguntas[40]['opcion']}}">
                                                                {{$preguntas[40]['opcion']}}
                                                            </label>
                                                    </div>
                                            </div>
                                            <div >
                                                    <h5>Tiene Procedimientos Tributarios en Vigor</h5>
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3ProcedimientosTributarios" value="41">
                                                                <input type="hidden" id="p41"  value="{{$preguntas[41]['precio']}}">
                                                                <input type="hidden" id="p41_o" value="{{$preguntas[41]['opcion']}}">
                                                                {{$preguntas[41]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3ProcedimientosTributarios" value="42">
                                                                <input type="hidden" id="p42"  value="{{$preguntas[42]['precio']}}">
                                                                <input type="hidden" id="p42_o" value="{{$preguntas[42]['opcion']}}">
                                                                {{$preguntas[42]['opcion']}}
                                                            </label>
                                                    </div>
                                            </div>
                                            <div >
                                                    <h5>Nro Trabajadores</h5>
                                                    <div class="input-group">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><small>(Requerido)</small></label>
                                                                <input type="hidden" id="p38"  value="{{$preguntas[38]['precio']}}">
                                                                <input name="op3NTrabajadores38" type="text" value="0" class="form-control" />
                                                            </div>
                                                    </div>
                                            </div>

                                            <div >
                                                    <h5>Facturación Anual</h5>
                                                    <label class="control-label"> <small>(Requerido)</small></label>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3FacturacionAnual" value="48">
                                                                <input type="hidden" id="p48"  value="{{$preguntas[48]['precio']}}">
                                                                <input type="hidden" id="p48_o" value="{{$preguntas[48]['opcion']}}">
                                                                {{$preguntas[48]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3FacturacionAnual" value="49">
                                                                <input type="hidden" id="p49"  value="{{$preguntas[49]['precio']}}">
                                                                <input type="hidden" id="p49_o" value="{{$preguntas[49]['opcion']}}">
                                                                {{$preguntas[49]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3FacturacionAnual" value="50">
                                                                <input type="hidden" id="p50"  value="{{$preguntas[50]['precio']}}">
                                                                <input type="hidden" id="p50_o" value="{{$preguntas[50]['opcion']}}">
                                                                {{$preguntas[50]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3FacturacionAnual" value="51">
                                                                <input type="hidden" id="p51"  value="{{$preguntas[51]['precio']}}">
                                                                <input type="hidden" id="p51_o" value="{{$preguntas[51]['opcion']}}">
                                                                {{$preguntas[51]['opcion']}}
                                                            </label>
                                                    </div>
                                                    <div class="radio">
                                                            <label>
                                                                <input type="radio" name="op3FacturacionAnual" value="52">
                                                                <input type="hidden" id="p52"  value="{{$preguntas[52]['precio']}}">
                                                                <input type="hidden" id="p52_o" value="{{$preguntas[52]['opcion']}}">
                                                                {{$preguntas[52]['opcion']}}
                                                            </label>
                                                    </div>
                                            </div>


                                    </div>


                                    <!-- Arrendador -->
                                    <div  class="opcion4 opcion-all" style="display:none;">
                                        <div >
                                            <h5>Cantidad de Locales</h5>
                                            <div class="input-group">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><small>(Requerido)</small></label>
                                                        <input type="hidden" id="p53"  value="{{$preguntas[53]['precio']}}">
                                                        <input name="op4NLocales53" type="text" value="0" class="form-control" />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Empleador de Hogar -->
                                    <div  class="opcion5 opcion-all" style="display:none;">
                                        <div >
                                            <h5>Cantidad de Empleados del Hogar</h5>
                                            <div class="input-group">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><small>(Requerido)</small></label>
                                                    <input type="hidden" id="p54"  value="{{$preguntas[54]['precio']}}">
                                                    <input name="op5NEmpleados54" type="text" value="0" class="form-control" />
                                                 </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="tab-pane" id="paso4">
                                    <div>
                                        <h3>Perfil del Cliente</h3>
                                        <table>
                                            <tr>
                                                <td class="perfilClienteTd">Nombre</td>
                                                <td class="perfilClienteTd_2" id="nombre_r">qqqqq</td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Apellido</td>
                                                <td class="perfilClienteTd_2" id="apellid_r">qqqq</td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Telefono</td>
                                                <td class="perfilClienteTd_2" id="telefono_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Email</td>
                                                <td class="perfilClienteTd_2" id="email_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Empresa</td>
                                                <td class="perfilClienteTd_2" id="empresa_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">NIF</td>
                                                <td class="perfilClienteTd_2" id="nif_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Tipo de Cliente</td>
                                                <td class="perfilClienteTd_2" id="tcliente_r"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- Sociedad -->
                                    <div class="opcion1 opcion-all" style="display:none;">
                                        <table>
                                            <tr>
                                                <td class="perfilClienteTd">Antigüedad</td>
                                                <td class="perfilClienteTd_2" id="a_op1_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Actividad</td>
                                                <td class="perfilClienteTd_2" id="b_op1_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Al corriente en la Seguridad Social</td>
                                                <td class="perfilClienteTd_2" id="c_op1_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Tiene Procedimientos Tributarios en Vigor</td>
                                                <td class="perfilClienteTd_2" id="d_op1_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Nro Trabajadores</td>
                                                <td class="perfilClienteTd_2" id="e_op1_r"></td>
                                            </tr>  
                                            </table>
                                        
                                    </div>
                                    <!-- Sociedad -->
                                    <div  class="opcion2 opcion-all" style="display:none;">
                                        <table>
                                            <tr>
                                                <td class="perfilClienteTd">Antigüedad</td>
                                                <td class="perfilClienteTd_2" id="a_op2_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Actividad</td>
                                                <td class="perfilClienteTd_2" id="b_op2_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Al corriente en la Seguridad Social</td>
                                                <td class="perfilClienteTd_2" id="c_op2_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Tiene Procedimientos Tributarios en Vigor</td>
                                                <td class="perfilClienteTd_2" id="d_op2_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Nro Trabajadores</td>
                                                <td class="perfilClienteTd_2" id="e_op2_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Facturación Anual</td>
                                                <td class="perfilClienteTd_2" id="f_op2_r"></td>
                                            </tr>  
                                        </table>
                                    </div>
                                      <!-- CB/SC -->   
                                    <div  class="opcion3 opcion-all" style="display:none;">
                                        <table>
                                            <tr>
                                                <td class="perfilClienteTd">Antigüedad</td>
                                                <td class="perfilClienteTd_2" id="a_op3_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Actividad</td>
                                                <td class="perfilClienteTd_2" id="b_op3_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Al corriente en la Seguridad Social</td>
                                                <td class="perfilClienteTd_2" id="c_op3_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Tiene Procedimientos Tributarios en Vigor</td>
                                                <td class="perfilClienteTd_2" id="d_op3_r"></td>
                                            </tr>
                                            <tr>
                                                <td class="perfilClienteTd">Nro Trabajadores</td>
                                                <td class="perfilClienteTd_2" id="e_op3_r"></td>
                                            </tr>  
                                            <tr>
                                                <td class="perfilClienteTd">Facturación Anual</td>
                                                <td class="perfilClienteTd_2" id="f_op3_r"></td>
                                            </tr>  
                                        </table>
                                    </div>
                                     <!-- Arrendador -->       
                                    <div  class="opcion4 opcion-all" style="display:none;">
                                        <table>
                                                <tr>
                                                    <td class="perfilClienteTd">Cantidad de Locales</td>
                                                    <td class="perfilClienteTd_2" id="a_op4_r"></td>
                                                </tr>  
                                        </table>
    
                                    </div>
    
                                    <!-- Empleador de Hogar -->
                                    <div  class="opcion5 opcion-all" style="display:none;">
                                        <table>
                                            <tr>
                                                    <td class="perfilClienteTd">Cantidad de Empleados del Hogar</td>
                                                <td class="perfilClienteTd_2" id="a_op5_r"></td>
                                            </tr>  
                                        </table>
                                    </div>


                                    <br><br>
                                    <div>
                                        <div style=" font-size: 24px;color: rgb(3, 146, 144);">Resultado</div>
                                        <div  style=" font-size: 24px;float: left;"></div>&#8364;
                                        <input type="text" readonly value="0" id="resultadoCalculo" style=" border: none; width: 100;font-size: 24px;" name="resultadoCalculo">
                                        
                                    </div>

                                    <h3>Conceptos</h3>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto1" checked>
                                                <input type="hidden" name="nombreConcepto1"  value="Asesoramiento Fiscal, Contable y Jurídico.">
                                                Asesoramiento Fiscal, Contable y Jurídico.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto1" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="15">Dentro de este Apartado nos encargamos en primer lugar de proceder a la Contabilización Completa de todas las operaciones económicas de su entidad, con el fin de elaborar los Estados Contables Oficiales, para que una vez validados con usted, podamos realizar la presentación y el cumplimiento en plazo de todas las Obligaciones Fiscales y Mercantiles de carácter periódico.

La realización de este trabajo contable requiere de la prestación de un servicio completo de Asesoramiento Fiscal que le permita a usted resolver todas las dudas que tenga y a nosotros garantizarle que el trabajo que se está haciendo es conforme a los criterios jurídicos que la normativa establece.

Igualmente y para su tranquilidad, nos encargamos de la vigilancia diaria durante los 365 días del año, de las Notificaciones Electrónicas que se puedan emitir hacia su empresa desde de la Agencia Tributaria o desde la Seguridad Social. Nosotros recogemos estas notificaciones EN PLAZO, y aquellas que directamente entren dentro de nuestros servicios procedemos a tramitarlas de inmediato, y por supuesto siempre teniéndole informado puntualmente de todo lo que se reciba y en particular de aquellas notificaciones sobre las que usted deba tomar alguna acción o deba indicarnos como debemos proceder.
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="180 euros + IVA / Mes (Estimado sobre un volumen de 2.000 apuntes anuales)"   id="cuotaConcepto1" name="cuotaConcepto1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto2" >
                                                <input type="hidden" name="nombreConcepto2"  value="Conciliación Bancaria.">
                                                Conciliación Bancaria.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto2" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="15">Cuando nos referimos a que dentro de nuestro trabajo está el realizar una contabilidad completa, nos referimos a que TODO lo que tenga contenido económico va a ser registrado contablemente de forma individual. Nosotros no hacemos ni agrupamos información en un solo registro y por ello consideramos muy necesario ponerle de manifiesto la importancia de que en la empresa exista una Conciliación Bancaria Completa, de manera que TODOS los movimientos que existan en el Banco de su empresa tengan su correspondiente asiento individual en la Contabilidad.

Le aseguro por experiencia que esto que parece obvio, no lo es y muchísimas empresas no lo tienen o lo hacen de una forma muy genérica e incompleta, porque hacerlo bien es un trabajo muy complejo que requiere de mucho esfuerzo para poder cuadrar todo lo que viene en el banco y que indudablemente muchas veces necesita de su ayuda.

Nosotros le proporcionamos este servicio de Conciliación Bancaria de forma completa porque además de ser obligatorio legalmente en Contabilidad, es una garantía que permite detectar muchos errores y que puede ahorrar mucho dinero al cliente como puede ser el descubrir pagos duplicados o ingresos no cobrados.

                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Incluido en la Cuota Mensual"   id="cuotaConcepto2" name="cuotaConcepto2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto3" >
                                                <input type="hidden" name="nombreConcepto3"  value="Espacio en la Nube para Cliente.">
                                                Espacio en la Nube para Cliente.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto3" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="5">Le ofrecemos la posibilidad de disponer de forma GRATUITA de un espacio de 1 Gb para almacenamiento en la nube de información. Este espacio nos permite tener a disposición del Cliente todos los datos escaneados de su empresa para que los pueda consultar, enviar y recibir a través de cualquier dispositivo, en cualquier lugar del mundo y a cualquier hora, y todo esto de forma segura.
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Incluido en la Cuota Mensual"   id="cuotaConcepto3" name="cuotaConcepto3" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto4" >
                                                <input type="hidden" name="nombreConcepto4"  value="Asesoramiento Laboral.">
                                                Asesoramiento Laboral.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto4" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="11">Una parte esencial de cualquier empresa es la Gestión de Personal, y este apartado es particularmente complejo, pues no sólo la normativa es muy variada sino que su aplicación Judicial lo es más todavía, es decir, los contratos, las bonificaciones, los despidos, en general cualquier acción que se lleve a efecto en relación con el personal si no está correctamente aplicada puede ser un problema en el futuro y puede costar mucho dinero a la empresa.

Nuestra obligación es hacer que el cliente conozca tanto las obligaciones que marca la ley, como las interpretaciones judiciales que cada día se conocen y asi de esta manera tratar de minimizar el riesgo futuro de problemas.

Nosotros ponemos a su disposición el equipo humano, técnico y jurídico necesario para que la Gestión de Personal sea completa, segura y eficaz desde la entrada en la empresa de cualquier trabajador, hasta su posible salida por cualquier motivo.
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Cuota Fija de 15 euros/ mes y Cuota Variable de 15 euros + IVA / Trabajador / Mes"   id="cuotaConcepto4" name="cuotaConcepto4" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto5" >
                                                <input type="hidden" name="nombreConcepto5"  value="Asesoramiento Jurídico.">
                                                Asesoramiento Jurídico.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto5" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="8">Como parte de nuestro servicio y dentro la cuota fijada para su empresa, dispondrá de Asesoramiento Jurídico Ilimitado para la resolución de cuantas consultas pueda necesitar dentro del ámbito de actividad de su negocio. Por nuestra experiencia en el Área Jurídica, solemos distinguir dos grupos habituales de problemas en los que intervenimos, por un lado la existencia de actuaciones que tratan de evitar un conflicto (que puede ser laboral, de impago, etc) y por otro lado, la existencia de procedimientos judiciales (laborales, civiles, mercantiles, penales, etc). La primera parte anterior estaría cubierta dentro de nuestra cuota ofertada y sólo se cobraría al cliente aquellos Gastos Suplidos (burofax, correo, etc) en los que se haya incurrido. 
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Incluido en la Cuota Mensual"   id="cuotaConcepto5" name="cuotaConcepto5" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto6" >
                                                <input type="hidden" name="nombreConcepto6"  value="Procedimientos Judiciales.">
                                                Procedimientos Judiciales.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto6" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="5">Además del Asesoramiento Jurídico para consultas de todo tipo, en la empresa nos podemos encontrar con asuntos que inevitablemente tengan que resolverse en los Juzgados y para este fin disponemos de un Departamento Jurídico propio para llevar la dirección letrada de cualquier procedimiento con arreglo a un presupuesto específico en función de la complejidad de cada caso.
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Desde 300 euros / Procedimiento"   id="cuotaConcepto6" name="cuotaConcepto6" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto7" >
                                                <input type="hidden" name="nombreConcepto7"  value="Gestión de Cobro de Clientes.">
                                                Gestión de Cobro de Clientes.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto7" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="5">Nos encargaremos de la Gestión de cobro de sus clientes, tratando preferentemente de que dichos cobros se realicen de forma domiciliada de manera que el control sobre los ingresos individuales sea más efectivo. Si alguno de los clientes no satisface las cantidades a las que se ha comprometido trataremos de cobrar amistosamente, en caso contrario y si así recibimos el encargo trataremos de que lo haga por la vía judicial
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Incluido en la Cuota Mensual"   id="cuotaConcepto7" name="cuotaConcepto7" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="checkbox" >
                                            <label style="font-size: 17px;">
                                                <input type="checkbox" name="checkConcepto8" >
                                                <input type="hidden" name="nombreConcepto8"  value="Asesoramiento Mercantil">
                                                Asesoramiento Mercantil.
                                            </label>
                                        </div>
                                        <textarea  name="textConcepto8" class="form-control" placeholder="Asesoramiento Fiscal, Contable y Jurídico" rows="4">Cualquier Entidad está obligada a formular sus Estados Contables y a Depositarlos en el Registro correspondiente. Nosotros nos encargamos de todos los trámites dentro de los plazos marcados para dar la publicidad que la norma exige a cualquier Entidad
                                        </textarea>

                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Valoración Económica</label>
                                                <input type="text" value="Legalización de Libros Anuales: 95  euros + IVA y Depósito de Cuentas Anuales: 180 euros + IVA"   id="cuotaConcepto8" name="cuotaConcepto8" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="input-group">
                                        <h5>Observación</h5>
                                            <div class="form-group label-floating">
                                                <textarea  name="t_presupuestosObservacion"  palceHolder="observación" class="form-control"  rows="1"></textarea>

                                             </div>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
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
                    t_clientesNombre: {
                    required: true,
                    minlength: 3
                    },
                    t_clientesTelefono: {
                    required: true,
                    minlength: 3
                    },
                    t_clientesApellido: {
                    required: true,
                    minlength: 3
                    }
                    ,
                    t_clientesEmail: {
                    required: true,
                    minlength: 3
                    },
                    tipoDeCliente: {
                    required: true
                    },
                    op1Antiguedad: {
                    required: true
                    },
                    op1Actividad: {
                    required: true
                    },
                    op1SeguridadSocial: {
                    required: true
                    },
                    op1ProcedimientosTributarios: {
                    required: true
                    },
                    op1NTrabajadores12: {
                    required: true,
                    number: true
                    }
                    ,
                    op2Antiguedad: {
                    required: true
                    },
                    op2Actividad: {
                    required: true
                    },
                    op2SeguridadSocial: {
                    required: true
                    },
                    op2ProcedimientosTributarios: {
                    required: true
                    },
                    op2NTrabajadores23: {
                    required: true,
                    number: true
                    },
                    op2FacturacionAnual: {
                    required: true
                    },
                    
                    op3Antiguedad: {
                    required: true
                    },
                    op3Actividad: {
                    required: true
                    },
                    op3SeguridadSocial: {
                    required: true
                    },
                    op3ProcedimientosTributarios: {
                    required: true
                    },
                    op3NTrabajadores38: {
                    required: true,
                    number: true
                    },
                    op3FacturacionAnual: {
                    required: true
                    },

                    op4NLocales53: {
                    required: true,
                    number: true
                    },
                    
                    op5NEmpleados54: {
                    required: true,
                    number: true
                    }
                },

                errorPlacement: function(error, element) {
                    $(element).parent('div').addClass('has-error');
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
                        
                        if($('form').attr('id') == 'formPreguntasImpuesto'){

                        }
                        if($('form').attr('id') == 'formPreguntasPresupuesto'){
                            calcularValorPresupuesto();
                        }
                        
                    
                    } else {
                        $($wizard).find('.btn-next').show();
                        $($wizard).find('.btn-finish').hide();
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

        
    </script>
@endsection
