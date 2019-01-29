<?php
    date_default_timezone_set("Europe/Madrid");   
    $date = date_create(date('Y-m-d'));
    date_add($date, date_interval_create_from_date_string('1 days'));
    $d = date_format($date, 'Y-m-d');

    $servername = "localhost";
    $username = "sampablo002";
    $password = "sr8R9_8l";
    $dbname = "sistemastw";
    $conn = new mysqli($servername, $username, $password, $dbname);

$sql_users = "SELECT * FROM `t_usuarios`";
$result_users = $conn -> query($sql_users);
while ($u = mysqli_fetch_assoc($result_users)) {
    $send = false;
    $reunion = '';
    $body = '';
    $task = '';
    $follow = '';
   
  
    $sql_users_task = "(SELECT t_taskTitle,t_taskDueDate,t_generalTaskCName,t_taskPriorityNumber,t_taskAssignedType,t_taskStatus FROM t_generalTask, `t_task`, `t_taskAssigned` WHERE t_generalTask.idt_generalTask = t_task.t_generalTask_idt_generalTask AND `t_task`.`idt_task` = `t_taskAssigned`.`t_task_idt_task` AND `t_task`.`t_taskDependenceDone` = 1 AND ((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed') OR `t_task`.`t_taskStatus` IS null ) AND (`t_taskAssigned`.`t_taskAssignedType` = 'Realiza' OR `t_taskAssigned`.`t_taskAssignedType` = 'Valida') AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']." ) UNION (SELECT t_taskTitle,t_taskDueDate,t_generalTaskCName,t_taskPriorityNumber,('Realiza') as t_taskAssignedType,t_taskStatus  FROM t_generalTask, `t_task` WHERE t_generalTask.idt_generalTask = t_task.t_generalTask_idt_generalTask AND `t_task`.`t_taskDependenceDone` = 1 AND ((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed') OR `t_task`.`t_taskStatus` IS null ) AND `t_task`.t_taskUserCreated = ".$u['idt_usuarios']." AND `t_task`.`idt_task` NOT IN (SELECT t_taskAssigned.t_task_idt_task as idt_task FROM t_taskAssigned WHERE t_taskAssigned.t_task_idt_task != '') ) UNION (SELECT (t_generalTask.t_generalTaskTitle) as t_taskTitle,(t_generalTask.t_generalTaskDueDate) as t_taskDueDate,t_generalTaskCName,(0) as t_taskPriorityNumber,('Realiza') as t_taskAssignedType,(t_generalTask.t_generalTaskStatus) as t_taskStatus FROM `t_generalTask` where   `t_generalTaskType` = 'GeneralTask' AND `t_generalTask`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']." AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND  t_generalTask.idt_generalTask NOT IN (SELECT DISTINCT(t_generalTask_idt_generalTask) as idt_generalTask FROM `t_task`) AND t_generalTask.idt_generalTask NOT IN (SELECT (t_generalTask_idt_generalTask) as idt_generalTask  FROM `t_taskAssigned`  WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` IS NOT NULL) ) UNION (SELECT (t_generalTask.t_generalTaskTitle) as t_taskTitle,(t_generalTask.t_generalTaskDueDate) as t_taskDueDate,t_generalTaskCName,(0) as t_taskPriorityNumber, t_taskAssignedType,(t_generalTask.t_generalTaskStatus) as t_taskStatus FROM `t_generalTask`, `t_taskAssigned` where   `t_generalTaskType` = 'GeneralTask'  AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']." AND  t_generalTask.idt_generalTask NOT IN (SELECT DISTINCT(t_generalTask_idt_generalTask) as idt_generalTask FROM `t_task`)) ORDER BY `t_taskDueDate` ASC";
    $result_users_task = $conn -> query($sql_users_task);
    
    if ($result_users_task -> num_rows >0) {
        $send = true;
        
        $task = '<h3>Te presentamos un resumen de tareas pendientes.</h3>';
        $task .= '<h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer el detalle de las tareas, agregar tareas nuevas o marcar una tarea como finalizada: </h4>';
        $task .=  '<a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$u['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>';
       
        while ($row = mysqli_fetch_assoc($result_users_task)) {
            $show = true;
            if ($row['t_taskAssignedType'] == 'Realiza' && $row['t_taskStatus'] == 'waiting_validation') {
                $show = false;
            }

            if ($row['t_taskAssignedType'] == 'Valida' && $row['t_taskStatus'] != 'waiting_validation') {
                $show = false;
            }

            if ($show) {
                if ($row['t_taskDueDate'] != '') {
                    $row['t_taskDueDate'] = explode(" ", $row['t_taskDueDate']);
                    $row['t_taskDueDate'] = $row['t_taskDueDate'][0];
                    $row['t_taskDueDate'] = explode("-", $row['t_taskDueDate']);
                    $row['t_taskDueDate'] = $row['t_taskDueDate'][2].'-'.$row['t_taskDueDate'][1].'-'.$row['t_taskDueDate'][0];
                }
                $urgente = '';
                if ($row['t_taskPriorityNumber'] == 1) {
                    $urgente = '<span style="color: #fffefe;font-weight: bold;background-color: #ff3333; margin-left: 20px;">&nbsp;&nbsp; ALTA &nbsp;&nbsp;</span>';
                }
                $task .= '<div style=" min-height: 50px; clear: both;border: 2px solid gainsboro;padding: 5px;margin-bottom: 10px;background-color: white;gainsboro;">
                        <div style="background-color: white; min-height: 20px; font-size: 14px;margin-top: 4px;"><span style=" font-weight: 600;">'. utf8_encode($row['t_taskTitle']).'</span></div>
                        
                        <div style=" font-size: 12px;">Cliente: '.$row['t_generalTaskCName'].'</div>
                        <div style=" color: #03A9F4;font-size: 12px;">Fecha: '.$row['t_taskDueDate'].' '.$urgente.'</div>
                        </div> <br>';
            }
        }

        
    }


    $sql_users_meeting = "SELECT DISTINCT(`t_generalTask`.`idt_generalTask`) as id, (`t_generalTask`.`t_generalTaskTitle`) as title, (`t_generalTask`.`t_generalTaskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer  FROM `t_generalTask` where  ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND  `t_generalTaskType` = 'Meeting' AND `t_generalTask`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']."  ORDER BY `t_generalTask`.`t_generalTaskDueDate` ASC";
    $result_users_meeting = $conn -> query($sql_users_meeting);
    if ($result_users_meeting -> num_rows >0) {
        $send = true;
       
        $reunion = '<h3>Te presentamos un resumen de reuniones pendientes.</h3>';
        $reunion .= '<h4 style=" font-weight: 100;" >Para ingresar al sistema y agregar una nueva reunión, consultar una reunión o agregar comentarios a la reuniones:</h4>';
            $reunion .=  '<a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$u['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>';
        
        while ($row = mysqli_fetch_assoc($result_users_meeting)) {
            $reunion .= taskHtml($row);
        }
    }

    $sql_users_meeting = "SELECT DISTINCT(`t_generalTask`.`idt_generalTask`) as id, (`t_generalTask`.`t_generalTaskTitle`) as title, (`t_generalTask`.`t_generalTaskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer  FROM `t_generalTask`, `t_taskAssigned` where  ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND  `t_generalTaskType` = 'Meeting' AND `t_generalTask`.`t_usuarios_idt_usuarios` != ".$u['idt_usuarios']." AND   `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask`  AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']."   ORDER BY `t_generalTask`.`t_generalTaskDueDate` ASC";
    $result_users_meeting = $conn -> query($sql_users_meeting);
    if ($result_users_meeting -> num_rows >0) {
        $send = true;
        if ($reunion == '') {
            $reunion = '<h3>Te presentamos un resumen de reuniones pendientes.</h3>';
            $reunion .= '<h4 style=" font-weight: 100;" >Para ingresar al sistema y agregar una nueva reunión, consultar una reunión o agregar comentarios a la reuniones:</h4>';
            $reunion .=  '<a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$u['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>';
        
        }
       
        while ($row = mysqli_fetch_assoc($result_users_meeting)) {
           
            $reunion .= taskHtml($row);
        }

        
    }
    
    $sql_users_follow = "(SELECT DISTINCT(`t_generalTask`.`idt_generalTask`) as id, (`t_generalTask`.`t_generalTaskTitle`) as title, (`t_generalTask`.`t_generalTaskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer  FROM `t_generalTask`, `t_taskAssigned` WHERE `t_generalTaskType` = 'GeneralTask' AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND t_generalTask.t_usuarios_idt_usuarios =  ".$u['idt_usuarios']." AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE t_taskAssigned.t_usuarios_idt_usuarios =  ".$u['idt_usuarios']." AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL))  UNION  
                              (SELECT (`t_generalTask`.`idt_generalTask`) as id, (`t_generalTask`.`t_generalTaskTitle`) as title, (`t_generalTask`.`t_generalTaskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer  FROM `t_generalTask`, `t_taskAssigned` WHERE `t_generalTaskType` = 'GeneralTask' AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted') OR t_generalTaskStatus is null) AND ((t_generalTaskStatus != 'Completed' AND t_generalTaskStatus != 'Deleted' AND t_generalTaskStatus != 'waiting_validation' ) OR t_generalTaskStatus is null) AND `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` AND t_generalTask.t_usuarios_idt_usuarios =  ".$u['idt_usuarios']." AND t_taskAssigned.t_usuarios_idt_usuarios =  ".$u['idt_usuarios']." AND t_generalTask.idt_generalTask NOT IN (SELECT (t_taskAssigned.t_generalTask_idt_generalTask) as idt_generalTask FROM `t_taskAssigned` WHERE t_taskAssigned.t_usuarios_idt_usuarios = ".$u['idt_usuarios']." AND t_taskAssigned.t_taskAssignedType != 'Valida' AND t_taskAssigned.t_generalTask_idt_generalTask IS NOT NULL)) UNION 
                              (SELECT (`t_generalTask`.`idt_generalTask`) as id, (`t_task`.`t_taskTitle`) as title, (`t_task`.`t_taskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer   FROM  `t_generalTask`,`t_task`, `t_taskAssigned` WHERE  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND   ((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed' AND `t_task`.`t_taskStatus` !='waiting_validation') OR `t_task`.`t_taskStatus` IS null ) AND `t_task`.`t_taskDependenceDone` = ".$u['idt_usuarios']." AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask`  AND t_task.t_taskUserCreated = ".$u['idt_usuarios']." AND t_task.idt_task NOT IN  (SELECT (t_taskAssigned.t_task_idt_task) as idt_task FROM `t_taskAssigned` WHERE t_taskAssigned.t_usuarios_idt_usuarios = ".$u['idt_usuarios']." AND t_taskAssigned.t_task_idt_task IS NOT NULL)) UNION 
                              (SELECT (`t_generalTask`.`idt_generalTask`) as id, (`t_task`.`t_taskTitle`) as title, (`t_task`.`t_taskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer    FROM `t_generalTask`, `t_task`, `t_taskAssigned` WHERE ((`t_task`.`t_taskStatus` !='Deleted' AND `t_task`.`t_taskStatus` !='Completed' AND `t_task`.`t_taskStatus` !='waiting_validation') OR `t_task`.`t_taskStatus` IS null ) AND `t_generalTask`.`idt_generalTask` = `t_task`.`t_generalTask_idt_generalTask` AND  `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` AND `t_taskAssigned`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']." AND `t_taskAssigned`.`t_taskAssignedType` = 'Valida')";
    $result_users_follow = $conn -> query($sql_users_follow);
    if ($result_users_follow -> num_rows >0) {
        
        $follow  = '<h3>Te presentamos un resumen de tareas en Seguimientos. </h3>';
        $follow .=  '<a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$u['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>';
        while ($row = mysqli_fetch_assoc($result_users_follow)) {
            
            $follow .= taskHtml($row);
        }
    }


    if ($send) {
        if ($u['t_usuariosEmail'] != '') {
           $body = '<html>
                    <head></head>
                    <body style="font-family: Verdana,sans-serif;">
                        
                            <div style=" "><img src="cid:logo_html" style="height:60px;"></div>
                            <br>
                            <br>
                            Buenos días '. utf8_encode($u['t_usuariosNombre'].' '.$u['t_usuariosApellido']).',
                            <br>
                            <br>
                            '.$task.'
                            <br>
                            '.$reunion.'
                            <br> 
                            '.$follow.'
                    </body>
                </html>';
            sendEmail($u['t_usuariosEmail'], 'Resumen Diario Tareas y Reuniones', $body,  utf8_encode($u['t_usuariosNombre'].' '.$u['t_usuariosApellido']));
        }
    }

      
    
}

// RUN FUNCTION

renewRecordatorios();
searchReminder();

// END


function taskHtml($p)
{
    // title customer date
    if ($p['date'] != '') {
        $p['date'] = explode(" ", $p['date']);
        $p['date'] = $p['date'][0];
        $p['date'] = explode("-", $p['date']);
        $p['date'] = $p['date'][2].'-'.$p['date'][1].'-'.$p['date'][0];
    }
    $html = '';
    $html .= '<div style=" min-height: 50px; clear: both;border: 2px solid gainsboro;padding: 5px;margin-bottom: 10px;background-color: white;gainsboro;">
    <div style=" min-height: 20px;font-size: 14px;margin-top: 4px;"><span style=" font-weight: 600;">'. utf8_encode($p['title']).'</span></div>
    <div style=" font-size: 12px;">Cliente: '.$p['customer'].'</div>
    <div style=" color: #03A9F4;font-size: 12px;">Fecha: '.$p['date'].'</div>
    </div> <br>';
    return $html;
}



/**
 * Function : renewRecordatorios
 * it will change the recordatorio date when the date have been past 
 * 
 * */
function renewRecordatorios()
{
    $servername = "localhost";
    $username = "sampablo002";
    $password = "sr8R9_8l";
    $dbname = "sistemastw";
    $conn = new mysqli($servername, $username, $password, $dbname);

    echo 'renewRecordatorios';
    $sql_recordatorios = "SELECT * FROM `t_generalTask` WHERE `t_generalTask`.`t_generalTaskDocRec` = 'Recordatorio' AND  `t_generalTask`.`t_generalTaskStatus` IS NULL AND `t_generalTask`.`t_generalTaskDueDate` < CURRENT_DATE";
    $result_recordatorios = $conn -> query($sql_recordatorios);
    while ($r = mysqli_fetch_assoc($result_recordatorios)) { 
        echo $r['idt_generalTask'].'<br>';
        echo $r['t_generalTaskDocRec'].'<br>';
        echo $r['t_generalTaskStatus'].'<br>';
        echo $r['t_generalTaskDueDate'].'<br>';
        echo $r['t_generalTaskRepeatMode'].'<br>';

        if ($r['t_generalTaskRepeatMode'] != '' && $r['t_generalTaskRepeatMode'] != 'no_repeart') {
            $new_due_date =  getNewDate($r['t_generalTaskDueDate'], $r['t_generalTaskRepeatMode']);
            echo  $sql_updated_recordatorios = "UPDATE `t_generalTask` SET t_generalTaskDueDate = '".$new_due_date."' WHERE `t_generalTask`.`idt_generalTask` = ".$r['idt_generalTask'].";";
            $result_updated_recordatorios = $conn -> query($sql_updated_recordatorios);
           
            echo 'task Repeart '.$new_due_date.' <br>';
        } else {
            $sql_updated_recordatorios = "UPDATE `t_generalTask` SET `t_generalTaskStatus` = 'Completed' WHERE `t_generalTask`.`idt_generalTask` = ".$r['idt_generalTask'].";";
            $result_updated_recordatorios = $conn -> query($sql_updated_recordatorios);
            echo ' task END <br>';
        }
        echo '<br><br>';
    }
}

function getNewDate($t_taskDueDate,$t_taskRepeatMode)
{
    
    $new_due_date = $t_taskDueDate;
    $temp_date = date('d', strtotime($t_taskDueDate));
    $use_last_day = false;
    if ($temp_date > 28) {
       
        if ($t_taskRepeatMode != 'yearly' && $t_taskRepeatMode != 'daily'  && $t_taskRepeatMode != 'weekly') {
            $use_last_day = true;
            $new_due_date = date('Y-m-d H:i:s', strtotime('-4 day', strtotime($new_due_date))); 
        }
    }

    if ($t_taskRepeatMode == 'daily') {
        $new_due_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($new_due_date))); 
    }

    if ($t_taskRepeatMode == 'weekly') { 
        $new_due_date = date('Y-m-d H:i:s', strtotime('+1 week', strtotime($new_due_date))); 
    }
    
    if ($t_taskRepeatMode == 'lastDay') { 
        $temp_day = explode(' ', $new_due_date);
        $temp_day_2 = explode('-', $temp_day[0]);
        $temp_day_2 = $temp_day_2[0].'-'.$temp_day_2[1].'-01 '.$temp_day[1];
        $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($temp_day_2)));
        $lastday = date('t', strtotime($new_due_date));

        $temp_day = explode(' ', $new_due_date);
        $temp_day_2 = explode('-', $temp_day[0]);
        $new_due_date = $temp_day_2[0].'-'.$temp_day_2[1].'-'.$lastday.' '.$temp_day[1];
    }

    if ($t_taskRepeatMode == 'monthly') { 
        if ($use_last_day) {
            $new_due_date = date('Y-m-t H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
        } else {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($new_due_date))); 
        }
    }

    if ($t_taskRepeatMode == 'quarterly') { 
        if ($use_last_day) {
            $new_due_date = date('Y-m-t H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
        } else {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+3 months', strtotime($new_due_date))); 
        }
    }

    if ($t_taskRepeatMode == 'biannual') { 
        if ($use_last_day) {
            $new_due_date = date('Y-m-t H:i:s', strtotime('+6 months', strtotime($new_due_date))); 
        } else {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+6 months', strtotime($new_due_date)));
        }
    }

    if ($t_taskRepeatMode == 'yearly') {
        if ($use_last_day) {
            $new_due_date = date('Y-m-t H:i:s', strtotime('+1 years', strtotime($new_due_date))); 
        } else {
            $new_due_date = date('Y-m-d H:i:s', strtotime('+1 years', strtotime($new_due_date))); 
        }
    }

    return $new_due_date;

}


/**
 * Function Buscar Recordatorio
 */

function searchReminder() 
{
    $servername = "localhost";
    $username = "sampablo002";
    $password = "sr8R9_8l";
    $dbname = "sistemastw";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql_users = "SELECT * FROM `t_usuarios`";
    $result_users = $conn -> query($sql_users);
    while ($u = mysqli_fetch_assoc($result_users)) {
        $body_html = '';
        $send = false;
        echo '<br><br>';
        $body_html = '<h3>Te presentamos un resumen de recordatorios.</h3>';
        $body_html .= '<h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer más detalles: </h4>';
        $body_html .=  '<a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$u['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>';
       
        $sql_recordatorios = "SELECT DISTINCT(`t_generalTask`.`idt_generalTask`) as id, (`t_generalTask`.`t_generalTaskTitle`) as title, (`t_generalTask`.`t_generalTaskDueDate`) as 'date', (`t_generalTask`.`t_generalTaskCName`) as customer  FROM `t_generalTask` WHERE `t_generalTask`.`t_generalTaskDocRec` = 'Recordatorio' AND  `t_generalTask`.`t_generalTaskStatus` IS NULL AND `t_generalTask`.`t_generalTaskDueDate` like '".date('Y-m-d')."%' AND (`t_generalTask`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']." OR `t_generalTask`.`idt_generalTask` IN (SELECT `t_taskAssigned`.`t_generalTask_idt_generalTask` as idt_generalTask FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_usuarios_idt_usuarios` = ".$u['idt_usuarios']."  AND `t_taskAssigned`.`t_generalTask_idt_generalTask` IS NOT NULL))";
        $result_recordatorios = $conn -> query($sql_recordatorios);
        while ($r = mysqli_fetch_assoc($result_recordatorios)) {
            $body_html .= reminderHtml($r);
            $send = true;
        }
        if ($send) {
            if ($u['t_usuariosEmail'] != '') {
                $body = '<html>
                        <head></head>
                        <body style="font-family: Verdana,sans-serif;">
                            <div style=" "><img src="cid:logo_html" style="height:60px;"></div>
                            <br>
                            <br>
                            Buenos días '. utf8_encode($u['t_usuariosNombre'].' '.$u['t_usuariosApellido']).',
                            <br>
                            <br>
                            '.$body_html.'
                        </body>
                    </html>';
                sendEmail($u['t_usuariosEmail'], 'Resumen Diario Recordatorios', $body,  utf8_encode($u['t_usuariosNombre'].' '.$u['t_usuariosApellido']));
            }
        }
    
        
    }
}


function reminderHtml($p)
{
    // title customer date
    if ($p['date'] != '') {
        $p['date'] = explode(" ", $p['date']);
        $p['date'] = $p['date'][0];
        $p['date'] = explode("-", $p['date']);
        $p['date'] = $p['date'][2].'-'.$p['date'][1].'-'.$p['date'][0];
    }
    $html = '';
    $html .= '<div style=" min-height: 50px; clear: both;border: 2px solid gainsboro;padding: 5px;margin-bottom: 10px;background-color: white;gainsboro;">
    <div style=" min-height: 20px;font-size: 14px;margin-top: 4px;"><span style=" font-weight: 600;">'. utf8_encode($p['title']).'</span></div>
    <div style=" font-size: 12px;">Cliente: '.$p['customer'].'</div>
    <div style=" color: #03A9F4;font-size: 12px;">Fecha: '.$p['date'].'</div>
    </div> <br>';
    return $html;
}





function sendEmail($email, $subject, $body, $name)
{
    include_once  'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true;
    $mail->Host = 'secure.emailsrvr.com';
    $mail->Username = 'presupuestos@mhf.es';
    $mail->Password = 'Presu2018';
    $mail->SMTPSecure = 'TLS';
    $mail->Port = 587;
    $mail->From = 'presupuestos@mhf.es';
    $mail->FromName = 'Sistema Sampablo';
    $mail->AddReplyTo('presupuestos@mhf.es', 'Sistema Sampablo');
    $mail->AddAddress($email, $name);
    $mail->Subject = $subject;
    $mail->AddEmbeddedImage('logo_sm.png', 'logo_html', 'logo_sm.png');
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Body = $body;
    $mail->Send();

}
?>