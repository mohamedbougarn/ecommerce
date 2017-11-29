	<?php
	session_start();
						
						$tab=$_SESSION['panier'];
							$id = $_GET['id'];
							$tab[$id]++;
							$_SESSION['panier']=$tab;
							header("location:panier.php");
					?>