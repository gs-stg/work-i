@extends('layouts.app')
@section('content')
    <!--   Big container   -->
<div class="container">
    <div class="tab-content">
            <div>
                <h2 >Presupuesto</h2>
                    <div class="pre_001" style=" float: left;margin-right: 25px;">Fecha: {{$presupuestos[0] -> t_presupuestosDate}}</div>
                    <div class="pre_001">Nro: {{$nro}}</div>
                    <a href="/descargar/{{sha1(md5($presupuestos[0] -> idt_presupuestos))}}/a" style="color: white;"><div class="btn btn-info">Enviar al Cliente</div></a>
                    <a href="/descargar/{{sha1(md5($presupuestos[0] -> idt_presupuestos))}}/b" style="color: white;"><div class="btn btn-info">Descargar</div></a>
                </div>
                <hr>
            <div>
                                   
            <div>
                <h3>Perfil del Cliente</h3>
                <table>
                    <tr>
                        <td class="perfilClienteTd">Nombre</td>
                        <td class="perfilClienteTd_2" >{{$presupuestos[0] -> t_clientesNombre}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Apellido</td>
                        <td class="perfilClienteTd_2">{{$presupuestos[0] -> t_clientesApellido}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Telefono</td>
                        <td class="perfilClienteTd_2" >{{$presupuestos[0] -> t_clientesTelefono}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Email</td>
                        <td class="perfilClienteTd_2" >{{$presupuestos[0] -> t_clientesEmail}}</td>
                    </tr>  
                    <tr>
                        <td class="perfilClienteTd">Empresa</td>
                        <td class="perfilClienteTd_2" >{{$presupuestos[0] -> t_clientesEmpresa}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">NIF</td>
                        <td class="perfilClienteTd_2" >{{$presupuestos[0] -> t_clientesNif}}</td>
                    </tr>
                    
                </table>
            </div>
            
            <!-- Preguntas -->
            @if(count($presupuestos_repuestas) > 0)
                <div class="" style="">
                    <table>
                        @foreach($presupuestos_repuestas as $repuesta)
                            <tr>
                                <td class="perfilClienteTd">{{$repuesta -> t_preguntasTitle}}</td>
                                <td class="perfilClienteTd_2">{{$repuesta -> t_presupuestoRepuestaValor}}{{$repuesta -> t_preguntasOpcion}}</td>
                            </tr>  
                        @endforeach
                    </table>
                    
                </div>
                
            @endif
        
<br><br>
            <div>
                <div style=" font-size: 24px; color:rgb(3, 146, 144);">Resultado</div>
                &#8364;<div id="resultadoCalculo" style=" font-size: 24px;float: left;">{{$presupuestos[0] -> t_presupuestosValor}}</div>
            </div>

            
            @if(count($presupuestos_conceptos) > 0)
                <h3>Conceptos</h3>
                <!-- Conceptos -->
                @foreach($presupuestos_conceptos as $concepto)
                    <div>
                        <div class="checkbox" >
                            <label style="font-size: 17px; color:rgb(152, 152, 152);">
                                    {{$concepto -> t_presupuestosConceptosNombres}}
                            </label>
                        </div>
                        <pre>{{$concepto -> t_presupuestosConceptosDescripcion}}</pre>
                        
                        <div class="input-group">
                            <div class="form-group label-floating">
                                <label class="control-label">Valoración Económica</label>
                            </div>
                        </div>
                        <pre>{{$concepto -> t_presupuestosConceptoCuota}}</pre>
                    </div>
                    <br>
                @endforeach
            @endif
            
            
            <br>
            <div class="input-group">
                <h5>Observación</h5>
                    <div class="form-group label-floating">
                      <pre>{{$presupuestos[0] -> t_presupuestosObservacion}}</pre>
                    </div>
            </div>
            
        </div>
    </div>          
</div> <!--  big container -->
@endsection