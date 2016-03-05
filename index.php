<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Cours en ligne">
	<title>Accueil de livisoo</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<div class="bloc_page">
		<header>
			<?php include'header.php';?>
		</header>
		<div class="corpsAccueil">
			<h1>Cours disponibles </h1>
			<?php
			$texte = "Comment fonctionnent les sites web ?
			Non, n'ayez pas peur de poser des questions même si vous pensez qu'elles sont « bêtes ». Il est très important que nous";
			accueil($bdd,1,"fonctionnement.jpg",$texte);
			$texte="Pour créer un site web, on doit donner des instructions à l'ordinateur. Il ne suffit pas simplement de taper dans le texte qui devra figurer dans le site (comme on le ferait";
			accueil($bdd,2,"Logo_HTML_CSS.svg",$texte);
			$texte="Les sites dynamiques : plus complexes, ils utilisent d'autres langages en plus de HTML et CSS, tels que PHP et MySQL. Le contenu de ces sites web est dit « dynamique »";
			accueil($bdd,3,"php-logo.svg",$texte);
			?>
		</div>
	</div>
</body>
</html>
