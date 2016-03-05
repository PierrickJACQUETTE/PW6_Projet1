<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Cours en ligne">
	<title>Cours 2</title>
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
				$cours = 2;
				if(!estConnecte()){
					echo connectForRead();
				}
				else{
					$page = "cours2.php";
					if(afficheCours($cours,$bdd)==false){
						noInscrit($bdd,$page,$cours);
						if(!empty($_POST['envoyerInscription'])) {
							add($bdd,$cours,$page);
						}
					}
					else{
						?>
						<article>
							<h2><img src="images/Logo_HTML_CSS.svg" alt="contenu de l'article" class="article_corps" />	HTML et CSS : deux langages pour créer un site web</h2>
							<p>Pour créer un site web, on doit donner des instructions à l'ordinateur. Il ne suffit pas simplement de taper le texte qui devra figurer dans le site (comme on le ferait dans un traitement de texte Word, par exemple), il faut aussi indiquer où placer ce texte, insérer des images, faire des liens entre les pages, etc.</p>
							<h4>Les rôles de HTML et CSS</h4>
							<p>Pour expliquer à l'ordinateur ce que vous voulez faire, il va falloir utiliser un langage qu'il comprend. Et c'est là que les choses se corsent, parce qu'il va falloir apprendre deux langages !</p>
							<p>Pourquoi avoir créé deux langages ? Un seul aurait suffi, non ?</p>
							<p>Vous devez vous dire que manipuler deux langages va être deux fois plus complexe et deux fois plus long à apprendre… mais ce n'est pas le cas ! Je vous rassure, s'il y a deux langages c'est, au contraire, pour faciliter les choses. Nous allons avoir affaire à deux langages qui se complètent car ils ont des rôles différents :</p>
							<div class="liste">
								<ul>
									<li> HTML (HyperText Markup Language) : il a fait son apparition dès 1991 lors du lancement du Web. Son rôle est de gérer et organiser le contenu. C'est donc en HTML que vous écrirez ce qui doit être affiché sur la page : du texte, des liens, des images… Vous direz par exemple : « Ceci est mon titre, ceci est mon menu, voici le texte principal de la page, voici une image à afficher, etc. ».</li>
									<li>CSS (Cascading Style Sheets, aussi appelées Feuilles de style) : le rôle du CSS est de gérer l'apparence de la page web (agencement, positionnement, décoration, couleurs, taille du texte…). Ce langage est venu compléter le HTML en 1996.</li>
								</ul>
							</div>

							<p>Vous avez peut-être aussi entendu parler du langage XHTML. Il s'agit d'une variante du HTML qui se veut plus rigoureuse et qui est donc un peu plus délicate à manipuler.
								Pour faire simple, le HTML est apparu le premier en 1991. Début 2000, le W3C a lancé le XHTML en indiquant que ce serait l'avenir… mais le XHTML n'a pas percé comme on l'espérait. Retour aux sources en 2009 : le W3C abandonne le XHTML et décide de revenir au HTML pour le faire évoluer.
								Il y a beaucoup de confusion autour de ces langages, alors qu'ils se ressemblent beaucoup. Aucun n'est vraiment meilleur que l'autre, il s'agit de deux façons de faire différentes. Dans ce cours, nous allons travailler sur la dernière version de HTML (HTML5) qui est aujourd'hui le langage d'avenir que tout le monde est incité à utiliser.
							</p>
							<p>
								Vous pouvez très bien créer un site web uniquement en HTML, mais celui-ci ne sera pas très beau : l'information apparaîtra « brute ». C'est pour cela que le langage CSS vient toujours le compléter.

								Pour vous donner une idée, la figure suivante montre ce que donne la même page sans CSS puis avec le CSS.

								<img src="images/339428.png" alt="Avec et sans CSS" class="html_avec_ou_sans_css" />
							</p>
							<p>Le HTML définit le contenu (comme vous pouvez le voir, c'est brut de décoffrage !). Le CSS permet, lui, d'arranger le contenu et de définir la présentation : couleurs, image de fond, marges, taille du texte…</p>
							<p>Comme vous vous en doutez, le CSS a besoin d'une page HTML pour fonctionner. C'est pour cela que nous allons d'abord apprendre les bases du HTML avant de nous occuper de la décoration en CSS.
								Vos premières pages ne seront donc pas les plus esthétiques, mais qu'importe ! Cela ne durera pas longtemps.

							</p>
							<h4>Les différentes versions de HTML et CSS</h4>
							<p>Au fil du temps, les langages HTML et CSS ont beaucoup évolué. Dans la toute première version de HTML (HTML 1.0) il n'était même pas possible d'afficher des images !</p>

							<p>Voici un très bref historique de ces langages pour votre culture générale.</p>
							<h5>Les versions de HTML</h5>
							<div class="liste">
								<ul>
									<li>HTML 1 : c'est la toute première version créée par Tim Berners-Lee en 1991.</li>
									<li> HTML 2 : la deuxième version du HTML apparaît en 1994 et prend fin en 1996 avec l'apparition du HTML 3.0. C'est cette version qui posera en fait les bases des versions suivantes du HTML. Les règles et le fonctionnement de cette version sont donnés par le W3C (tandis que la première version a été créée par un seul homme).</li>
									<li>HTML 3 : apparue en 1996, cette nouvelle version du HTML rajoute de nombreuses possibilités au langage comme les tableaux, les applets, les scripts, le positionnement du texte autour des images, etc.</li>
									<li> HTML 4 : il s'agit de la version la plus répandue du HTML (plus précisément, il s'agit de HTML 4.01). Elle apparaît pour la première fois en 1998 et propose l'utilisation de frames (qui découpent une page web en plusieurs parties), des tableaux plus complexes, des améliorations sur les formulaires, etc. Mais surtout, cette version permet pour la première fois d'exploiter des feuilles de style, notre fameux CSS !</li>
									<li>    HTML 5 : c'est LA dernière version. Encore assez peu répandue, elle fait beaucoup parler d'elle car elle apporte de nombreuses améliorations comme la possibilité d'inclure facilement des vidéos, un meilleur agencement du contenu, de nouvelles fonctionnalités pour les formulaires, etc. C'est cette version que nous allons découvrir ensemble.</li>
								</ul>
							</div>

							<h5>Les versions de CSS</h5>
							<div id="liste">
								<ul>
									<li>    CSS 1 : dès 1996, on dispose de la première version du CSS. Elle pose les bases de ce langage qui permet de présenter sa page web, comme les couleurs, les marges, les polices de caractères, etc</li>
									<li>		CSS 2 : apparue en 1999 puis complétée par CSS 2.1, cette nouvelle version de CSS rajoute de nombreuses options. On peut désormais utiliser des techniques de positionnement très précises, qui nous permettent d'afficher des éléments où on le souhaite sur la page.</li>
									<li>    CSS 3 : c'est la dernière version, qui apporte des fonctionnalités particulièrement attendues comme les bordures arrondies, les dégradés, les ombres, etc.</li>
								</ul>
							</div>
							<p>Notez que HTML5 et CSS3 ne sont pas encore des versions totalement finalisées par le W3C. Cependant, même s'il peut y avoir des changements mineurs dans ces langages, je vous recommande chaudement de commencer dès aujourd'hui avec ces nouvelles versions. Leurs apports sont nombreux et valent vraiment le coup. D'ailleurs, de nombreux sites web professionnels se construisent aujourd'hui sur ces dernières versions.	</p>
							<p>
								<img src="images/CreativeCommons.jpg" alt="Licence : OpenClassRoom" class="licence" />
							</p>
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
