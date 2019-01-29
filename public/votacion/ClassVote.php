<?php
if (isset($_POST)) {
    if (isset($_POST['myClass'])){
        $c = $_POST['myClass'];
        $function = $_POST['f'];
        $param = $_POST['p'];
        $obj = new $c();
        echo $obj -> $function($param);
    }
}

class  Vote {
    private $obj_db;

    function __construct()
    {
        include_once 'db.php';
        $obj_db = new Db();
        $this -> obj_db = $obj_db;
    }

    function addCandidate($p)
    {
        $sql = "INSERT INTO `t_votacionCandidate` (`idt_votacionCandidate`, `t_votacionCandidateName`, `t_votacionCandidatePicture`, `t_votacionCandidateStars`) VALUES (NULL, '".$p['name']."', '".$p['picture']."', '0');";
        $result = $this -> obj_db -> insert($sql);
        return $result;
        
    }
    
    function addVote($p)
    {
        $sql = "SELECT * FROM `t_votacionCandidate`WHERE sha1(md5(`t_votacionCandidate`.`idt_votacionCandidate`)) = '". $p[0]['u']."'";
        $result = $this -> obj_db -> request($sql);
        $result = json_decode($result);
        if (!$result -> data[0] -> t_votacionCandidateVoto) {
            
            foreach ($p as $v) {
                if (!$updated_t_votacionCandidateVoto) {
                    $updated_t_votacionCandidateVoto = true;
                    $sql = "UPDATE `t_votacionCandidate` SET `t_votacionCandidateVoto` = '1' WHERE sha1(md5(`t_votacionCandidate`.`idt_votacionCandidate`)) = '". $v['u']."'";
                    $result = $this -> obj_db -> update($sql);
                }
                
                $sql = "UPDATE `t_votacionCandidate` SET `t_votacionCandidateStars` =  `t_votacionCandidateStars` + ". $v['star']." WHERE sha1(md5(`t_votacionCandidate`.`idt_votacionCandidate`)) = '". $v['candidate']."'";
                $result = $this -> obj_db -> update($sql);
            }
            
           
            return $result;
        }
        
        return json_encode(array('data' => false));
       
    }

    function getTop($p)
    {
        $sql = "SELECT * FROM `t_votacionCandidate` ORDER BY `t_votacionCandidate`.`t_votacionCandidateStars` DESC";
        $result = $this -> obj_db -> request($sql);
        return $result;
    }
    
    
    function getCandidate() {
        $sql = "SELECT *, sha1(md5(idt_votacionCandidate)) as control FROM `t_votacionCandidate` ORDER BY `t_votacionCandidate`.`t_votacionCandidateName` ASC";
        $result = $this -> obj_db -> request($sql);
        return $result;
    }
    
    function deleteCandidate($p) {
        $sql = "DELETE FROM `t_votacionCandidate` WHERE idt_votacionCandidate = ".$p['id'];
        $result = $this -> obj_db -> delete($sql);
        return $result;
    }
    
    function getU($p){
        $sql = "SELECT *, sha1(md5(idt_votacionCandidate)) as control FROM `t_votacionCandidate` WHERE `t_votacionCandidate`.`t_votacionCandidateVoto` != 1 ORDER BY `t_votacionCandidate`.`t_votacionCandidateName` ASC";
        $result = $this -> obj_db -> request($sql);
        return $result;
    }
    
    
    
}

?>