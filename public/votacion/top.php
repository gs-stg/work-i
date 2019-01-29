<?php
    include_once 'header.php';
?>
<h1 style="    color: #e83f43;">Top</h1>
<div  id="all_candidate">
    
    
</div>

<script type="text/javascript">
function showCandidate() {	
	var p = "";
	
	$.post("ClassVote.php",
        {
            myClass: "Vote",
            f: "getTop",
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
	    	html += '<div class="A001">';
	    		html += '<div class="A009">';
	    		html += (i+1);
	    		html += '</div>';
	    		html += '<div class="A003">';
	    			html += '<img class="A002" alt="" src="'+ data[i].t_votacionCandidatePicture +'" >';
	    		html += '</div>';
	    		
	    			html += '<div class="A007">';
	    			html += data[i].t_votacionCandidateName;
	    			html += '</div>';
	    
	    			html += '<div class="A008">';
	    				html += data[i].t_votacionCandidateStars;
	    			html += '</div>';
			html += '</div>';
	    }
	    $("#all_candidate").html(html);
	
}
$(document).ready(function() {
	showCandidate();
	
});
</script>

<style>
.A001{
width: 100%;
    padding: 10px;
    box-shadow: 2px 2px 5px gainsboro;
    border-radius: 3px;
    margin-top: 5px;
    height: 144px;
    background: rgba(255, 255, 255, 0.87);
    background-image: url("img/candidate_2.png");
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

.A007{
   font-size: 46px;
    float: left;
    padding: 24px;
    margin-top: 0px;
    text-transform: capitalize;
}

.A008{
   float: right;
padding: 23px;
font-size: 60px;
background: #ffe330;
width: 145px;
text-align: center;
color: #795548;
border-radius: 87px;
height: 136px;
margin-top: -6px;

}

.A009{
float: left;
    padding: 34px;
       background: white;
    margin-right: 11px;
    font-size: 34px;
    width: 104px;
    text-align: center;
    color: #795548;
}

body {
   background-image: url("img/701.jpg");
   background-color: #cccccc;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>

<?php
    include_once 'footer.php';
?>