<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Cours en ligne">
	<title>Cours 1</title>
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
				$cours = 1;
				if(!estConnecte()){
					echo connectForRead();
				}
				else{
					$page = "cours1.php";
					if(afficheCours($cours,$bdd)==false){
						noInscrit($bdd,$page,$cours);
						if(!empty($_POST['envoyerInscription'])) {
							add($bdd,$cours,$page);
						}
					}
					else{
						?>
						<article>
							<h2><img src="images/fonctionnement.jpg" alt="contenu de l'article" class="article_corps" />	Le fonctionnement des sites web</h2>
							<p>Comment fonctionnent les sites web ?</p>
							<p>
								Non, n'ayez pas peur de poser des questions même si vous pensez qu'elles sont « bêtes ». Il est très important que nous en parlions un peu avant de nous lancer à fond dans la création de sites !

								Je suis certain que vous consultez des sites web tous les jours. Pour cela, vous lancez un programme appelé le navigateur web en cliquant sur l'une des icônes représentées à la figure suivante.
								<img src="images/379937.png" alt=" Les icônes des navigateurs web les plus répandus" class="navigateur" />
							</p>
							<p>Avec le navigateur, vous pouvez consulter n'importe quel site web. Voici par exemple un navigateur affichant le célèbre site web Wikipédia (figure suivante).

								<img src="images/339310.png" alt="Le site web Wikipédia" class="wikipedia" />
							</p>
							<p>		Je suis sûr que vous avez l'habitude d'utiliser un navigateur web ! Aujourd'hui, tout le monde sait aller sur le Web… mais qui sait vraiment comment le Web fonctionne ? Comment créer des sites web comme celui-ci ?</p>
							<p>		J'ai entendu parler de HTML, de CSS, est-ce que cela a un rapport avec le fonctionnement des sites web </p>
							<p>
								Tout à fait !
								Il s'agit de langages informatiques qui permettent de créer des sites web. Tous les sites web sont basés sur ces langages, ils sont incontournables et universels aujourd'hui. Ils sont à la base même du Web. Le langage HTML a été inventé par un certain Tim Berners-Lee en 1991…

								Tim Berners-Lee suit encore aujourd'hui avec attention l'évolution du Web. Il a créé le World Wide Web Consortium (W3C) qui définit les nouvelles versions des langages liés au Web. Il a par ailleurs créé plus récemment la World Wide Web Foundation qui analyse et suit l'évolution du Web.

							</p>
							<p>		De nombreuses personnes confondent (à tort) Internet et le Web. Il faut savoir que le Web fait partie d'Internet.
								Internet est un grand ensemble qui comprend, entre autres : le Web, les e-mails, la messagerie instantanée, etc.
								Tim Berners-Lee n'est donc pas l'inventeur d'Internet, c'est « seulement » l'inventeur du Web.
							</p>
							<p>
								Les langages HTML et CSS sont à la base du fonctionnement de tous les sites web. Quand vous consultez un site avec votre navigateur, il faut savoir que, en coulisses, des rouages s'activent pour permettre au site web de s'afficher. L'ordinateur se base sur ce qu'on lui a expliqué en HTML et CSS pour savoir ce qu'il doit afficher, comme le montre la figure suivante.

								<img src="images/339311.png" alt="Du HTML à l'écran" class="html_screen" />
							</p>
							<p>
								HTML et CSS sont deux « langues » qu'il faut savoir parler pour créer des sites web. C'est le navigateur web qui fera la traduction entre ces langages informatiques et ce que vous verrez s'afficher à l'écran.
								Vous vous demandez sûrement pourquoi il faut connaître deux langages pour créer des sites web ? Je vous réponds sans plus tarder !
							</p><p>
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
