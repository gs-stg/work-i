<?php
    include_once 'header.php';
    if (!isset($_GET)) {
        $user = ''; 
    } else {
        $user = $_GET['u'];
    }
?>


<?php if ($user == '') { ?>

<div class="i003">
<img src="img/Gestoria Navidad.png" style="height: 90px;" >
<h1>Votación Cena Navidad 2018</h1>
<form action="" method="get">
  <input type="hidden" name="u" id="u"><br>
  	<div id="all_u">
  	</div>
  <input type="submit" value="Entrar" class="btn btn_intro" style="    margin-top: 19px;    padding-left: 60px;    padding-right: 60px;">
</form>
</div>
<?php } ?>

<?php if ($user != '') { ?>
<div class="alert alert-danger" role="alert" style="display:none;" id="error">
  Error al Votar
</div>
<center>
<div id="all_candidate_A">
	<h1>Candidatos</h1>
	<div id="all_candidate">
	</div>
</div>
</center>
<?php } ?>
<div id="done" style="display:none;">
    <img style=" -webkit-user-select: none; display: block; margin: auto; margin-top: 60px;" src="img/check.gif">
    <div class="i005">Gracias!</div>
</div>



<script type="text/javascript">
var u = '<?php echo $user; ?>';
function showCandidate()
{	
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

function addVote() {	
	var p = [];
	var error = false;
	var x = document.getElementsByClassName("candidate_id");
	var i;
	for (i = 0; i < x.length; i++) {
		
	   if ($('#star_'+ x[i].value).val() !=''){
		   	$("#c_"+ x[i].value).removeClass("car_error");
		   p.push({ u:'<?php echo $user;?>', candidate: x[i].value, star:$('#star_'+ x[i].value).val() });
		} else {
			error = true;
			$("#c_"+ x[i].value).addClass("car_error");
		}
	}
	console.log(p);
	if (!error) {
		$.post("ClassVote.php",
	 	        {
	 	            myClass: "Vote",
	 	            f: "addVote",
	 	            p:p
	 	        },
	 	        function(data, status){
	 	        	var obj = JSON.parse(data);
	 	        	if (obj.data) {
		            	
	 	        		$('#all_candidate_A').hide();
	 	        		$('#done').show();  
	 	            } else {
	 	                $('#error').show(); 
	 	                $('#all_candidate_A').hide(); 
	 	            }
	 	        	setTimeout(start, 5000);
		        	
	 		});
	}
	
}

function start(){
	location.assign("index.php");
}

function getU(id) {	
	var p = '';
	
	$.post("ClassVote.php",
        {
            myClass: "Vote",
            f: "getU",
            p:p
        },
        function(data, status){
       		var obj = JSON.parse(data);
       		showU(obj.data);
	});
}

function showU(data){
	var html = '';
    $("#all_u").html('');
    for (var i = 0; i< data.length; i++ ) {
		html += '<div class="i002" onclick="active(this,\''+ data[i].control +'\')">';
		html += data[i].t_votacionCandidateName;
		html += '</div>';
    }
    $("#all_u").html(html);
	
}

function active(e,u){
	$('.i002').removeClass('active');
	$(e).addClass('active');
	$('#u').val(u);
	
}

function fillCandidate(data) {
    var html = '';
    $("#all_candidate").html('');
	for (var i = 0; i< data.length; i++ ) {
    	if (data[i].control != u){
    		html += '<div class="card" style="width: 17rem;" id="c_'+ data[i].control +'">';
            	html += '<img class=" i001" src="'+ data[i].t_votacionCandidatePicture +'" alt="Card image cap">';
            	html += '<form><div class="card-body">';
            		html += '<h5 class="card-title">'+ data[i].t_votacionCandidateName +'</h5>';
            		html += '<div class="card-text">';
            		html += '<input type="hidden" value="'+ data[i].control +'" class="candidate_id">';
            		html += '<input type="hidden" value=""  id="star_'+ data[i].control +'">';
            		html += '<fieldset class="starability-basic">';
            				html += '<input type="radio" id="no-rate_'+ data[i].control +'" class="input-no-rate" name="rating" value="0" checked aria-label="No rating." />';
    
            					html += '<input type="radio" id="rate_'+ data[i].control +'1" name="rating" value="1" onclick="$(\'#star_'+data[i].control+'\').val(this.value)"/>';
            						html += '<label for="rate_'+ data[i].control +'1">1 star.</label>';
    
            							html += '<input type="radio" id="rate_'+ data[i].control +'2" name="rating" value="2" onclick="$(\'#star_'+data[i].control+'\').val(this.value)"/>';
            								html += '<label for="rate_'+ data[i].control +'2">2 stars.</label>';
    
            									html += '<input type="radio" id="rate_'+ data[i].control +'3" name="rating" value="3" onclick="$(\'#star_'+data[i].control+'\').val(this.value)"/>';
            										html += '<label for="rate_'+ data[i].control +'3">3 stars.</label>';
    
            											html += '<input type="radio" id="rate_'+ data[i].control +'4" name="rating" value="4" onclick="$(\'#star_'+data[i].control+'\').val(this.value)"/>';
            												html += '<label for="rate_'+ data[i].control +'4">4 stars.</label>';
    
            													html += '<input type="radio" id="rate_'+ data[i].control +'5" name="rating" value="5" onclick="$(\'#star_'+data[i].control+'\').val(this.value)"/>';
            														html += '<label for="rate_'+ data[i].control +'5">5 stars.</label>';
    
            															html += '<span class="starability-focus-ring"></span>';
            																
            															html += '</fieldset>';
    				html += '</div>';
            		
            	html += '</div></form>';
    		html += '</div>';
    	}
     }
	html += '<button class="btn btn-primary bnt_vote" type="submit" onclick=" addVote()">VOTAR</button>';
	 $("#all_candidate").append(html);
    
}

$(document).ready(function() {
	showCandidate();
	getU();
});
</script>


<style>
.i000{
}
.i001{
    width: 150px !important;
    height: 150px !important;
    margin: auto;
    margin-top: 10px;
    border-radius: 88px !important;
    border-top-left-radius: 88px !important;
    border-top-right-radius: 88px !important;

}
.card-img-top{
width: 150px !important;
    height: 150px !important;
    margin: auto;
    margin-top: 10px;
    border-radius: 88px !important;
    border-top-left-radius: 88px !important;
    border-top-right-radius: 88px !important;
}
.i002{
    padding: 11px;
    margin-bottom: 3px;
    background: #4caf50;
    cursor: pointer;
    color: #ffffff;
    text-align: left;
    text-transform: capitalize;
}
.i002:hover{
    background: #2196F3;
    color: white;
}

.i003{
   
    margin: auto;
    max-width: 320px;
    background: #ffffff;
    padding: 10px;
    text-align: center;
    color: #dc3a5f;
    border-radius: 3px;
    position: relative;
    top: 10%;
}
.i005{
     
    text-align: center;
    color: #00d0ad;
    font-size: 29px;
}

#all_u{
    height: 152px;
    overflow-y: auto;
}

.active{
    background: #2196F3;
    color: white;
}

.car_error{
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
#done{
    margin: auto;
    width: 320px;
    background: white;
    padding: 10px;
    text-align: center;
    color: white;
    border-radius: 3px;
    position: relative;
    top: 20%;
}
.bnt_vote{
    width: 100%;
    padding: 15px;
    margin-top: 20px;
    margin-bottom: 25px;
}
.card{
   float: none;
    margin: 2px;
    text-align: center;
    height: 260px;
    border-radius: 10px;
    box-shadow: 6px 9px 20px 0px gainsboro;
    background-image: url("img/candidate_1.png");
    
}
.card-title{
    color: dimgray;
}


.btn_intro {
    color: #fff;
    background-color: #d60303;
    border-color: #e80202;
}

.container{
    height: 100%;
}
.starability-basic{
  margin: auto;
}
@media (min-width: 576px) {
    .card{
        float:left;
    }
}
</style>

<?php
    include_once 'footer.php';
?>