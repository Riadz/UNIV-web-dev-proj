<?php
	function selectOptions($x,$y){
		if($x){
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
			$string="";

			$result = $sql->query("SELECT `Code_Sport`, `Designation_Sport` FROM `sports`") or die($sql->error);
			while ($data = mysqli_fetch_row($result))
				$string = $string."<option value='".$data[0]."' ".toSelect($data[0],$y).">".$data[0]." - ".$data[1]."</option>";

			return $string;
		}
		else{
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
			$string="";

			$result = $sql->query("SELECT `Matricule`, `Nom`, `Prenom` FROM `joueurs`") or die($sql->error);
			while ($data = mysqli_fetch_row($result))
				$string = $string."<option value='".$data[0]."' ".toSelect($data[0],$y).">".$data[0]." - ".$data[1]." ".$data[2]."</option>";

			return $string;
		}
	}
	function toSelect($x,$y){
		if($x==$y) return "selected";
		else return "";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gestion Sport - Modifier</title>
	<link rel="shortcut icon" href="img/favicon-image.png">

	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<script type="text/javascript" src="javascript/forms.js"></script>
</head>
<body>
	<div id="container">
		<h1>Modification</h1>
		<div id="errorDiv"></div>
		<?php
		if($_GET['t']==0){
			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
			$result = $sql->query("
				SELECT `Designation_Sport`, `Type_Sport` 
				FROM `sports` 
				WHERE Code_Sport=".$_POST['Code_Sport']) or die($sql->error());

			$data = mysqli_fetch_row($result);

			$cChecked="";$IChecked="";
			if($data[1]=="collectif") $cChecked="checked";
			else $IChecked="checked";

			echo
			'
			<form action="modifier_save.php?Code_Sport='.$_POST['Code_Sport'].'" name="sports" method="POST" onsubmit="return validateSports()">
				<input name="Designation_Sport" type="text" placeholder="Designation du sport" value="'.$data[0].'" required><br>
				<label>collectif</label><input name="Type_Sport" value="collectif" type="radio" '.$cChecked.'>
				<label>indivuduel</label><input name="Type_Sport" value="indivuduel" type="radio" '.$IChecked.'><br>
				<button type="submit" name="modifierSport">Sauvegarder</button>
			</form>
			';
		}
		else if($_GET['t']==1){
						$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
			$result = $sql->query("
				SELECT `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Tel`, `Fax`, `Email` 
				FROM `joueurs` 
				WHERE `Matricule`=".$_POST['Matricule']) or die($sql->error());

			$data = mysqli_fetch_row($result);

			echo
			'
			<form action="modifier_save.php?Matricule='.$_POST['Matricule'].'" name="joueurs" method="POST" onsubmit="return validateJoueurs()">
				<input value="'.$data[0].'" name="Nom" type="text" placeholder="Nom" required><br>
				<input value="'.$data[1].'" name="Prenom" type="text" placeholder="Prenom" required><br>
				<input value="'.$data[3].'" name="Adresse" type="text" placeholder="Adresse" required><br>
				<input value="'.$data[4].'" name="Tel" type="text" placeholder="Numero de telephone" required><br>
				<input value="'.$data[5].'" name="Fax" type="text" placeholder="Numero de fax" required><br>
				<input value="'.$data[6].'" name="Email" type="text" placeholder="Email" required><br>
				<label>Date de naissance:</label><input value="'.$data[2].'" name="Date_Naissance" type="date" required><br>
				<button type="submit" name="modifierJoueur" required>Sauvegarder</button>
			</form>
			';
		}
		else{
			$keys=explode(" ", $_POST['keys']);

			$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
			$result = $sql->query("SELECT `Date_Fin` FROM `pratiques` 
				WHERE `Code_Sport`=".$keys[0]." AND `Matricule`=".$keys[1]." AND `Date_Debut`='".$keys[2]."'") or die($sql->error());

			$data = mysqli_fetch_row($result);

			echo
			'
			<form action="modifier_save.php?keys='.$_POST['keys'].'" name="pratiques" method="POST" onsubmit="return validatePratiques()">
				<label>Code du sport:</label>
				<select name="Code_Sport" required>
					'.selectOptions(true,$keys[0]).'
				</select><br>
				<label>Matricule du joueur:</label> 
				<select name="Matricule" required>
					'.selectOptions(false,$keys[1]).'
				</select><br>
				<label>Date de debut:</label><input value="'.$keys[2].'" name="Date_Debut" type="date" required><br>
				<label>Date de fin:</label><input value="'.$data[0].'" name="Date_Fin" type="date" required><br>
				<button type="submit" name="modifierPratique">Sauvegarder</button>
			</form>
			';
		}
		?>
	</div>

	<button id="returnBtn" onclick="window.open('modifier.php','_self')"></button>
</body>
</html>