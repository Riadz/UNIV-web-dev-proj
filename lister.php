<?php
	function listerSports(){
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

		$result = $sql->query("SELECT * FROM `sports`") or die($sql->error);
		while ($data = mysqli_fetch_row($result))
  	  		echo
 	   		"
    		<tr>
				<td>".$data[0]."</td>
				<td>".$data[1]."</td>
				<td>".$data[2]."</td>
			</tr>
    		";
	}

	function listerJoueurs(){
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

		$result = $sql->query("SELECT * FROM `joueurs`") or die($sql->error);
		while ($data = mysqli_fetch_row($result))
    		echo
    		"
    		<tr>
				<td>".$data[0]."</td>
				<td>".$data[1]."</td>
				<td>".$data[2]."</td>
				<td>".$data[3]."</td>
				<td>".$data[4]."</td>
				<td>".$data[5]."</td>
				<td>".$data[6]."</td>
				<td>".$data[7]."</td>
			</tr>
    		";
	}

	function listerPratiques(){
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

		$result = $sql->query("SELECT * FROM `pratiques`") or die($sql->error);
		while ($data = mysqli_fetch_row($result))
    		echo
    		"
    		<tr>
				<td>".$data[0]."</td>
				<td>".$data[1]."</td>
				<td>".$data[2]."</td>
				<td>".$data[3]."</td>
			</tr>
    		";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion Sport - Affichage</title>
	<link rel="shortcut icon" href="img/favicon-image.png">

	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<script type="text/javascript" src="javascript/forms.js"></script>
</head>
<body>
	<div id="container">
		<h1>Afficahge</h1>
		<div id="errorDiv"></div>
		<button class="changeBtn" onclick="changeFrom(event)">sports</button>
		<button class="changeBtn" onclick="changeFrom(event)">joueurs</button>
		<button class="changeBtn" onclick="changeFrom(event)">pratiques</button><br>

		<div id="sports">
			<table border="3" align="center" background="img/tableBg.jpg">
				<tr>
					<td>Code_Sport</td>
					<td>Designation_Sport</td>
					<td>Type_Sport</td>
				</tr>
				<?php listerSports() ?>
			</table>
		</div>
		<div id="joueurs">
			<table border="3" align="center" background="img/tableBg.jpg">
				<tr>
					<td>Matricule</td>
					<td>Nom</td>
					<td>Prenom</td>
					<td>Date_Naissance</td>
					<td>Adresse</td>
					<td>Tel</td>
					<td>Fax</td>
					<td>Email</td>
				</tr>
				<?php listerJoueurs() ?>
			</table>
		</div>
		<div id="pratiques">
			<table border="3" align="center" background="img/tableBg.jpg">
				<tr>
					<td>Code_Sport</td>
					<td>Matricule</td>
					<td>Date_Debut</td>
					<td>Date_Fin</td>
				</tr>
				<?php listerPratiques() ?>
			</table>
		</div>
	</div>

	<button id="returnBtn" onclick="window.open('index','_self')"></button>
</body>
</html>