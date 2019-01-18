<?php 

// Insertion d'une message
// -----------------------
function insertionMessage($message) {
require("../bdd/connection.php");
$message = htmlspecialchars($message);
$message = str_replace('\n','<br/>',$message);
$req = $bdd->prepare('INSERT INTO message(msg,dates) VALUES(:msg,:dates)');
$req->execute(array(
	'msg' => $message,
	'dates'=> time()
));
}

// Modification d'un message
// -------------------------
function modificationMessage($msg,$id){
	require("../bdd/connection.php");
	$req = $bdd->prepare('UPDATE message SET msg=:msg,dates=:dates WHERE id=:id');

	$req->execute(array(
		'msg' => $msg,
		'dates' => time(),
		'id' => $id
	));	
}

// Supression d'un message
// -----------------------
function suppressionMessage($id){
	require("../bdd/connection.php");
	$req = $bdd->prepare('DELETE  FROM message WHERE id=:id');
	$req->execute(array(
		'id' => $id
	));
}

// Connexion d'un utilisateur
// --------------------------
function connexionUtilisateur($mail){
require("../bdd/connection.php");
$req = $bdd->prepare('SELECT * from utilisateurs where mail = :mail ');
$req->execute(array(
	'mail' => $mail
));
$req = $req->fetch();
return $req;
}

// Modification du nombre de vote 
// ------------------------------
function modificationVote($id,$ip){
require("../bdd/connection.php");
$req = $bdd->prepare('UPDATE message SET vote=vote+1,last_vote=:ip where id=:id ');
$req->execute(array(
	'id' => $id,
	'ip' => $ip
));
$req2 = $bdd->prepare('SELECT * from message where id=:id');
$req2->execute(array(
	'id' => $id
));
$req2 = $req2->fetch();
return $req2;
}

// Fonction qui regarde la dernière ip ayant voté
// ----------------------------------------------

function last_ip($id){
require("../bdd/connection.php");
$req = $bdd->prepare('SELECT * from message where id=:id');
$req->execute(array(
	'id' => $id
));
$req = $req->fetch();
return $req['last_vote'];
}




