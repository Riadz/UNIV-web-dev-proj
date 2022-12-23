<?php
	if (isset($_POST['creerSport'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("INSERT INTO `sports`(`Designation_Sport`, `Type_Sport`) VALUES ('".$_POST['Designation_Sport']."','".$_POST['Type_Sport']."')") or die($sql->error);

		echo "<script>alert('Sport ajouter avec succes');window.open('creer.php','_self')</script>";
	}

	if (isset($_POST['creerJoueur'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("INSERT INTO `joueurs`(`Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Tel`, `Fax`, `Email`) 
			VALUES ('".$_POST['Nom']."',
					'".$_POST['Prenom']."',
					'".$_POST['Date_Naissance']."',
					'".$_POST['Adresse']."',
					'".$_POST['Tel']."',
					'".$_POST['Fax']."',
					'".$_POST['Email']."'
					)") or die($sql->error);

		echo "<script>alert('Joueurs ajouter avec succes');window.open('creer.php','_self')</script>";
	}

	if (isset($_POST['creerPratique'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("INSERT INTO `pratiques`(`Code_Sport`, `Matricule`, `Date_Debut`, `Date_Fin`) 
			VALUES ('".$_POST['Code_Sport']."',
					'".$_POST['Matricule']."',
					'".$_POST['Date_Debut']."',
					'".$_POST['Date_Fin']."'
					)") or die($sql->error);

		echo "<script>alert('Pratique ajouter avec succes');window.open('creer.php','_self')</script>";
	}

	function selectOptions($x){
		if($x) {
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

			$result = $sql->query("SELECT `Code_Sport`, `Designation_Sport` FROM `sports`") or die($sql->error);
			while ($data = mysqli_fetch_row($result))
				echo "<option value='".$data[0]."'>".$data[0]." - ".$data[1]."</option>";
		}
		else {
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

			$result = $sql->query("SELECT `Matricule`, `Nom`, `Prenom` FROM `joueurs`") or die($sql->error);
			while ($data = mysqli_fetch_row($result))
				echo "<option value='".$data[0]."'>".$data[0]." - ".$data[1]." ".$data[2]."</option>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion Sport - Creer</title>
	<link rel="shortcut icon" href="img/favicon-image.png">

	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<script type="text/javascript" src="javascript/forms.js"></script>
</head>
<body>
	<div id="container">
		<h1>Creation</h1>
		<div id="errorDiv"></div>
		<button class="changeBtn" onclick="changeFrom(event)">sports</button>
		<button class="changeBtn" onclick="changeFrom(event)">joueurs</button>
		<button class="changeBtn" onclick="changeFrom(event)">pratiques</button><br>

		<form name="sports" id="sports" method="POST" onsubmit="return validateSports()">
			<input name="Designation_Sport" type="text" placeholder="Designation du sport" required><br>
			<label>collectif</label><input name="Type_Sport" value="collectif" type="radio" checked>
			<label>indivuduel</label><input name="Type_Sport" value="indivuduel" type="radio"><br>
			<button type="submit" name="creerSport">Creer</button>
		</form>

		<form name="joueurs" id="joueurs" method="POST" onsubmit="return validateJoueurs()">
			<input name="Nom" type="text" placeholder="Nom" required><br>
			<input name="Prenom" type="text" placeholder="Prenom" required><br>
			<input name="Adresse" type="text" placeholder="Adresse" required><br>
			<input name="Tel" type="text" placeholder="Numero de telephone" required><br>
			<input name="Fax" type="text" placeholder="Numero de fax" required><br>
			<input name="Email" type="text" placeholder="Email" required><br>
			<label>Date de naissance:</label><input name="Date_Naissance" type="date" required><br>
			<button type="submit" name="creerJoueur" required>Creer</button>
		</form>

		<form name="pratiques" id="pratiques" method="POST" onsubmit="return validatePratiques()">
			<label>Code du sport:</label>
			<select name="Code_Sport" required>
				<?php selectOptions(true) ?>
			</select><br>
			<label>Matricule du joueur:</label> 
			<select name="Matricule" required>
				<?php selectOptions(false) ?>
			</select><br>
			<label>Date de debut:</label><input name="Date_Debut" type="date" required><br>
			<label>Date de fin:</label><input name="Date_Fin" type="date" required><br>
			<button type="submit" name="creerPratique">Creer</button>
		</form>
	</div>
	<button id="returnBtn" onclick="window.open('index','_self')"></button>
</body>
</html>