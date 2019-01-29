<?php
$servername = "localhost";
$username = "sampablo002";
$password = "sr8R9_8l";
$dbname = "sistemastw";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql_subTask = "SELECT * FROM `t_task` WHERE `t_task`.`t_taskExplanation` IS NOT null ORDER BY `t_task`.`idt_task` ASC";
$result_subTask = $conn -> query($sql_subTask);
while ($u = mysqli_fetch_assoc($result_subTask)) {
    echo $u['idt_task'].'<br>';
    echo $u['t_taskTitle'].'<br>';
    echo $u['t_taskExplanation'].'<br>';
  

    echo  $sql = "INSERT INTO `t_taskComments` (`idt_taskComments`, `t_taskCommentsText`, `t_task_idt_task`, `t_usuarios_idt_usuarios`, `t_taskCommentsUserName`, `t_taskCommentsDate`, `t_generalTask_idt_generalTask`) VALUES (NULL, '".$u['t_taskExplanation']."', '".$u['idt_task']."', '1', 'Descripción', NOW(), NULL);";
    echo '<br>';
    echo $result = $conn->query($sql);   
    echo '<br>';
    echo '<br>';
}

?>