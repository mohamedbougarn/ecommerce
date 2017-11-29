<?php
require_once("Mysql.php");
class Commande extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_nom;
	private $_prenom;
	private $_adress;
	private $_email;

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
		$q = "SELECT * FROM commande WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$prod = new Commande();
		
		$prod->_id 			= $row['id'];
		$prod->_nom 		= $row['nom'];
		$prod->_prenom 		= $row['prenom'];
		$prod->_email		= $row['email'];
		$prod->_adress		= $row['adress'];
		
		return $prod;
	}


	public function liste()
	{
		$q = "SELECT * FROM commande ORDER BY id";
		$list_prod = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$prod = new Commande();

		$prod->_id 			= $row['id'];
		$prod->_nom 	    = $row['nom'];
		$prod->_email		= $row['email'];
		$prod->_adress	    = $row['adress'];
		
			$list_prod[]=$prod;
		}
		
		return $list_prod;
	}
	
	public function ajouter()
	{
	    $q = "INSERT INTO commande(id,nom,email,adress) VALUES 
	  		(  null	,'$this->_nom','$this->_email','$this->_adress'
			);";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE commande SET
			  nom 	= '$this->_nom',
			  email = '$this->_email',
			  adress = '$this->_adress'
			  
			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM commande WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>