<?php
require_once("Mysql.php");
class produit extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_libelle;
	private $_description;
	private $_image;
	private $_prix;
	private $_id_category;


	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return htmlentities( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $attribut n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut  $attribut n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM produit WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$prd = new produit();
		
		$prd->_id 			= $row['id'];
		$prd->_libelle 		= $row['libelle'];
		$prd->_image 		= $row['image'];
		$prd->_description	= $row['description'];
		$prd->_prix           =$row['prix'];
		$prd->_id_category           =$row['id_categorie'];
	
		return $prd;
	}


	public function liste()
	{
		$q = "SELECT * FROM produit ORDER BY libelle";
		$list_prd = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$prd = new produit();
		
		$prd->_id 			= $row['id'];
		$prd->_libelle 		= $row['libelle'];
		$prd->_image 		= $row['image'];
		$prd->_description	= $row['description'];
		$prd->_prix         =$row['prix'];
		$prd->_id_category  =$row['id_categorie'];
	
		$list_prd[]=$prd;
	}
		
		return $list_prd;
	}
	
	public function ajouter()
	{
	    $q = "INSERT INTO produit(id, libelle, image, description,prix,id_categorie) VALUES 
	  		(  null				, '$this->_libelle'		,
			  '$this->_image'	, '$this->_description' , '$this->_prix', '$this->_id_category'	
			)";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produit SET
			  libelle 	= '$this->_libelle',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  description = '$this->_description',
			  			  prix = '$this->_prix',
			  			  			  id_categorie = '$this->_id_category'


			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM produit WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>