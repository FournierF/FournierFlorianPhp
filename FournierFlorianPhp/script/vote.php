<?php
require("../function/function.php");

$id = $_POST['id'];
$ip = $_SERVER['REMOTE_ADDR'];

$last_ip = last_ip($id);

if($ip != $last_ip){

$nbVote = modificationVote($id,$ip);

echo json_encode($nbVote);

}else{

echo json_encode("Vous avez deja voté");
}




