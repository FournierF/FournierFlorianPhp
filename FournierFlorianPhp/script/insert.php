<?php

require("../function/function.php");

$msg = $_POST['message'];
echo($msg);
insertionMessage($msg);

header('location:../index.php');