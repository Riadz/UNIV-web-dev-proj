<?php
	if (isset($_POST['supprimerSport'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("DELETE FROM `sports` WHERE `Code_Sport`=".$_POST['Code_Sport']) or die($sql->error);
		echo "<script>alert('Sport supprimer avec succes');window.open('supprimer.php','_self')</script>";
	}

	if (isset($_POST['supprimerJoueur'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("DELETE FROM `joueurs` WHERE `Matricule`=".$_POST['Matricule']) or die($sql->error);
		echo "<script>alert('Joueurs supprimer avec succes');window.open('supprimer.php','_self')</script>";
	}

	if (isset($_POST['supprimerPratique'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

		$keys = explode(" ", $_POST['keys']);
		
		$sql->query("DELETE FROM `pratiques` WHERE `Code_Sport`=".$keys[0]." AND `Matricule`=".$keys[1]." AND `Date_Debut`='".$keys[2]."'") or die($sql->error);
		echo "<script>alert('Pratique supprimer avec succes');window.open('supprimer.php','_self')</script>";
	}

	function selectOptions($x){
		if($x==0) {
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

			$result = $sql->query("SELECT `Code_Sport`, `Designation_Sport` FROM `sports`") or die($sql->error);

			while ($data = mysqli_fetch_row($result))
				echo "<option value='".$data[0]."'>".$data[0]." - ".$data[1]."</option>";
		}
		else if($x==1) {
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

			$result = $sql->query("SELECT `Matricule`, `Nom`, `Prenom` FROM `joueurs`") or die($sql->error);

			while ($data = mysqli_fetch_row($result))
				echo "<option value='".$data[0]."'>".$data[0]." - ".$data[1]." ".$data[2]."</option>";
		}
		else{
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

			$result = $sql->query("
				SELECT pratiques.Code_Sport, sports.Designation_Sport, pratiques.Matricule, joueurs.Nom, joueurs.Prenom, `Date_Debut`
				FROM `pratiques`, `sports` , `joueurs`
				WHERE pratiques.Matricule = joueurs.Matricule AND pratiques.Code_Sport = sports.Code_Sport")
				or die($sql->error);

			while ($data = mysqli_fetch_row($result))
				echo "<option value='".$data[0]." ".$data[2]." ".$data[5]."'>(".$data[0]."-".$data[1].") (".$data[2]."-".$data[3]." ".$data[4].") ".$data[5]."</option>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion Sport - Supprimer</title>
	<link rel="shortcut icon" href="img/favicon-image.png">

	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<script type="text/javascript" src="javascript/forms.js"></script>
</head>
<body>
	<div id="container">
		<h1>Suppression</h1>
		<div id="errorDiv"></div>
		<button class="changeBtn" onclick="changeFrom(event)">sports</button>
		<button class="changeBtn" onclick="changeFrom(event)">joueurs</button>
		<button class="changeBtn" onclick="changeFrom(event)">pratiques</button><br>

		<form name="sports" id="sports" method="POST">
			<label>Sport:</label>
			<select name="Code_Sport" required>
				<?php selectOptions(0) ?>
			</select><br>
			<button type="submit" name="supprimerSport">Supprimer</button>
		</form>

		<form name="joueurs" id="joueurs" method="POST">
			<label>Joueur:</label>
			<select name="Matricule" required>
				<?php selectOptions(1) ?>
			</select><br>
			<button type="submit" name="supprimerJoueur" required>Supprimer</button>
		</form>

		<form name="pratiques" id="pratiques" method="POST">
			<label>Pratique:</label> 
			<select name="keys" style="width: 450px" required>
				<?php selectOptions(2) ?>
			</select><br>
			<button type="submit" name="supprimerPratique">Supprimer</button>
		</form>

	</div>
	<button id="returnBtn" onclick="window.open('index','_self')"></button>
</body>
</html>