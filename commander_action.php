<?php session_start();
require_once("./classes/Commande.php");
require_once("./classes/Produit_Commande.php");
require_once("./classes/Produit.php");
@$nom = $_POST['nom'];
@$id = $_POST['id'];
@$email = $_POST['email'];
@$adress = $_POST['adress'];
@$id_prod=$_GET['id_prod'];
@$s=$_SESSION['panier'];

if( !empty($nom) && !empty($email)&& !empty($adress) ) 
{
	$cat = new Commande();
	$cat->_nom = $nom;
	$cat->_email = $email;
	$cat->_adress = $adress;
	
	if( empty($id) ) 	// Ajout
	{
	$id = $cat->ajouter();
		$prod=new Produit();
		$pc=new Produit_Commande();
		$liste = $prod->liste();
		foreach ($s as $key => $value) {
			$pc->_id_com = $id;
			$pc->_id_prod = $key;
          foreach($liste as $data )
          {
				if($data->_id==$key)
			{$pc->_prix =$data->_prix*$value;}
			}
			$pc->_qte = $value;
			$pc->ajouter();
		}
	}else				// Modification
	{
		$cat->_id = $id;
		$cat->modifier();
	}

	header("Location: paiement.php");
} 
else 
	exit('Tous les champs sont obligatoires !!');
?>