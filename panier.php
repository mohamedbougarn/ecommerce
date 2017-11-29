<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Affable Beans</title>
</head><!--/head-->

<body>
	<?php require_once("header.php") ?>
	
	
	<form id="form" name="form" methode="get">	
		
<section id="cart_items">

		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Panier</li>
				</ol>
			</div>

		

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Produit</td>
							<td class="description">Détails</td>
							<td class="price">Prix</td>
							<td class="quantity">Quantité</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						require_once("./classes/Produit.php");
						$tab=$_SESSION['panier'];
							foreach ($tab as $key => $value) 
							{
							$prod= new Produit();
							$prod=$prod->details($key);
					?>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/<?php echo $prod->_image ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $prod->_libelle ?></a></h4>
								<p>Web ID: <?php echo $prod->_id ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo $prod->_prix ?> DTN</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" onclick="panier_plus('#qte_1')"> + </a>
									<input id="qte_1" class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" onclick="panier_moins('#qte_1')"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php @$somme = ($prod->_prix)*($value); echo $somme; ?> DTN</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="panier_supp.php?id=<?php echo $prod->_id; ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
				<?php } ?>
					</tbody>
				</table>
			</div>

			
		</div>
	</section> <!--/#cart_items-->

<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">	
				</div>
				<div class="col-sm-6">
					<?php
						require_once("./classes/Produit.php");
						$tab=$_SESSION['panier'];
						$st=0;
							foreach ($tab as $key => $value) 
							{
							$prod= new Produit();
							$prod=$prod->details($key);
							$st = $st + ($prod->_prix)*($value);
							$tva=$st/10;
							$t=$st+$tva;}
					?>

					<div class="total_area">
						<ul>
							<li>Sous total <span><?php echo $st; ?> DTN</span></li>
							<li>TVA (10%) <span><?php echo $tva; ?> DTN</span></li>
							<li>Frais de transport <span>Gratuit</span></li>
							<li>Total <span><?php echo $t; ?> DTN</span></li>
						</ul>
							<a class="btn btn-default update" href="#" onclick="form.submit()">Mettre à jour le panier</a>
							<a class="btn btn-default check_out" href="commander.php">Valider ma commande</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
		</form>	
<?php require_once("footer.php") ?>
<script>
	function panier_plus(id_champ_qte)
	{
		$(id_champ_qte).val(parseInt($(id_champ_qte).val()) + 1);
	}
	function panier_moins(id_champ_qte)
	{
		$(id_champ_qte).val(parseInt($(id_champ_qte).val()) - 1);
	}

</script>
</body>
</html>