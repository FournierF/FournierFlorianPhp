<?php
require("../function/function.php");
$id =$_GET['id'];
suppressionMessage($id);
header('location:../index.php');