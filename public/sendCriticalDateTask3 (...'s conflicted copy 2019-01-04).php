<?php
date_default_timezone_set("Europe/Madrid");   
// $date = date_create(date('Y-m-d'));
// date_add($date, date_interval_create_from_date_string('1 days'));
// $d = date_format($date, 'Y-m-d');


// $nuevafecha = date ( 'Y-m-s' , strtotime() );

$servername = "localhost";
$username = "sampablo002";
$password = "sr8R9_8l";
$dbname = "sistemastw";
$conn = new mysqli($servername, $username, $password, $dbname);

$jose_antonio = getUserData(13);
$send_to_ja_task = array();
$send_to_ja_subtask = array();


$sql_task = "SELECT *, t_generalTask.t_usuarios_idt_usuarios as user_create, t_taskAssigned.t_usuarios_idt_usuarios as assigned_user FROM `t_generalTask` LEFT JOIN `t_taskAssigned` ON `t_taskAssigned`.`t_generalTask_idt_generalTask` = `t_generalTask`.`idt_generalTask` WHERE `t_generalTask`.`t_generalTaskCriticalDate` = 1 AND `t_generalTask`.`t_generalTaskStatus` IS NULL";
$result_task = $conn -> query($sql_task);
while ($t = mysqli_fetch_assoc($result_task)) {
    $is_it_jose_antonio = false;
    $p_all = array();
    //Get User 
    if ($t['assigned_user'] != '') {
       
        $sql_task_assigned = "SELECT * FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_generalTask_idt_generalTask` = ".$t['idt_generalTask'];
        $result_task_assigned = $conn -> query($sql_task_assigned);
        while ($t_user_assigned = mysqli_fetch_assoc($result_task_assigned)) {
            $user_data = getUserData($t_user_assigned['t_usuarios_idt_usuarios']);
            $p_all[] = array(
                'date' => changeDateEs($t['t_generalTaskDueDate']),
                'customer' => $t['t_generalTaskCName'],
                'title' => $t['t_generalTaskTitle'],
                't_usuariosNombre' => $user_data -> t_usuariosNombre,
                't_usuariosApellido' => $user_data -> t_usuariosApellido,
                't_usuariosEmail' => $user_data -> t_usuariosEmail,
                't_usuariosReferencia' => $user_data -> t_usuariosReferencia,
                't_usuariosTelefono' => $user_data -> t_usuariosTelefono,
                'usuario_reposnsable' => ''
            );
            
            if ($t_user_assigned['t_usuarios_idt_usuarios'] == 13) {
                $is_it_jose_antonio = true;
            }
        }
        
        
    } else {
        $user_data = getUserData($t['user_create']);
        // Create Email Array
        $p_all[] = array(
            'date' => changeDateEs($t['t_generalTaskDueDate']),
            'customer' => $t['t_generalTaskCName'],
            'title' => $t['t_generalTaskTitle'],
            't_usuariosNombre' => $user_data -> t_usuariosNombre,
            't_usuariosApellido' => $user_data -> t_usuariosApellido,
            't_usuariosEmail' => $user_data -> t_usuariosEmail,
            't_usuariosReferencia' => $user_data -> t_usuariosReferencia,
            't_usuariosTelefono' => $user_data -> t_usuariosTelefono,
            'usuario_reposnsable' => ''
        );
        if ($user_data -> idt_usuarios == 13) {
            $is_it_jose_antonio = true;
        }
    }

    

    // creates DateTime objects 
    $today  = date_create(date('Y-m-d'));
    $due_day = date_create(date('Y-m-d', strtotime($t['t_generalTaskDueDate'])));
    
    // calculates the difference between DateTime objects 
    $interval = date_diff($today, $due_day); 
    $diff_date =  $interval -> days;
    
    if ($interval -> invert == 1) {
        $diff_date = 0;
    }
    if (!isset($send_to_ja_task[$t['idt_generalTask']])) {
        foreach ($p_all as $p) {
            $send_copy = false;
            $mode_1 = false;
            if ($diff_date <= 0) {
                buildEmail($p);
                updateLastSent('t_generalTaskLastSent', $t['idt_generalTask']);
                sendSms($p);
                $mode_1 = true;
                $send_copy = true;
            } elseif ($diff_date <= 3) {
                $send = true;
                $last_send = $t['t_generalTaskLastSent'];
                if ($last_send != '') {
                    $last_send = date_create(date('Y-m-d', strtotime($t['t_generalTaskLastSent'])));
                    if ($last_send == $today) {
                        $send = false;
                    }
                }
        
                if ($send) {
                    buildEmail($p);
                    $send_copy = true;
                }
                updateLastSent('t_generalTaskLastSent', $t['idt_generalTask']);
            }
        }
       
        if ($send_copy && !$is_it_jose_antonio) {
           
            $p = array(
                'date' => changeDateEs($t['t_generalTaskDueDate']),
                'customer' => $t['t_generalTaskCName'],
                'title' => $t['t_generalTaskTitle'],
                't_usuariosNombre' => $jose_antonio -> t_usuariosNombre .' '.$jose_antonio -> t_usuariosApellido,
                't_usuariosApellido' => '',
                't_usuariosEmail' => $jose_antonio -> t_usuariosEmail,
                't_usuariosReferencia' => $jose_antonio -> t_usuariosReferencia,
                't_usuariosTelefono' => $jose_antonio -> t_usuariosTelefono,
                'usuario_reposnsable' => ' de '.$user_data -> t_usuariosNombre .' '.$user_data -> t_usuariosApellido
            );

           
            buildEmail($p);
            if ($mode_1) {
                sendSms($p);
            }
        }
        
        $send_to_ja_task[$t['idt_generalTask']] = $t['idt_generalTask'];
    }
    echo '<br><br>';
}

$p_all = array();
$sql_task = "SELECT *, t_task.t_taskUserCreated as user_create, t_taskAssigned.t_usuarios_idt_usuarios as assigned_user FROM t_generalTask, `t_task` LEFT JOIN `t_taskAssigned` ON `t_taskAssigned`.`t_task_idt_task` = `t_task`.`idt_task` WHERE `t_task`.`t_taskCriticalDay` = 1 AND `t_task`.`t_taskStatus` IS NULL AND t_generalTask.idt_generalTask = t_task.t_generalTask_idt_generalTask";
$result_task = $conn -> query($sql_task);
while ($t = mysqli_fetch_assoc($result_task)) {
    $is_it_jose_antonio = false;
    $p_all = array();
    //Get User 
    if ($t['assigned_user'] != '') {
        $sql_task_assigned = "SELECT * FROM `t_taskAssigned` WHERE `t_taskAssigned`.`t_task_idt_task` = ".$t['idt_task'];
        $result_task_assigned = $conn -> query($sql_task_assigned);
        while ($t_user_assigned = mysqli_fetch_assoc($result_task_assigned)) {
            $user_data = getUserData($t_user_assigned['t_usuarios_idt_usuarios']);
            $p_all [] = array(
                'date' => changeDateEs($t['t_taskDueDate']),
                'customer' => $t['t_generalTaskCName'],
                'title' => $t['t_taskTitle'],
                't_usuariosNombre' => $user_data -> t_usuariosNombre,
                't_usuariosApellido' => $user_data -> t_usuariosApellido,
                't_usuariosEmail' => $user_data -> t_usuariosEmail,
                't_usuariosReferencia' => $user_data -> t_usuariosReferencia,
                't_usuariosTelefono' => $user_data -> t_usuariosTelefono,
                'usuario_reposnsable' => ''
            );
            
            if ($t_user_assigned['t_usuarios_idt_usuarios'] == 13) {
                $is_it_jose_antonio = true;
            }
        }
    } else {
        $user_data = getUserData($t['user_create']);
        // Create Email Array
        $p_all [] = array(
            'date' => changeDateEs($t['t_taskDueDate']),
            'customer' => $t['t_generalTaskCName'],
            'title' => $t['t_taskTitle'],
            't_usuariosNombre' => $user_data -> t_usuariosNombre,
            't_usuariosApellido' => $user_data -> t_usuariosApellido,
            't_usuariosEmail' => $user_data -> t_usuariosEmail,
            't_usuariosReferencia' => $user_data -> t_usuariosReferencia,
            't_usuariosTelefono' => $user_data -> t_usuariosTelefono,
            'usuario_reposnsable' => ''
        );
        
        if ($user_data -> idt_usuarios == 13) {
            $is_it_jose_antonio = true;
        }
    }

   

    // creates DateTime objects 
    $today  = date_create(date('Y-m-d'));
    $due_day = date_create(date('Y-m-d', strtotime($t['t_taskDueDate'])));
    
    // calculates the difference between DateTime objects 
    $interval = date_diff($today, $due_day); 
    $diff_date =  $interval -> days;
    if ($interval -> invert == 1) {
        $diff_date = 0;
    }
    
    if (!isset($send_to_ja_subtask[$t['idt_task']])) {
    foreach ($p_all as $p) {
        $send_copy = false;
        $mode_1 = false;
        if ($diff_date <= 0) {
            buildEmail($p);
            updateLastSent('t_taskLastSent', $t['idt_task']);
            $send_copy = true;
            $mode_1 = true;
        } elseif ($diff_date <= 3) {
            $send = true;
            
            $last_send = $t['t_taskLastSent'];
            if ($last_send != '') {
                $last_send = date_create(date('Y-m-d', strtotime($t['t_taskLastSent'])));
                if ($last_send == $today) {
                    $send = false;
                }
            }
    
            if ($send) {
                buildEmail($p);
                $send_copy = true;
            }
            updateLastSent('t_taskLastSent', $t['idt_task']);
        }
    }
        if ($send_copy && !$is_it_jose_antonio) {  
    
            $p = array(
                'date' => changeDateEs($t['t_taskDueDate']),
                'customer' => $t['t_generalTaskCName'],
                'title' => $t['t_taskTitle'],
                't_usuariosNombre' => $jose_antonio -> t_usuariosNombre .' '.$jose_antonio  -> t_usuariosApellido,
                't_usuariosApellido' => '',
                't_usuariosEmail' => $jose_antonio -> t_usuariosEmail,
                't_usuariosReferencia' => $jose_antonio -> t_usuariosReferencia,
                't_usuariosTelefono' => $jose_antonio -> t_usuariosTelefono,
                'usuario_reposnsable' => ' de '.$user_data -> t_usuariosNombre .' '.$user_data -> t_usuariosApellido
            );

           
            buildEmail($p);
            if ($mode_1) {
                sendSms($p);
            }
            
        }
    $send_to_ja_subtask[$t['idt_task']] = $t['idt_task'];
    }

    echo '<br><br>';
}

function getUserData($id)
{
    $conn = $GLOBALS['conn'];
    $sql_users = "SELECT * FROM `t_usuarios`  WHERE  `t_usuarios`.`idt_usuarios` = ". $id;
    $result_users = $conn -> query($sql_users);
    $row = $result_users -> fetch_assoc();
    return (object) $row;
}

function updateLastSent($field,$id)
{
    $conn = $GLOBALS['conn'];
    if ($field == 't_generalTaskLastSent') {
        $sql = "UPDATE `t_generalTask` SET `t_generalTaskLastSent` = CURRENT_DATE() WHERE `t_generalTask`.`idt_generalTask` = ". $id;
    }

    if ($field == 't_taskLastSent') {
        $sql = "UPDATE `t_task` SET  `t_taskLastSent` = CURRENT_DATE() WHERE `t_task`.`idt_task` = ". $id;
    }
    $result = $conn -> query($sql);
}

/**
 * Build Email
 * [date,customer,title,t_usuariosNombre,t_usuariosApellido,t_usuariosEmail]
 */
function buildEmail($p)
{
    $body = emailBody($p);
    echo $body.'<br>';
    sendEmail($p['t_usuariosEmail'], 'Tarea Con Fecha Critica', $body, $p['t_usuariosNombre'].' '.$p['t_usuariosApellido']);

}

function sendSms($p)
{
    if ($p['t_usuariosTelefono'] != '') {
        $email = $p['t_usuariosTelefono'].'@bulksms.net';
        $subject = 'EnvioSMS';
        $body = 'Tarea Critica Vence HOY: '.$p['title'];
       sendEmailToSMS($email, $subject, $body, $p['t_usuariosTelefono']);
    }
}

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


function emailBody($p)
{
    $task = taskHtml($p);
    $body = '<html>
        <head></head>
        <body style="font-family: Verdana,sans-serif;">
            
                <div style=" "><img src="cid:logo_html" style="height:60px;"></div>
                <br>
                <br>
                Buenos días '. utf8_encode($p['t_usuariosNombre'].' '.$p['t_usuariosApellido']).',
                <br>
                <h3>Te presentamos  Tarea con Fecha Critica '. utf8_encode($p['usuario_reposnsable']).'.</h3>
                <h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer el detalle de la tarea o marcar tarea como finalizada: </h4>
                <a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/'.$p['t_usuariosReferencia'].'"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>
        
                <br>
                '.$task.'
        </body>
    </html>';
    return $body;
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
    if ($email != '') {
        $mail->Send();
    }
   

}

function sendEmailToSMS($email, $subject, $body, $name)
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
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Body = $body;
    if ($email != '') {
        $mail->Send();
    }
   

}


function changeDateEs($date)
{
    $date = explode(' ', $date);
    $time = $date[1];
    $date = $date[0];
    $date = explode('-', $date);
    $date = $date[2].'-'.$date[1].'-'.$date[0];
    return $date;
}

// $sql_users = "SELECT * FROM `t_usuarios`";
// $result_users = $conn -> query($sql_users);
// while ($u = mysqli_fetch_assoc($result_users)) {

// }
?>