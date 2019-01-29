@extends('layouts.app')
@section('content')
    <!--   Big container   --> 
    <div class="alert alert-success" id="alert" style="display:none;"></div> 
        
<div class="container">
       
    <div class="tab-content">
            <div>
                    <?php  $fecha = explode('-', $declaracion -> t_impuestoDeclaracionFecha);
                
                    $ano =  $fecha[0];
                    $ano =  ($ano - 1);
                    ?>
                <h3 style="margin-top: 0px;">Cuestionario Renta {{$declaracion -> t_impuestoDeclaracionYear}}</h3>
                
                    <div class="pre_001" style="margin-right: 25px;">Fecha: {{$declaracion -> t_impuestoDeclaracionFecha}}</div>
                    <div class="pre_001" style="margin-right: 25px;margin-top: 10px;">Nro: {{$declaracion -> t_impuestoDeclaracionReferencia}}</div>
                    <a href="/impuesto/descargar/{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}/a" style="color: white;"><div class="btn btn-info" style=" width: 153px;">Enviar Correo</div></a>
                    <a href="/impuesto/descargar/{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}/b" style="color: white;"><div class="btn btn-info" style=" width: 153px;">Descargar PDF</div></a>
                    <div class="btn btn-info" onclick="document.getElementById('file').click()" style=" width: 153px;">Subir Archivo</div>
                    <div class="btn btn-info" onclick="$('html,body').animate({scrollTop: $('#documentos').offset().top},'slow');" style=" width: 153px;">Ver Archivos</div>
                </div>
                <hr>
            <div>
                <?php $index = ''; $class_div = ''; ?>
                @if($declarante_2 != '')
                <?php
                    $index = 1;
                    $class_div = 'col-sm-6';
                ?>
                @endif
                                   
            <div class="{{$class_div}}">
            <h3>Declarante {{$index}}</h3>
                <table>
                    <tr>
                        <td class="perfilClienteTd">Nombre</td>
                        <td class="perfilClienteTd_2" >{{$declaracion -> t_clientesNombre}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Apellido</td>
                        <td class="perfilClienteTd_2">{{$declaracion-> t_clientesApellido}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Telefono</td>
                        <td class="perfilClienteTd_2" >{{$declaracion -> t_clientesTelefono}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">Email</td>
                        <td class="perfilClienteTd_2" >{{$declaracion -> t_clientesEmail}}</td>
                    </tr>  
                    <tr>
                        <td class="perfilClienteTd">Empresa</td>
                        <td class="perfilClienteTd_2" >{{$declaracion-> t_clientesEmpresa}}</td>
                    </tr>
                    <tr>
                        <td class="perfilClienteTd">NIF</td>
                        <td class="perfilClienteTd_2" >{{$declaracion -> t_clientesNif}}</td>
                    </tr>
                    
                </table>
            </div>
            @if($declarante_2 != '')
                <div class="{{$class_div}}">
                    <h3>Declarante 2</h3>
                    <table>
                        <tr>
                            <td class="perfilClienteTd">Nombre</td>
                            <td class="perfilClienteTd_2" >{{$declarante_2[0] -> t_clientesNombre}}</td>
                        </tr>
                        <tr>
                            <td class="perfilClienteTd">Apellido</td>
                            <td class="perfilClienteTd_2">{{$declarante_2[0] -> t_clientesApellido}}</td>
                        </tr>
                        <tr>
                            <td class="perfilClienteTd">Telefono</td>
                            <td class="perfilClienteTd_2" >{{$declarante_2[0] -> t_clientesTelefono}}</td>
                        </tr>
                        <tr>
                            <td class="perfilClienteTd">Email</td>
                            <td class="perfilClienteTd_2" >{{$declarante_2[0] -> t_clientesEmail}}</td>
                        </tr>  
                        <tr>
                            <td class="perfilClienteTd">Empresa</td>
                            <td class="perfilClienteTd_2" >{{$declarante_2[0] -> t_clientesEmpresa}}</td>
                        </tr>
                        <tr>
                            <td class="perfilClienteTd">NIF</td>
                            <td class="perfilClienteTd_2" >{{$declarante_2[0] -> t_clientesNif}}</td>
                        </tr>
                        
                    </table>
                </div>
            @endif
            
            <div style=" width: 100%;" style=" margin-top: 50px;">
            <h3>&nbsp;</h3>
            </div>
            <div >
                <?php
                $declarante = 0;
                $n = 1;
                ?>
                @foreach($respuestas as $r)
                <?php
                    if( $declarante_2 != '') {
                        if ($r -> t_impuestoDeclaracionRespuestaIdDeclarante !=  $declarante ) {
                            $declarante  = $r -> t_impuestoDeclaracionRespuestaIdDeclarante;
                            echo '<div style=" background-color: rgb(115, 192, 255);padding: 10px;color: white;margin-top: 15px;font-size: 20px;">Declarante '.$n.'</div>';
                            $n++;
                        }
                    }
                ?>

                    <table style=" width: 100%;">
                        <tbody>
                            <tr class="pre_t_tr" style="border-top: 1px solid #f2f2f2;border-bottom :none;">
                                <td class="pre_t_td" style=" font-weight: bold;">{{$r -> t_impuestoDeclaracionRespuestaPregunta}}</td>
                                <td class="pre_t_td" style=" font-weight: bold;    text-align: right;color: #ff9800;">{{$r -> t_impuestoDeclaracionRespuestaRespuesta}}</td>
                            </tr>
                        </tbody>
                     </table>
                    @if($r -> t_impuestoDeclaracionRespuestaObservacion != '')
                        <p class="observaciones_p">{{$r -> t_impuestoDeclaracionRespuestaObservacion}}</p>
                    @endif
                @endforeach
               
               
            </div>
            <br>
            <div class="input-group">
                <h5>Observaciones Finales. No incluidas en ningún apartado</h5>
                    <div class="form-group label-floating">
                      <p class="observaciones_p">{{$declaracion -> t_impuestoDeclaracionObservacion}}</p>
                    </div>
            </div>

            <br>
            <div class="alert alert-success" id="alert_note" style="display:none;"></div> 
            <div class="input-group">
                <h3>Anotaciones</h3>
                    <div class="form-group label-floating" style="display:none;">
                        <textarea class="notes" id="note">{{$declaracion -> t_impuestoDeclaracionNotes}}</textarea>
                        <button class="btn btn-warning" onclick="saveNote('{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}')">Guardar</button>
                    </div>

                    <div class="">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link" href="#internas">Internas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#externas">Externas</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content border mb-3">
                            <div id="internas" class="container tab-pane active"><br>
                                <div>
                                    <button class="btn btn-warning" onclick="addNoteInternas('{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}');" style=" width: 210px;padding: 12px;">Agregar Anotación Interna</button>
                                    @if($_SERVER['SERVER_NAME'] != 'renta.somostuwebmaster.es') 
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" style=" width: 210px;">Comunicar Compañeros</button>
                                    @endif
                                </div>
                                <div id="all_notes_internas">
                                    @foreach($notes_i as $n) 
                                    <div class="anatacionInternaTitle">{{$n -> tb_anotacionesUsuario}} {{$n -> tb_anotacionesDate}}</div>
                                    <textarea class="anatacionInternaBody" readOnly style=" margin-bottom: 10px;" id="note_{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}">{{$n -> tb_anotacionesNotes}}</textarea>
                                    @endforeach
                                </div>
                            </div>
                            <div id="externas" class="container tab-pane fade"><br>
                                <div>
                                        
                                    <button class="btn btn-warning" onclick="addNoteExternas('{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}');" style=" width: 210px;padding: 12px;">Agregar Anotación Externa</button>
                                    @if($_SERVER['SERVER_NAME'] != 'renta.somostuwebmaster.es') 
                                    <button class="btn btn-warning" onclick="formSendCustomer('{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}')" style=" width: 210px;">Comunicar al Cliente</button>
                                       
                                        {{-- <a href="/impuesto/descargar/{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}/c" style="color: white;"><div class="btn btn-warning" style=" width: 210px;">Comunicar al Cliente</div></a> --}}
                                    @endif
                                    </div>
                                    <div id="all_notes_externas">
                                        @foreach($notes_e as $n) 
                                        <div class="anatacionExternaTitle">{{$n -> tb_anotacionesUsuario}} {{$n -> tb_anotacionesDate}}</div>
                                        <textarea class="anatacionExternaBody" readOnly style=" margin-bottom: 10px;" id="note_{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}">{{$n -> tb_anotacionesNotes}}</textarea>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>

            </div>

            
            
        </div>
    </div> 


    <?php 
        $i = $e = $t = $c = ''; 
        if($declaracion -> t_impuestoDeclaracionEstatus == 'Iniciado'){
            $i = 'selected="selected"';
        }
        if($declaracion -> t_impuestoDeclaracionEstatus == 'En Tramitación'){
            $e = 'selected="selected"';
        }
        if($declaracion -> t_impuestoDeclaracionEstatus == 'Tramitado'){
            $t = 'selected="selected"';
        }
        if($declaracion -> t_impuestoDeclaracionEstatus == 'Comprobado'){
            $c = 'selected="selected"';
        }
    
    
    ?>
    <h3>Estado</h3>
    <div class="alert alert-success" id="alert_status" style="display:none;"></div> 
    {!! Form::open(['action' => 'ImpuestoController@updateStatus']) !!}
        <input type="hidden" name="control_id" value="{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}">
        <input type="hidden" name="cuestionario" value="{{$declaracion -> t_impuestoDeclaracionReferencia}}">
        
        <select class="change_state_tax" name="status" id="select_td_{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}">
            <option value="Iniciado" {{$i}}>Iniciado</option>
            <option value="En Tramitación" {{$e}}>En Tramitación</option>
            <option value="Tramitado" {{$t}}>Tramitado</option>
            <option value="Comprobado" {{$c}}>Comprobado</option>
        </select>
    {!! Form::close() !!}

    
    



    

  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['action' => 'ImpuestoController@sendTeam', 'id'=> 'formSendTeam','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="mode" value="d" >
                    <input type="hidden" name="id" value="{{sha1(md5($declaracion -> idt_impuestoDeclaracion))}}" >
                    <div class="modal-header">
                        <h4 class="modal-title">Comunicar a:</h4>
                    </div>
                    <div class="modal-body">
                        
                        @foreach($team as $t) 
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" name="user_{{$t -> idt_usuarios}}" >
                                    {{$t -> t_usuariosNombre}} {{$t -> t_usuariosApellido}}
                                </label>
                            </div>
                        @endforeach
                                    
                    </div>
                    <div class="modal-footer">
                        {{-- {{Form::submit('Comunicar', ['class'=>'btn btn-info','style'=> 'margin-bottom: 0px;'])}} --}}
                        <button type="button" onclick="formSendTeam();" class="btn btn-info" style="margin-bottom: 0px;">Comunicar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
  


    
    {!! Form::open(['action' => 'ImpuestoController@uploadFile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    
        <input name="idt_impuestoDeclaracion" type="hidden" value="{{$declaracion -> idt_impuestoDeclaracion}}" />
        <input name="image[]" type="file" id="file" multiple="" onchange="this.form.submit()" style="display:none;">
        {{-- {{Form::submit('Subir Archivo', ['class'=>'btn btn-primary'])}} --}}
    {!! Form::close() !!}
    <div>
        <h3 id="documentos">Documentos</h3>
        <table style=" width: 100%;">
                <th class="pre_t_th" style="width: 50px;text-align: center;" ></th>
                <th class="pre_t_th" style=" width: 150px; cursor: pointer;" >Nombre</th>
                <th class="pre_t_th" style=" cursor: pointer;" ></th>
        @foreach($files as $f)
        <?php
        $url = str_replace("\\","/", $f -> t_fileUrl );
        ?>
            <tr class="pre_t_tr">
            <td class="pre_t_td" style="width: 50px;text-align: center;" onclick="window.open('{{ URL::asset( $url)}}', '_blank');"><div class="{{strtolower($f -> t_fileFormat)}}_icon"></div></td>
            <td class="pre_t_td" onclick="window.open('{{ URL::asset( $url)}}', '_blank');">{{$f -> t_fileName}}</td>
            <td class="pre_t_td">
               
                <button class="btn btn-danger btn-sm" onclick="deleteFile('{{sha1(md5($f->idt_file))}}',this)">Eliminar</button>
            </td>
                
            </tr>
            
               
        @endforeach
        </table>
    </div>

</div> <!--  big container -->
@endsection
@section('js')
    <script>

        function formSendTeam(){
            if (confirm("Desea Enviar a Compañeros ?")) {
                document.getElementById("formSendTeam").submit();
            }
        }
        function formSendCustomer(value){
            if (confirm("Desea Enviar al Cliente ?")) {
                location.assign("/impuesto/descargar/"+value+"/c");
            }
        }


        $(document).ready(function(){
                   if ( document.getElementById("main_alert")) {
                        if (document.getElementById("main_alert").innerHTML.trim() == 'Archivo Guardado con exito.') {
                            
                            $('html,body').animate({scrollTop: $("#documentos").offset().top}, 'slow');
                        }
                   } 
        });

        $(document).ready(function(){
            $(".nav-tabs a").click(function(){
                $(this).tab('show');
            });
            $('.nav-tabs a').on('shown.bs.tab', function(event){
                var x = $(event.target).text();         // active tab
                var y = $(event.relatedTarget).text();  // previous tab
                $(".act span").text(x);
                $(".prev span").text(y);
            });
        });
         
        function deleteFile(f,e) {
            if (confirm("Desea Eliminar Archivo")) {
                var tr = $(e).parents('tr');
                var url = '/impuesto/deleteFile';
                    $('#alert').hide();
                    
                
                $.post(url,{'file':f,'_token':'{{ csrf_token()}}'},function(result){
                    
                    $( "#alert" ).removeClass( "alert-danger" );
                    $( "#alert" ).removeClass( "alert-success" );
                    $( "#alert" ).addClass( result.class );
                    $('#alert').html(result.message);
                    $('#alert').show();
                    if (result.class == "alert-success") {
                        $(tr).hide('slow');
                    } else {
                        $('html,body').animate({scrollTop: $("#alert").offset().top});
                    }
                    
                    
                        
                });
            }
        }

        function saveNote(id){
            var url = '/impuesto/saveNote';
            var v = $('#note').val();

            $.post(url,{'note':v,'id':id,'_token':'{{ csrf_token()}}'},function(result){
                console.log(result);
                $("#alert_note" ).removeClass( "alert-danger" );
                $("#alert_note" ).removeClass( "alert-success" );
                $("#alert_note" ).addClass( result.class );
                $('#alert_note').html(result.message);
                $('#alert_note').show();
                setTimeout(hideNoteAlert,600);
            });

        }

        function hideNoteAlert(){
            $('#alert_note').hide('slow')
        }

        function addNoteInternas(id){
            if ($("#control_interna").val()) {

            } else {
                var url = '/impuesto/addNote';
                
                $.post(url,{'id':id,'type':'I','_token':'{{ csrf_token()}}'},function(result){
                    console.log(result);
                    $("#all_notes_internas").prepend("<div style=\" margin-bottom: 10px;\" id=\"div_note_"+result.id_note+"\"><input type=\"hidden\"  id=\"control_interna\" value=\"true\"><input type=\"hidden\"  id=\"id_note\" value=\""+result.id_note+"\"><textarea class=\"anatacionInternaBody\" id=\"note_"+result.id_note+"\" onkeyup=\"updateNote('"+result.id_note+"');\"></textarea><button class=\"btn btn-danger btn-sm\" onclick=\"deleteNote('"+result.id_note+"')\">Eliminar</button></div>");
           
                });

            }
        }

        function updateNote(id){
            var url = '/impuesto/updateNote';
            var v = $('#note_'+id).val();    
            $.post(url,{'id':id,'note':v,'_token':'{{ csrf_token()}}'},function(result){
                console.log(result);
                
            });
            
        }

        function deleteNote(id){
            var url = '/impuesto/deleteNote';
            $.post(url,{'id':id,'_token':'{{ csrf_token()}}'},function(result){
                console.log(result);
                 
            });
            $("#div_note_"+id).hide('slow');
            $("#div_note_"+id).html("");
        }

        function addNoteExternas(id){
           if ($("#control_externa").val()) {

            } else {
                var url = '/impuesto/addNote';
                
                $.post(url,{'id':id,'type':'E','_token':'{{ csrf_token()}}'},function(result){
                    console.log(result);
                    $("#all_notes_externas").prepend("<div style=\" margin-bottom: 10px;\" id=\"div_note_"+result.id_note+"\"><input type=\"hidden\"  id=\"control_externa\" value=\"true\"><input type=\"hidden\"  id=\"id_note\" value=\""+result.id_note+"\"><textarea class=\"anatacionExternaBody\" id=\"note_"+result.id_note+"\" onkeyup=\"updateNote('"+result.id_note+"');\"></textarea><button class=\"btn btn-danger btn-sm\" onclick=\"deleteNote('"+result.id_note+"')\">Eliminar</button></div>");
           
                });

            }
            
        }


        
        
        $(document).ready(function(){
            $.material.init();
        
            $('.change_state_tax').change(
            function(e){
                e.preventDefault();
                var form = $(this).parents('form');
               // form.submit();
                var url = '/impuesto/estado';
                
                $.post(url,form.serialize(),function(result){
                    console.log(result);
                        $('#alert_status').html(result.message);
                        if (result.status) {
                            $( "#alert_status" ).removeClass( "alert-danger" );
                            $( "#alert_status" ).addClass( "alert-success" );
                        }else{
                            $( "#alert_status" ).removeClass( "alert-success" );
                            $( "#alert_status" ).addClass( "alert-danger" );
                            
                        }
                        $('#alert_status').show();
                });
            }
            );
        
        });
                
    </script>
    <style>
    .anatacionInternaTitle{
        background-color: rgb(255, 244, 112);
        padding: 5px 2px 5px 10px;
        text-transform: capitalize;

    }
    .anatacionInternaBody{
        background-color: rgb(255, 252, 179);
        width: 100%;
        height: 100px;
        font: normal 14px verdana;
        line-height: 25px;
        padding: 2px 10px;
        border: none;
    }

     .anatacionExternaTitle{
        background-color: rgb(116, 255, 235);
        padding: 5px 2px 5px 10px;
        text-transform: capitalize;

    }
    .anatacionExternaBody{
        background-color: rgb(189, 255, 250);
        width: 100%;
        height: 100px;
        font: normal 14px verdana;
        line-height: 25px;
        padding: 2px 10px;
        border: none;
    }
    </style>
@endsection