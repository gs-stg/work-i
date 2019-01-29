<?php
    include_once 'header.php';

    $target_dir = "img/";
    $ia = md5(microtime());
    $target_file = $target_dir .$ia.basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        include_once 'ClassVote.php';
        $obj_vote = new Vote();
        $obj_vote -> addCandidate(array('name' => $_POST['name'], 'picture' => $target_dir.$ia.$_FILES["fileToUpload"]["name"]));
        ?>
        <script type="text/javascript">
        	parent.uploadOk();
        </script>
        
        <?php
    } else {
        ?>
        <script type="text/javascript">
        	parent.uploadKo();
        </script>
        
        <?php
    }
    
 ?>


 
<?php  
    
    include_once 'footer.php';
?>