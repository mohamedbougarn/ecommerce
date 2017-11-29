<?php
require_once("Mysql.php");
class Produit_Commande extends Mysql
{
	// Les attributs privés
	private $_id_prod;
	private $_id_com;
	private $_qte;
	private $_prix;
	

	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM produit_commande WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$prod = new Produit_Commande();
		
		$prod->_id_prod 	= $row['id_prod'];
		$prod->_id_com 		= $row['id_com'];
		$prod->_qte			= $row['qte'];
		$prod->_prix		= $row['prix'];
		
		return $prod;
	}


	public function liste()
	{
		$q = "SELECT * FROM produit_commande ORDER BY id_com";
		$list_prod = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$prod = new Produit_Commande();

		$prod->_id_prod 	= $row['id_prod'];
		$prod->_id_com 		= $row['id_com'];
		$prod->_qte			= $row['qte'];
		$prod->_prix		= $row['prix'];
		
			$list_prod[]=$prod;
		}
		
		return $list_prod;
	}
	
	public function ajouter()
	{
	    $q = "INSERT INTO produit_commande(id_prod, id_com, qte, prix) VALUES 
	  		( '$this->_id_prod'		,
			  '$this->_id_com'	,'$this->_qte','$this->_prix'
			)";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produit_commande SET
			  id_prod 	= '$this->_id_prod',
			  id_com = '$this->_id_com',
			  qte = '$this->_qte'
			  prix= '$this->_prix'
			  WHERE id_prod = '$this->_id_prod' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM produit_commande WHERE id_prod = '$id_prod'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>