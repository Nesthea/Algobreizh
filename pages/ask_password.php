<!DOCTYPE html>
<html>
<head>
</head>
<body style="background-color:grey;">
	<div id="test" style="text-align:center;margin-top:20%;">
		<label>Code client : </label><input type="text" name="codeClient"> <br/> <br/>
		<button id="btnNewMdp">Demande de nouveau mot de passe</button>
	</div>
</body>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js">

var j$ = jQuery.noConflict();

j$('#btnNewMdp').click(function(){
	j$ window.location("../index.php");
});





</script>
</html>











