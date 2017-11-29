<?php
require_once("../classes/produit.php");
require_once("../classes/Util.php");

@$libelle = $_POST['libelle'];
@$description = $_POST['description'];
@$prix = $_POST['prix'];
@$image = $_POST['image'];
@$id_category = $_POST['id_category'];

@$id = $_POST['id'];


if( !empty($libelle) && !empty($description) ) 
{
	$prd = new produit();
	$util = new Util();
	$prd->_libelle = $libelle;
	$prd->_description = $description;
	$prd->_image = $util->upload('image', "../upload");
	$prd->_prix = $prix;
	$prd->_id_category =$id_category;

	
	if( empty($id) ) 	// Ajout
		$id = $prd->ajouter();
	else				// Modification
	{
		$prd->_id = $id;
		$prd->modifier();
	}

	header("Location: produit_liste.php");
} 
else 
	exit('Tous les champs sont obligatoires !!');
?>