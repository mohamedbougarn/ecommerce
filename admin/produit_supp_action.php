<?php
require_once('verifier_access.php'); 
require_once("../classes/produit.php");
$prd = new produit($bdd);

$prd->supprimer((int)$_REQUEST['id']);
header("Location: produit_liste.php");
?>