<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Cours en ligne">
	<title>Cours 3</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<div class="bloc_page">
		<header>
			<?php include 'header.php'; ?>
		</header>

		<div class="div_corps">
			<div class="corps">
				<?php
				$cours = 3;
				if(!estConnecte()){
					echo connectForRead();
				}
				else{
					$page = "cours3.php";
					if(afficheCours($cours,$bdd)==false){
						noInscrit($bdd,$page,$cours);
						if(!empty($_POST['envoyerInscription'])) {
							add($bdd,$cours,$page);
						}
					}

					else{
						?>
						<article>
							<h2><img src="images/php-logo.svg" alt="contenu de l'article" class="article_corps" />Les sites statiques et dynamiques</h2>
							<h5>On considère qu'il existe deux types de sites web : les sites statiques et les sites dynamiques.</h5>
							<p>Les sites dynamiques : plus complexes, ils utilisent d'autres langages en plus de HTML et CSS, tels que PHP et MySQL. Le contenu de ces sites web est dit « dynamique » parce qu'il peut changer sans l'intervention du webmaster ! La plupart des sites web que vous visitez aujourd'hui, y compris le Site du Zéro, sont des sites dynamiques. Le seul prérequis pour apprendre à créer ce type de sites est de déjà savoir réaliser des sites statiques en HTML et CSS.</p>
							<p>Vous pouvez lire sur le Site du Zéro le cours HTML/CSS que j'ai rédigé pour vous mettre à niveau ou bien vous procurer le livre « Réalisez votre site web avec HTML5 et CSS3 ».</p>
							<p>
								<img src="images/207064.jpg.gif" alt="IMAGE L'éléPHPant, la mascotte de PHP" class="mascotte_de_PHP" />

								<p>

									L'objectif de ce cours est de vous rendre capables de réaliser des sites web dynamiques entièrement par vous-mêmes, pas à pas.
									En effet, ceux-ci peuvent proposer des fonctionnalités bien plus excitantes que les sites statiques. Voici quelques éléments que vous serez en mesure de réaliser :
								</p>
								<div class="liste">
									<ul>
										<li>  un espace membres : vos visiteurs peuvent s'inscrire sur votre site et avoir accès à des sections qui leur sont réservées ;</li>
										<li> un forum : il est courant aujourd'hui de voir les sites web proposer un forum de discussion pour s'entraider ou simplement passer le temps ;</li>

										<li>un compteur de visiteurs : vous pouvez facilement compter le nombre de visiteurs qui se sont connectés dans la journée sur votre site, ou même connaître le nombre de visiteurs en train d'y naviguer !
										</li>
										<li>des actualités : vous pouvez automatiser l'écriture d'actualités, en offrant à vos visiteurs la possibilité d'en rédiger, de les commenter, etc. ;</li>
										<li>une newsletter : vous pouvez envoyer un e-mail à tous vos membres régulièrement pour leur présenter les nouveautés et les inciter ainsi à revenir sur votre site.</li>
									</ul>
								</div>
								<p>Bien entendu, ce ne sont là que des exemples. Il est possible d'aller encore plus loin, tout dépend de vos besoins. Sachez par exemple que la quasi-totalité des sites de jeux en ligne sont dynamiques. On retrouve notamment des sites d'élevage virtuel d'animaux, des jeux de conquête spatiale, etc.</p>

								<p>Mais… ne nous emportons pas. Avant de pouvoir en arriver là, vous avez de la lecture et bien des choses à apprendre ! Commençons par la base : savez-vous ce qui se passe lorsque vous consultez une page web ?</p>
								<p>
									<img src="images/CreativeCommons.jpg" alt="Licence : OpenClassRoom" class="licence" /></p>
								</article>
								<?php
							}
						}
						?>
					</div>
				</div>

				<footer>
					<?php include 'footer.php'; ?>
				</footer>
			</div>
		</body>
		</html>
