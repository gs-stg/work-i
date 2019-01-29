<?php
    include_once 'header.php';
?>

	<h1>Add</h1>
	<div class="alert alert-success" role="alert" style="display:none;">
      Candidato Agregado
    </div>
    <div class="alert alert-danger" role="alert" style="display:none;">
      Error Agregando Candidato
    </div>
	<div class="A001">
        <form action="upload_file.php" id="add_candidate" style="margin-top: 12px;" method="post" enctype="multipart/form-data"  target="upload_file">
			<div class="A003">
           		<img class="A002" alt="" src="img/picture_icon.png" id="image" title="Cargar Foto">
            </div>
            <div class="A003">
                <div class="form-group">
                	<label for="exampleFormControlInput1">Candidato</label>
                	<input type="text" class="form-control" name="name" placeholder="Candidato">
				</div>
            	
            	<div>
            		<input class="btn btn-primary" type="submit" value="Agregar" name="submit" onclick="$('.alert-success').hide();">
            	</div>
           	</div>
            <input type="file" name="fileToUpload" id="fileToUpload" style="display:none;">
            
            
        </form>
    </div>
    
  
    <div class="row" id="all_candidate">
    
    
  	</div>


<iframe name="upload_file" style=" display: none;"></iframe>
<script>
   
	
    $("#image").click(function(){
    	document.getElementById("fileToUpload").click();
    });

	document.getElementById("fileToUpload").onchange = function() {
		var reader = new FileReader(); 

    	  reader.onload = function(e) {
    	    document.getElementById("image").src = e.target.result;
    	  };
    
    	  reader.readAsDataURL(this.files[0]);
	};

	function uploadOk() {
		$('.alert-danger').hide();
		$('.alert-success').show();
		document.getElementById("add_candidate").reset();
		document.getElementById("image").src = 'img/picture_icon.png';
		showCandidate();
	}

	function uploadKo() {
		$('.alert-success').hide();
		$('.alert-danger').show();
		
	}

	function showCandidate() {	
    	var p = "";
    	
    	$.post("ClassVote.php",
            {
                myClass: "Vote",
                f: "getCandidate",
                p:p
            },
            function(data, status){
            	var obj = JSON.parse(data);
            	fillCandidate(obj.data);
    	});
    }

    function fillCandidate(data) {
        var html = '';
        $("#all_candidate").html('');
    	for (var i = 0; i< data.length; i++ ) {
    		html += '<div class="col-sm-4">';
            	html += '<div class="A001">';
            		html += '<div class="A003">';
            			html += '<img class="A002" alt="" src="'+ data[i].t_votacionCandidatePicture +'">';
            		html += '</div>';
            		html += '<div class="A003">';
            				html += '<div>'+ data[i].t_votacionCandidateName +'</div>';
            				html += '<div class="A006">';
            					html += '<input class="btn btn-danger" type="button" value="Borrar" onclick="deleteCandidate(\''+ data[i].idt_votacionCandidate +'\')">';
            				html += '</div>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
         }
    	 $("#all_candidate").append(html);
        
    }

    function deleteCandidate(id) {
        if (confirm('Esta Seguro?')) {
        	var p = {id:id};
        	
        	$.post("ClassVote.php",
                {
                    myClass: "Vote",
                    f: "deleteCandidate",
                    p:p
                },
                function(data, status){
                	var obj = JSON.parse(data);
                	showCandidate();
        	});
        }
		
     }

    $(document).ready(function() {
    	showCandidate();
    });
</script>
<style>
.A001{
 display: flex;
    background-color: white;
    padding: 10px;
    box-shadow: 2px 2px 5px gainsboro;
    border-radius: 3px;
        margin-top: 5px;
/*     height: 165px; */
}
.A002{
    height: 120px;
    width: 120px;
    background-color: #ece7f5;
    border-radius: 5px;
}
.A003{
   
    float: left;
    margin-right: 10px;
}

.A004{
    display: flex;
/*     float: left; */
/*     width: 300px; */
}
.A006{
    margin-top: 20px;
}

</style>

<?php
    include_once 'footer.php';
?>