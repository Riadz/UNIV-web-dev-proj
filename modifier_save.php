<?php
	if (isset($_POST['modifierSport'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("UPDATE `sports` 
			SET `Designation_Sport`='".$_POST['Designation_Sport']."',
				`Type_Sport`='".$_POST['Type_Sport']."'
			WHERE `Code_Sport`='".$_GET['Code_Sport']."'") or die($sql->error);

		echo "<script>alert('Sport modifier avec succes');window.open('modifier.php','_self')</script>";
	}

	if (isset($_POST['modifierJoueur'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");
		
		$sql->query("UPDATE `joueurs` SET 
			`Nom`='".$_POST['Nom']."',
			`Prenom`='".$_POST['Prenom']."',
			`Date_Naissance`='".$_POST['Date_Naissance']."',
			`Adresse`='".$_POST['Adresse']."',
			`Tel`='".$_POST['Tel']."',
			`Fax`='".$_POST['Fax']."',
			`Email`='".$_POST['Email']."'
			 WHERE `Matricule`='".$_GET['Matricule']."'") or die($sql->error);

		echo "<script>alert('Joueur modifier avec succes');window.open('modifier.php','_self')</script>";
	}

	if (isset($_POST['modifierPratique'])) {
		$sql= mysqli_connect("localhost", "root", "", "gestion_sport");

		$keys=explode(" ", $_GET['keys']);
		
		$sql->query("UPDATE `pratiques` SET 
			`Code_Sport`='".$_POST['Code_Sport']."',
			`Matricule`='".$_POST['Matricule']."',
			`Date_Debut`='".$_POST['Date_Debut']."',
			`Date_Fin`='".$_POST['Date_Fin']."' 
			WHERE 
			`Code_Sport`='".$keys[0]."' AND
			`Matricule`='".$keys[1]."' AND
			`Date_Debut`='".$keys[2]."'") or die($sql->error);

		echo "<script>alert('Pratique modifier avec succes');window.open('modifier.php','_self')</script>";
	}
?>