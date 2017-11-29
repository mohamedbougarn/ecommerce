<?php 
include("/classes/Categorie.php");
include("/classes/Produit.php");
@$id = $_GET['id'];


	$cat= new Categorie();
  $liste = $cat->liste();
          				foreach($liste as $data )
          				{
						if($data->_id==$id){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Affable Beans - Liste des produits</title>
</head><!--/head-->

<body>
	<?php require_once("header.php") ?>
	
	
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2><?php echo $data->_libelle ?></h2>
						<div class="panel-group category-products" id="accordian">
							<?php echo $data->_description ?>
						</div>
						

						
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Les produits de la catégorie <?php echo $data->_libelle; }} ?> </h2>




						<?php
			

				$prod= new Produit();
				$prod->_id = $id;
	            $prod = $prod->liste();

	            foreach($prod as $info )
                      {
if($info->_id_category==$id){
				?>
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="upload/<?php echo $info->_image; ?>"  alt="" />
										
										<a href="panier_ajouter.php?id=<?php echo $info->_id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
											Ajouter au panier
										</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<p><?php echo $info->_description; ?></p>
										<h2><?php echo $info->_prix; ?>dt</h2>
										<p><?php echo $info->_libelle; ?></p>
										<a href="panier_ajouter.php?id=<?php echo $info->_id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
											Ajouter au panier
										</a>
										</div>

									</div>										
								</div>
							</div>
						</div>

<?php } }?>
						
					</div><!--features_items-->
					
				</div>
			</div>
		</div>
	</section>
	
	<?php require_once("footer.php") ?>
</body>
</html>