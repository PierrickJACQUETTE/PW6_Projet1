<?php
require_once("config-function.php");
session_start();

define( 'BDD_HOST', 'localhost' );
define( 'BDD_USER', 'root' );
define( 'BDD_PASSWORD', 'azerty' );
define( 'BDD_NAME', 'PW6JACQUETTE' );

try {
	$bdd = new PDO('mysql:host='.BDD_HOST, BDD_USER, BDD_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE));
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$requete = $bdd->prepare('CREATE DATABASE IF NOT EXISTS '.BDD_NAME.' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
	$requete->execute();
	$bdd = new PDO('mysql:host='.BDD_HOST.';dbname='.BDD_NAME, BDD_USER, BDD_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE));

	if (!tableExists($bdd,"User")||!tableExists($bdd,"Cours")||!tableExists($bdd,"UserCours")){
		tableCreate($bdd,"PW6JACQUETTE.sql");
		$r = '`Name`, `Email`, `Password`, `User_id`, `Date`';
		tableDataInsert($bdd,"User.csv","User",$r);
		$r = '`Name`, `Cours_id`, `Date`, `Prix`,`Categorie`';
		tableDataInsert($bdd,"Cours.csv","Cours",$r);
		$r=' `Id_user`, `Id_cours`, `Id_Relation`';
		tableDataInsert($bdd,"CoursUser.csv","UserCours",$r);
	}

}
catch (PDOExeption $e) {
	die("Error PDO :".$e);
}
catch(Exception $e) {
	die("Error :".$e);
}
?>
