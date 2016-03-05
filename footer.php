<div id="last">
	<h1>Le dernier cours</h1>
	<?php
	$req = $bdd->prepare('SELECT Name, Date FROM Cours ORDER BY Date DESC');
	$req->execute();
	$dn = $req->fetch();
	$d = date_create($dn['Date']);
	echo "<p>".$dn['Name']."</p>";
	echo "<p>".date_format($d,'l j F Y H:i:s')."</p>";
	?>
</div>
<div id="mes_sites">
	<h1>Mes sites favoris</h1>
	<p>
		<a href="https://www.mysql.fr/"><img src="images/mysql.svg" alt="Photographie du logo de my_sql" /></a>
		<a href="https://www.tripadvisor.fr/"><img src="images/tripavisor.svg" alt="Photographie logo du site tripadvisor" /></a>
		<a href="https://openclassrooms.com/"><img src="images/openclassroom.png" alt="Logo du site openclassrooms" /></a>
		<a href="http://didel.script.univ-paris-diderot.fr/"><img src="images/didel.jpg" alt="Photographie du logo du site de cours en ligne de l'universite Diderot Paris " /></a>
	</p>
</div>
<div id="les_amis">
	<h1>Les derniers inscrits</h1>
	<div id="listes_amis">
		<ul>
			<?php
			$req = $bdd->prepare('SELECT Name FROM User ORDER BY Date DESC');
			$req->execute();
			$utilisateur =0;
			while($dn = $req->fetch()){
				if($utilisateur<6){
					echo '<li>'.$dn['Name'].'</li>';
					$utilisateur+=1;
				}
			}
			?>
		</ul>
	</div>
</div>
