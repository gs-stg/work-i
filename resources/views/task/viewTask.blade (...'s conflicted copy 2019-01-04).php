@extends('layouts.app')
@section('content')


<div class="container">
    <div class="tab-content">
        <div id="editTask" style="display:none;" >
            <div id="t-0007">
                    
                <button style="display:none;" class="btn  btn-sm btn-topTask" id="markCompleted"  onclick="completedButtonFather(this)"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp; <span class="removeForMobile" id="closeTaskButtonFather">Finalizar Reunion</span></button>
                

                <button  class="btn  btn-sm btn-topTask removeForMobile" id="addSubTask" title="Sub-Tarea"><span class="glyphicon glyphicon-tasks"></span> &nbsp;&nbsp; <span class="removeForMobile">Sub-Tarea</span></span></button>
                <button class="btn  btn-sm btn-topTask" id="notifyEmailFather" title="Enviar Notificación"><span class="glyphicon glyphicon-send" ></span> &nbsp;&nbsp; <span class="removeForMobile">Enviar Notificación</span></button>
                <button class="btn  btn-sm btn-topTask" id="shareFather" title="Enviar Notificación" data-toggle="modal" data-target="#myModalCompartir"><span class="glyphicon glyphicon-share" ></span> &nbsp;&nbsp; <span class="removeForMobile">Compartir</span></button>
               
                
                <a href="#" id="closeEditTask" title="Cerrar">
                    <span class="glyphicon glyphicon-remove"></span>  
                </a>
            
            </div>
            <div style="clear: both;height: calc(100vh - 200px); display: table;width: 100%;">
                <div class="t-0045" id="to_know_where">
                    Tarea Madre
                </div>
                <div class="col-sm-12" style="height: 40px;margin-top: 20px;">
                    <div class="input-group">
                        <div class="form-group label-floating">
                            <label class="control-label">Asunto General</label>
                            <input name=""  id="t_generalTaskTitle" type="text" value="" class="form-control" />
                        </div>
                    </div>
                </div>
                <div id="alertDivFather" style="display:none;"></div>
                <div class="col-sm-12 ">
                   
                    <div  class="t-0008" style="margin-top: 20px; " >
                        <div id="customerFather"></div>
                        <div id="assignedFather"></div>
                        <div id="dueDateFather"></div>
                        <div id="dueTimeFather"></div>
                        <div id="dueTimeEndFather"></div>
                        <div id="repeatFather" class="only_in_task" style="display:none"></div>
                        <div id="priorityFather" class="only_in_task" style="display:none"></div>
                        <div id="locationFather" class="only_in_meeting" style="display:none"></div>
                        <div id="documentaryReminder" class="only_in_project" style="display:none"></div>
                        <div id="bookNoteBook" class="only_in_project" style="display:none"></div>
                        
                        <div id="createdByFather"></div>
                    </div>
                    
    
                    <div  id="t-0009"  style="margin-top: 20px;display:none">
                        <div id="descriptionFather" placeholder="Descripción" style="height: 0px;"></div>
                    </div>
                </div>
                {!! Form::open(['id' => 'fromEfiTask']) !!}
                    <div id="DivFormCustomer" class="col-sm-12" style="   display:none;   clear: both;  padding: 15px;">
                        <div id="DivFormCustomer2" class="col-sm-12" style=" background-color: #f3f3f3;">
                            <input type="hidden" name="id" id="generalTaskId" >
                            <input type="hidden" name="idt_clientes" id="idt_clientes" >
                            <input type="hidden" name="customerControl" id="customerControl" value="form">
                            <div style="margin-bottom: 15px; margin-top: 5px;">
                                <div id="t-0010">
                                    <input  placeholder="Buscar Cliente" style="    border: 1px solid white;  padding: 3px;     width: 250px;" type="text" name="searchCustomer" id="searchCustomer">
                                    
                                    <div class="removeForMobile t-0033" id="overwriteContact">Sobrescribir Contacto en Tareas</div>
                                    <div class="removeForMobile t-0033" id="cleanCustomer" style="    margin-right: 10px;">Limpiar Cliente</div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6" style="">
                                <div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">NIF</label>
                                            <input name="t_clientesNif_1"  onkeyup="nifFormat(this);" id="t_clientesNif_1" maxlength="9"  type="text" value="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nombre  o Razón Social</label>
                                            <input name="t_clientesNombre"  id="t_clientesNombre" type="text" value="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Apellidos Cliente</label>
                                            <input name="t_clientesApellido"  id="t_clientesApellido" type="text" value="" class="form-control" />
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                            <div class="col-sm-6" style="">
                                <div style="">
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Persona Contacto</label>
                                            <input name="t_generalTaskCPContact"  id="t_generalTaskCPContact" type="text" value="" class="form-control" />
                                        </div>
                                    </div>
        
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Telefono</label>
                                            <input name="t_clientesTelefono"  id="t_clientesTelefono" type="text" value="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input name="t_clientesEmail"  id="t_clientesEmail" type="text" value="" class="form-control" />
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                            
                        </div>
                        <div  id="DivFormCustomer3"  style="background-color: rgb(117, 216, 232);display: none;" class="col-sm-12"><button class="btn btn-sm btn-info" type="button" id="createCustomer">Crear Cliente</button></div>
                    </div>
                {!! Form::close() !!}
                
                <div  style="clear: both;margin-top: 20px;float:  left;width: 100%;">
                    <div class="t-0028">
                        <div style="height: 50px;">
                            <div style="float: left;">
                                <h5>Anotaciones</h5>
                            </div>
                            <div style="float: left;margin-left: 10px;margin-top: 2px;">
                                <button type="button" id="addFatherTaskNotes" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                            </div>
                        </div>
                        <div  class="" id="notesFatherTaskListNew" style="clear: both;">
                                
                        </div>
                        <div  class="" id="notesFatherTaskList" style="clear: both;">
                            <div id="notesFatherTaskListText"></div>
                        </div>
                    </div>

                    <div class="t-0028">
                        <div style="height: 50px;">
                            <div style="float: left;">
                                <h5>Documentos</h5>
                            </div>
                            <div style="float: left;margin-left: 10px;margin-top: 2px;">
                                <button type="button" id="addFatherTaskDocuments" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                            </div>
                            <div  style="height: 40px;float:  left;margin-left: 15px;width: 60%;margin-top: 5px;" class="removeForMobile">
                                <div class="input-group">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Ruta</label>
                                        <input name=""  id="t_generalTaskDirectory" type="text" value="" class="form-control" />
                                        
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        {!! Form::open(['action' => 'TaskController@uploadFile', 'method' => 'POST','id' => 'form_documentsFatherTaskList', 'enctype' => 'multipart/form-data',  'target'=> 'uploadTrg']) !!}
                            <input name="mode"  type="hidden" value="father" />
                            <input name="id" id="id_subTask_father_upload" type="hidden" value="" />
                            <input name="image[]" type="file" id="file_documentsFatherTaskList" multiple="" onchange="uploadFile('father');"   style=" display:none;">
                        {!! Form::close() !!}
                        <iframe id="uploadTrg" name="uploadTrg" height="0" width="0" frameborder="0" scrolling="yes"></iframe>
                        <div  class="" id="documentsFatherTaskList">
                            <div id="documentsFatherTaskListText"></div>
                        </div>
                    </div>
                </div>
                

               
                <div style="clear: both;">
                    <div style="float: left;">
                        <h5 id="t-0011">Sub-Tareas</h5>
                    </div>
                    <div style="float: left;margin-left: 10px;margin-top: 2px;">
                        <button type="button" id="addSubTaskPlus" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                    </div>

                    <div style="float:right; margin-top: 8px;padding-right: 15px;" class="removeForMobile">
                        <div class="t-0029">
                            <div class="t-0031">
                                <input type="hidden" id="active_status_son" value="incompleted">
                                <button style="" class="btn t-0032 status-task-son active-status-son"  id="status-task-son_open" onclick="activeStatusSon(this,'incompleted');" id="default_active_status_son">Abiertas</button>
                                <button style="" class="btn t-0032 status-task-son" id="status-task-son_close" onclick="activeStatusSon(this,'completed');">Cerradas</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="" id="subTaskList">
                    <div id="subTaskListText"></div>
                </div>

                <div style="clear: both; display:none;" class="only_in_project_b" >
                    <div style="float: left;">
                        <h5 id="t-0011">Reuniones</h5>
                    </div>
                    <div style="float: left;margin-left: 10px;margin-top: 2px;">
                        <button type="button" id="addSubTaskPlusMeeting" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                    </div>

                    <div style="float:right; margin-top: 8px;padding-right: 15px;" class="removeForMobile">
                        <div class="t-0029">
                            <div class="t-0031">
                                <input type="hidden" id="active_status_fatherMeeting" value="incompleted">
                                <button style="" class="btn t-0032 status-task-fatherMeeting active-status-son"  id="status-task-fatherMeeting_open" onclick="activeStatusFatherMeeting(this,'incompleted');" id="default_active_status_son">Abiertas</button>
                                <button style="" class="btn t-0032 status-task-fatherMeeting" id="status-task-fatherMeeting_close" onclick="activeStatusFatherMeeting(this,'completed');">Cerradas</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div  style="display:none;" id="subTaskListMeeting" class="only_in_project_b">
                    <div id="subTaskListTextMeeting"></div>
                </div>
            </div>

            
            <div class="modal-footer" >
                <div   class="deleteTaskButton" id="deleteTaskButton">Eliminar</div>
            </div>
            
        </div>
            
        <div id="editSubTask" style="display:none;">
            <div id="t-0007">
                    
                <button class="btn  btn-sm btn-topTask" id="markCompletedSon" title="Finalizar Tarea" onclick="completedButtonSon(this)"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp; <span class="removeForMobile">Finalizar Tarea</span></button>
                <button class="btn  btn-sm btn-topTask" id="seeAsuntoGeneral" title="Tarea" onclick="fillTask(this);"><span class="glyphicon glyphicon-triangle-top" ></span> &nbsp;&nbsp; <span class="removeForMobile">Tarea Madre</span></button>
                <button class="btn  btn-sm btn-topTask removeForMobile" id="addDocumentTop" title="Adjuntar Documento"><span class="glyphicon glyphicon-paperclip" ></span> &nbsp;&nbsp; <span class="removeForMobile">Adjuntar Documento</span></button>
                <button class="btn  btn-sm btn-topTask removeForMobile" id="addNoteTop" title="Agregar Anotacion"><span class="glyphicon glyphicon-pencil" ></span> &nbsp;&nbsp; <span class="removeForMobile">Agregar Anotacion</span></button>
                <button class="btn  btn-sm btn-topTask" id="notifyEmail" title="Enviar Notificación"><span class="glyphicon glyphicon-send" ></span> &nbsp;&nbsp; <span class="removeForMobile">Enviar Notificación</span></button>
                <button class="btn  btn-sm btn-topTask" id="shareSon" title="Enviar Notificación" data-toggle="modal" data-target="#myModalCompartir"><span class="glyphicon glyphicon-share" ></span> &nbsp;&nbsp; <span class="removeForMobile">Compartir</span></button>
               
                
               
                <a href="#" id="closeEditSubTask" title="Cerrar">
                    <span class="glyphicon glyphicon-remove"></span>  
                </a>
            
            </div>
            <div style="    clear: both;
            height: calc(100vh - 200px);
            display: table;
            width: 100%;">
                <div class="t-0045">
                    Sub-Tarea
                </div>
                <div class="col-sm-12" style="height: 40px;margin-top: 20px;">
                    <div class="input-group">
                        <div class="form-group label-floating">
                            <label class="control-label">Escribe Nombre de Tarea</label>
                            <input name=""  id="t_taskTitle" type="text" value="" class="form-control" />
                        </div>
                    </div>
                </div>
                <div id="alertDivSon" style="display:none;"></div>

                <div class="col-sm-12 t-0008" style="margin-top: 20px;">
                    <div id="customer"></div>
                    <div id="assigned"></div>
                    <div id="dueDate"></div>
                    <div id="dueTime"></div>
                    <div id="repeat"></div>
                    <div id="priority"></div>
                    <div id="workflow"></div>
                    <div id="createdBySon"></div>
                </div>

                

                <div  id="t-0009"  style="margin-top: 20px;display:none;">
                    <div id="descriptionSon"  placeholder="Descripción" style="height: 0px;"></div>
                    <div id="descriptionSonReadOnly"  placeholder="Descripción" style="height: 0px;"></div>
                </div>
                <div style="clear: both;margin-top: 20px;float:  left;width: 100%;">
                    <div class="t-0028" >
                        <div style="height: 50px;">
                            <div style="float: left;">
                                <h5>Anotaciones</h5>
                            </div>
                            <div style="float: left;margin-left: 10px;margin-top: 2px;">
                                <button type="button" id="addSubTaskNotes" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                            </div>
                        </div>
                        <div  class="" id="notesSubTaskListNew" style="clear: both;"></div>
                        <div  class="" id="notesSubTaskList">
                            <div id="notesTaskListText"></div>
                        </div>
                    </div>
                </div>
                

                <div style="clear: both;margin-top: 20px;float:  left;width: 100%;">
                    <div class="t-0028">
                        <div style="height: 50px;">
                            <div style="float: left;">
                                <h5>Documentos</h5>
                            </div>
                            <div style="float: left;margin-left: 10px;margin-top: 2px;">
                                <button type="button" id="addSubTaskDocuments" class="btn" style="   margin-top: 2px;padding: 10px 25px 10px 25px;"><span class="glyphicon glyphicon-plus" style="font-size: 16px;"></span></button>
                            </div>
                            <div  style="height: 40px;float:  left;margin-left: 15px;width: 60%;margin-top: 5px;" class="removeForMobile">
                                <div class="input-group">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Ruta</label>
                                        <input name=""  id="t_taskDirectory" type="text" value="" class="form-control" />
                                        
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        {!! Form::open(['action' => 'TaskController@uploadFile', 'method' => 'POST','id' => 'form_documentsSubTaskList', 'enctype' => 'multipart/form-data',  'target'=> 'uploadTrg']) !!}
                                    <input name="mode"  type="hidden" value="son" />
                                    <input name="id" id="id_subTask_son_upload" type="hidden" value="" />
                                    <input name="image[]" type="file" id="file_documentsSubTaskList" multiple="" onchange="uploadFile('son');"   style=" display:none;">
                                
                                {!! Form::close() !!}
                                <iframe id="uploadTrg" name="uploadTrg" height="0" width="0" frameborder="0" scrolling="yes"></iframe>
                        <div  class="" id="documentsSubTaskList">
                            <div id="documentsTaskListText"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" >
                <div   class="deleteTaskButton">Eliminar Subtarea</div>
            </div>
        </div>

        @if ($mode == 'GeneralTask')
            <h2  id="t-0000" style="margin-top: 0px;">Tareas</h2>
        @endif

        @if ($mode == 'Meeting')
            <h2  id="t-0000" style="margin-top: 0px;">Reuniones</h2>
        @endif

        @if ($mode == 'Project')
            <h2  id="t-0000" style="margin-top: 0px;">Anotaciones</h2>
        @endif


        <div id="t-0001">
            
            <div id="t-0002">
                {{-- <button style=" margin-left: 15px;" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Agregar</button>  --}}
                <div class="t-0029">
                    <button style=" float: left;margin-left: 15px;padding: 10px;margin-top: 1px;margin-bottom: 2px;" class="btn btn-info " id="addTask" >Agregar</button>
                </div>
                
                <div style="float:right; margin-top: 8px;" class="removeForMobile">
                    <div class="t-0029">
                        <div class="t-0031" style="margin-top: -8px; border: none;">
                            @if ($mode == 'GeneralTask')
                                <input type="text" id="search_task" class="selectSimple" style="width: 250px;height: 37px;border-radius: 5px;" value="" placeholder="Buscar Tarea" onkeyup="searchTask(this.value);">
                            @endif
                            @if ($mode == 'Meeting')
                                <input type="text" id="search_task" class="selectSimple" style="width: 250px;height: 37px;border-radius: 5px;" value="" placeholder="Buscar Reunión" onkeyup="searchTask(this.value);">
                            @endif
                            @if ($mode == 'Project')
                                <input type="text" id="search_task" class="selectSimple" style="width: 250px;height: 37px;border-radius: 5px;" value="" placeholder="Buscar Anotacion" onkeyup="searchTask(this.value);">
                            @endif
                        </div>
                     </div>

                     @if (isset(Session::get('permisos')['get_other_user_task']))
                        <div class="t-0029">
                            <div class="t-0031" style="margin-top: -8px; border: none;">
                                <select name="" id="active_user" class="selectSimple" style="width: 200px;height: 37px;    " onchange="activeUser(this);" onclick="activeUser(this);" onselect="activeUser(this);">
                                    <option value="all">Todos</option> 
                                    @foreach($team as $t)
                                        <?php 
                                            $selected = '';
                                            if ($t -> idt_usuarios == Session::get('user') -> idt_usuarios) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="{{sha1(md5($t -> idt_usuarios))}}" {{$selected}} onselect="activeUser(this);" onclick="activeUser(this);">{{$t -> t_usuariosNombre}} {{$t -> t_usuariosApellido}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif
                    @if ($mode == 'Project')
                        <input type="hidden" id="active_status" value="incompleted">
                    @else
                        <div class="t-0029">
                            <div class="t-0031" style="margin-top: -8px; ">
                                <input type="hidden" id="active_status" value="incompleted">
                                <button style="" class="btn t-0032 status-task" onclick="activeStatus(this,'all');">Todas</button>
                                <button style="" class="btn t-0032 status-task active-status" onclick="activeStatus(this,'incompleted');">Abiertas</button>
                                <button style="" class="btn t-0032 status-task" id="status-task-main_close" onclick="activeStatus(this,'completed');">Cerradas</button>
                            </div>
                        </div>
                    @endif

                    @if ($mode == 'GeneralTask')
                        <input type="hidden" id="active_show" value="son">
                        {{-- <div class="t-0029">
                            <div class="t-0031" style="margin-top: -8px; ">
                                   
                                <button style="" class="btn t-0032 show-task"  onclick="activeShow(this,'father');" >Tareas</button>
                                <button style="" class="btn t-0032 show-task active-show" onclick="activeShow(this,'son');">Subtareas</button>
                            </div>
                        </div> --}}
                    @endif
                    <div class="t-0029">
                        <div class="t-0031" style="margin-top: -8px;">

                            

                            <button style="" class="btn t-0032 orden-task" onclick="activeOrden(this,'title');">Nombre</button>
                            @if ($mode == 'GeneralTask')
                                <input type="hidden" id="active_orden" value="date">
                                {{-- <button style="" class="btn t-0032 orden-task active-orden" onclick="activeOrden(this,'priority');">Prioridad</button> --}}
                                <button style="" class="btn t-0032 orden-task" onclick="activeOrden(this,'type');">Tipo</button>
                                <button style="" class="btn t-0032 orden-task active-orden" onclick="activeOrden(this,'date');" >Fecha</button>
                            @endif
                            @if ($mode == 'Meeting')
                                <input type="hidden" id="active_orden" value="date">
                                <button style="" class="btn t-0032 orden-task active-orden" onclick="activeOrden(this,'date');" >Fecha</button>
                            @endif

                            @if ($mode == 'Project')
                                <input type="hidden" id="active_orden" value="date">
                                <button style="" class="btn t-0032 orden-task active-orden" onclick="activeOrden(this,'date');" >Fecha</button>
                            @endif
                            
                        </div>
                    </div>
                    @if ($mode == 'GeneralTask')
                        <div class="t-0029">
                            <div class="t-0031" style="margin-top: -8px; " id="follow_mention">
                                <input type="hidden" id="follow_mode" value=""> 
                                <input type="hidden" id="mention_mode" value="">
                                <button style="" class="btn t-0032 follow-task" onclick="followMode(this,'follow');">Seg.</button>
                                <button style="" class="btn t-0032 follow-task" onclick="mentionMode(this,'mention');">@</button>
                            </div>
                        </div>
                    @endif
                    
                    <input type="hidden" id="doc_rec_mode" value="">
                    @if ($mode == 'Project')
                        <div class="t-0029">
                            <div class="t-0031" style="margin-top: -8px; " id="task_doc_rec">
                                
                                <button style="" class="btn t-0032 doc_rec-task" onclick="docRec(this,'Recordatorio');">Rec.</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
           
            <div id="t-0003">
                <div style="height: 33px;" class="removeForMobile">
                    <div id="totalTaskMain">Total</div>
                </div>
                <div id="task">
                </div>    
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalCompartir" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Compartir</h4>
            </div>

            <div class="modal-body" style="padding:0;">
                <div style="padding: 10px;">
                    <label for="text_copy">Link: </label>
                    <input id="text_copy" value="" readonly class="t-0046">
                    <button class="btn_copy t-0047" data-clipboard-action="copy" data-clipboard-target="#text_copy">Copiar</button>
        
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalCalendar" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="padding:0;">
               
                <div id="error_date_son" class="alert alert-danger" role="alert" style="display:none;"></div>
                <div id="calendar_1"></div>
                <div style="min-height: 100px;">
                    <div class="t-0038">Repetición</div>
                    <div class="t-0036" id="daily" onclick="changeRepeat(this,'daily')">Diaria</div>
                    <div class="t-0036" id="weekly" onclick="changeRepeat(this,'weekly')">Semanal</div>
                    <div class="t-0036" id="monthly" onclick="changeRepeat(this,'monthly')">Mensual</div>
                    <div class="t-0036" id="lastDay" onclick="changeRepeat(this,'lastDay')">Final de Mes</div>
                    <div class="t-0036" id="quarterly" onclick="changeRepeat(this,'quarterly')">Trimestral</div>
                    <div class="t-0036" id="biannual" onclick="changeRepeat(this,'biannual')">Semestral</div>
                    <div class="t-0036" id="yearly" onclick="changeRepeat(this,'yearly')">Anual</div>
                    <div class="t-0036" id="no_repeart" onclick="changeRepeat(this,'no_repeart')">Sin Repetición</div>
                </div>
                <div id ="critical_date">
                    <div class="t-0038">Fecha Critica</div>
                    <input id="critical_date_son" value="0" type="hidden">
                    <div class="t-0048"   id ="critical_date_son_div" onclick="criticalDateSon()">Desactivada</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="myModalCalendar_close" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalCalendarTime" role="dialog">
    <div class="modal-dialog">
            
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hora:</h4>
            </div>
            <div class="modal-body" style="padding:0;">
                <center>
                    <div style="width: 120px;height: 55px;margin-top: 10px;">
                        <div>
                            <select id="h_son" class="selectSimple" style="padding: 10;float: left;" onchange="dueDateTimeClick()">
                                <option value="" selected>HH</option>
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                        </div>
                        <div>
                            <select id="m_son" class="selectSimple" style="margin-left: 5px;padding: 10;float: left;" onchange="dueDateTimeClick()">
                                <option value="" selected>MM</option>
                                <option value="00">00</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                </div>
                </center>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalCalendarTimeFather" role="dialog">
    <div class="modal-dialog">
            
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                 <h4 class="modal-title">Hora:</h4>
            </div>
            <div class="modal-body" style="padding:0;">
                <center>
                    <div style="width: 120px;height: 100px;margin-top: 10px;">
                        <span class="glyphicon glyphicon-time t-0035"></span>
                        <div class="t-0034">Comienza</div>
                        <div>
                            <select id="h_father" class="selectSimple" style="padding: 10;float: left;" onchange="dueDateTimeClickFather()">
                                <option value="" selected>HH</option>
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                        </div>
                        <div>
                            <select id="m_father" class="selectSimple" style="margin-left: 5px;padding: 10;float: left;" onchange="dueDateTimeClickFather()">
                                <option value="" selected>MM</option>
                                <option value="00">00</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>

                    <div style="width: 120px;height: 100px;margin-top: 10px;" class="only_in_meeting">
                        <span class="glyphicon glyphicon-time t-0035"></span>
                        <div class="t-0034">Termina</div>
                        <div>
                            <select id="h_father_End" class="selectSimple" style="padding: 10;float: left;" onchange="dueDateTimeClickFather()">
                                <option value="" selected>HH</option>
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                        </div>
                        <div>
                            <select id="m_father_end" class="selectSimple" style="margin-left: 5px;padding: 10;float: left;" onchange="dueDateTimeClickFather()">
                                <option value="" selected>MM</option>
                                <option value="00">00</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalLocationFather" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubicación :</h4>
            </div>
            <div class="modal-body" >
                <form id="form_location">
                    @foreach($offices as $o)
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios"  value="{{$o -> t_oficinasNombre}}" onclick="changeLocation(this.value)">
                                {{$o -> t_oficinasNombre}}
                            </label>
                        </div>
                    @endforeach
                    <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios"  value="otra" onclick="changeLocation(this.value)">
                                Otra
                            </label>
                        </div>
                    {{-- <select class="selectSimple" style="width: 300px;margin-bottom: 30px;" onchange="changeLocation(this.value)">
                        <option > Seleccione Ubicación</option>
                        @foreach($offices as $o)
                            <option value="{{$o -> t_oficinasNombre}}" onselect="changeLocation(this.value)" onclick="changeLocation(this.value)"> {{$o -> t_oficinasNombre}}</option>
                        @endforeach
                        <option value="otra" onclick="changeLocation(this.value)" onselect="changeLocation(this.value)"  >Otra</option>
                    </select> --}}

                    <br>
                    <div class="input-group" style="display:none;" id="other_location">
                        <div class="form-group label-floating">
                            <label class="control-label">Ubicación</label>
                            <input name="other_location" id="other_location_value" onkeyup="changeLocation(this.value)"   type="text" value="" class="form-control" />
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalWorkflow" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Flujo de Trabajo :</h4>
            </div>
            <div class="modal-body" style="padding:0;" id="body_workflow">
                <div>
                    <input type="text" placeholder="Buscar Tarea" id="body_workflow_search" onkeyup="fillWorkflow(this.value);">
                </div>
                <div id="body_workflow_2">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalCalendarFather" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="padding:0;">
                <div id="calendar_2"></div>
                <div class="only_in_task only_in_project_recordatorio" style="display:none; min-height: 100px;" >
                    <div class="t-0038">Repetición</div>
                    <div class="t-0036" id="daily_father" onclick="changeRepeat(this,'daily')">Diaria</div>
                    <div class="t-0036" id="weekly_father" onclick="changeRepeat(this,'weekly')">Semanal</div>
                    <div class="t-0036" id="monthly_father" onclick="changeRepeat(this,'monthly')">Mensual</div>
                    <div class="t-0036" id="lastDay_father" onclick="changeRepeat(this,'lastDay')">Final de Mes</div>
                    <div class="t-0036" id="quarterly_father" onclick="changeRepeat(this,'quarterly')">Trimestral</div>
                    <div class="t-0036" id="biannual_father" onclick="changeRepeat(this,'biannual')">Semestral</div>
                    <div class="t-0036" id="yearly_father" onclick="changeRepeat(this,'yearly')">Anual</div>
                    <div class="t-0036" id="no_repeart_father" onclick="changeRepeat(this,'no_repeart')">Sin Repetición</div>
                    <div></div>
                </div>
                <div id ="critical_date_father" class="only_in_task" style="display:none;">
                    <div class="t-0038">Fecha Critica</div>
                    <input id="critical_date_father" value="0" type="hidden">
                    <div class="t-0048"   id ="critical_date_father_div" onclick="criticalDateFather()">Desactivada</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="myModalCalendarFather_close" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

 <!-- assigned to-->
 <div class="modal fade" id="myModalTeam" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['action' => 'TaskController@editTaskSon', 'id'=> 'formAssignedTeam','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="id" id="id_subTask_son" value="" >
                    <input type="hidden" name="assignedTeam" value="assignedTeam" >
                    <div class="modal-header">
                        
                        <h4 class="modal-title">Asignar a:</h4>
                        <div class="t-0041 " style="display:none" id="team_take_control" onclick="takeControl('son')">Tomar Control</div>
                    </div>
                    <div class="modal-body" >
                        <div class="t-0044">
                            <select style="    margin-top: 10px;" class="t-0020" id="dp_subTask" onchange="$('#team_radio_dp_subTask_ninguno').click();">
                                @foreach($deparments as $d) 
                                    <option value="{{$d -> idt_department}}">{{$d -> t_departmentName}}</option>
                                @endforeach
                            </select>
                            
                            <div class="radio team_radio" style="    margin-top: 10px;" title="remover">
                                    <label>
                                        <input type="radio"   name="team_radio_dp_subTask"    value="remover" onclick="$('#dp_subTask_type').val(this.value);formAssignedTeamDeparment();">Remover</label>
                                </div>
                            <div class="radio team_radio"  style="    margin-top: 10px;"  title="Valida">
                            <label>
                                <input type="radio"   name="team_radio_dp_subTask"   value="Valida" onclick="$('#dp_subTask_type').val(this.value);formAssignedTeamDeparment()">V</label>
                            </div>
                            <div class="radio team_radio" style="    margin-top: 10px;"  title="Copia">
                                <label>
                                    <input type="radio"  name="team_radio_dp_subTask" value="CC" onclick="$('#dp_subTask_type').val(this.value);formAssignedTeamDeparment()">C</label>
                            </div>
                            
                            <div class="radio team_radio" style="    margin-top: 10px;" title="Responsable">
                                <label>
                                    <input type="radio"   name="team_radio_dp_subTask"    value="Realiza" onclick="$('#dp_subTask_type').val(this.value);formAssignedTeamDeparment()">R</label>
                            </div>
                            <input type="radio"   name="team_radio_dp_subTask"  id="team_radio_dp_subTask_ninguno" style="display:none;" value="ninguno" onclick="" checked="checked">
                            <input type="hidden"  id="dp_subTask_type" value="">
                        </div>
                        <div>
                            <input type="text" placeholder="Buscar" id="" onkeyup="searchTeamSub(this.value)" class="search_team">
                        </div>
                        <div id="body_assined">
                            @foreach($team as $t) 
                                <div class="t-0019" id="user_assigned_{{$t -> idt_usuarios}}">
                                    <div class="checkbox t-0020">
                                        <label>
                                        <input type="checkbox" name="user_{{$t -> idt_usuarios}}" id="user_subTask_{{$t -> idt_usuarios}}"  onclick="checkDefaultRadio('{{$t -> idt_usuarios}}',this)">
                                            {{$t -> t_usuariosNombre}} {{$t -> t_usuariosApellido}}
                                        </label>
                                    </div>
                                    
                                    <input type="hidden" name="user_type_{{$t -> idt_usuarios}}" id="user_subTask_type_{{$t -> idt_usuarios}}" value="">
                                    <input type="hidden" class="team_all_radios_son dp_subTask_{{$t->department['id_dp']}}" value="{{$t -> idt_usuarios}}">
                                    <div class="radio team_radio"  style="    margin-top: 10px;"  title="Valida">
                                    <label>
                                        <input type="radio" class="team_all_radios "  name="team_radio_{{$t -> idt_usuarios}}"   value="Valida" onclick="$('#user_subTask_type_{{$t -> idt_usuarios}}').val(this.value);">V</label>
                                    </div>
                                    <div class="radio team_radio" style="    margin-top: 10px;"  title="Copia">
                                        <label>
                                            <input type="radio" class="team_all_radios " name="team_radio_{{$t -> idt_usuarios}}" value="CC" onclick="$('#user_subTask_type_{{$t -> idt_usuarios}}').val(this.value); ">C</label>
                                    </div>
                                    
                                    <div class="radio team_radio" style="    margin-top: 10px;" title="Responsable">
                                        <label>
                                            <input type="radio" class="team_all_radios "  name="team_radio_{{$t -> idt_usuarios}}"    value="Realiza" onclick="$('#user_subTask_type_{{$t -> idt_usuarios}}').val(this.value); ">R</label>
                                    </div>
                                    <input disabled type="radio" class="team_all_radios"  name="team_radio_{{$t -> idt_usuarios}}"  style="display:none;"  value="ninguno" onclick="">
                                </div>
                            @endforeach
                        </div>     
                    </div>
                    <div class="modal-footer">
                        {{-- {{Form::submit('Comunicar', ['class'=>'btn btn-info','style'=> 'margin-bottom: 0px;'])}} --}}
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_assignar">Cerrar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- assigned to-->
 <div class="modal fade" id="myModalTeamFather" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['action' => 'TaskController@editTaskA', 'id'=> 'formAssignedTeamFather','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" id="idt_generalTask_team" value="" >
                <input type="hidden" name="assignedTeamFather" value="assignedTeamFather" >
                <div class="modal-header">
                    <h4 class="modal-title " ><span class="modalTeamFatherTitle">Asistente</span>  :</h4>
                    <div class="t-0041 " style="display:none" id="team_take_control_father" onclick="takeControl('father')">Tomar Control</div>
                </div>
                <div class="modal-body" >
                    <div class="t-0044 only_in_task">
                        <select style="    margin-top: 10px;" class="t-0020" id="dp_father" onchange="$('#team_radio_dp_father_ninguno').click();">
                            @foreach($deparments as $d) 
                                <option value="{{$d -> idt_department}}">{{$d -> t_departmentName}}</option>
                            @endforeach
                        </select>
                        <div class="radio team_radio" style="    margin-top: 10px;" title="remover">
                                <label>
                                    <input type="radio"   name="team_radio_dp_father"    value="remover" onclick="$('#dp_father_type').val(this.value);formAssignedTeamDeparmentFather();">Remover</label>
                            </div>
                        <div class="radio team_radio"  style="    margin-top: 10px;"  title="Valida">
                        <label>
                            <input type="radio"   name="team_radio_dp_father"   value="Valida" onclick="$('#dp_father_type').val(this.value);formAssignedTeamDeparmentFather()">V</label>
                        </div>
                        <div class="radio team_radio" style="    margin-top: 10px;"  title="Copia">
                            <label>
                                <input type="radio"  name="team_radio_dp_father" value="CC" onclick="$('#dp_father_type').val(this.value);formAssignedTeamDeparmentFather()">C</label>
                        </div>
                        
                        <div class="radio team_radio" style="    margin-top: 10px;" title="Responsable">
                            <label>
                                <input type="radio"   name="team_radio_dp_father"    value="Realiza" onclick="$('#dp_father_type').val(this.value);formAssignedTeamDeparmentFather()">R</label>
                        </div>
                        <input type="radio"   name="team_radio_dp_father"  id="team_radio_dp_father_ninguno" style="display:none;" value="ninguno" onclick="" checked="checked">
                        <input type="hidden"  id="dp_father_type" value="">
                    </div>


                    <div id="body_assined_2">
                        @foreach($team as $t) 
                        <div class="t-0019"  id="user_assigned_father_{{$t -> idt_usuarios}}">
                        <div class="checkbox t-0020" >
                                <label>
                                <input type="checkbox" name="user_{{$t -> idt_usuarios}}" id="user_taskFather_{{$t -> idt_usuarios}}"  onclick="checkDefaultRadioFather('{{$t -> idt_usuarios}}',this)">
                                    {{$t -> t_usuariosNombre}} {{$t -> t_usuariosApellido}}
                                </label>
                            </div>
                            
                            <input type="hidden" name="user_type_{{$t -> idt_usuarios}}" id="user_taskFather_type_{{$t -> idt_usuarios}}" value="">
                            <input type="hidden" class="team_all_radios_father dp_father_{{$t->department['id_dp']}}" value="{{$t -> idt_usuarios}}">
    
                            <div class="radio team_radio only_in_task"  style="    margin-top: 10px;"  title="Valida">
                                <label>
                                    <input disabled type="radio" class="team_all_radios only_in_task"  name="team_radio_father_{{$t -> idt_usuarios}}"   value="Valida" onclick="$('#user_taskFather_type_{{$t -> idt_usuarios}}').val(this.value);">V</label>
                            </div>
                            <div class="radio team_radio only_in_task" style="    margin-top: 10px;"  title="Copia">
                                <label>
                                    <input disabled type="radio" class="team_all_radios " name="team_radio_father_{{$t -> idt_usuarios}}" value="CC" onclick="$('#user_taskFather_type_{{$t -> idt_usuarios}}').val(this.value);">C</label>
                            </div>
                            
                            <div class="radio team_radio only_in_task" style="    margin-top: 10px;" title="Responsable">
                                <label>
                                    <input disabled type="radio" class="team_all_radios"  name="team_radio_father_{{$t -> idt_usuarios}}"    value="Realiza" onclick="$('#user_taskFather_type_{{$t -> idt_usuarios}}').val(this.value);">R</label>
                            </div>
                            <input disabled type="radio" class="team_all_radios"  name="team_radio_father_{{$t -> idt_usuarios}}"  style="display:none;"  value="ninguno" onclick="">
                            
                        </div>
                        @endforeach
                    </div>
                    <div style="border-top: 1px solid #d2d2d2;" class="only_in_meeting" style="display:none">
                        <div style="    background: aliceblue;padding: 5px;"> 
                            <h4>Asistente por la vía del Cliente</h4>
                            <div><input type="text" placeholder="Nombre" id="name_asistente_cliente"> <input type="text" placeholder="Telefono" id="phone_asistente_cliente"></div>
                            <div style="    float: left;"><input type="text" placeholder="email" id="email_asistente_cliente"> </div>
                            <div class="t-0041 " id="btn_add_asistente_cliente">Agregar</div>
                        </div>
                        <div id="asistente_cliente_list"> </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- {{Form::submit('Comunicar', ['class'=>'btn btn-info','style'=> 'margin-bottom: 0px;'])}} --}}
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_assignar_father">Cerrar</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{-- customer  --}}
<div class="modal fade" id="myModalSubTaskCustomer" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Cliente:</h4>
                </div>
                <div class="modal-body" style="padding:0;">
                    <div id="SubTaskCustomer" style="    padding: 15px;">
                        {!! Form::open(['action' => 'TaskController@editTaskSon', 'id'=> 'formSubTaskCustomer','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <input type="hidden" name="SubTaskCustomerControl" id="SubTaskCustomerControl" value="form">
                            <input type="hidden" name="id" id="id_SubTaskCustomerControl" value="" >
                            <div class="input-group" style="    padding-top: 10px;">
                                <div class="form-group label-floating">
                                    <label class="control-label">NIF</label>
                                    <input name=""   id="SubTaskCustomer_1" readOnly maxlength="9"  type="text" value="" class="form-control" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre Cliente</label>
                                    <input name=""  id="SubTaskCustomer_2" readOnly type="text" value="" class="form-control" />
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="form-group label-floating">
                                    <label class="control-label">Apellidos Cliente</label>
                                    <input name=""  id="SubTaskCustomer_3" readOnly type="text" value="" class="form-control" />
                                </div>
                            </div>
                            <div style=" background-color: #f7f7f7;padding-top: 25px;">
                                <div style="">
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Persona Contacto</label>
                                            <input name="t_taskCPContact"  id="SubTaskCustomer_4"  type="text" value="" class="form-control" onkeyup="formSubTaskCustomer();"/>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Telefono</label>
                                            <input name="t_taskCTelefono"  id="SubTaskCustomer_5"  type="text" value="" class="form-control" onkeyup="formSubTaskCustomer();"/>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="input-group">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input name="t_taskCEmail"  id="SubTaskCustomer_6" type="text" value="" class="form-control"   onkeyup="formSubTaskCustomer();"/>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default" id="formSubTaskCustomer_cerrar" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




 <div class="bottonAlert" id="bottonAlert" style="display:none;">
     <div class="bottonAlert-001"></div>
     <div class="bottonAlert-002" id="bottonAlert-002">notification</div>
     
 </div>
    
@endsection
@section('js')
    <script>
   
    <?php
    $team_mention = '';
    foreach($team as $t) {
        $team_mention .='{\'ref\':\''.$t -> t_usuariosReferencia.'\',\'name\':\''.$t -> t_usuariosNombre.' '.$t -> t_usuariosApellido.'\'},';
    }
    $team_mention = substr($team_mention, 0, -1);
    //[{'ref':'jayden','name':'n1'}, {'ref':'sam','name':'n2'}, {'ref':'alvin','name':'n3'}, {'ref':'david','name':'n4'}]    
    ?>
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    
    var team_mention = [<?php echo $team_mention;?>];
    var default_mode = "{{$mode}}";
    var root = "{{$_SERVER['HTTP_HOST']}}";
    var calendar_2_father;
    var calendar_1_son;
    var last_calendar_2 = '';
    var last_calendar_1 = '';
    const SYSTEM_GUEST = '{{$SYSTEM_GUEST}}';
    const SYSTEM_LINK = '{{$SYSTEM_LINK}}';
    var interval_task = {
        active_task: '',
        type_task: '',
        interval_elem: false,
        runIntervalTask: function() {
            this.interval_elem = setInterval(this.doIt, 5000);
        },
        stopIntervalTask: function(){
            clearInterval(this.interval_elem);
            this.init();
        },
        init: function() {
            this.active_task = '';
            this.type_task = '';
        },
        addTask: function (a,b) {
            this.active_task = a;
            this.type_task = b;
        },
        doIt: function() {
            if (interval_task.active_task != '') {
                
                if (interval_task.type_task == 'father') {
                    getNotesFather(interval_task.active_task);
                    getDocuments();
                    getTask();
                }

                if (interval_task.type_task == 'son') {
                    getNotes(interval_task.active_task);
                    getDocuments();
                    getTask();
                }
            } 
        },
        initDefault : function(){
              
            if (whereIAm.task.type == 'father') {
                this.addTask(whereIAm.task.taskFather,'father');
            }

            if (whereIAm.task.type == 'son') {
                this.addTask(whereIAm.task.taskSon,'son');
            }

            this.runIntervalTask();
        }
    }
    var whereIAm = {
        screen:"main",
        taskFather:0,
        taskSon:0,
        listToRefresh:"task",
        task:"",
        taskFatherName:"",
        ordenSigno:">",
        activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
        mode:"{{$mode}}",
        isMobile:isMobile.any()
    };
     

    function intervalTask(){
        console.info('hello');
    }
    function runIntervalTask(){
       
    }
    function stopIntervalTask(){

    }

   

    function checkDefaultRadio(id,e) {
        
        if (e.checked  == true) {

            $("input[name='team_radio_"+id+"']").attr('disabled', false);
            $("input[name=team_radio_" +id+"][value=ninguno]").click();
            $("input[name=team_radio_" +id+"][value=Realiza]").click();
           
            
        } else {
            $("#user_subTask_type_" + id).val('');
            $("input[name=team_radio_" +id+"][value=ninguno]").click();
            $("input[name='team_radio_"+id+"']").attr('disabled', true);
            formAssignedTeam();
        }
        //formAssignedTeam();
                
    }

    function checkDefaultRadioFather(id,e) {
       
        if (e.checked  == true) {
            $("input[name='team_radio_father_"+id+"']").attr('disabled', false);
            $("input[name=team_radio_father_" +id+"][value=ninguno]").click();
            $("input[name=team_radio_father_" +id+"][value=Realiza]").click();
            
           
        } else {
            $("#user_taskFather_type_" + id).val('');
            $("input[name=team_radio_father_" +id+"][value=ninguno]").click();
            $("input[name='team_radio_father_"+id+"']").attr('disabled', true);
            formAssignedTeamFather();
        }
        //formAssignedTeamFather();
              
    }
    function changeLocation(value){
       
        if (value == 'otra') {
            $('#other_location').show();
        } else {
            if (value != '' && value != 'Seleccione Ubicación') {
                var url = '/task/editTaskA';
                $.post(url,{'whereIAm':whereIAm,'t_generalTaskLocation':value,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
                    showLocationFather(result.task[0].t_generalTaskLocation);
                });
            }
        }
       
    }

    function criticalDateSon(){
        var critical_date = $('#critical_date_son').val();
        var confirmation = true;
       
        if (critical_date == '0') {
            if (confirm('¿Está seguro que es una Tarea Crítica?, debéis tener en cuenta que los recordatorios de estas tareas incluyen SMS y generan gastos adicionales.')) {
                critical_date = '1';
                showCriticalDateSon(critical_date);
                
            } else {
                confirmation = false;
            }
        } else {
            critical_date = '0';
            
            showCriticalDateSon(critical_date)
        }
        if (confirmation) {
           
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'t_taskCriticalDay':critical_date,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
               
            });
        }
    }

    function showCriticalDateSon(value){
        $('#critical_date_son').val(value);
        
        if (value == '1') {
            $('#critical_date_son_div').html('Activada');
            $('#critical_date_son_div').addClass('t-0049');
        } else {
            $('#critical_date_son_div').html('Desactivada');
            $('#critical_date_son_div').removeClass('t-0049');
        }
    }

    function criticalDateFather(){
        var critical_date = $('#critical_date_father').val();
        var confirmation = true;
       
        if (critical_date == '0') {
            if (confirm('¿Está seguro que es una Tarea Crítica?, debéis tener en cuenta que los recordatorios de estas tareas incluyen SMS y generan gastos adicionales.')) {
                critical_date = '1';
                showCriticalDateFather(critical_date);
                
            } else {
                confirmation = false;
            }
        } else {
            critical_date = '0';
            
            showCriticalDateFather(critical_date)
        }
        if (confirmation) {
           
            var url = '/task/editTaskA';
            $.post(url,{'whereIAm':whereIAm,'t_generalTaskCriticalDate':critical_date,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
               
            });
        }
    }

    function showCriticalDateFather(value){
        $('#critical_date_father').val(value);
        
        if (value == '1') {
            $('#critical_date_father_div').html('Activada');
            $('#critical_date_father_div').addClass('t-0049');
        } else {
            $('#critical_date_father_div').html('Desactivada');
            $('#critical_date_father_div').removeClass('t-0049');
        }
    }


    function deleteTask(){
        if (confirm('¿ Está seguro que desea Eliminar ?')) {
            if (whereIAm.taskSon != '') {
                var url = '/task/editTaskSon';
                $.post(url,{'whereIAm':whereIAm,'deleteTask':true,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
                   // $('#closeEditSubTask').click();
                   $('#editSubTask').hide('slow');
                
                    if (whereIAm.screen == 'main') {
                        $('#t-0001').show('slow');
                        $('#t-0000').show('slow');

                    } else {
                        $('#editTask').show('slow');
                        whereIAm.screen = "addTask";
                        whereIAm.taskSon = 0;
                        whereIAm.listToRefresh = "subTaskList";
                    }
                    clearEditSubTask();
                    getTask();
                });
            } else {
                var url = '/task/editTaskA';
                $.post(url,{'whereIAm':whereIAm,'deleteTask':true,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
                    //$('#closeEditTask').click();
                    whereIAm = {
                    screen:"main",
                    taskFather:0,
                    taskSon:0,
                    listToRefresh:"task",
                    task:"",
                    taskFatherName:"",
                    activeUser: whereIAm.activeUser,
                    ordenSigno: whereIAm.ordenSigno,
                    mode: whereIAm.mode,
                    activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
                    isMobile:isMobile.any()
                    };
                    $('#editTask').hide('slow');
                    $('#t-0001').show('slow');
                    $('#t-0000').show('slow');
                    clearEditTask();
                    getTask();
                    $('#t-0002').css("opacity", "1");
                });
            }
        }
    }

    function deleteFileTask(id){
        if (confirm('¿ Está seguro que desea de eliminar documento ?')) {
            var url = '/task/deleteFileTask';
            var html = '';
            //$url = str_replace("\\","/", $f -> t_fileUrl );
            $.post(url,{'whereIAm':whereIAm,'id':id,'_token':'{{ csrf_token()}}'},function(result){
                getDocuments();
            });
            
        }
    }

    function renameFileTaskA(id,event){
        interval_task.stopIntervalTask();
        document.getElementById("doc_"+ id).onclick = '';
        document.getElementById("input_"+ id).readOnly = false;
        $('#input_'+id).removeClass('t-0051');
        $('#input_'+id).addClass('t-0050');
        $('#btn_remove_file_'+id).hide();
        $('#btn_rename_file_'+id).show();
        document.getElementById("input_"+ id).focus();
         

    }

    function renameFileTaskB(id){
        var name = $('#input_'+id).val();
        var url = '/task/editDocumentsName';
        var html = '';
        //$url = str_replace("\\","/", $f -> t_fileUrl );
        $.post(url,{id:id,name:name, '_token':'{{ csrf_token()}}'},function(result){
            interval_task.initDefault();
           getDocuments();
          
        });
    }

    

    function cancelRenameFileTask(id,event){
        document.getElementById("doc_"+ id).onclick = 'window.open(\''+ event +'\', \'_blank\')';
        $('#btn_rename_file_'+id).hide();
        $('#btn_remove_file_'+id).show();
        document.getElementById("input_"+ id).readOnly = true;
        $('#input_'+id).removeClass('t-0050');
        $('#input_'+id).addClass('t-0051');
        interval_task.initDefault();
        
    }
    function getDocuments(){
        var url = '/task/getDocuments';
        var html = '';
        //$url = str_replace("\\","/", $f -> t_fileUrl );
        $.post(url,{'whereIAm':whereIAm,'_token':'{{ csrf_token()}}'},function(result){
            if (result.documents) {
                if (result.documents.length > 0) {
                    var d = result.documents;
                    html += '<table style=" width: 100%;">';
                        html += '<th class="pre_t_th" style="width: 50px;text-align: center;" ></th>';
                        html += '<th class="pre_t_th" style=" width: 150px; cursor: pointer;" >Nombre</th>';
                        html += '<th class="pre_t_th" style=" cursor: pointer;" ></th>';
                        for (var i = 0; i < result.documents.length; i++ ) {
                            html += '<tr class="pre_t_tr">';
                                html += '<td class="pre_t_td" style="width: 50px;text-align: center;" onclick="window.open(\'http://'+root +'/'+ d[i].t_fileUrl +'\', \'_blank\');" ><div class="'+ d[i].t_fileFormat +'_icon" ></div></td>';
                                html += '<td class="pre_t_td" style="width: 70%;" id="doc_'+ d[i].id +'" onclick="window.open(\'http://'+root +'/'+ d[i].t_fileUrl +'\', \'_blank\');"><input readOnly id="input_'+ d[i].id +'" style="width: 80%; border: none;" class="t-0051" value="'+ d[i].file_name +'"></td>';
                                html += '<td class="pre_t_td" style="text-align: right;">';
                                if(d[i].t_file_has_t_taskPointer == 0){
                                    html += '<div id="btn_remove_file_'+ d[i].id +'">';
                                        html += '<button class="btn btn-info btn-sm removeForMobile"  onclick="renameFileTaskA(\''+ d[i].id +'\',\'http://'+root +'/'+ d[i].t_fileUrl +'\')">Renombrar</button>';
                                        html += '<button class="btn btn-danger btn-sm"  onclick="deleteFileTask(\''+ d[i].id +'\')">Eliminar</button>';
                                    html += '</div>';
                                    html += '<div id="btn_rename_file_'+ d[i].id +'" style="display:none;">';
                                        html += '<button class="btn btn-info btn-sm removeForMobile"  onclick="renameFileTaskB(\''+ d[i].id +'\');">Guardar</button>';
                                        html += '<button class="btn btn-secondary btn-sm removeForMobile"  onclick="cancelRenameFileTask(\''+ d[i].id +'\',\'http://'+root +'/'+ d[i].t_fileUrl +'\')">Cancelar</button>';
                                        
                                    html += '</div>';
                                }
                                html += '</td>';
                            html += '</tr>';
                        }
                    html += '</table>';
                    if (result.mode == 'son') {
                        $('#documentsSubTaskList').html(html);
                    } else {
                        $('#documentsFatherTaskList').html(html);
                    }
                    
                } else {
                    if (result.mode == 'son') {
                        $("#documentsSubTaskList").html('<div id="documentsTaskListText" style=""></div>');
                    } else {
                        $("#documentsFatherTaskList").html('<div id="documentsFatherTaskListText" style=""></div>');
                    }
                    
                }
            }
        });
    }

    function uploadFileSuccess(value){
        if (value == 'son') {
            document.getElementById("id_subTask_son_upload").value = "";
            document.getElementById("form_documentsSubTaskList").reset();
            $('html,body').animate({scrollTop: $("#form_documentsSubTaskList").offset().top});
            getDocuments();
        }
       
        if (value == 'father') {
            document.getElementById("id_subTask_father_upload").value = "";
            document.getElementById("form_documentsFatherTaskList").reset();
            $('html,body').animate({scrollTop: $("#form_documentsFatherTaskList").offset().top});
            getDocuments();

        }
       
    }    

    function uploadFile(mode){
        if (mode == 'son') {
            $('#id_subTask_son_upload').val(whereIAm.taskSon);
            var form = $('#id_subTask_son_upload').parents('form');
            $(form).submit();
        } else {
            
            $('#id_subTask_father_upload').val(whereIAm.taskFather);
            var form = $('#id_subTask_father_upload').parents('form');
            $(form).submit();
        }
        
    }
    function formAssignedTeamDeparmentFather(){
        var dp = $('#dp_father').val();
        var users_input = 'dp_father_' + dp;
        var users = document.getElementsByClassName(users_input);
        var type = $('#dp_father_type').val();
        var i;
        for (i = 0; i < users.length; i++) {
            var u_id = users[i].value;
            var e_checkbox = document.getElementById('user_taskFather_'+u_id);
            if (type != 'remover') {
                
                e_checkbox.checked = true;
                $("input[name='team_radio_father_"+u_id+"']").attr('disabled', false);
                $("input[name=team_radio_father_" +u_id+"][value=ninguno]").click();
                $("input[name=team_radio_father_" +u_id+"][value="+type+"]").click();
                
            } else {
                e_checkbox.checked = false;
                $("#user_taskFather_type_" + u_id).val('');
                $("input[name=team_radio_father_" +u_id+"][value=ninguno]").click();
                $("input[name='team_radio_father_"+u_id+"']").attr('disabled', true);
            }
        }
        
        formAssignedTeamFather();
    }
    
    function formAssignedTeamDeparment(){
        var dp = $('#dp_subTask').val();
        var users_input = 'dp_subTask_' + dp;
        var users = document.getElementsByClassName(users_input);
        var type = $('#dp_subTask_type').val();
        var i;
        for (i = 0; i < users.length; i++) {
            var u_id = users[i].value;
            var e_checkbox = document.getElementById('user_subTask_'+u_id);
            if (type != 'remover') {
                
                e_checkbox.checked = true;
                $("input[name='team_radio_"+u_id+"']").attr('disabled', false);
                $("input[name=team_radio_" +u_id+"][value=ninguno]").click();
                $("input[name=team_radio_" +u_id+"][value="+type+"]").click();
                
            } else {
                e_checkbox.checked = false;
                $("#user_subTask_type_" + u_id).val('');
                $("input[name=team_radio_" +u_id+"][value=ninguno]").click();
                $("input[name='team_radio_"+u_id+"']").attr('disabled', true);
            }
        }
        
        formAssignedTeam();
    }

    function searchTeamSub(value){
        console.info(value);
    }

    function formAssignedTeam(){
        $('#id_subTask_son').val(whereIAm.taskSon);
        var url = '/task/editTaskSon';
        var form = $('#id_subTask_son').parents('form');
        $.post(url,form.serialize(),function(result){
            var show_take_control = false;
            for (i = 0; i < result.taskAssigned.length; i++ ) {
               
                if (result.taskAssigned[i].t_usuarios_idt_usuarios == result.taskAssignedDefault ) {
                    if (result.taskAssigned[i].t_taskAssignedType == 'Realiza') {
                        show_take_control = true;
                    }
                }
            }
            if (show_take_control) {
                $('#team_take_control').show();
            } else {
                $('#team_take_control').hide();
            }
          //$('#cerrar_assignar').click();
          //document.getElementById("formAssignedTeam").reset();
          //showAssigned(result.taskAssigned, result.taskAssignedDefault);
          whereIAm.task.taskAssigned = result.taskAssigned;
          whereIAm.task.taskAssignedDefault = result.taskAssignedDefault;

           url = '/task/getOneTask';
            $.post(url,{'type':'son', 'id':whereIAm.taskSon, '_token':'{{ csrf_token()}}'},function(result){
                showAssigned(result.task.taskAssigned, result.task.taskAssignedDefault);
            });
        });
    }

    function takeControl(mode) {
        if (mode == 'son') {
            // user_type_   team_radio_  team_all_radios_son
            //team_all_radios_son
            var x = document.getElementsByClassName("team_all_radios_son");
            var i;
            var id_radio;
            for (i = 0; i < x.length; i++) {
                id_radio = x[i].value;
                if ($('#user_subTask_type_'+id_radio).val() == 'Realiza') {
                    if (whereIAm.task.taskAssignedDefault != id_radio) {
                        $("input[name=team_radio_" +id_radio+"][value=CC]").click();
                    }
                }
            }
        }
        if (mode == 'father') {
            //    
            var x = document.getElementsByClassName("team_all_radios_father");
            var i;
            var id_radio;
            for (i = 0; i < x.length; i++) {
                id_radio = x[i].value;
                if ($('#user_taskFather_type_'+id_radio).val() == 'Realiza') {
                    if (whereIAm.task.taskAssignedDefault != id_radio) {
                        $("input[name=team_radio_father_" +id_radio+"][value=CC]").click();
                    }
                }
            }
        }
    }


    function formAssignedTeamFather(){
        $('#idt_generalTask_team').val(whereIAm.taskFather);
        var url = '/task/editTaskA';
        var form = $('#idt_generalTask_team').parents('form');
        $.post(url,form.serialize(),function(result){
            var show_take_control = false;
            for (i = 0; i < result.taskAssigned.length; i++ ) {
               
                if (result.taskAssigned[i].t_usuarios_idt_usuarios == result.taskAssignedDefault ) {
                    if (result.taskAssigned[i].t_taskAssignedType == 'Realiza') {
                        show_take_control = true;
                    }
                }
            }
            if (show_take_control) {
                $('#team_take_control_father').hide();
                if (whereIAm.taskType != 'Meeting' && whereIAm.taskType != 'Project') {
                    $('#team_take_control_father').show();
                }
            } else {
                $('#team_take_control_father').hide();
            }
            //$('#cerrar_assignar_father').click();
            //document.getElementById("formAssignedTeamFather").reset();
            //showAssignedFather(result.taskAssigned, result.taskAssignedDefault);
            whereIAm.task.taskAssigned = result.taskAssigned;
            whereIAm.task.taskAssignedDefault = result.taskAssignedDefault;


            var url = '/task/getOneTask';
            $.post(url,{'type':'father', 'id':whereIAm.taskFather, '_token':'{{ csrf_token()}}'},function(result){
                showAssignedFather(result.task.taskAssigned, result.task.taskAssignedDefault);
            });
        });
    }

    function formSubTaskCustomer(){
        $('#id_SubTaskCustomerControl').val(whereIAm.taskSon);
        var url = '/task/editTaskSon';
        var form = $('#id_SubTaskCustomerControl').parents('form');
        $.post(url,form.serialize(),function(result){
           
            // $('#formSubTaskCustomer_cerrar').click();
        });
    }

    function addNoteSon(){
        if ($("#control_notes_son").val()) {

        } else {
            var url = '/task/addNote';
            $.post(url,{'id':whereIAm.taskSon,'type':'son','_token':'{{ csrf_token()}}'},function(result){
                $("#notesSubTaskListNew").prepend('<div id="div_note_'+result.id_note+'"><input type="hidden"  id="control_notes_son" value="true"><input type="hidden"  id="id_note" value="'+result.id_note+'"><div id="note_'+result.id_note+'"></div><button class="btn btn-danger btn-sm" onclick="deleteNote(\''+result.id_note+'\')">Eliminar</button><div>');
                $('#note_'+result.id_note).summernote({
                    lang: 'es-ES',
                    placeholder: 'Anotación',
                    toolbar: [
                        ['style', ['bold',]],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul']]
                    ],
                    callbacks: {
                        onBlur: function() {
                          
                            updateNote(result.id_note);
                            //updateDescriptionSon($('#descriptionSon').summernote('code'));
                        },
                        onChange: function(){
                            updateNote(result.id_note);
                        }
                    },
                    hint: {
                        mentions: team_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                        callback($.grep(this.mentions, function (item) {
                            var i_name = item.name.toUpperCase();
                            return i_name.indexOf(keyword.toUpperCase()) == 0;
                        }));
                        },
                        content: function (item) {
                        return '@' + item.ref;
                        }    
                    }
                });
               
                // $("#notesSubTaskList").prepend("<div style=\" margin-bottom: 10px;\" id=\"div_note_"+result.id_note+"\"><input type=\"hidden\"  id=\"control_notes_son\" value=\"true\"><input type=\"hidden\"  id=\"id_note\" value=\""+result.id_note+"\"><textarea class=\"anatacionInternaBody\" id=\"note_"+result.id_note+"\" onkeyup=\"updateNote('"+result.id_note+"');\"></textarea><button class=\"btn btn-danger btn-sm\" onclick=\"deleteNote('"+result.id_note+"')\">Eliminar</button></div>");
                 $("#notesTaskListText").hide();
                 $('#note_'+result.id_note).focus();
                // $('html,body').animate({scrollTop: ($('#note_'+result.id_note).offset().top - 40)});

            });
            
        }
    } 

       
    function addNoteFather(){
        if ($("#control_notes_father").val()) {

        } else {
            var url = '/task/addNote';
            $.post(url,{'id':whereIAm.taskFather,'type':'father','_token':'{{ csrf_token()}}'},function(result){
               
                $("#notesFatherTaskListNew").prepend('<div id="div_note_'+result.id_note+'"><input type="hidden"  id="control_notes_father" value="true"><input type="hidden"  id="id_note" value="'+result.id_note+'"><div id="note_'+result.id_note+'"></div><button class="btn btn-danger btn-sm" onclick="deleteNote(\''+result.id_note+'\')">Eliminar</button><div>');
                $('#note_'+result.id_note).summernote({
                    lang: 'es-ES',
                    placeholder: 'Anotación',
                    toolbar: [
                        ['style', ['bold',]],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul']]
                    ],
                    callbacks: {
                        onBlur: function() {
                           
                            updateNote(result.id_note);
                            //updateDescriptionSon($('#descriptionSon').summernote('code'));
                        },
                        onChange: function(){
                            updateNote(result.id_note);
                        }
                    },
                    hint: {
                        mentions: team_mention,
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                        callback($.grep(this.mentions, function (item) {
                            var i_name = item.name.toUpperCase();
                            return i_name.indexOf(keyword.toUpperCase()) == 0;
                        }));
                        },
                        content: function (item) {
                        return '@' + item.ref;
                        }    
                    }
                });
               


                // $("#notesFatherTaskList").prepend("<div style=\" margin-bottom: 10px;\" id=\"div_note_"+result.id_note+"\"><input type=\"hidden\"  id=\"control_notes_father\" value=\"true\"><input type=\"hidden\"  id=\"id_note\" value=\""+result.id_note+"\"><textarea class=\"anatacionInternaBody\" id=\"note_"+result.id_note+"\" onkeyup=\"updateNote('"+result.id_note+"');\"></textarea><button class=\"btn btn-danger btn-sm\" onclick=\"deleteNote('"+result.id_note+"')\">Eliminar</button></div>");
                $("#notesFatherTaskListText").hide();
                $('#note_'+result.id_note).focus();
                // $('html,body').animate({scrollTop: ($('#note_'+result.id_note).offset().top - 40)});
            });            
        }
    } 

    function updateNote(id){
        var url = '/task/updateNote';
        // var v = $('#note_'+id).val();    
        var v = $('#note_'+id).summernote('code')
        $.post(url,{'id':id,'note':v,'type':'son','_token':'{{ csrf_token()}}'},function(result){
            
        });
        
    }

    function deleteNote(id){
        if (confirm('¿ Está seguro que desea de eliminar anotacion ?')) {
            var url = '/task/deleteNote';
            $.post(url,{'id':id,'_token':'{{ csrf_token()}}'},function(result){
                    
            });
            $("#div_note_"+id).hide('slow');
            $("#div_note_"+id).html("");

            var parent = document.getElementById("notesSubTaskList");
            var child = document.getElementById("div_note_"+id);
            parent.removeChild(child);
            if ($("#notesSubTaskList").html().trim() == '<div id="notesTaskListText" style="display: none;"></div>') {
                $("#notesTaskListText").show('slow');
            }
        }
        
        
    }

    function getNotes(id){
        var url = '/task/getNotes';
        $.post(url,{'id':id,'type':'son','_token':'{{ csrf_token()}}'},function(result){
            var notes = result.notes;
            if (notes.length > 0){
                $("#notesTaskListText").hide();
            }
            for (var i = 0; i < notes.length; i++ ) {
                var id_n = notes[i].idt_taskComments;
                var v = notes[i].t_taskCommentsText;
                var user = notes[i].t_taskCommentsUserName;
                var html = '';
                var d = "";
                var date = "";
                if (notes[i].t_taskCommentsDate) {
                    d = changeDateES(notes[i].t_taskCommentsDate);
                    date = notes[i].t_taskCommentsDate.split(" ");
                    date = d +' '+ date[1];
                }
                if ($('#note_'+id_n).length) {
                    $('#note_'+id_n).html(v);
                } else {
                    if (v) {
                        var edit_button = '';
                        if (notes[i].can_edit) {
                            edit_button = '<div  style="float:right;" id="editNote_'+id_n+'" class="editNote" onclick="editNote(\''+id_n+'\');">Editar</div>';
                        }

                        html += '<div class="anatacionInternaTitle"><div style="float:left;">'+ user +'</div> '+ edit_button +'<div  style="float:right;">'+ date +'</div></div>';
                    // html += '<textarea class="anatacionInternaBody" readOnly style=" margin-bottom: 10px;" id="">'+ v +'</textarea>';
                    html += '<div class="anatacionInternaBody" id="note_'+id_n+'"></div>';
                        $("#notesSubTaskList").prepend(html);
                        $('#note_'+id_n).prepend(v);
                    }  
                } 
            }
        });
    }
    function editNote(id) {
        $('#editNote_'+id).hide();
        $('#note_'+id).summernote({
            lang: 'es-ES',
            placeholder: 'Anotación',
            toolbar: [
                ['style', ['bold',]],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul']]
            ],
            callbacks: {
                onBlur: function() {
                    updateNote(id);
                },
                onChange: function(){
                    updateNote(id);
                }
            },
            hint: {
                mentions: team_mention,
                match: /\B@(\w*)$/,
                search: function (keyword, callback) {
                callback($.grep(this.mentions, function (item) {
                    var i_name = item.name.toUpperCase();
                    return i_name.indexOf(keyword.toUpperCase()) == 0;
                }));
                },
                content: function (item) {
                return '@' + item.ref;
                }    
            }
        });
    }

    function getNotesFather(id){
        var url = '/task/getNotes';
        $.post(url,{'id':id,'type':'father','_token':'{{ csrf_token()}}'},function(result){
            var notes = result.notes;
            if (notes.length > 0){
                $("#notesFatherTaskListText").hide();
            }
            for (var i = 0; i < notes.length; i++ ) {
                var id_n = notes[i].idt_taskComments;
                var v = notes[i].t_taskCommentsText;
                var user = notes[i].t_taskCommentsUserName;
                var html = '';
                var d = "";
                var date = "";
                if (notes[i].t_taskCommentsDate) {
                    d = changeDateES(notes[i].t_taskCommentsDate);
                    date = notes[i].t_taskCommentsDate.split(" ");
                    date = d +' '+ date[1];
                }
                if ($('#note_'+id_n).length) {
                    $('#note_'+id_n).html(v);
                } else {
                    if (v) {
                        var edit_button = '';
                        if (notes[i].can_edit) {
                            edit_button = '<div  style="float:right;" id="editNote_'+id_n+'" class="editNote" onclick="editNote(\''+id_n+'\');">Editar</div>';
                        }
                        html += '<div class="anatacionInternaTitle"><div style="float:left;">'+ user +'</div> '+ edit_button +' <div  style="float:right;">'+ date +'</div></div>';
                        //html += '<textarea class="anatacionInternaBody" readOnly style=" margin-bottom: 10px;" id="">'+ v +'</textarea>';
                        html += '<div class="anatacionInternaBody" id="note_'+id_n+'"></div>';
                        $("#notesFatherTaskList").prepend(html);
                        $('#note_'+id_n).prepend(v);
                    }   
                }
            }
        });
    }

    function updateCustomer() {
        var url = '/task/editTaskA';
        var form = $('#idt_clientes').parents('form');
        $.post(url,form.serialize(),function(result){
          
            if (result.status) {
                whereIAm.task = result.task[0];
                $('#DivFormCustomer3').hide('slow');
                showCustomerFather(result.task[0]);
            } else {
                whereIAm.task = "";
            }
        });
    }
    

    function showCreatedByFather(p){
        var html = "";
        $('#createdByFather').html("");
        html += '<div class="t-0012" >';
            html += '<div class="t-0013">'+ getIconName(p) +'</div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Creada Por</div>';
                html += '<div class="t-0016">'+ p  +'</div>';
            html += '</div>';
        html += '</div>';
        $('#createdByFather').html(html);
     
    }

    function showCreatedBySon(p){
        var html = "";
        $('#createdBySon').html("");
        html += '<div class="t-0012" >';
            html += '<div class="t-0013">'+ getIconName(p) +'</div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Creada Por</div>';
                html += '<div class="t-0016">'+ p  +'</div>';
            html += '</div>';
        html += '</div>';
        $('#createdBySon').html(html);
     
    }



    function showCustomerFather(p){
       
        var html = "";
        var html_2 = "";
        var customer = "Sin Cliente";
        if (p.t_generalTaskCName) {
            customer = p.t_generalTaskCName;
        }
        
        $('#customerFather').html("");
        html += '<div class="t-0012" >';
            html += '<div class="t-0013">C</div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Cliente</div>';
                html += '<div class="t-0016">'+ customer  +'</div>';
            html += '</div>';
        html += '</div>';
        $('#customerFather').html(html);
     
    }



    function showCustomer(p){
        var html = "";
        var html_2 = "";
        var customer = "Sin Cliente";
        if (p.t_generalTaskCName) {
            customer = p.t_generalTaskCName;
        }
        
        $('#customer').html("");
        if (SYSTEM_GUEST) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalSubTaskCustomer">';
        }
        
            html += '<div class="t-0013">C</div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Cliente</div>';
                html += '<div class="t-0016">'+ customer  +'</div>';
            html += '</div>';
        html += '</div>';
        $('#customer').html(html);
      //
        document.getElementById("formSubTaskCustomer").reset();
        $('#SubTaskCustomer_1').val(p.t_generalTaskCNif);
        $("#SubTaskCustomer_1").parent('div').removeClass('is-empty');
        $('#SubTaskCustomer_2').val(p.t_generalTaskCFirstName);
        $("#SubTaskCustomer_2").parent('div').removeClass('is-empty');
        $('#SubTaskCustomer_3').val(p.t_generalTaskCLastName);
        $("#SubTaskCustomer_3").parent('div').removeClass('is-empty');
        
        if (p.t_taskCPContact) {
            $('#SubTaskCustomer_4').val(p.t_taskCPContact);
            $("#SubTaskCustomer_4").parent('div').removeClass('is-empty');
            $('#SubTaskCustomer_5').val(p.t_taskCTelefono);
            $("#SubTaskCustomer_5").parent('div').removeClass('is-empty');
            $('#SubTaskCustomer_6').val(p.t_taskCEmail);
            $("#SubTaskCustomer_6").parent('div').removeClass('is-empty');
        } else {
            $('#SubTaskCustomer_4').val(p.t_generalTaskCPContact);
            $("#SubTaskCustomer_4").parent('div').removeClass('is-empty');
            $('#SubTaskCustomer_5').val(p.t_generalTaskCTelefono);
            $("#SubTaskCustomer_5").parent('div').removeClass('is-empty');
            $('#SubTaskCustomer_6').val(p.t_generalTaskCEmail);
            $("#SubTaskCustomer_6").parent('div').removeClass('is-empty');
        }
    }

   
    function showWorkflow(obj) {
        var html = "";
        var workflow = "Normal";
        var p =  obj.t_taskDependence;
        var color = ''
       
        if (obj.t_taskDependence) {
            var a = 1; 
            workflow = "Con Dependencia";
            if (obj.t_taskDependenceDone == 1) {
                workflow = "Dependencia Completada";
                color = 'background-color: #00da09; border-color: #12d002;';
            }
        }
        
        $('#workflow').html("");
        if (SYSTEM_GUEST) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalWorkflow">';
        }
            html += '<div class="t-0013" style="'+ color +'"><img src="{{ URL::asset('workflow.png')}}" ></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Flujo de Trabajo</div>';
                html += '<div class="t-0016">'+ workflow  +'</div>';
            html += '</div>';
        html += '</div>';
        $('#workflow').html(html);
        
    }

    function fillWorkflow(search) {
        var url = '/task/getTask';
        var search = {
            active_orden : "title",
            active_status : "incompleted",
            active_show : "son",
            active_status_son : "incompleted",
            search : search,
            activeUser : whereIAm.activeUser,
            ordenSigno : ">",
            mode : "GeneralTask",
            listToRefresh : "subTaskList",
            taskFather:  whereIAm.taskFather

        }
        $.post(url,{'whereIAm':search,'_token':'{{ csrf_token()}}'},function(result){
            fillWorkflowList(result.task);
        });

        
    }
    function fillWorkflowList(p) {
        var html = "";
        var checked = '';
        //67a74306b06d0c01624fe0d0249a570f4d093747
        if (whereIAm.task.taskDependence == '67a74306b06d0c01624fe0d0249a570f4d093747') {
            checked = 'checked="true"';
        }
        html += '<div class="radio">';
                html += '<label>';
                    html += '<input type="radio" '+ checked +' onclick="updateWorkflow(this.value)" value="no_dependence" name="optionsRadiosWorkFlow" id="">';
                    html += "Normal";
                html += '</label>';
            html += '</div>';

       
        var default_checked = '';
        for (var i = 0; i < p.length; i++) {
            checked = '';
            
            if ( p[i].son == whereIAm.task.taskDependence) {
                checked = 'checked="true"';
                default_checked = 'radio_dependece_'+p[i].son;
            }

            html += '<div class="radio" id="radio_dependece_'+ p[i].son +'">';
                html += '<label>';
                    html += '<input type="radio" onclick="updateWorkflow(this.value)" '+ checked +'  value="'+ p[i].son +'" name="optionsRadiosWorkFlow" >';
                    html += p[i].title;
                html += '</label>';
            html += '</div>';

        }
        $('#body_workflow_2').html(html);
        if (default_checked != '') {
            $("#"+default_checked).prependTo("#body_workflow_2");
        }
       
        $.material.init();
    }

    function showDocumentaryReminder(p){
        //documentaryReminder 
        var html = "";
        html += '<div class="t-0012">';
            html += '<div class="t-0013" style=""><span class="glyphicon glyphicon-bell" style="font-size: 16px;padding: 1px; "></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Caducidad Modo</div>';
                html += '<div class="t-0016">'+ p  +'</div>';
            html += '</div>';
        html += '</div>';
        html += '<input type="hidden" id="documentary_reminder" value="'+ p +'">';
        $('#documentaryReminder').html(html); 
        //only_in_project_recordatorio
        if (p == 'Recordatorio') {
            $('.only_in_project_recordatorio').show();
        }  else {
            $('.only_in_project_recordatorio').hide();
            changeRepeat($('#no_repeart_father'),'no_repeart')
        }
                       
    }
    

    function updateDocumentaryReminder() {
        var url = '/task/editTaskA';
        $.post(url,{'whereIAm':whereIAm,'t_generalTaskDocRec':$('#documentary_reminder').val(),'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
            showDocumentaryReminder(result.task[0].t_generalTaskDocRec);
        });
    }


    function showBookNoteBook(p) {
        //bookNoteBook
        var html = "";
        html += '<div class="t-0012">';
            html += '<div class="t-0013" style=""><span class="glyphicon glyphicon-book" style="font-size: 16px;padding: 1px; "></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Editable Modo</div>';
                html += '<div class="t-0016">'+ p +'</div>';
            html += '</div>';
        html += '</div>';
        html += '<input type="hidden" id="book_notebook" value="'+ p +'">';
        $('#bookNoteBook').html(html);

    }

    function updateBookNoteBook() {
        var url = '/task/editTaskA';
        $.post(url,{'whereIAm':whereIAm,'t_generalTaskLibroCuaderno':$('#book_notebook').val(),'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
            showBookNoteBook(result.task[0].t_generalTaskLibroCuaderno);
        });
    }
   
    function showPriority(p){
        //repeatFather
        //priorityFather
        var html = "";
        var priority = "Normal";
        var color = '';
        if (p == 1) {
            priority = "Alta";
            var color = 'background-color: #ff5252; border-color: #ff5252;';
        }
       
       
        html += '<div class="t-0012">';
            html += '<div class="t-0013" style="'+color+'"><span class="glyphicon glyphicon-flag" style="font-size: 16px;padding: 1px; "></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Prioridad</div>';
                html += '<div class="t-0016">'+ priority  +'</div>';
            html += '</div>';
        html += '</div>';
       
        if (whereIAm.taskSon != 0) {
            html += '<input type="hidden" id="priority_value" value="'+ p +'">';
            $('#priority').html(html);
        } else {
            html += '<input type="hidden" id="priority_father_value" value="'+ p +'">';
            $('#priorityFather').html(html);
        }
        
    }

    

    function updatePriority() {
        if (whereIAm.taskSon != 0) {
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'t_taskPriorityNumber':$('#priority_value').val(),'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
                showPriority(result.obj.t_taskPriorityNumber);
            });
        } else {
            var url = '/task/editTaskA';
            $.post(url,{'whereIAm':whereIAm,'t_generalTaskPriorityNumber':$('#priority_father_value').val(),'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
                showPriority(result.task[0].t_generalTaskPriorityNumber);
            });
        }
    }

    function updateWorkflow(value){
        var url = '/task/editTaskSon';
        $.post(url,{'whereIAm':whereIAm,'t_taskDependence':value,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
                showWorkflow(result.obj);
        });
    }

    function showAssigned(assigned,default_v){
        var html = "";
        var lettle = "SA";
        var name = "Sin Asignar";
        var type = " ";
        var lettle_b = "SA";
        var name_b  = "Sin Asignar";
        var type_b  = " ";
        var search_default = true;
        var show_take_control = false;
        document.getElementById('formAssignedTeam').reset()
        $('#team_take_control').hide();
        if (assigned.length > 0) {
            for (i = 0; i < assigned.length; i++ ) {
                if (search_default) {
                    lettle = getIconName(assigned[i].t_taskAssignedUserName);
                    name = assigned[i].t_taskAssignedUserName;
                    type = assigned[i].t_taskAssignedType.substring(0, 1);
                    if (assigned[i].t_usuarios_idt_usuarios == default_v ) {
                        search_default = false;
                        if (type == 'R') {
                            $('#team_take_control').show();
                        }
                    }
                }
                if (type == 'R') {
                    lettle_b = lettle;
                    name_b = name;
                    type_b = type;
                }
                
               
                $("input[name='team_radio_"+assigned[i].t_usuarios_idt_usuarios+"']").attr('disabled', false);
                $("#user_subTask_type_" + assigned[i].t_usuarios_idt_usuarios).val(assigned[i].t_taskAssignedType);
                $("input[name=team_radio_" + assigned[i].t_usuarios_idt_usuarios+"][value="+assigned[i].t_taskAssignedType+"]").prop( "checked", true );

               
               $('#user_subTask_' + assigned[i].t_usuarios_idt_usuarios).prop( "checked", true );
                $("#user_assigned_" + assigned[i].t_usuarios_idt_usuarios).prependTo("#body_assined");
            }
            if (search_default) {
                if (type_b == 'R') {
                   
                    lettle = lettle_b;
                    name = name_b;
                    type = type_b;
                }
            }
        } 
       
           

        $('#assigned').html("");
        if (SYSTEM_GUEST) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalTeam">';
        }
            html += '<div class="t-0013">'+  lettle +'</div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Asignada a</div>';
                html += '<div class="t-0016">' + name + '</div>';
            html += '</div>';
            html += '<div class="t-0022">'+ type +'</div>';
        html += '</div>';
        $('#assigned').html(html);
    }

    function showAssignedFather(assigned,default_v){
        var html = "";
        var lettle = "SA";
        var name = "Sin Asignar";
        var type = " ";
        var lettle_b = "SA";
        var name_b  = "Sin Asignar";
        var type_b  = " ";
        var search_default = true;
        document.getElementById('formAssignedTeamFather').reset()
        $('#team_take_control_father').hide();
        if (whereIAm.taskType == 'Meeting') {
            $('.only_in_task').hide();        
        } else if(whereIAm.taskType == 'Project') {
            $('.only_in_task').hide(); 
            $('.only_in_meeting').hide();
        } else {
            $('.only_in_task').show();   
        }

        if (assigned.length > 0) {
            
            for (var i = 0; i < assigned.length; i++ ) {
               
                if (search_default) {
                    lettle = getIconName(assigned[i].t_taskAssignedUserName);
                    name = assigned[i].t_taskAssignedUserName;
                    type = assigned[i].t_taskAssignedType.substring(0, 1);
                    if (assigned[i].t_usuarios_idt_usuarios == default_v ) {
                        search_default = false;
                        if (type == 'R') {
                            if (whereIAm.taskType != 'Meeting' && whereIAm.taskType != 'Project') {
                                $('#team_take_control_father').show();
                            }
                        }
                    } 

                    if (type == 'R') {
                       
                        lettle_b = lettle;
                        name_b = name;
                        type_b = type;
                    }
                }
                $("input[name='team_radio_father_"+assigned[i].t_usuarios_idt_usuarios+"']").attr('disabled', false);
                $("#user_taskFather_type_" + assigned[i].t_usuarios_idt_usuarios).val(assigned[i].t_taskAssignedType);
                $("input[name=team_radio_father_" + assigned[i].t_usuarios_idt_usuarios+"][value="+assigned[i].t_taskAssignedType+"]").prop( "checked", true );
               
                $('#user_taskFather_' + assigned[i].t_usuarios_idt_usuarios).prop( "checked", true );
                $("#user_assigned_father_" + assigned[i].t_usuarios_idt_usuarios).prependTo("#body_assined_2");
            }
            if (search_default) {
                if (type_b == 'R') {
                   
                    lettle = lettle_b;
                    name = name_b;
                    type = type_b;
                }
            }
        } 
        $('#assignedFather').html("");
        var other_user_can_edit_project = false;
        if (whereIAm.task.obj) {
            if ( whereIAm.task.obj.t_generalTaskType == 'Project') {
                if (!whereIAm.task.can_edit) {
                    other_user_can_edit_project = true;
                }
            }
        } else {
            if ( whereIAm.task.t_generalTaskType == 'Project') {
                if (!whereIAm.task.can_edit) {
                    other_user_can_edit_project = true;
                }
            }
        }

        if (SYSTEM_GUEST || whereIAm.task.lock || other_user_can_edit_project) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalTeamFather">';
        }
            html += '<div class="t-0013">'+  lettle +'</div>';
            html += '<div class="t-0014">';
                if (whereIAm.taskType == 'Meeting') {
                    html += '<div class="t-0015"><span class="modalTeamFatherTitle">Asistente</span> </div>';
                }  else if (whereIAm.taskType == 'Project') {
                    html += '<div class="t-0015"><span class="modalTeamFatherTitle">Mostrar</span> </div>';
                } else {
                    html += '<div class="t-0015"><span class="modalTeamFatherTitle">Asignada</span> a</div>';
                }
                
                html += '<div class="t-0016">' + name + '</div>';
               
            html += '</div>';
            if (whereIAm.taskType != 'Meeting' && whereIAm.taskType != 'Project') {
                html += '<div class="t-0022">'+ type +'</div>';
            }
        html += '</div>';
        $('#assignedFather').html(html);
        showMeetingInvited();
    }

    function showLocationFather(location){
        var html = "";
        if (location == null) {
            location = 'Sin Asignar';
        }
        if (SYSTEM_GUEST) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalLocationFather">';
        }
               // html +=  '<input id="t_taskDueDate" value="'+ location +'" type="hidden">';
            html += '<div class="t-0017"><span class="glyphicon glyphicon-pushpin"></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Ubicación</div>';
                html += '<div class="t-0016" id="dueDate_0016">' + location + '</div>';
            html += '</div>';
        html += '</div>';
        $('#locationFather').html(html);
    }

    function showDueDateSon(date,repeat){
        var html = "";
        var d = "";
        var time = "";
        
        $('#dueDate').html("");
        if (date == null) {
            d = "DD-MM-YYY";
            date = "";
        } else {
            d = changeDateES(date);
            date = date.split(" ");
            time = date[1];
            time = time.substring(0,5);
            date = date[0];
        }
        if (SYSTEM_GUEST) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendar">';
        }
                html +=  '<input id="t_taskDueDate" value="'+ date +'" type="hidden">';
            html += '<div class="t-0017"><span class="glyphicon glyphicon-calendar"></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Fecha</div>';
                html += '<div class="t-0016" id="dueDate_0016">' + d + '</div>';
            html += '</div>';
        html += '</div>';
        $('#dueDate').html(html);

        html = "";
        if (repeat) {
            var repeat_text = 'Sin Repetición';
            if (repeat == 'daily') { repeat_text = 'Diaria'; }
            if (repeat == 'weekly') { repeat_text = 'Semanal'; }
            if (repeat == 'monthly') { repeat_text = 'Mensual'; }
            if (repeat == 'lastDay') { repeat_text = 'Final de Mes'; }
            if (repeat == 'quarterly') { repeat_text = 'Trimestral'; }
            if (repeat == 'biannual') { repeat_text = 'Semestral'; }
            if (repeat == 'yearly') { repeat_text = 'Anual'; }
            
            if (SYSTEM_GUEST) {
                html += '<div class="t-0012" >';
            } else {
                html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendar">';
            }
                    html +=  '<input id="t_taskRepeatMode" value="'+ repeat +'" type="hidden">';
                html += '<div class="t-0017"><span class=" glyphicon glyphicon-repeat"></span></div>';
                html += '<div class="t-0014">';
                    html += '<div class="t-0015">Repetición</div>';
                    html += '<div class="t-0016" id="dueDate_0019">' + repeat_text + '</div>';
                html += '</div>';
            html += '</div>';

             x = document.getElementsByClassName("t-0036");
            for (i = 0; i < x.length; i++) {
                $(x[i]).removeClass("t-0037");
            }
            if (repeat == '') {
                $('#no_repeart').addClass("t-0037");
            } else {
                $('#'+repeat).addClass("t-0037");
            }
           
        }
        $('#repeat').html(html);

        // $('#calendar_1').html('');
        
        if (last_calendar_1 != whereIAm.taskSon) {
            last_calendar_1 = whereIAm.taskSon;
            $('#calendar_1').html('');
            calendar_1_son = createCalendarVanilla('id="t_taskDueDate"','calendar_1','dueDateClick');
            calendar_1_son.init({
                disablePastDays: false,
                new_date: date
            });
        }
        

        html = ""
        $('#dueTime').html("");
        if (d != "DD-MM-YYY") {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendarTime">';
                    html +=  '<input id="t_taskDueTime" value="'+ time +'" type="hidden">';
                html += '<div class="t-0017"><span class="glyphicon glyphicon-time" style="font-size: 20px;margin-top: -3px;margin-left: -1px;"></span></div>';
                html += '<div class="t-0014">';
                    html += '<div class="t-0015">Hora</div>';
                    html += '<div class="t-0016" id="dueDate_0017">' + time + '</div>';
                html += '</div>';
            html += '</div>';
            $('#dueTime').html(html);
            var h = time.split(":");
            $('#h_son').val(h[0]);
            $('#m_son').val(h[1]);

        }
        $('#myModalCalendar_close').click();
        $('#myModalCalendar_close').click();
    }

    


    function showDueDateFater(date,date2,repeat){
        var html = "";
        var d = "";
        var date_original = date;
        $('#dueDateFather').html("");
        if (date == null) {
            d = "DD-MM-YYY";
            date = "";
        } else {
            d = changeDateES(date);
            date = date.split(" ");
            time = date[1];
            date = date[0];
            time = time.substring(0,5);
        }

        var other_user_can_edit_project = false;
        if (whereIAm.task.obj) {
            if ( whereIAm.task.obj.t_generalTaskType == 'Project') {
                if (!whereIAm.task.can_edit) {
                    other_user_can_edit_project = true;
                }
            }
        } else {
            if ( whereIAm.task.t_generalTaskType == 'Project') {
                if (!whereIAm.task.can_edit) {
                    other_user_can_edit_project = true;
                }
            }
        }

        if (SYSTEM_GUEST || whereIAm.task.lock || other_user_can_edit_project) {
            html += '<div class="t-0012" >';
        } else {
            html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendarFather">';
        }
                html +=  '<input id="t_taskDueDateFather" value="'+ date +'" type="hidden">';
            html += '<div class="t-0017"><span class="glyphicon glyphicon-calendar"></span></div>';
            html += '<div class="t-0014">';
                html += '<div class="t-0015">Fecha</div>';
                html += '<div class="t-0016" id="dueDate_0016_father">' + d + '</div>';
            html += '</div>';
        html += '</div>';
        $('#dueDateFather').html(html);

        html = ""
        $('#dueTimeFather').html("");
        $('#dueTimeEndFather').html("");
        if (d != "DD-MM-YYY") {

            if (SYSTEM_GUEST) {
                html += '<div class="t-0012" >';
            } else {
                html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendarTimeFather">';
            }
                    html +=  '<input id="t_taskDueTimeFather" value="'+ time +'" type="hidden">';
                html += '<div class="t-0017"><span class="glyphicon glyphicon-time" style="font-size: 20px;margin-top: -3px;margin-left: -1px;"></span></div>';
                html += '<div class="t-0014">';
                    html += '<div class="t-0015">Comienza</div>';
                    html += '<div class="t-0016" id="dueDate_0017">' + time + '</div>';
                html += '</div>';
            html += '</div>';

            if (whereIAm.taskType != 'Project') {
                $('#dueTimeFather').html(html);
            }

            var h = time.split(":");
            $('#h_father').val(h[0]);
            $('#m_father').val(h[1]);

            date2 = date2.split(" ");
            time = date2[1];
            time = time.substring(0,5);
            html = ""
            if (SYSTEM_GUEST) {
                html += '<div class="t-0012" >';
            } else {
                html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendarTimeFather">';
            }
                    html +=  '<input id="t_generalTaskDueDateEnd" value="'+ time +'" type="hidden">';
                html += '<div class="t-0017"><span class="glyphicon glyphicon-time" style="font-size: 20px;margin-top: -3px;margin-left: -1px;"></span></div>';
                html += '<div class="t-0014">';
                    html += '<div class="t-0015">Termina</div>';
                    html += '<div class="t-0016" id="dueDate_0018">' + time + '</div>';
                html += '</div>';
            html += '</div>';

            if (whereIAm.taskType == 'Meeting') {
               
                $('#dueTimeEndFather').html(html);
            }

            var h2 = time.split(":");
            $('#h_father_End').val(h2[0]);
            $('#m_father_end').val(h2[1]);
           
           // $("#myModalCalendarFather").removeClass("show");
           // $('#myModalCalendarFather').attr('aria-hidden', true);
        }
        


        html = "";
        console.info(repeat);
        if (repeat) {

            var repeat_text = 'Sin Repetición';
            if (repeat == 'daily') { repeat_text = 'Diaria'; }
            if (repeat == 'weekly') { repeat_text = 'Semanal'; }
            if (repeat == 'monthly') { repeat_text = 'Mensual'; }
            if (repeat == 'lastDay') { repeat_text = 'Final de Mes'; }
            if (repeat == 'quarterly') { repeat_text = 'Trimestral'; }
            if (repeat == 'biannual') { repeat_text = 'Semestral'; }
            if (repeat == 'yearly') { repeat_text = 'Anual'; }
            
            if (SYSTEM_GUEST) {
                html += '<div class="t-0012" >';
            } else {
                html += '<div class="t-0012" data-toggle="modal" data-target="#myModalCalendarFather">';
            }
                    html +=  '<input id="t_taskRepeatMode_father" value="'+ repeat +'" type="hidden">';
                html += '<div class="t-0017"><span class=" glyphicon glyphicon-repeat"></span></div>';
                html += '<div class="t-0014">';
                    html += '<div class="t-0015">Repetición</div>';
                    html += '<div class="t-0016" id="dueDate_0019">' + repeat_text + '</div>';
                html += '</div>';
            html += '</div>';

            x = document.getElementsByClassName("t-0036");
            for (i = 0; i < x.length; i++) {
                $(x[i]).removeClass("t-0037");
            }
            if (repeat == '') {
                $('#no_repeart_father').addClass("t-0037");
            } else {
                $('#'+repeat+'_father').addClass("t-0037");
            }
           
        } else {
            $('#no_repeart_father').addClass("t-0037");
        }
        if (whereIAm.taskType != 'Meeting') {
            $('#repeatFather').html(html);
        }





        if (date_original) {
            date_original = date_original.split(" ");
            date_original = date_original[0];
        }
        
        if (last_calendar_2 != whereIAm.taskFather) {
            last_calendar_2 = whereIAm.taskFather;
            $('#calendar_2').html('');
            calendar_2_father = createCalendarVanilla('id="t_taskDueDateFather"','calendar_2','dueDateClickFather')
            calendar_2_father.init({
                disablePastDays: false,
                new_date: date_original
            });
        }
        $('#myModalCalendarFather_close').click();
        $('#myModalCalendarFather_close').click();
        
    }

    function changeDateES(date){
        var d_temp = date.split(" ");
        var d_temp_date = d_temp[0];
        d_temp_date = d_temp_date.split("-");
        date = d_temp_date[2] + '-' + d_temp_date[1] + '-' + d_temp_date[0];
        return date;
    }
    function changeDateESNombre(date){
        var d_temp = date.split(" ");
        var d_temp_date = d_temp[0];
        var month = {'01':'Ene', '02':'Feb', '03':'Mar', '04':'Abr', '05':'May', '06':'Jun', '07':'Jul', '08':'Ago', '09':'Sep', '10':'Oct', '11':'Nov', '12':'Dic'};
        d_temp_date = d_temp_date.split("-");
        date = d_temp_date[2] + ' ' + month[d_temp_date[1]] + ' ' + d_temp_date[0];
        return date;
    }

    function dueDateTimeClick(){
        var h = '00';
        var m = '00';
        var date = $('#t_taskDueDate').val()
        
        if($('#h_son').val() != ''){
            h = $('#h_son').val();
        }

        if($('#m_son').val() != ''){
            m = $('#m_son').val();
        }

        date = date+' '+ h + ':' + m;

        var url = '/task/editTaskSon';
        $.post(url,{'whereIAm':whereIAm,'t_taskDueDate':date,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
            showDueDateSon(date);
        });
    }

    function dueDateTimeClickFather(){
        var h = '00';
        var m = '00';
        var h2 = '00';
        var m2 = '00';
        var date = $('#t_taskDueDateFather').val()
        
        if($('#h_father').val() != ''){
            h = $('#h_father').val();
        }

        if($('#m_father').val() != ''){
            m = $('#m_father').val();
        }

         if($('#m_father').val() != ''){
            m = $('#m_father').val();
        }

        if($('#h_father_End').val() != ''){
            h2 = $('#h_father_End').val();
        }

        if($('#m_father_end').val() != ''){
            m2 = $('#m_father_end').val();
        }
        date_end = date+' '+ h2 + ':' + m2;
        date = date+' '+ h + ':' + m;
       

        var url = '/task/editTaskA';
        $.post(url,{'whereIAm':whereIAm,'t_generalTaskDueDate':date,'t_generalTaskDueDateEnd':date_end,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
            showDueDateFater(date,date_end, result.task[0].t_generalTaskRepeatMode);
        });
    }

    

    function dueDateClick(date){
        var d = changeDateES(date);
        var h = '00';
        var m = '00';
        
        if($('#h_son').val() != ''){
            h = $('#h_son').val();
        }

        if($('#m_son').val() != ''){
            m = $('#m_son').val();
        }

        date = date+' '+ h + ':' + m;
        $('#dueDate_0016').html(d);
        var url = '/task/editTaskSon';

        $.post(url,{'whereIAm':whereIAm,'t_taskDueDate':date,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
            $('#error_date_son').hide();
            if(!result.status){
                var d = changeDateES(result.date);
                $('#error_date_son').html('La fecha debe ser anterior o igual al Dia : '+d);
                $('#error_date_son').show('slow');
                
            } else {
                showDueDateSon(date, result.obj.t_taskRepeatMode);
                $('#alertDivSon').hide();
            }
           
            
        });
    }7

    function dueDateClickFather(date){
        
        var d = changeDateES(date);
        var h = '00';
        var m = '00';
        var h2 = '00';
        var m2 = '00';
        var date_end;
        if($('#h_father').val() != ''){
            h = $('#h_father').val();
        }

        if($('#m_father').val() != ''){
            m = $('#m_father').val();
        }

        if($('#h_father_End').val() != ''){
            h2 = $('#h_father_End').val();
        }

        if($('#m_father_end').val() != ''){
            m2 = $('#m_father_end').val();
        }

        date_end = date+' '+ h2 + ':' + m2;
        date = date+' '+ h + ':' + m;
        
        $('#dueDate_0016_father').html(d);

        var url = '/task/editTaskA';
        $.post(url,{'whereIAm':whereIAm,'t_generalTaskDueDate':date,'t_generalTaskDueDateEnd':date_end,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
           
            showDueDateFater(date,date_end, result.task[0].t_generalTaskRepeatMode)
            //     whereIAm.task = result.task[0];
            $('#alertDivFather').hide();
        });
    }


    function getTask() {
        console.log('getTask');
        var url = '/task/getTask';
        whereIAm.active_show = $('#active_show').val();
        whereIAm.active_orden = $('#active_orden').val();
        whereIAm.active_status = $('#active_status').val();
        whereIAm.active_status_son = $('#active_status_son').val();
        whereIAm.follow_mode = $('#follow_mode').val();
        whereIAm.mention_mode = $('#mention_mode').val();
        whereIAm.search = $('#search_task').val();
        whereIAm.doc_rec_mode = $('#doc_rec_mode').val();
       

        if (whereIAm.mode == 'Meeting' || whereIAm.mode == 'Project') {
            whereIAm.active_show = 'father';
        }

        if (whereIAm.listToRefresh == 'task') {
            whereIAm.mode = default_mode;
        }
        
        
        $.post(url,{'whereIAm':whereIAm,'_token':'{{ csrf_token()}}'},function(result){
            buildTaskDiv(result);
            var total = result.task.length;
            $('#totalTaskMain').html("Total : " + total);
            if (SYSTEM_GUEST) {
                if (whereIAm.mode == 'Meeting') {
                    if (total == 0) {
                        if(whereIAm.active_status == 'incompleted') {
                            if (whereIAm.listToRefresh == 'task') {
                                $('#status-task-main_close').click();
                            }
                        }
                    }
                }
            }
        });
    }

     function getMeeting() {
            var url = '/task/getTask';
            var whereIAm_temp = whereIAm;
            console.log('getMeeting');
            whereIAm_temp.active_show = $('#active_show').val();
            whereIAm_temp.active_orden = $('#active_orden').val();
            whereIAm_temp.active_status = $('#active_status_fatherMeeting').val();
            whereIAm_temp.active_status_son = $('#active_status_son').val();
            whereIAm_temp.follow_mode = $('#follow_mode').val();
            whereIAm_temp.mention_mode = $('#mention_mode').val();
            whereIAm_temp.search = $('#search_task').val();
            whereIAm_temp.doc_rec_mode = $('#doc_rec_mode').val();
            whereIAm_temp.mode = 'Meeting';

            if (whereIAm_temp.mode == 'Meeting' || whereIAm_temp.mode == 'Project') {
                whereIAm_temp.active_show = 'father';
            }
            
            whereIAm_temp.listToRefresh = 'subTaskListMeeting';
            $.post(url,{'whereIAm':whereIAm_temp,'_token':'{{ csrf_token()}}'},function(result){
                buildTaskDiv(result);
                var total = result.task.length;
                $('#totalTaskMain').html("Total : " + total);
                if (SYSTEM_GUEST) {
                    if (whereIAm.mode == 'Meeting') {
                        if (total == 0) {
                            if(whereIAm.active_status == 'incompleted') {
                                if (whereIAm.listToRefresh == 'task') {
                                    $('#status-task-main_close').click();
                                }
                            }
                        }
                    }
                }
            });
    }


    function activeUser(e){
        whereIAm.activeUser = e.value;
        getTask();
    }

    function activeStatus(e,value){
        var x = document.getElementsByClassName("status-task");
        var i;
        $('#active_status').val(value);
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-status');
        }

        $(e).addClass('active-status');
        $(e).blur();
        getTask();
    }

    
    function activeStatusFatherMeeting(e,value){
        var x = document.getElementsByClassName("status-task-fatherMeeting");
        var i;
        $('#active_status_fatherMeeting').val(value);
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-status-son');
        }

        $(e).addClass('active-status-son');
        $(e).blur();
        getMeeting();

      
    }

    function activeStatusSon(e,value){
        var x = document.getElementsByClassName("status-task-son");
        var i;
        $('#active_status_son').val(value);
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-status-son');
        }

        $(e).addClass('active-status-son');
        $(e).blur();
        getTask();
    }

    function followMode(e,value){
       
        if ($('#follow_mode').val() == '') {
            $('#follow_mode').val(value);
            $(e).addClass('active-follow');
        
        } else {
            $('#follow_mode').val('');
            $(e).removeClass('active-follow');
        }
        $(e).blur();
        getTask();
    }

    function mentionMode(e,value){
       
       if ($('#mention_mode').val() == '') {
           $('#mention_mode').val(value);
           $(e).addClass('active-follow');
       
       } else {
           $('#mention_mode').val('');
           $(e).removeClass('active-follow');
       }
       $(e).blur();
       getTask();
   }
    

    function activeOrden(e,value){
        var x = document.getElementsByClassName("orden-task");
        var i;
        $('#active_orden').val(value);
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-orden');
        }

        $(e).addClass('active-orden');
        $(e).blur();
        if (whereIAm.ordenSigno == '<') {
            whereIAm.ordenSigno = ">";
        } else {
            whereIAm.ordenSigno = "<";
        }
        getTask();

    }

    function docRec(e,value){
        if ($('#doc_rec_mode').val() == '') {
           $('#doc_rec_mode').val(value);
           $(e).addClass('active-doc_rec');
        } else {
           $('#doc_rec_mode').val('');
           $(e).removeClass('active-doc_rec');
        }
        $(e).blur();
        getTask();

    }

    

    function activeShow(e,value){
        var x = document.getElementsByClassName("show-task ");
        var i;
        $('#active_show').val(value);
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-show');
        }

        $(e).addClass('active-show');
        $(e).blur();
        getTask();
    }

    function searchTask(value){
        getTask();
    }



    

    function buildTaskDiv(result){
         // father  son
        // father_{n}  son_{n}
        // my_{type}_{n}
        $('#' + result.whereIAm.listToRefresh).html('<div id="subTaskListText"></div>');
        if (result.whereIAm.listToRefresh == 'subTaskListMeeting') {
            $('#' + result.whereIAm.listToRefresh).html('<div id="subTaskListTextMeeting"></div>');
        }
        if (result.status) {
            $('#' + result.whereIAm.listToRefresh).html('');
            for (var i = 0; i < result.task.length; i++) {
                var title = '';
                var html = '';
                var id = '';
                var id_control = '';
                var type = '';
                var father_control = '';
                var due_date = '';
                var class_priority = "t-0023";
                var title_priority = "Normal";
                var type_assigned = '';
                var name_assigned = '';
                var date_color = '';

                if (result.task[i].expired) {
                    date_color = 'background-color: #f13636;color: white;';
                }
                if (result.task[i].due_date) {
                    due_date = changeDateESNombre(result.task[i].due_date);
                }

                if (result.task[i].title) {
                    title = result.task[i].title;
                } 

                type = result.task[i].type;
                if(result.task[i].type == 'father'){
                    id_control = result.task[i].type + '_' + result.task[i].father;
                    id = result.task[i].father;
                } else {
                    id_control = result.task[i].type + '_' + result.task[i].son;
                    id = result.task[i].son;
                    father_control =  'myFather_' + result.task[i].father;
                }
                var input_control_id = result.task[i].father+result.task[i].son;

                var color_priority = '';
                var color_circle = '';
                var title_cirle = '';
                if (result.task[i].priority == 1) {
                    class_priority = "t-0024";
                    title_priority = "Alta";
                    color_priority = 'border-color: #ff7777;';
                    color_circle = 'border-color: #ff7777;';
                    title_cirle = 'Alta';
                }
                if (result.task[i].status == 'waiting_validation') {
                    color_circle = 'border-color: #ffe14e;';
                    title_cirle = 'En espera de Validación';
                }

                if (!result.task[i].taskAssigned_default_me) {
                    name_assigned = result.task[i].taskAssigned_default_name;
                }
                
                checked = '';
                if (result.task[i].status == 'Completed'){
                    checked = 'checked';
                }

                var onchange = "taskCompleted(this, '"+ id +"','"+ type +"')";
                
                if (result.task[i].taskAssigned_default_type != '') {
                    type_assigned_title = result.task[i].taskAssigned_default_type;
                    if (type_assigned_title == 'CC') {
                        onchange = "";
                    }
                }
                
                var group_icon = '';
                
                if (result.task[i].taskAssigned.length > 0) {
                    group_icon += '<div  class="tooltip_2" ><img src="https://'+root +'/users-solid.svg" style=" float: left;height: 18px;margin-top: 1px;" >';
                        group_icon += '<span class="tooltiptext_2 tooltip-left" style="width: 250px;"><table style="margin-left: 8px;text-transform: capitalize;color: white;width: 240px;    font-size: 14px;"> ';
                                for(var a = 0; a < result.task[i].taskAssigned.length; a++ ){
                                    group_icon += '<tr><td>'+ result.task[i].taskAssigned[a].t_taskAssignedUserName +'</td><td>'+ result.task[i].taskAssigned[a].t_taskAssignedType.substring(0, 1) +'</td></tr>'; 
                                } 
                                
                        group_icon += '</table></span>';
                    group_icon += '</div> ';
                    
               
                }
                var style_005_006 = "";
                if (!result.task[i].can_close) {
                    style_005_006 = "opacity: 0.3;";
                }

                var  follow_style = '';
                if (result.task[i].follow == '1') {
                    follow_style = 't-0043';
                }
                if (result.task[i].mention == '1') {
                    follow_style = 't-0042';
                }
                
                html += '<div class="t-0004 '+follow_style+'" id="tt_'+id_control+'" >';
                    if (whereIAm.mode == 'Project' && result.whereIAm.listToRefresh == 'task') {

                    } else {
                        html += '<div class="t-0005" style="'+style_005_006+'">';
                                html += '<label title="'+ title_cirle +'" >';
                                    if (result.task[i].can_close) {
                                        if (onchange != "") {
                                            html += '<input '+ checked +' class="label__checkbox" type="checkbox" onChange="'+onchange+'" id="tt_check_'+ id_control +'"/>';
                                        }
                                        
                                    }
                                        html += '<span class="label__text"><span class="label__check" style="'+ color_circle +'">';
                                            if (result.task[i].taskAssigned_default_type != '' && result.task[i].status != 'Completed') {
                                                var tast_asig = result.task[i].taskAssigned_default_type.substring(0, 1);
                                                if (!result.task[i].taskAssigned_default_me) {
                                                    tast_asig = ''
                                                }
                                                if (result.task[i].mention == '1') {
                                                    tast_asig = '@';
                                                }
                                                html += '<span style="color: #585858;">'+tast_asig+'</span>';
                                            } else {
                                                if (result.task[i].mention == '1') {
                                                    tast_asig = '@';
                                                    html += '<span style="color: #585858;">'+tast_asig+'</span>';
                                                } else {
                                                    html += '<i class="fa fa-check icon"></i>';
                                                }
                                                
                                            }
                                            
                                        html += '</span> </span>';
                                html += '</label>';
                        html += '</div>';
                    }
                    html += '<div class="t-0006" style="'+style_005_006+'">';
                        html += '<input readOnly    class="my_task inputTask '+ result.whereIAm.listToRefresh +' '+ type +' '+ father_control +'  me_'+ id +'  '+input_control_id+'" value="'+ title +'">';
                        if (result.task[i].repeat) {
                            if (result.task[i].repeat != 'no_repeart') {
                                html += '<div class="t-0024  tooltip_2" title="Repetición"  ><span class=" t-0039 glyphicon glyphicon-repeat"></span>';
                                html += '<div class="tooltiptext_2 tooltip-left">Repetición</div>';
                                html += '</div>';

                            }
                           
                        }
                        
                        if (due_date != '') {
                            html += '<div class="t-0018" style="'+date_color+'">'+due_date +'</div>';
                        }
                       

                        if (result.task[i].taskAssigned_default_type != '') {
                            type_assigned_title = result.task[i].taskAssigned_default_type;
                            if (type_assigned_title == 'Realiza') {
                                type_assigned_title = 'Responsable';
                            }
                            type_assigned = result.task[i].taskAssigned_default_type.substring(0, 1);
                            html += '<div class="t-0026" title="'+ type_assigned_title +'"> '+ group_icon +' </div>';
                        }
                        
                        html += '<div class="'+ class_priority +' tooltip_2" title="'+ title_priority +'"><span class="glyphicon glyphicon-flag" style="font-size: 16px;padding: 1px;"></span>';
                            html += '<div class="tooltiptext_2 tooltip-left">'+ title_priority +'</div>';
                        html += '</div>';
                       
                        
                    html += '</div>';
                    var customer = '';
                    if(result.task[i].customer) {
                        customer = result.task[i].customer;
                    }
                    html += '<div class="t-0040">'+customer+'</div>';
                   
                html += '</div>';
                $('#' + result.whereIAm.listToRefresh).append(html);
                $("."+input_control_id).val(title);
                $("."+input_control_id).click(function(){
                  fillTask(this);
                 });
            }
            //$('[data-toggle="tooltip"]').tooltip();
       }
    }

    function showMeetingInvited(){
        $('#asistente_cliente_list').html('');
        var html = '';
        var url = '/task/getMeetingInvited';
        $.post(url,{'id':whereIAm.taskFather, '_token':'{{ csrf_token()}}'},function(result){
            console.log(result.list_inv.length);
            for (var i = 0; i < result.list_inv.length; i++) {
                html = '';
                if (result.list_inv[i].t_meeting_invitedPhone) {} else { result.list_inv[i].t_meeting_invitedPhone = '';}
                if (result.list_inv[i].t_meeting_invitedEmail) {} else { result.list_inv[i].t_meeting_invitedEmail = '';}

                html += '<div class="asistente_cliente_list_item">';
                    html += '<div>'+result.list_inv[i].t_meeting_invitedName+'</div>';
                    html += '<div>'+result.list_inv[i].t_meeting_invitedPhone+'</div>';
                    html += '<div>'+result.list_inv[i].t_meeting_invitedEmail+'</div>';
                    html += '<div class="asistente_cliente_list_remover" onclick="removeMeetingInvited(\''+result.list_inv[i].idt_meeting_invited+'\')">Eliminar</div>';
                html += '</div>';
                $('#asistente_cliente_list').append(html);
            }
        });

    }
    function removeMeetingInvited(id){
        var url = '/task/removeMeetingInvited';
        $.post(url,{'id':id, '_token':'{{ csrf_token()}}'},function(result){
            showMeetingInvited();
        });
    }
    function fillTask(e){
       

        var all_class =  e.className;
        var type = ''; 
        var c = '';
        var id = '';
        var can_edit = '';
        var listToRefresh = 'task';
        var myFather = 0;

       
        if (all_class.search("father") != -1) {
            type = 'father'; 
        }

        if (all_class.search("son") != -1) {
            type = 'son';
        }

        if (all_class.search(" task ") != -1) {
            listToRefresh = 'task';
        }

         if (all_class.search("subTaskList") != -1) {
            listToRefresh = 'subTaskList';
        }

        var all_class_array =  all_class.split(" ");
        for (var i = 0; i< all_class_array.length; i++) {
            c =  all_class_array[i];

            if (c.search("me_") !=  -1) {
                id = c.split("me_")[1];
            }

            if (c.search("myFather_") !=  -1) {
                myFather = c.split("myFather_")[1];
            }
            
        }
        
        $('.deleteTaskButton').hide();
        
        if (type == 'father') {
            $('#editSubTask').hide('slow');
            clearEditTask();
            var url = '/task/getOneTask';
            $.post(url,{'type':'father', 'id':id, '_token':'{{ csrf_token()}}'},function(result){
                
                
                can_edit =  result.task.can_edit;
               
                $('#generalTaskId').val(id);
                if (result.task.title != "" && result.task.title != null) {
                    $("#t_generalTaskTitle").val(result.task.title);
                    $("#t_generalTaskTitle").parent('div').removeClass('is-empty');
                } else {
                    $("#t_generalTaskTitle").focus();
                }

                if (result.task.can_delete) {
                    $('.deleteTaskButton').show();
                }
                
                // if () {
                //     $('.deleteTaskButton').show();
                // }
                
                if (result.task.obj.t_generalTaskDirectory != "" && result.task.obj.t_generalTaskDirectory != null) {
                    $('#t_generalTaskDirectory').val(result.task.obj.t_generalTaskDirectory);
                    $("#t_generalTaskDirectory").parent('div').removeClass('is-empty');
                }
                $('#markCompleted').show();
               
                addClassCompletedButtonFather(id);
                if (result.task.status == 'Completed'){
                    $("#markCompleted").addClass("completed");
                    $("#markCompleted").css("background-color", "#4be88f;");
                }  
                

                interval_task.addTask(id,'father');
                whereIAm = {
                    screen:"addTask",
                    taskFather:id,
                    taskSon:0,
                    listToRefresh:"subTaskList",
                    task:result.task,
                    taskFatherName:"",
                    activeUser: whereIAm.activeUser,
                    ordenSigno: whereIAm.ordenSigno,
                    mode: whereIAm.mode,
                    taskType: result.task.obj.t_generalTaskType,
                    activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
                    isMobile:isMobile.any()

                };

                showCustomerFather(result.task.obj);
                showAssignedFather(result.task.taskAssigned,result.task.taskAssignedDefault);
                showDueDateFater(result.task.obj.t_generalTaskDueDate, result.task.obj.t_generalTaskDueDateEnd, result.task.obj.t_generalTaskRepeatMode);
                showLocationFather(result.task.obj.t_generalTaskLocation);
                showCreatedByFather(result.task.obj.t_generalTaskUsuarioName);
                showPriority(result.task.obj.t_generalTaskPriorityNumber);
                getNotesFather(id);
                getDocuments();
                showCriticalDateFather(result.task.obj.t_generalTaskCriticalDate);

                if (result.task.obj.t_generalTaskType == 'Project') {
                    showDocumentaryReminder(result.task.obj.t_generalTaskDocRec);
                    showBookNoteBook(result.task.obj.t_generalTaskLibroCuaderno);
                }
                
                if (result.task.obj.t_clientes_idt_clientes != "" && result.task.obj.t_clientes_idt_clientes != null) {
                    $('#idt_clientes').val(result.task.obj.t_clientes_idt_clientes);
                    $('#t_clientesNombre').attr('readonly', true);
                    $('#t_clientesApellido').attr('readonly', true);
                    
                    
                    if (result.task.obj.t_generalTaskCFirstName != "" && result.task.obj.t_generalTaskCFirstName != null) {
                        $('#t_clientesNombre').val(result.task.obj.t_generalTaskCFirstName);
                        $("#t_clientesNombre").parent('div').removeClass('is-empty');
                    }
                    if (result.task.obj.t_generalTaskCLastName != "" && result.task.obj.t_generalTaskCLastName != null) {
                        $('#t_clientesApellido').val(result.task.obj.t_generalTaskCLastName);
                        $("#t_clientesApellido").parent('div').removeClass('is-empty');
                    }
                    
                    if (result.task.obj.t_generalTaskCNif != "" && result.task.obj.t_generalTaskCNif != null) {
                        $('#t_clientesNif_1').val(addNifFormat(result.task.obj.t_generalTaskCNif));
                        $("#t_clientesNif_1").parent('div').removeClass('is-empty');
                    }
                    
                }

                if (result.task.obj.t_generalTaskCTelefono != "" && result.task.obj.t_generalTaskCTelefono != null) {
                    $('#t_clientesTelefono').val(result.task.obj.t_generalTaskCTelefono);
                    $("#t_clientesTelefono").parent('div').removeClass('is-empty');
                }
                if (result.task.obj.t_generalTaskCPContact != "" && result.task.obj.t_generalTaskCPContact != null) {
                    $('#t_generalTaskCPContact').val(result.task.obj.t_generalTaskCPContact);
                    $("#t_generalTaskCPContact").parent('div').removeClass('is-empty');
                }
                if (result.task.obj.t_generalTaskCEmail != "" && result.task.obj.t_generalTaskCEmail != null) {
                    $('#t_clientesEmail').val(result.task.obj.t_generalTaskCEmail);
                    $("#t_clientesEmail").parent('div').removeClass('is-empty');
                }

                $('#descriptionFather').summernote('code',result.task.obj.t_generalTaskExplanation);
                if (!can_edit) {
                    $('#t_clientesNif_1').attr('readonly', true);
                    $('#t_clientesEmail').attr('readonly', true);
                    $('#t_clientesTelefono').attr('readonly', true);
                    $('#t_generalTaskCPContact').attr('readonly', true);
                    $('#searchCustomer').attr('readonly', true);
                    $('#t_generalTaskTitle').attr('readonly', true);
                    $('#t_clientesNombre').attr('readonly', true);
                    $('#t_clientesApellido').attr('readonly', true);
                    $('#cleanCustomer').hide();
                    $('#overwriteContact').hide();
                } else {
                    $('#cleanCustomer').show();
                    $('#overwriteContact').show();
                }
                
                if (result.task.obj.t_generalTaskType == 'Meeting') {
                    $('.only_in_meeting').show();
                    $('.only_in_project').hide();
                    $('#closeTaskButtonFather').html('Finalizar Reunión');
                    $('.modalTeamFatherTitle').html('Asistente');
                    $('#deleteTaskButton').html('Eliminar Reunion');
                    $('#to_know_where').html('Reunión');
                } else if (result.task.obj.t_generalTaskType == 'Project') {
                    $('.only_in_meeting').hide();
                    $('.only_in_project').show();
                    $('#closeTaskButtonFather').html('Finalizar Reunión');
                    $('.modalTeamFatherTitle').html('Mostrar');
                    $('#deleteTaskButton').html('Eliminar Anotación');
                    $('#to_know_where').html('Anotación');
                } else {
                    $('.only_in_project').hide();
                    $('.only_in_meeting').hide();
                    $('#closeTaskButtonFather').html('Finalizar Tarea');
                    $('.modalTeamFatherTitle').html('Asignar');
                    $('#deleteTaskButton').html('Eliminar Tarea');
                    $('#to_know_where').html('Tarea Madre');
                }

               
                if (result.task.can_close) {
                    $('#markCompleted').show();
                    $('#status-task-son_close').click();
                } else {
                    $('#markCompleted').hide();
                    $('#status-task-son_open').click();    
                }

                
                if (result.task.obj.t_generalTaskType == 'Project') {
                    $('#markCompleted').hide();
                    // $('#notifyEmailFather').hide();
                    $('#status-task-fatherMeeting_open').click(); 
                    $('.only_in_project_b').show();
                    
                } else {
                    $('.only_in_project_b').hide();
                }

                
                var link = '';
                if (result.task.obj.t_generalTask_link) {
                    link = 'http://{{$_SERVER['HTTP_HOST']}}/task/'+result.task.obj.t_generalTask_link;
                }
                $('#text_copy').val(link);


                if (result.task.lock) {
                    // $('#customerFather').off('click');
                    // $('#assignedFather').off('click');
                    // $('#dueDateFather').off('click');
                    // $('#documentaryReminder').off('click');
                    // $('#bookNoteBook').off('click');
                    // $('#addFatherTaskNotes').off('click');
                    // $('#addFatherTaskDocuments').off('click');
                    // $('#addSubTaskPlus').off('click');
                    // $('#addSubTask').off('click');
                    
                }


               
            });

            $('#t-0001').hide('slow');
            $('#t-0000').hide('slow');
            $('#editTask').show('slow');
        }


        if (type == 'son') { 
            clearEditSubTask()
            addClassCompletedButtonSon(id);
            whereIAm.taskSon = id;
            
            whereIAm.listToRefresh = listToRefresh;
            var url = '/task/getOneTask';
            $.post(url,{'type':'son', 'id':id, '_token':'{{ csrf_token()}}'},function(result){
                
                if (result.task.title != "" && result.task.title != null) {
                    $('#t_taskTitle').val(result.task.title);
                    $("#t_taskTitle").parent('div').removeClass('is-empty');
                }
                if (result.task.obj.t_taskDirectory != "" && result.task.obj.t_taskDirectory != null) {
                    $('#t_taskDirectory').val(result.task.obj.t_taskDirectory);
                    $("#t_taskDirectory").parent('div').removeClass('is-empty');
                }
                if (result.task.can_delete) {
                    $('.deleteTaskButton').show();
                }
                interval_task.addTask(id,'son');
                whereIAm.task = result.task;
                whereIAm.taskFather = result.task.father,

                showAssigned(result.task.taskAssigned, result.task.taskAssignedDefault);
                showDueDateSon(result.task.obj.t_taskDueDate, result.task.obj.t_taskRepeatMode);
                showPriority(result.task.obj.t_taskPriorityNumber);
                showWorkflow(result.task.obj);
                showCustomer(result.task.obj);
                showCreatedBySon(result.task.obj.t_taskUserName);
                getDocuments();
                getNotes(id);
                showCriticalDateSon(result.task.obj.t_taskCriticalDay);

                if (result.task.status == 'Completed'){
                    $("#markCompletedSon").addClass("completed");
                    $("#markCompletedSon").css("background-color", "#4be88f;");
                }

                $('#descriptionSon').summernote('code', result.task.obj.t_taskExplanation);
                if (result.task.taskAssignedDefault != result.task.obj.t_taskUserCreated) {
                    $('#descriptionSon').summernote('disable');
                }
                whereIAm.task = result.task;
                whereIAm.taskFather = result.task.father,
                
                document.getElementById("seeAsuntoGeneral").className = "btn  btn-sm btn-topTask task father me_" + result.task.father;
                if (result.task.can_close) {
                   $('#markCompletedSon').show();
                } else {
                    $('#markCompletedSon').hide();
                }

                var link = '';
                if (result.task.obj.t_task_link) {
                    link = 'http://{{$_SERVER['HTTP_HOST']}}/task/'+result.task.obj.t_task_link;
                }
                $('#text_copy').val(link);
               
            });

            if (whereIAm.listToRefresh == 'task') {
                $('#t-0001').hide('slow');
                $('#t-0000').hide('slow');
            }
            $('#editTask').hide('slow');
            $('#editSubTask').show('slow');

           
        }
            
    }
    function addZero(x,n) {
        while (x.toString().length < n) {
            x = "0" + x;
        }
        return x;
    }

    function getMilli() {
        var d = new Date();
        
        var h = addZero(d.getHours(), 2);
        var m = addZero(d.getMinutes(), 2);
        var s = addZero(d.getSeconds(), 2);
        var ms = addZero(d.getMilliseconds(), 3);
        return h + "" + m + "" + s + "" + ms;
    }

    function addClassCompletedButtonFather(id){
        //btn  btn-sm  markCompletedSon
        document.getElementById("markCompleted").className = "btn  btn-sm btn-topTask me_" + id;
        
    }

    function addClassCompletedButtonSon(id){
        document.getElementById("markCompletedSon").className = "btn  btn-sm btn-topTask me_" + id;
        //btn  btn-sm  markCompletedSon
    }

    function completedButtonFather(e){
        var id = '';
        var all_class = e.className;
        var all_class_array =  all_class.split(" ");
        for (var i = 0; i< all_class_array.length; i++) {
            c =  all_class_array[i];
            if (c.search("me_") !=  -1) {
                id = c.split("me_")[1];
            }
        }

        if (all_class.search("completed") !=  -1) {
            $("#markCompleted").removeClass("completed");
            $("#markCompleted").css("background-color", "");
            taskIncompletedButton(id,'father');
        } else {
            if (whereIAm.taskType == 'Meeting') {
                if (confirm('¿Desea dar por Finalizada esta Reunión ?')) {
                    $("#markCompleted").addClass("completed");
                    $("#markCompleted").css("background-color", "#4be88f;");
                    taskCompletedButton(id,'father');
                }
            } else {
                if (confirm('¿Desea dar por Finalizada esta Tarea ?')) {
                    $("#markCompleted").addClass("completed");
                    $("#markCompleted").css("background-color", "#4be88f;");
                    taskCompletedButton(id,'father');
                }

            }

            
        }

       
        
    }

    function completedButtonSon(e){
        
            var id = '';
            var all_class = e.className;
            var all_class_array =  all_class.split(" ");
            for (var i = 0; i< all_class_array.length; i++) {
                c =  all_class_array[i];
                if (c.search("me_") !=  -1) {
                    id = c.split("me_")[1];
                }
            }
            if (all_class.search("completed") !=  -1) {
                $("#markCompletedSon").removeClass("completed");
                $("#markCompletedSon").css("background-color", "");
                taskIncompletedButton(id,'son');
            } else {
                if (confirm('¿Desea dar por Finalizada esta tarea ?')) {
                    $("#markCompletedSon").addClass("completed");
                    $("#markCompletedSon").css("background-color", "#4be88f;");
                    taskCompletedButton(id,'son');
                }
            }
        
    }

    function taskCompletedButton(id,type){
        
        var url = '/task/completedTask';
        $.post(url,{'type':type,'id':id,'_token':'{{ csrf_token()}}'},function(result){
            if (type == 'father'){
                $('#closeEditTask').click();
            } else {
                $('#closeEditSubTask').click();
            }
                    
        });

    }

    function showBottomAlert(id,type){
        var html = '';
        var str_task  = 'Tarea';
        if (whereIAm.mode == 'Meeting') { 
            str_task = 'Reunión';
        }
        $("#bottonAlert").show();
        setTimeout(function() {
            $("#bottonAlert").hide('slow');
        }, 8000);
        html += '<div style="padding: 10px;margin-top: 10px;"><span>'+str_task+' Completada</span> ';
        html += '<button class="tn  btn-sm deshacer" onclick="undoTask(\'' + id +'\',\'' + type +'\')">Deshacer</button></div>';
        $("#bottonAlert-002").html(html);
    }
    function undoTask(id,type){
        $("#bottonAlert").hide('slow');
        taskIncompletedButton(id,type);
       
    }

    function taskIncompletedButton(id,type) {
       
        var url = '/task/incompleteTask';
        $.post(url,{'type':type,'id':id,'_token':'{{ csrf_token()}}'},function(result){
            getTask();
        });
    }

    function taskCompleted(e,id,type){
        if ( e.checked ) {
            var str_task  = 'tarea';
            if (whereIAm.mode == 'Meeting') { 
                str_task = 'reunión';
            }
            
            if (confirm('¿Desea dar por Finalizada esta '+str_task+' ?')) {
                showBottomAlert(id,type);
                var url = '/task/completedTask';
                $.post(url,{'type':type,'id':id,'_token':'{{ csrf_token()}}'},function(result){
                    if (result.status) {
                    $('#tt_' + type + '_' +id).hide('slow');
                    } 

                    
                });
            } else {
                e.checked = false;
            }
        } else {
           
            var url = '/task/incompleteTask';
            $.post(url,{'type':type,'id':id,'_token':'{{ csrf_token()}}'},function(result){
               
                 
            });
        }
    }

    function clearEditTask(){
       
        //$('#bar_meeting_1').hide();
        //$('#bar_meeting_2').hide();
        $('#critical_date_son').val('0');
        $('#critical_date_father').val('0');
        $("#DivFormCustomer").hide();
        $('.only_in_meeting').hide();
        $('#t_clientesNif_1').attr('readonly', false);
        $('#t_clientesEmail').attr('readonly', false);
        $('#t_clientesTelefono').attr('readonly', false);
        $('#t_generalTaskCPContact').attr('readonly', false);
        $('#searchCustomer').attr('readonly', false);
        $('#t_generalTaskTitle').attr('readonly', false);
        document.getElementById("formAssignedTeamFather").reset();
        $('#t_clientesNombre').val('');
        $("#t_clientesNombre").parent('div').addClass('is-empty');
        $('#t_clientesApellido').val('');
        $("#t_clientesApellido").parent('div').addClass('is-empty');
        $('#t_clientesTelefono').val('');
        $("#t_clientesTelefono").parent('div').addClass('is-empty');
        $('#t_generalTaskCPContact').val('');
        $("#t_generalTaskCPContact").parent('div').addClass('is-empty');
        $('#t_clientesEmail').val('');
        $("#t_clientesEmail").parent('div').addClass('is-empty');
        $('#idt_clientes').val('');
        $('#t_generalTaskTitle').val('');
        $("#t_generalTaskTitle").parent('div').addClass('is-empty');
        $('#t_clientesNif_1').val('');
        $("#t_clientesNif_1").parent('div').addClass('is-empty');
        $('#task').html('');
        $('#subTaskList').html('<div id="subTaskListText"></div>');
        $('#subTaskListMeeting').html('<div id="subTaskListTextMeeting"></div>');
        // $("#markCompleted").css("background-color", "");
        $("#markCompletedSon").css("background-color", "");
        $("#markCompleted").removeClass("completed");
        $("#markCompleted").css("background-color", "");
        $('#searchCustomer').val('');
        $('#descriptionFather').summernote('code','');
        $('#descriptionFather').summernote('enable');
        $('#assigned').html("");
        $('#assignedFather').html("");
        $('#dueDate').html("");
        document.getElementById("formAssignedTeam").reset();
        document.getElementById("form_location").reset();
        //$('#markCompleted').hide();
        $('#other_location').hide();
        $('#other_location_value').val('');
        $('#t_generalTaskDirectory').val('');
        $("#t_generalTaskDirectory").parent('div').addClass('is-empty');
        $('#alertDivFather').html("");
        $('#alertDivFather').hide();
        $("#documentsFatherTaskList").html('<div id="documentsFatherTaskListText" style=""></div>');
        $("#notesFatherTaskList").html('<div id="notesFatherTaskListText" style=""></div>');
        $("#notesFatherTaskListNew").html('');

        
        clearEditSubTask();
    }

    function clearEditSubTask(){
        interval_task.init();
        $(".team_all_radios").attr('disabled', true);
            
        $('#t_taskTitle').val('');
        $('#body_workflow_search').val('');
        $("#t_taskTitle").parent('div').addClass('is-empty');
        $('#descriptionSon').summernote('code','');
        $('#descriptionSon').summernote('enable');
        $('#assigned').html("");
        $('#dueDate').html("");
        $('#alertDivSon').html("");
        $('#alertDivSon').hide();
        document.getElementById("formAssignedTeam").reset();
        $("#notesSubTaskList").html('<div id="notesTaskListText" style=""></div>');
        $("#documentsSubTaskList").html('<div id="documentsTaskListText" style=""></div>');
        $('#t_taskDirectory').val('');
        $("#t_taskDirectory").parent('div').addClass('is-empty');
        $("#markCompletedSon").css("background-color", "");
        $('#active_status_son').val('incompleted');
        var x = document.getElementsByClassName("status-task-son");
        var i;
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass('active-status-son');
        }
        $('#default_active_status_son').addClass('active-status-son');

        x = document.getElementsByClassName("t-0036");
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass("t-0037");
        }
        $('#no_repeart').addClass("t-0037");

        
        
    }

    function addSubTaskToList(data){
        // my_subTask  or my_Task
        // father_{n}  son_{n}
        // my_{type}_{n}
        var title = '';
        var html = '';
        
        html += '<div class="t-0004" id="">';
            html += '<div class="t-0005">';
                    html += '<label >';
                            html += '<input  class="label__checkbox" type="checkbox" onChange=""/>';
                            html += '<span class="label__text"><span class="label__check"><i class="fa fa-check icon"></i></span> </span>';
                    html += '</label>';
            html += '</div>';
            html += '<div class="t-0006">';
                html += '<input class="inputTask my_subTask " id="" value="'+ title +'">';
            html += '</div>';
        html += '</div>';

        $('#subTaskList').prepend(html);
    }

    function updateDescriptionFather(value){
        var url = '/task/editTaskA';
        $.post(url,{'whereIAm':whereIAm,'t_generalTaskExplanation':value,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
           
            //     whereIAm.task = result.task[0];
        });
    }

    function updateDescriptionSon(value){
        var url = '/task/editTaskSon';
        $.post(url,{'whereIAm':whereIAm,'t_taskExplanation':value,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
          
            //     whereIAm.task = result.task[0];
        });
    }

    function getIconName(string){
        var icon = '';
        s = string.split(" ");
        if (s.length == 2) {
            var l1 = s[0].substring(0, 1);
            var l2 = s[1].substring(0, 1);
            icon = l1.toUpperCase() + l2.toUpperCase();
            return icon;
        }

        if (s.length >= 3) {
            var l1 = s[0].substring(0, 1);
            var l2 = s[2].substring(0, 1);
            icon = l1.toUpperCase() + l2.toUpperCase();
            return icon;
        }
        return icon;
    }

    function changeRepeat(e,value) {
        var x = document.getElementsByClassName("t-0036");
        var i;
        for (i = 0; i < x.length; i++) {
            $(x[i]).removeClass("t-0037");
        }
        $(e).addClass("t-0037");
        if (whereIAm.taskSon != 0) {
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'t_taskRepeatMode':value,'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
              
                showDueDateSon(result.obj.t_taskDueDate, result.obj.t_taskRepeatMode);
            });
        }  else {
            var url = '/task/editTaskA';
            $.post(url,{'whereIAm':whereIAm,'t_generalTaskRepeatMode':value,'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
                showDueDateFater(result.task[0].t_generalTaskDueDate, result.task[0].t_generalTaskDueDateEnd, result.task[0].t_generalTaskRepeatMode);
            });
        }
    }

    function addNifFormat(nif) {
            var number = nif;
            if (number.length == 9) {
                //var str = "X8459952T";
                var str = number;
                //X8.459.952-T B-87.171.062 48.998.078-M
                var res = str.substring(8, 9);
                var str_end = false;
                var str_start = false;
                var new_nif = '';
                if(parseInt(res) || res == '0'){
                
                } else {
                    str_end = true;
                }
                res = str.substring(0, 1);
                if(parseInt(res)){
                
                } else {
                    str_start = true;
                }
                str = str.split("");
                if (str_start && str_end){
                   
                    number = str[0]+str[1]+'.'+str[2]+str[3]+str[4]+'.'+str[5]+str[6]+str[7]+'-'+str[8];
                } else if (str_start){
                    
                    number = str[0]+'-'+str[1]+str[2]+'.'+str[3]+str[4]+str[5]+'.'+str[6]+str[7]+str[8];
                } else if(str_end) {
                    
                    number = str[0]+str[1]+'.'+str[2]+str[3]+str[4]+'.'+str[5]+str[6]+str[7]+'-'+str[8];
                }
    
            }
            
            return number;
        }
    function nifFormat(e) {
        var number = $(e).val();
        number = number.replace(/[^a-zA-Z0-9]/g,'');
        if (number.length == 9) {
            //var str = "X8459952T";
            var str = number;
            //X8.459.952-T B-87.171.062 48.998.078-M
            var res = str.substring(8, 9);
            var str_end = false;
            var str_start = false;
            var new_nif = '';
            if(parseInt(res)){
            
            } else {
                str_end = true;
            }
            res = str.substring(0, 1);
            if(parseInt(res)){
            
            } else {
                str_start = true;
            }
            str = str.split("");
            if (str_start && str_end){
                number = str[0]+str[1]+'.'+str[2]+str[3]+str[4]+'.'+str[5]+str[6]+str[7]+'-'+str[8];
            } else if (str_start){
                number = str[0]+'-'+str[1]+str[2]+'.'+str[3]+str[4]+str[5]+'.'+str[6]+str[7]+str[8];
            } else if(str_end) {
                number = str[0]+str[1]+'.'+str[2]+str[3]+str[4]+'.'+str[5]+str[6]+str[7]+'-'+str[8];
            }
   
        }
        
        $(e).val(number.toUpperCase());
    }

    $(document).ready(function() {
        $.material.init();

        if (SYSTEM_GUEST) {
            $('#addTask').hide();
            $('#addSubTask').hide();
            $('#markCompletedSon').hide();
            $('#notifyEmailFather').hide();
            $('#notifyEmail').hide();
            $('#addSubTaskPlus').hide();
            $('#follow_mention').hide();

            if (SYSTEM_LINK == 'son') {
                $('#seeAsuntoGeneral').hide();
            }
            
        } else {
            addEventA();
        }// Fin SYSTEM GUEST

        addEventB();

        getTask();
        if (whereIAm.mode == 'Meeting') { 
            $('#to_know_where').html('Reunión');
        }
        if (whereIAm.mode == 'Project') { 
            $('#to_know_where').html('Anotación');
        }
        
        // Instantiate clipboard 
        var clipboard = new ClipboardJS('.btn_copy');
        clipboard.on('success', function(e) {
            console.log(e);
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });

        interval_task.runIntervalTask();

    });

    function addEventA() {
        $('#btn_add_asistente_cliente').click(function(){
            var url = '/task/editTaskA';
            if ($('#name_asistente_cliente').val() != '') {
                $.post(url,{'t_meeting_invited':'t_meeting_invited','id':whereIAm.taskFather,'name':$('#name_asistente_cliente').val(),'phone':$('#phone_asistente_cliente').val(),'email':$('#email_asistente_cliente').val(),'_token':'{{ csrf_token()}}'},function(result){
                    $('#name_asistente_cliente').val('');
                    $('#phone_asistente_cliente').val('');
                    $('#email_asistente_cliente').val('');
                    showMeetingInvited();
                });
            }
        });
        
        $('#documentaryReminder').click(function(){
            var other_user_can_edit_project = false;
            if (whereIAm.task.obj) {
                if ( whereIAm.task.obj.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            } else {
                if ( whereIAm.task.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            }

            if (whereIAm.task.lock || other_user_can_edit_project) {

            } else {
                updateDocumentaryReminder();
            }
           
        });

        $('#bookNoteBook').click(function(){
            var other_user_can_edit_project = false;
            if (whereIAm.task.obj) {
                if ( whereIAm.task.obj.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            } else {
                if ( whereIAm.task.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            }

            if (whereIAm.task.lock || other_user_can_edit_project) {

            } else {
                updateBookNoteBook();
            }
            
        });
    
        $('#t_taskDirectory').change(function(){
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'t_taskDirectory':$('#t_taskDirectory').val(),'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
            
            });
        });

        

        $('#t_generalTaskDirectory').change(function(){
            var url = '/task/editTaskA';
            $.post(url,{'whereIAm':whereIAm,'t_generalTaskDirectory':$('#t_generalTaskDirectory').val(),'id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
            
            });
        });
        

        $('#notifyEmail').click(function(){
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'notify':'notify','id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
            });
        });

        $('#notifyEmailFather').click(function(){
            var url = '/task/editTaskA';
            $.post(url,{'whereIAm':whereIAm,'notify':'notify','id':whereIAm.taskFather,'_token':'{{ csrf_token()}}'},function(result){
            });
        });

        

        $('#priority').click(function(){
            updatePriority();
        });

        $('#priorityFather').click(function(){
            updatePriority();
        });

        $('#workflow').click(function(){
            fillWorkflow('');
        });
    
    
        $(".deleteTaskButton").click(function(){
            deleteTask();
        });


        $('#myModalTeam').on('hidden.bs.modal', function () {
        // do something…
            formAssignedTeam();
            
        
        });

        $('#myModalTeamFather').on('hidden.bs.modal', function () {
        // do something…
            formAssignedTeamFather();
            
        });

        

        

        
        $('#descriptionSon').summernote({
            lang: 'es-ES',
            placeholder: 'Descripción',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold',]],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul']]
            ],
            callbacks: {
                onBlur: function() {
                    updateDescriptionSon($('#descriptionSon').summernote('code'));
                }
            }
        });

        $('#descriptionFather').summernote({
            lang: 'es-ES',
            placeholder: 'Descripción',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold',]],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul']]
            ],
            callbacks: {
                onBlur: function() {
                    updateDescriptionFather($('#descriptionFather').summernote('code'));
                }
            }
        });


$("#addSubTaskPlusMeeting").click(function(){
            $('#t-0001').hide('slow');
            $('#t-0000').hide('slow');
            $('#editTask').show('slow');
            $('#t-0002').css("opacity", "0.2");
            clearEditTask();
            var url = '/task/addTaskA';
            whereIAm.isMobile = isMobile.any();
            var whereIAm_temp = whereIAm;
            whereIAm_temp.mode = 'Meeting';
            whereIAm_temp.father_father = whereIAm.taskFather;

            $.post(url,{'whereIAm':whereIAm_temp,'_token':'{{ csrf_token()}}'},function(result){
                

                whereIAm = {
                    screen:"addTask",
                    taskFather:result.id,
                    taskSon:0,
                    listToRefresh:"subTaskList",
                    task:result.task,
                    taskFatherName:"",
                    activeUser: whereIAm.activeUser,
                    ordenSigno: whereIAm.ordenSigno,
                    mode: whereIAm.mode,
                    taskType: result.task.t_generalTaskType,
                    activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
                    isMobile:isMobile.any() 
                };
                interval_task.addTask(result.id,'father');
                $('#h_father').val('09');
                $('#m_father').val('00');
                $('#h_father_End').val('10');
                $('#m_father_end').val('00');

                $('#generalTaskId').val(result.id);
                $("#t_generalTaskTitle").focus();
                addClassCompletedButtonFather(result.id);
                showAssignedFather(result.taskAssigned, result.taskAssignedDefault);
                showDueDateFater(result.task.t_generalTaskDueDate, result.task.t_generalTaskDueDateEnd, result.task.t_generalTaskRepeatMode);
                showLocationFather(result.task.t_generalTaskLocation);
                showCustomerFather(result.task);
                showCreatedByFather(result.task.t_generalTaskUsuarioName);
                showPriority(result.task.t_generalTaskPriorityNumber);
                if (result.task.t_generalTaskType == 'Project') {
                    showDocumentaryReminder(result.task.t_generalTaskDocRec);
                    showBookNoteBook(result.task.t_generalTaskLibroCuaderno);
                    $('#status-task-fatherMeeting_open').click(); 
                    $('.only_in_project_b').show();
                } else {
                    $('.only_in_project_b').hide();
                }
                $('.deleteTaskButton').show();


                $('#markCompleted').show();

                if (result.task.t_generalTaskType == 'Meeting') {
                    $('.only_in_meeting').show();
                    $('.only_in_project').hide();
                    $('#closeTaskButtonFather').html('Finalizar Reunión');
                    $('.modalTeamFatherTitle').html('Asistente');
                    $('#deleteTaskButton').html('Eliminar Reunion');
                    $('#to_know_where').html('Reunión');
                } else if (result.task.t_generalTaskType == 'Project') {
                    $('.only_in_meeting').hide();
                    $('.only_in_project').show();
                    $('#markCompleted').hide();
                    $('.modalTeamFatherTitle').html('Mostrar');
                    $('#deleteTaskButton').html('Eliminar Anotación');
                    $('#to_know_where').html('Anotación');
                } else {
                    $('.only_in_meeting').hide();
                    $('.only_in_project').hide();
                    $('#closeTaskButtonFather').html('Finalizar Tarea');
                    $('.modalTeamFatherTitle').html('Asignar');
                    $('#deleteTaskButton').html('Eliminar Tarea');
                }
                    
                    // $('#bar_meeting_1').show();
                    // $('#bar_meeting_2').show();
                   
                
                
                
            });
        });

        $("#addTask").click(function(){
            $('#t-0001').hide('slow');
            $('#t-0000').hide('slow');
            $('#editTask').show('slow');
            $('#t-0002').css("opacity", "0.2");
            clearEditTask();
            var url = '/task/addTaskA';
            whereIAm.isMobile = isMobile.any();
            $.post(url,{'whereIAm':whereIAm,'_token':'{{ csrf_token()}}'},function(result){
                

                whereIAm = {
                    screen:"addTask",
                    taskFather:result.id,
                    taskSon:0,
                    listToRefresh:"subTaskList",
                    task:result.task,
                    taskFatherName:"",
                    activeUser: whereIAm.activeUser,
                    ordenSigno: whereIAm.ordenSigno,
                    mode: whereIAm.mode,
                    taskType: result.task.t_generalTaskType,
                    activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
                    isMobile:isMobile.any() 
                };
                interval_task.addTask(result.id,'father');
                $('#h_father').val('09');
                $('#m_father').val('00');
                $('#h_father_End').val('10');
                $('#m_father_end').val('00');

                $('#generalTaskId').val(result.id);
                $("#t_generalTaskTitle").focus();
                addClassCompletedButtonFather(result.id);
                showAssignedFather(result.taskAssigned, result.taskAssignedDefault);
                showDueDateFater(result.task.t_generalTaskDueDate, result.task.t_generalTaskDueDateEnd, result.task.t_generalTaskRepeatMode);
                showLocationFather(result.task.t_generalTaskLocation);
                showCustomerFather(result.task);
                showCreatedByFather(result.task.t_generalTaskUsuarioName);
                showPriority(result.task.t_generalTaskPriorityNumber);
                showCriticalDateFather(0);
                if (result.task.t_generalTaskType == 'Project') {
                    showDocumentaryReminder(result.task.t_generalTaskDocRec);
                    showBookNoteBook(result.task.t_generalTaskLibroCuaderno);
                    $('#status-task-fatherMeeting_open').click(); 
                    $('.only_in_project_b').show();
                } else {
                    $('.only_in_project_b').hide();
                }

                $('.deleteTaskButton').show();


                $('#markCompleted').show();

                if (result.task.t_generalTaskType == 'Meeting') {
                    $('.only_in_meeting').show();
                    $('.only_in_project').hide();
                    $('#closeTaskButtonFather').html('Finalizar Reunión');
                    $('.modalTeamFatherTitle').html('Asistente');
                    $('#deleteTaskButton').html('Eliminar Reunion');
                    $('#to_know_where').html('Reunión');
                } else if (result.task.t_generalTaskType == 'Project') {
                    $('.only_in_meeting').hide();
                    $('.only_in_project').show();
                    $('#markCompleted').hide();
                    $('.modalTeamFatherTitle').html('Mostrar');
                    $('#deleteTaskButton').html('Eliminar Anotación');
                    $('#to_know_where').html('Anotación');
                } else {
                    $('.only_in_meeting').hide();
                    $('.only_in_project').hide();
                    $('#closeTaskButtonFather').html('Finalizar Tarea');
                    $('.modalTeamFatherTitle').html('Asignar');
                    $('#deleteTaskButton').html('Eliminar Tarea');
                }
                    
                    // $('#bar_meeting_1').show();
                    // $('#bar_meeting_2').show();
                
                   
                
                
            });
        });

        
        $("#addSubTaskPlus").click(function(){
            if (whereIAm.task.lock) {

            } else {
                $('#editTask').hide('slow');
                $('#editSubTask').show('slow');
                clearEditSubTask();
                var url = '/task/addSubTask';
                whereIAm.isMobile = isMobile.any();
                $.post(url,{'whereIAm':whereIAm,'id':$('#generalTaskId').val(),'_token':'{{ csrf_token()}}'},function(result){
                
                    addClassCompletedButtonSon(result.id);
                    interval_task.addTask(result.id,'son');
                    whereIAm.taskSon = result.id;
                    whereIAm.screen = "addSubTask";
                    showAssigned(result.taskAssigned, result.taskAssignedDefault);
                    showDueDateSon(result.obj.t_taskDueDate, result.obj.t_taskRepeatMode);
                    showPriority(result.obj.t_taskPriorityNumber);
                    showCustomer(result.obj);
                    showWorkflow(result.obj);
                    document.getElementById("seeAsuntoGeneral").className = "btn  btn-sm btn-topTask task father me_" + result.father;
                    $('#t_taskTitle').focus();
                });
            }
        });

        $("#addSubTask").click(function(){
            if (whereIAm.task.lock) {

            } else {
                $('#editTask').hide('slow');
                $('#editSubTask').show('slow');
                clearEditSubTask();
                var url = '/task/addSubTask';
                whereIAm.isMobile = isMobile.any();
                $.post(url,{'whereIAm':whereIAm,'id':$('#generalTaskId').val(),'_token':'{{ csrf_token()}}'},function(result){
                
                    addClassCompletedButtonSon(result.id);
                    whereIAm.taskSon = result.id;
                    whereIAm.screen = "addSubTask";
                    showAssigned(result.taskAssigned, result.taskAssignedDefault);
                    showDueDateSon(result.obj.t_taskDueDate);
                    showPriority(result.obj.t_taskPriorityNumber);
                    showCreatedBySon(result.obj.t_taskUserName);
                    showCustomer(result.obj);
                    showWorkflow(result.obj);
                    document.getElementById("seeAsuntoGeneral").className = "btn  btn-sm btn-topTask task father me_" + result.father;
                    $('#t_taskTitle').focus();
                    $('.deleteTaskButton').show();
                    interval_task.addTask(result.id,'son');
                });
            }
        });

    
        $("#customerFather").click(function(){
            var other_user_can_edit_project = false;
            if (whereIAm.task.obj) {
                if ( whereIAm.task.obj.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            } else {
                if ( whereIAm.task.t_generalTaskType == 'Project') {
                    if (!whereIAm.task.can_edit) {
                        other_user_can_edit_project = true;
                    }
                }
            }

            if (whereIAm.task.lock || other_user_can_edit_project) {

            } else {
                $("#DivFormCustomer").toggle();
            }
           
        });

        $('#t_generalTaskTitle').change(function(){
            var url = '/task/editTaskA';
            $.post(url,{'t_generalTaskTitle':$('#t_generalTaskTitle').val(),'id':$('#generalTaskId').val(),'_token':'{{ csrf_token()}}'},function(result){
                whereIAm.task = result.task[0];
            });
        });

        $('#t_taskTitle').change(function(){
            var url = '/task/editTaskSon';
            $.post(url,{'whereIAm':whereIAm,'t_taskTitle':$('#t_taskTitle').val(),'id':whereIAm.taskSon,'_token':'{{ csrf_token()}}'},function(result){
            
            });
        });
        
        $('#cleanCustomer').click(function(){
            if (confirm('¿ Está seguro que desea limpiar Cliente ?')) {
                var url = '/task/editTaskA';
                $.post(url,{'cleanCustomer':'cleanCustomer','id':$('#generalTaskId').val(),'_token':'{{ csrf_token()}}'},function(result){
                    document.getElementById('fromEfiTask').reset();
                    showCustomerFather(result.task[0]);
                });
            }
        });
        
        $('#overwriteContact').click(function(){
            if (confirm('¿ Está seguro que desea sobrescribir los contacto en sub tareas ?')) {
                var url = '/task/editTaskA';
                $.post(url,{'overwriteContact':'overwriteContact','id':$('#generalTaskId').val(),'_token':'{{ csrf_token()}}'},function(result){
                
                });
            }
        });

        $('#createCustomer').click(function(){
            updateCustomer();

        });
        

        $('#t_clientesNif_1').blur(
            function(e){
                
                var url = '/task/nif';
                
                $.post(url,{'t_clientesNif_1':$('#t_clientesNif_1').val(),'_token':'{{ csrf_token()}}'},function(result){
                    
                    if (result.customer) {
                        $('#t_clientesNombre').val(result.customer.t_clientesNombre);
                        $("#t_clientesNombre").parent('div').removeClass('is-empty');
                        $('#t_clientesApellido').val(result.customer.t_clientesApellido);
                        $("#t_clientesApellido").parent('div').removeClass('is-empty');
                        $('#t_clientesNombre').attr('readonly', true);
                        $('#t_clientesApellido').attr('readonly', true);
                        $('#t_clientesTelefono').val(result.customer.t_clientesTelefono);
                        $("#t_clientesTelefono").parent('div').removeClass('is-empty');
                        
                        $('#t_clientesEmail').val(result.customer.t_clientesEmail);
                        $("#t_clientesEmail").parent('div').removeClass('is-empty');
                        $('#idt_clientes').val(result.customer.idt_clientes);
                        updateCustomer();
                        $('#DivFormCustomer3').hide('slow');
                        
                    
                    } else {
                        $('#t_clientesNombre').val('');
                        $('#t_clientesApellido').val('');
                        $('#t_clientesTelefono').val('');
                        $('#t_generalTaskCPContact').val();
                        $('#t_clientesEmail').val('');
                        $('#idt_clientes').val('');
                        $('#t_clientesNombre').attr('readonly', false);
                        $('#t_clientesApellido').attr('readonly', false);
                        if($('#t_clientesNif_1').val() != '') {
                            $('#DivFormCustomer3').show('slow');
                        } 
                    }
                });
            }
        );


        $("#searchCustomer").autocomplete({
            source:  function( request, response ) {
                var url = '/task/searchCustomer';
                $.post(url,{'search':$('#searchCustomer').val(),'_token':'{{ csrf_token()}}'},function(result){
                
                    response(result.customer)
                })
            },
            minLength: 1,
            select: function( event, ui ) {
            
                $('#t_clientesNif_1').val(addNifFormat(ui.item.c.t_clientesNif));
                $("#t_clientesNif_1").parent('div').removeClass('is-empty');
                $("#t_clientesNif_1").focus();
                $("#t_generalTaskTitle").focus();
                updateCustomer();
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>")
            .data("item.autocomplete", item)
            .append('<div>' + item.label + '</div>')
            .appendTo(ul);
        };

        $('#t_generalTaskCPContact').blur(function(){
            // if ($('#idt_clientes').val() != '') {
                updateCustomer();
            // }
        });
        $('#t_clientesTelefono').blur(function(){
            // if ($('#idt_clientes').val() != '') {
                updateCustomer();
            // }
        });
        $('#t_clientesEmail').blur(function(){
            // if ($('#idt_clientes').val() != '') {
                updateCustomer();
            // }
        });

    }

    function addEventB() {
        $("#addFatherTaskNotes").click(function(){
            if (whereIAm.task.lock) {

            } else {
                addNoteFather();
            }
            
        });

        $("#addNoteTop").click(function(){
            if (whereIAm.task.lock) {

            } else {
                addNoteSon(); 
            }
     
        });

        $("#addSubTaskDocuments").click(function(){
                
            $('#file_documentsSubTaskList').click();
        });

        $("#addFatherTaskDocuments").click(function(){
            if (whereIAm.task.lock) {

            } else {
                $('#file_documentsFatherTaskList').click();    
            }
        });

        $("#addDocumentTop").click(function(){
            $('#file_documentsSubTaskList').click();
        });

        $("#addSubTaskNotes").click(function(){
            addNoteSon();
        });

  
        $("#closeEditTask").click(function(){
            if ( ($('#t_generalTaskTitle').val() != ''  && $('#t_taskDueDateFather').val() != '') || whereIAm.taskType == 'Project' ) {
                whereIAm = {
                    screen:"main",
                    taskFather:0,
                    taskSon:0,
                    listToRefresh:"task",
                    task:"",
                    taskFatherName:"",
                    activeUser: whereIAm.activeUser,
                    ordenSigno: whereIAm.ordenSigno,
                    mode: whereIAm.mode,
                    activeUser: "{{sha1(md5(Session::get('user') -> idt_usuarios))}}",
                    isMobile:isMobile.any()

                };
                $('#editTask').hide('slow');
                $('#t-0001').show('slow');
                $('#t-0000').show('slow');
                clearEditTask();
                getTask();
                $('#t-0002').css("opacity", "1");
            } else {
                if ($('#t_taskDueDateFather').val() == '') {
                    $('#alertDivFather').html("Debe Seleccionar Fecha");
                }
                if ($('#t_generalTaskTitle').val() == '') {
                    $('#alertDivFather').html("Debe llenar Asunto");
                }
                $('#alertDivFather').show();
            }

        });

        $("#closeEditSubTask").click(function(){
            if ($('#t_taskDueDate').val() != '' && $('#t_taskTitle').val() != '') {
                $('#editSubTask').hide('slow');
                
                if (whereIAm.screen == 'main') {
                    $('#t-0001').show('slow');
                    $('#t-0000').show('slow');
                } else {
                    $('#editTask').show('slow');
                    whereIAm.screen = "addTask";
                    whereIAm.taskSon = 0;
                    whereIAm.listToRefresh = "subTaskList";
                }
                clearEditSubTask();
                getTask();
            } else {
                if ($('#t_taskDueDate').val() == '') {
                    $('#alertDivSon').html("Debe Seleccionar Fecha");
                }
                if ($('#t_taskTitle').val() == '') {
                    $('#alertDivSon').html("Debe llenar Asunto");
                }
                $('#alertDivSon').show();
            }
            
        });
        

        

        $(document).keyup(function(e) {
            if (e.key === "Escape") { // escape key maps to keycode `27`
                if (whereIAm.taskSon == '0') {
                    if (document.getElementById("editTask").style.display != "none") {
                        if($('#notesFatherTaskListNew').html() != ''){
                            $('#notesFatherTaskListNew').html('');
                            interval_task.doIt();
                        } else {
                            $('#t_generalTaskTitle').blur()
                            $("#closeEditTask").click();
                        }
                    }
                } else {
                    if (document.getElementById("editSubTask").style.display != "none") {
                       if($('#notesSubTaskListNew').html() != ''){
                            $('#notesSubTaskListNew').html('');
                            interval_task.doIt();
                        } else {
                            $('#t_taskTitle').blur()
                            $("#closeEditSubTask").click();
                        }
                    }
                }
            }
        });
    }
    


  
    </script>
<script src="{{ URL::asset('dist-calendar/vanillaCalendar.js')}}?v=<?php echo microtime();?>"></script>
<script>
    window.addEventListener('load', function () {
        calendar_1_son = createCalendarVanilla('id="t_taskDueDate"','calendar_1','dueDateClick');
        calendar_1_son.init({
            disablePastDays: false,
            new_date: ''
        });

        calendar_2_father = createCalendarVanilla('id="t_taskDueDateFather"','calendar_2','dueDateClickFather');
        calendar_2_father.init({
            disablePastDays: false,
            new_date: ''
        });
        
    })

</script>

    <style>
        .tooltip_2 {
            position: relative;
            display: inline-block;
            
        }
        #asistente_cliente_list{
            max-height: 120px;
            overflow-x: auto;
            background: aliceblue;
        }
        .asistente_cliente_list_item{
            border: 1px solid gainsboro;
            padding: 5px;
            margin-bottom: 5px;
            background: white;
            margin: 5;
        }

        .asistente_cliente_list_remover{
            background: #f36a6a;
            text-align: center;
            color: white;
            padding: 3px;
            box-shadow: 1px 1px 5px gainsboro;
            cursor: pointer;
        }
        .asistente_cliente_list_remover:hover{
            background: #c14d4d;

        }
        .tooltip_2 .tooltiptext_2 {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .tooltip_2 .tooltiptext_2::after {
            /* content: "";
            position: absolute;
            top: 20%;
            left: 100%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent; */

                content: "";
            position: absolute;
            top: -22%;
            left: 71%;
            margin-left: -5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
            transform: rotate(179deg);
        }

        .tooltip_2:hover .tooltiptext_2 {
            visibility: visible;
            opacity: 1;
        }
        .tooltip-left {
            /* top: -1px;
            bottom: auto;
            right: 128%; */

                top: 22px;
                bottom: auto;
                right: -347%;
        }
        .editNote{
            background-color: #ffc005;
            padding-left: 30px;
            padding-right: 30px;
            margin-left: 10px;
            color: white;
            border-radius: 3px;
            font-weight: 400;
            cursor: pointer;
        }
        .editNote:hover{
            background-color: #d8a200;
        }

        .anatacionInternaTitle{
            background-color: rgb(255, 244, 112);
            padding: 5px 2px 5px 10px;
            text-transform: capitalize;
            height: 30px;

        }
        .anatacionInternaBody{
            background-color: rgb(255, 252, 179);
            width: 100%;
            /* height: 60px; */
            font: normal 14px verdana;
            line-height: 25px;
            padding: 2px 10px;
            margin-bottom: 10px;
            border: none;
        }

        .btn-topTask{
            background-color: #f6f8f9;
            color: rgb(93, 93, 93);
            box-shadow: none;
            border: none;
            margin-left: 15px;
            padding-right: 10px; 
        }
        
        .btn-topTask:hover{
            background-color: #4be88f;
            color: white;
        }
         .deshacer{
            margin-left: 15px;
        }
        .deshacer:hover{
            background-color: #ff9800;
            color: white;
            border: none;
            margin-left: 15px;
        }
        .bottonAlert{
            background-color: white;
            height: 80px;
            width: 250px;
            position: fixed;
            bottom: 35;
            left: 0;
            box-shadow: 10px 5px 35px #8c8b8bba;
            z-index: 5;
            border-radius: 4px;
        }
        .bottonAlert-001{
            height: 10px;
            border-radius: 0px 4px 0px 0px;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2ddfe5+15,2ddfe5+15,2ad4ea+50,2dd9e2+74,7db9e8+100 */
            background: #2ddfe5; /* Old browsers */
            background: -moz-linear-gradient(left, #2ddfe5 15%, #2ddfe5 15%, #2ad4ea 50%, #2dd9e2 74%, #7db9e8 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(left, #2ddfe5 15%,#2ddfe5 15%,#2ad4ea 50%,#2dd9e2 74%,#7db9e8 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to right, #2ddfe5 15%,#2ddfe5 15%,#2ad4ea 50%,#2dd9e2 74%,#7db9e8 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2ddfe5', endColorstr='#7db9e8',GradientType=1 ); /* IE6-9 */
        }
        .bottonAlert-002{
            height: 70px;
        }
          
        .container{
            /* margin-bottom: 0px; */
        }
        body{
           /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6f8f9+1,f1f1f1+70,eaeaea+70,eaeaea+70 */
background: rgb(246,248,249); /* Old browsers */
background: -moz-linear-gradient(top, rgba(246,248,249,1) 1%, rgba(241,241,241,1) 70%, rgba(234,234,234,1) 70%, rgba(234,234,234,1) 70%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(246,248,249,1) 1%,rgba(241,241,241,1) 70%,rgba(234,234,234,1) 70%,rgba(234,234,234,1) 70%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(246,248,249,1) 1%,rgba(241,241,241,1) 70%,rgba(234,234,234,1) 70%,rgba(234,234,234,1) 70%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
        }
        #t-0001{
           /* height: 100%; */
           box-shadow: 6px 6px 20px -2px rgba(29, 29, 29, 0.15);
        }
        #t-0002{
            background-color: white;
            padding: 5px;
            border-radius: 5px 5px 0px 0px;
            height: 56px;
            margin-bottom: 4px;
        }
        #t-0003{
            background-color: white;
            min-height: 0px;
            height: calc(100vh - 30vh);
            overflow-y: auto;
            overflow-x: hidden;
            clear: both;
        }
        .t-0004{
            height: 53px;
            padding: 6px;
            border-bottom: 1px solid gainsboro;
            margin-bottom: 2px;
            border-radius: 5px 0px 0px 0px;
        }
        .t-0004:hover{
            background-color: #d8e0e859;
        }
        .t-0005{
            float: left;
            padding-top: 5px;

        }
        .t-0006{
            padding: 5px;
        }

        #t-0007{
            background-color: #f6f8f9;
        }

        #t-0009{
            padding: 15px;
            clear: both;
        }
        #t-0010{
            padding-left: 0px;
            background-color: #dcdcdc;
            padding: 5px;
            border-radius: 4px;
        }
        #t-0011{
            clear: both;
            padding: 0px 15px 1px 15px;
            margin-bottom: 0px;
        }

        .t-0012{
            height: 46px;
            width: auto;
            float: left;
            padding: 5px 10px 5px 5px;
            cursor: pointer;
            /* border: 1px solid white; */
        }
        .t-0012:hover{
            /* border: 1px solid gainsboro; */
            border-radius: 15px;
            padding: 5px 10px 5px 5px;
            background-color: whitesmoke;
            
        }
        .t-0013{
            background-color: #00adff;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 30px;
            border: 1px solid #419dff;
            text-align: center;
            padding: 6;
            float: left;
        }
        .t-0014{
            float: left;
            margin-left: 5px;
        }
        .t-0015{
            font-size: 12px;
            height: 16px;
            color: #a2a2a2;
        }
        .t-0016{
            text-transform: capitalize;
            font-size: 14px;
            font-weight: 400;
        }

        .t-0017{
            background-color: #00adff;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 30px;
            border: 1px solid #419dff;
            text-align: center;
            padding: 8;
            font-size: 16px;
            float: left;

        }

        .t-0018{
            float: right;
            color: #5f5f5f;
            font-size: 12px;
            margin-top: 12px;
            /* border: 1px solid gainsboro; */
            border-radius: 3px;
            padding-left: 10px;
            padding-right: 10px;
            width: 90px;
            margin-left: 4px;
            background-color: #f1f1f1;
        }

        .t-0019{
            height: 45px;

        }
        .t-0020{
            float: left;

        }
        .t-0021{
            float: right;
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .t-0022{
            float: left;
            padding: 10px;
            font-weight: bold;
            font-size: 16px;
            background-color: gainsboro;
            border-radius: 0px 15px 15px 0px;
            margin-top: -2px;
            margin-left: 15px;
            height: 40px;

        }

        .t-0023{
            float: right;
            font-size: 12px;
            text-shadow: -1px 0 #d4d4d4, 0 1px #d4d4d4, 1px 0 #d4d4d4, 0 -1px #d4d4d4;
            margin-top: 12px;
            margin-right: 5px;
            color: white;
            display: none;
        }
        .t-0024{
            float: right;
            font-size: 12px;
            color: #ff7979;
            margin-top: 11px;
            /* text-shadow: -1px 0 #9E9E9E, 0 1px #9E9E9E, 1px 0 #9E9E9E, 0 -1px #9E9E9E; */
            border-radius: 3px;
            background-color: #f1f1f1;
            margin-left: 4px;
            padding-left: 5px;
            padding-right: 5px;
            height: 22px;
        }
        
        .t-0025{
            margin-right: 5px;
            color: #5f5f5f;
            float: left;
            text-transform: capitalize;
        }
        

        .t-0026{
            float: right;
            margin-top: 12px;
            /* border: 1px solid gainsboro; */
            padding-left: 10px;
            border-radius: 3px;
            background-color: #f1f1f1;
            margin-left: 4px;
        }

        .t-0027{
            margin-right: 10px;
            color: #5f5f5f;
            float: left;
            text-transform: capitalize;
            padding-left: 2px;
            padding-right: 2px;
            background-color: #dcdcdc;
        }

        .t-0028{
            padding-left: 15px;
            padding-right: 15px;
            margin-bottom: 10px;
        }

        .t-0029{
            float: left;
            padding: 2px;
        }

        .t-0030{
            float: left;
        }

        .t-0031{
            float: left;
            margin-left: 15px;
            border: 1px solid gainsboro;
            border-radius: 4px;
            padding: 2;
            background-color: #ececec;
        }

        .t-0032{
            padding: 10px;
            margin-top: 2px;
            margin-bottom: 2px;
            background-color: #ffffff;
            color: #828181;
            padding-top: 2px;
            padding-bottom: 2px;
            font-size: 11px;

            height: 31;
        }

        .t-0033{
            float: right;
            background-color: #bdbbbb;
            color: white;
            padding: 4;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 1px 1px 10px #cacaca;
        }
        .t-0033:hover{
            background-color: #949393;
        }

        .t-0034{
            padding: 8px;
            font-weight: 400;
        }

        .t-0035{
            font-size: 30px;
            font-weight: 500;
            float: left;
            color: rgb(18, 143, 200);
        }

        .t-0036{
            float: left;
            padding: 5px;
            margin-left: 5px;
            color: #828282;
            margin-bottom: 5px;
            border-radius: 3px;
            cursor: pointer;
            width: 118px;
            text-align: center;
        }
        .t-0036:hover{
            float: left;
            padding: 5px;
            margin-left: 5px;
            color: white;
            cursor: pointer;
            background-color: #11989e;
            margin-bottom: 5px;
            border-radius: 3px;
            width: 118px;
            text-align: center;
        }
        .t-0037{
            cursor: pointer;
            float: left;
            padding: 5px;
            margin-left: 5px;
            background-color: #11989e;
            color: white;
            margin-bottom: 5px;
            border-radius: 3px;
            width: 118px;
            text-align: center;
        }
        .t-0038{
            border-bottom: 1px solid gainsboro;
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 4px;
            margin-top: 10px;
            font-weight: 400;
        }
        .t-0039{
            margin-top: 5px;
            color: #797979;
        }
        .t-0040{
            margin-left: 48px;
            margin-top: -12px;
            font-size: 11px;
        }
        .t-0041{
            background-color: #2196F3;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 25px;
            padding-right: 25px;
            cursor: pointer;
            color: white;
            border-radius: 3px;
        }
        .t-0041:hover{
            background-color: #146eb5;
        }

        .t-0042{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#3acaff+2,3acaff+3,d1f2ff+3,ffffff+3 */
// background: #3acaff; /* Old browsers */
// background: -moz-linear-gradient(-45deg,  #3acaff 2%, #3acaff 3%, #d1f2ff 3%, #ffffff 3%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  #3acaff 2%,#3acaff 3%,#d1f2ff 3%,#ffffff 3%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  #3acaff 2%,#3acaff 3%,#d1f2ff 3%,#ffffff 3%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3acaff', endColorstr='#ffffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
// background: #e1ffff; /* Old browsers */
// background: -moz-linear-gradient(-45deg,  #e1ffff 0%, #e1ffff 7%, #e1ffff 12%, #fdffff 12%, #e6f8fd 30%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  #e1ffff 0%,#e1ffff 7%,#e1ffff 12%,#fdffff 12%,#e6f8fd 30%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  #e1ffff 0%,#e1ffff 7%,#e1ffff 12%,#fdffff 12%,#e6f8fd 30%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e1ffff', endColorstr='#e6f8fd',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e1ffff+0,e1ffff+7,e1ffff+12,fdffff+12 */
// background: rgb(225,255,255); /* Old browsers */
// background: -moz-linear-gradient(-45deg,  rgba(225,255,255,1) 0%, rgba(225,255,255,1) 7%, rgba(225,255,255,1) 12%, rgba(253,255,255,1) 12%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  rgba(225,255,255,1) 0%,rgba(225,255,255,1) 7%,rgba(225,255,255,1) 12%,rgba(253,255,255,1) 12%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  rgba(225,255,255,1) 0%,rgba(225,255,255,1) 7%,rgba(225,255,255,1) 12%,rgba(253,255,255,1) 12%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e1ffff', endColorstr='#fdffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f1da36+5,fefcea+6 */
// background: rgb(241,218,54); /* Old browsers */
// background: -moz-linear-gradient(-45deg,  rgba(241,218,54,1) 5%, rgba(254,252,234,1) 6%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  rgba(241,218,54,1) 5%,rgba(254,252,234,1) 6%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  rgba(241,218,54,1) 5%,rgba(254,252,234,1) 6%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1da36', endColorstr='#fefcea',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fff200+5,fefcea+6 */
// background: rgb(255,242,0); /* Old browsers */
// background: -moz-linear-gradient(-45deg,  rgba(255,242,0,1) 5%, rgba(254,252,234,1) 6%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  rgba(255,242,0,1) 5%,rgba(254,252,234,1) 6%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  rgba(255,242,0,1) 5%,rgba(254,252,234,1) 6%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff200', endColorstr='#fefcea',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fff200+5,fcfcfc+5 */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fff200+5,ffffff+5 */
// background: rgb(255,242,0); /* Old browsers */
// background: -moz-linear-gradient(-45deg,  rgba(255,242,0,1) 5%, rgba(255,255,255,1) 5%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  rgba(255,242,0,1) 5%,rgba(255,255,255,1) 5%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  rgba(255,242,0,1) 5%,rgba(255,255,255,1) 5%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff200', endColorstr='#ffffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffe500+4,ffffff+5&1+0,0+100 */
background: -moz-linear-gradient(-45deg,  rgba(255,229,0,1) 0%, rgba(255,229,0,0.96) 4%, rgba(255,255,255,0.95) 5%, rgba(255,255,255,0) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-45deg,  rgba(255,229,0,1) 0%,rgba(255,229,0,0.96) 4%,rgba(255,255,255,0.95) 5%,rgba(255,255,255,0) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(135deg,  rgba(255,229,0,1) 0%,rgba(255,229,0,0.96) 4%,rgba(255,255,255,0.95) 5%,rgba(255,255,255,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffe500', endColorstr='#00ffffff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */


        }
        .t-0042:hover{
          
        }
        .t-0043{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e1ffff+0,e1ffff+7,e1ffff+12,fdffff+12,e6f8fd+30 */
// background: #e1ffff; /* Old browsers */
// background: -moz-linear-gradient(-45deg,  #e1ffff 0%, #e1ffff 7%, #e1ffff 12%, #fdffff 12%, #e6f8fd 30%); /* FF3.6-15 */
// background: -webkit-linear-gradient(-45deg,  #e1ffff 0%,#e1ffff 7%,#e1ffff 12%,#fdffff 12%,#e6f8fd 30%); /* Chrome10-25,Safari5.1-6 */
// background: linear-gradient(135deg,  #e1ffff 0%,#e1ffff 7%,#e1ffff 12%,#fdffff 12%,#e6f8fd 30%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
// filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e1ffff', endColorstr='#e6f8fd',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */



        }
        .t-0043:hover{
          
        }

        .t-0044{
            display: table;
            background: aliceblue;
            border: 1px solid #c6e2fb;
            padding: 3;
            border-radius: 3px;
            width: 100%;
            margin-bottom: 5px;
        }

        .t-0045{
            width: 100px;
            padding: 5px;
            color: white;
            border-radius: 0px 0px 15px 15px;
            /* margin-left: -3px; */
            text-align: center;
            /* margin-top: 3px; */
            box-shadow: 1px 1px 5px #0e0e0e47;
            font-weight: bold;
            margin-bottom: 3px;
            background: rgb(59,103,158);
            background: -moz-linear-gradient(45deg, rgba(59,103,158,1) 0%, rgba(43,136,217,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%);
            background: -webkit-linear-gradient(45deg, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%);
            background: linear-gradient(45deg, rgba(59,103,158,1) 0%,rgba(43,136,217,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b679e', endColorstr='#7db9e8',GradientType=1 );

        }

        .t-0046{
            border: none;
            width: 383px;
            padding: 8px;
            background-color: aliceblue;
            color: #4c4c4c;
            margin-top: 0px;
            font-size: 18px;
        }
        .t-0046:hover{
            
        }
        .t-0047{
            margin-left: -3px;
            padding: 10px;
            border: none;
            background-color: #94c8f5;
            height: 37px;
            color: white;
            border-radius: 0px 5px 5px 0px;
        }
        .t-0047:hover{
            background-color: #608fb7;
        }

        .t-0048{
            float: left;
            padding: 5px;
            margin-left: 5px;
            color: #828282;
            margin-bottom: 5px;
            border-radius: 3px;
            cursor: pointer;
            width: 118px;
            text-align: center;
        }
        .t-0048:hover{
            float: left;
            padding: 5px;
            margin-left: 5px;
            color: white;
            cursor: pointer;
            background-color: #11989e;
            margin-bottom: 5px;
            border-radius: 3px;
            width: 118px;
            text-align: center;
        }

        .t-0049{
            cursor: pointer;
            float: left;
            padding: 5px;
            margin-left: 5px;
            background-color: #11989e;
            color: white;
            margin-bottom: 5px;
            border-radius: 3px;
            width: 118px;
            text-align: center;
        }

        .t-0050{
            background: white;
            height: 35px;
            color: black;
        }

        .t-0051{
            background: #ffffff00;
        }

        #critical_date {
            clear: both;
            margin-top: 20px;
        }

         #critical_date_father {
            clear: both;
            margin-top: 20px;
        }

        #name_asistente_cliente{
            width: 300px;
            margin-bottom: 5px;
        }
        #phone_asistente_cliente{
            margin-bottom: 5px;
            width: 151px;
        }
        #email_asistente_cliente{
            width: 455px;
            margin-bottom: 5px;
        }
        #btn_add_asistente_cliente{
            width: 100%;
            clear: both;
            text-align: center;
        }
        #body_assined{
            height: 300px;
            overflow-y: auto;
            clear: both;
        }

        #body_assined_2{
            height: 300px;
            overflow-y: auto;
            clear: both;
        }
        
        #body_workflow_2{
            height: 250px;
            overflow-y: auto;
        }

        #body_workflow_search{
            padding: 10px;
            width: calc(99% - 15px);
            background-color: #ececec;
            margin-left: 10px;
            border: none;
            margin-top: 5px;
        }
        .search_team{
            padding: 10px;
            width: 100%;
            background-color: #ececec;
            border: none;
            margin-top: 5px;
        }
        #calendar_1{
            padding: 10;
        }
        
        .active-orden, .active-status-son, .active-doc_rec{
            background: #57b6ef;
            color: white;
        }

         
        .active-status{
            background: #57b6ef;
            color: white;
        }
        .active-show{
            background: #57b6ef;
            color: white;
        }

        .active-follow{
            background: #57b6ef;
            color: white;
        }

        #subTaskList{
            width: 100%;
            clear: both;
            padding: 1px 15px 15px 15px;
            margin-bottom: 20px;
        }
        #editTask{
            min-height: calc(100vh - 100px);
            /* height: 93vh; */
            /* height: calc(100vh - 79px); */
            box-shadow: 1px 1px 50px rgba(115, 115, 115, 0.38);
            /* position: relative; */
            /* top: -145px; */
            background-color: white;
            border: 3px solid white;
            border-radius: 5px;
            z-index: 98;
        }
        .team_radio{
            float: right;
            margin-top: 10px;
            margin-left: 10px;
        }

        #editSubTask{
            min-height: calc(100vh - 100px);
            /* height: calc(100vh - 79px); */
            box-shadow: 1px 1px 50px rgba(115, 115, 115, 0.38);
            /* position: relative; */
            /* top: -145px; */
            background-color: white;
            border: 3px solid white;
            border-radius: 5px;
            z-index: 99;
        }

        #totalTaskMain{
            float: right;
            margin-right: 26px;
            margin-top: 5px;
            font-size: 16px;
            font-family: Verdana, Geneva, sans-serif;
            background-color: #f6f7f8;
            border: 1px solid white;
            border-radius: 4px;
            color: #566d84;
            padding: 3px;
            box-shadow: inset 1px 3px 3px 0px #bbbaba;
            padding-left: 10px;
            padding-right: 10px;
        }

        #subTaskListText{
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
        }

        #subTaskListText::before{
            content: "Tareas";
        }

        #subTaskListMeeting{
            clear: both;
            width: 100%;
            padding: 1px 15px 15px 15px;
            margin-bottom: 20px;
        }

        #subTaskListTextMeeting {
            clear: both;
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
            width: 100%;
        }

        #subTaskListTextMeeting::before{
            content: "Reuniones";
        }

        #notesTaskListText{
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
        }
        #notesTaskListText::before{
            content: "Anotaciones";
        }

         #notesFatherTaskListText{
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
        }
        #notesFatherTaskListText::before{
            content: "Anotaciones";
        }

        #documentsTaskListText{
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
        }
        #documentsTaskListText::before{
            content: "Documentos";
        }

        #documentsFatherTaskListText{
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #d8d8d8;
            background-color: #f9f9f9;
        }
        #documentsFatherTaskListText::before{
            content: "Documentos";
        }

        

        #alertDivSon{
            color: white;
            clear: both;
            padding: 10;
            background-color: #fd5555;
        }
        #alertDivFather{
            color: white;
            clear: both;
            padding: 10;
            background-color: #fd5555;
        }

        #task{
            padding: 15px;
            padding-top: 0px;
            /* overflow-y: auto;
            height: calc(100vh - 35vh); */
        }

        .inputTask{
            background-color: #ffffff00;
            border: none;
            font-size: 14px;
            height: 30px;
            padding: 10px;
            width: 65%;
            cursor: pointer;
            color: #3e3e3e;
            font-weight: 400;

        }

        /* #addSubTask{
            background-color: #f6f8f9;
            color: rgb(93, 93, 93);
            box-shadow: none;
            border: 1px solid gainsboro;
        }
        #addSubTask:hover{
            background-color: gainsboro;;
            color: white;
        } */

         .deleteTaskButton{
            background-color: #ec2f2f;
            color: white;
            text-align: center;
            padding: 5px;
            border-radius: 3px;
            font-weight: 400;
            width: 200px;
            margin-left: 15px;
            cursor: pointer;
        }
        .deleteTaskButton:hover{
            background-color: #ce1313;
        }


        .only_in_meeting{
           
        }
        .completed{
            background-color: #4be88f;
        }

        #closeEditTask{
            float: right;
            font-size: 22px;
            color: grey;
            margin-top: 3px;
            padding: 8px;
        }
        #closeEditSubTask{
            float: right;
            font-size: 22px;
            color: grey;
            margin-top: 3px;
            padding: 8px;
        }
        .form-group {
            padding-bottom: 15px;
            margin: 0 0 0 0; 
        }


        .label__checkbox {
        display: none;
        }

        .label__check {
        display: inline-block;
        border-radius: 50%;
        border: 5px solid rgba(0,0,0,0.1);
        background: white;
        vertical-align: middle;
        margin-right: 10px;
        width: 2em;
        height: 2em;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: border .3s ease;
        color: white;
        
        i.icon {
            opacity: 0.2;
            font-size: ~'calc(1rem + 1vw)';
            color: transparent;
            transition: opacity .3s .1s ease;
            -webkit-text-stroke: 3px rgba(0,0,0,.5);
        }
        
        &:hover {
            border: 5px solid rgba(0,0,0,0.2);
        }
        }

        .label__checkbox:checked + .label__text .label__check {
        animation: check .5s cubic-bezier(0.895, 0.030, 0.685, 0.220) forwards;
        
        .icon {
            opacity: 1;
            transform: scale(0);
            color: white;
            -webkit-text-stroke: 0;
            animation: icon .3s cubic-bezier(1.000, 0.008, 0.565, 1.650) .1s 1 forwards;
        }
        }



        @keyframes icon {
            from {
                opacity: 0;
                transform: scale(0.3);
            }
            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes check {
            0% {
                width: 1.5em;
                height: 1.5em;
                border-width: 5px;
            }
            10% {
                width: 1.5em;
                height: 1.5em;
                opacity: 0.1;
                background: rgba(0,0,0,0.2);
                border-width: 15px;
            }
            12% {
                width: 1.5em;
                height: 1.5em;
                opacity: 0.4;
                background: rgba(0,0,0,0.1);
                border-width: 0;
            }
            50% {
                width: 2em;
                height: 2em;
                background: #00d478;
                border: 0;
                opacity: 0.6;
            }
            100% {
                width: 2em;
                height: 2em;
                background: #00d478;
                border: 0;
                opacity: 1;
            }
        }
        @media screen and (max-width:767px) {

            .t-0046{
                width: 225px;
            }
            .tooltip_2 .tooltiptext_2 {
                display: none;
                position: static;
            }
            #btn_add_asistente_cliente{
               
            }
            #nombre_asistente_cliente{
                width: 100%;
            }
            #apellido_asistente_cliente{
                width: 100%;
            }
            #email_asistente_cliente{
                width: 100%;
            }
            .removeForMobile{
                display: none !important;
            }
            .t-0040{
            margin-left: 48px;
            margin-top: -44px;
            font-size: 11px;
            float: left;
            }

            #t-0003{
                min-height: 100%;  
                height: unset;
                overflow-y: auto;
                overflow-x: hidden;

            }   
            .t-0004 {
                height: 75px;
            }
            .t-0006 {
                height: 70px;
            }
            .t-0005 {
                padding-top: 15px;
            }
            .t-0012{
                width: 100%;
            }
            
            .t-0020{
                width: 100%;
            }

            .inputTask{
                width: 220px;
            }

            #notifyEmail, #addNoteTop, #addDocumentTop, #seeAsuntoGeneral, #markCompletedSon {
                padding-left: 10px;
                padding-right: 10px;
            }
            
           
        }
    </style>
@endsection
