<?php
session_start();
$id=$_GET['id'];
$tab=$_SESSION['panier'];
unset($tab[$id]);
$_SESSION['panier']=$tab;
header("location:panier.php");
?>