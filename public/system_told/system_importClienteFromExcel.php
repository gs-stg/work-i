<?php
$servername = "localhost";
$username = "sampablo002";
$password = "sr8R9_8l";
$dbname = "sistemastw";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
$inputFileName = 'Files/Clientes.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


$start = false; // to avoid the first row
$count = 1;
$saved = 0;
foreach ($sheetData as $r) {
    if ($r['A'] != '' && $r['C'] != '' ) {
        if ($start) {
            $nif = $r['C'];
            $nif = str_replace(".", "", $nif);
            $nif = str_replace("-", "", $nif);

            echo $nif.'<br>';
            $sql = "SELECT * FROM `t_clientes`  WHERE  `t_clientes`.`t_clientesNif` = '".$nif."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                echo '<br><br> EXIST <br><br>';
                $row = $result->fetch_assoc();
                $sql = "UPDATE `t_clientes` SET `t_clientesNombre` = '".utf8_decode($r['A'])."', `t_clientesApellido` =  '".utf8_decode($r['B'])."' WHERE `t_clientes`.`idt_clientes` = ".$row['idt_clientes'];
                $result = $conn->query($sql);
                echo 'sin:'.$r['A'].'  con:'.utf8_decode($r['A']).'<br>';
            } else {
                $telefono = trim(str_replace(" ", "", trim($r['D']))). ' ' .trim(str_replace(" ", "", trim($r['E']))).' '.trim(str_replace(" ", "", trim($r['F'])));
                $telefono = trim($telefono);
                $sql = "INSERT INTO `t_clientes` (`idt_clientes`, `t_clientesNombre`, `t_clientesApellido`, `t_clientesTelefono`, `t_clientesEmail`, `t_clientesNif`, `t_clientesEmpresa`, `t_clientesEstatus`, `t_usuarios_idt_usuarios_CreadoPor`, `t_clientesDate`, `t_clientesTipoCliente`, `t_clientesContact`) VALUES 
                                                 (NULL, '".utf8_decode($r['A'])."', '".utf8_decode($r['B'])."', '".$telefono ."', '".$r['G']."', '".$nif."', NULL, NULL, '1', CURRENT_DATE(), NULL, '".$r['H']."');";
                $result = $conn->query($sql);   
                $saved++; 
            }
        }
    } 
    $start = true;
}
?>