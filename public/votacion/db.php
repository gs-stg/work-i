<?php

class Db{

    private $user = 'sampablo002';
    private $password = 'sr8R9_8l';
    private $db = 'sistemastw';
    private $host = 'localhost';
    private $con = '';

    function __construct()
    {
        $conn = new mysqli($this -> host, $this -> user, $this -> password, $this -> db);
        $this -> con = $conn;
    }

    function insert($sql)
    {
        $result = $this -> con -> query($sql);
        return json_encode(array('data' => $result));
    }
    
    function request($sql)
    {
        $r = array();
        $result = $this -> con -> query($sql);
        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) { 
                $r[] = $row;
            }
        }
        return json_encode(array('data' => $r));
    }

    function update($sql)
    {
        $result = $this -> con -> query($sql);
        return json_encode(array('data' => $result));
    }
    
    function delete($sql)
    {
        $result = $this -> con -> query($sql);
        return json_encode(array('data' => $result));
    }

}

?>