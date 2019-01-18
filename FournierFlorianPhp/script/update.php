<?php
$msg = $_POST['message'];
$id = $_POST['id'];

require("../function/function.php");
$msg = $_POST['message'];
$id = $_POST['id'];
modificationMessage($msg,$id);

header('location:../index.php');