<?php
session_start();
require("../function/function.php");

if(isset($_POST['mail']) && isset($_POST['pass'])){

	$pass = $_POST['pass'];
	$mail = $_POST['mail'];

	$data = connexionUtilisateur($mail);
	$mail =  $data['mail'];
	$pswd =  $data['password'];
	$_SESSION['id'] = $data['id'];
	$_SESSION['nom'] = $data['nom'];
	$_SESSION['prenom'] = $data['prenom'];
	header('location:../index.php');



}