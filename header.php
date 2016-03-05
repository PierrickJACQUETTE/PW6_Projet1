<div id="titre_principal">
	<div id="logo">
		<a href="index.php"><img src="images/livisoo.svg" alt="Logo de Livisoo" id="logo_img"/></a>
		<h1>Livisoo</h1>
	</div>
	<h2>Cours en ligne</h2>
</div>

<nav>
	<div class="log">
		<ul>
			<li>
				<?php
				if(estConnecte()){
					echo 'Bonjour '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
				}
				else{
					echo 'Utilisateur non connecté';
				}
				?>
			</li>
		</ul>
	</div>

	<div class="log">
		<ul>
			<?php
			if(!isset($_SESSION['username'])){
				echo '<li><a href="connexion.php">Connexion</a></li>';
				echo '<li><a href="inscription.php">Inscription</a></li>';
			}
			else{
				echo '<li><a href="connexion.php">Deconnexion</a></li>';
				echo '<li><a href="profil.php">Mon Profil</a></li>';
			}
			?>

		</ul>
	</div>
	<ul id="menuDeroulant">
		<li><a href="index.php">Accueil</a></li>


		<?php
		$req = $bdd->prepare('SELECT Categorie FROM Cours ORDER BY Categorie ASC');
		$req->execute();
		$page =1;
		$tmpcat=0;
		while($dn= $req->fetch()){
			$cat = $dn['Categorie'];
			if($cat!=$tmpcat&&$tmpcat!=0){
				echo '</ul>';
				echo '</li>';
			}
			if($cat!=$tmpcat){
				qCategorie($cat);
				echo '<ul class="sousmenu">';
				menuCours($page);
				$page++;
				$tmpcat=$cat;
			}
			else{
				menuCours($page);
				$page++;
			}
		}
		?>
	</ul>
</li>

</ul>
</nav>
