<?php
function editProfil(){
  if(isset($_GET['modif'])){
    switch ($_GET['modif']) {
      case "name":
      return "name";
      break;
      case "email":
      return "email";
      break;
      case "password":
      return "password";
      break;
      case "suppCompte":
      return "suppCompte";
      break;
      default:
      return "erreur de page";
      break;
    }
  }
  else {
    return false;
  }
}

function estConnecte(){
  if(isset($_SESSION['username'])){
    return true;
  }
  else{
    return false;
  }
}

function redirection($page,$times){
  echo '<div class="corps">';
  echo "<meta http-equiv='refresh' content=".$times.";".$page .">";
  echo '</div>';
}

function afficheCours($cours,$bdd){
  $affiche = false;
  $req = $bdd->prepare('SELECT Id_cours FROM UserCours WHERE Id_user="'.$_SESSION['userid'].'"');
  $req->execute();
  while($dn = $req->fetch()){
    if($dn['Id_cours']==$cours){
      $affiche = true;
      break;
    }
  }
  return $affiche;
}

function connectForRead(){
  return '<p>Il faut être connecté et acheté le cours pour acceder au contenu.</p>
  <p>Merci de vous connecter et de payer.</p>';
}

function noInscrit($bdd,$page,$numero){
  echo '<p>Il faut payer pour acceder au contenu.</p><p>Merci de proceder au payement.</p>';
  $req = $bdd->prepare('SELECT Cours_id, Name,Prix FROM Cours WHERE Cours_id="'.$numero.'"');
  $req->execute();
  $dn = $req->fetch();
  ?>
  <div id="bouton_special">
    <form action="<?php echo $page ?>" method="post">
      Le titre du cours  : <?php echo $dn['Name'];?><br />
      Si vous voulez l'acheter il coute : <?php echo $dn['Prix']; ?> unités.
      <input type="submit" id="envoyer" name="envoyerInscription" class="buttonAdd" value="Acheter">
    </form>
  </div>
  <?php
}

function listeCours($bdd,$mesCours){
  ?>
  <div class="listeCours">
    <h4>
      <?php
      $affiche="Liste de";
      if($mesCours==true){
        $affiche=$affiche." mes";
      }
      else{
        $affiche=$affiche."s autres";
      }
      $affiche=$affiche." cours :";
      echo $affiche;
      ?>
    </h4>
    <?php
    $affiche='';
    if($mesCours==true){
      $affiche='SELECT Cours_id, Name FROM Cours WHERE Cours_id IN ( SELECT Cours_id FROM Cours JOIN UserCours ON (Cours_id=Id_cours) WHERE Id_user ="'.$_SESSION['userid'].'")';
    }
    else{
      $affiche='SELECT Cours_id, Name,Prix FROM Cours WHERE Cours_id NOT IN ( SELECT Cours_id FROM Cours JOIN UserCours ON (Cours_id=Id_cours) WHERE Id_user ="'.$_SESSION['userid'].'")';
    }
    $req = $bdd->prepare($affiche);
    $dn = $req->execute();
    if(empty($req->rowCount())){
      echo "<p>Vous avez tous les cours</p>";
    }
    else{
      while($dn = $req->fetch()){
        ?>
        <form action="profil.php" method="post">
          <p>
            <?php
            echo $dn['Name'];
            if($mesCours==false){
              echo " ( ".$dn['Prix']." unités)";
              ?>
              <a href="profil.php?add=<?php echo $dn['Cours_id'] ?>" class="button add">Acheter</a>
              <?php
            }
            ?>
          </p>
        </form>
        <?php
      }
    }
    ?>
  </div>
  <?php
}

function addModif($bdd,$cours){
  $newCredit = userHasGoldCours($bdd,$cours);
  if($newCredit>=0){
    $r = 'INSERT INTO UserCours (`Id_user`, `Id_cours`) VALUES ("'.$_SESSION['userid'].'","'.$cours.'")';
    $req = $bdd->prepare($r);
    $req->execute();
    $r = 'UPDATE User SET Credit = "'.$newCredit.'" WHERE User_id="'.$_SESSION['userid'].'"';
    $req = $bdd->prepare($r);
    $req->execute();
    return true;
  }
  else{
    return false;
  }
}

function add($bdd,$cours,$page){
  if(addModif($bdd,$cours)==true){
    redirection($page,0);
  }
  else {
    echo "<p>IMPOSSIBLE D'ACHETER CE COURS !!! VOUS AVEZ PLUS ASSEZ DE CREDIT</p>";
  }
}

function coursExist($bdd,$cours){
  $r = 'SELECT Cours_id FROM Cours';
  $req = $bdd->prepare($r);
  $req->execute();
  while($dn = $req->fetch()){
    if($dn['Cours_id']==$cours){
      return true;
    }
  }
  return false;
}

function dejaAcheter($bdd,$cours){
  $r = 'SELECT Id_cours FROM UserCours WHERE Id_user="'.$_SESSION['userid'].'"';
  $req = $bdd->prepare($r);
  $req->execute();
  while($dn = $req->fetch()){
    if($dn['Id_cours']==$cours){
      return true;
    }
  }
  return false;
}

function addGet($bdd){
  if(isset($_GET['add'])){
    $cours = $_GET['add'];
    if(coursExist($bdd,$cours)==true){
      if(dejaAcheter($bdd,$cours)==false){
        add($bdd,$cours,"profil.php");
      }
      else {
        echo "Vous avez déjà acheté ce cours !";
      }
    }
    else {
      echo "Ce cours n'existe pas";
    }
  }
}

function userHasGoldCours($bdd,$cours){
  $r = 'SELECT Credit FROM User WHERE User_id="'.$_SESSION['userid'].'"';
  $req = $bdd->prepare($r);
  $req->execute();
  $dn = $req->fetch();
  $r = 'SELECT Prix FROM Cours WHERE Cours_id="'.$cours.'"';
  $req = $bdd->prepare($r);
  $req->execute();
  $dn2 = $req->fetch();
  return $dn['Credit']-$dn2['Prix'];
}

function accueil($bdd,$numero,$image,$texte){
  ?>
  <div class="cours">
    <a href="cours<?php echo $numero ;?>.php">
      <div class="contenu">
        <div class="image">
          <img src="images/<?php echo $image; ?>" alt="contenu de l'article" class="article_corps" />
          <div class="description">
            <?php echo $texte ?>
          </div>
        </div>
      </div>

      <?php
      $r = 'SELECT Prix,Name FROM Cours WHERE Cours_id="'.$numero.'"';
      $req = $bdd->prepare($r);
      $req->execute();
      $dn = $req->fetch();
      ?>
      <h5>
        <?php echo $dn['Name'] ?>
      </h5>
      <p><?php echo $dn['Prix'] ?> unités
      </p>
    </a>
  </div>
  <?php
}

function menuCours($page){
  $lien ="";
  $titre="";
  switch ($page){
    case 1 :
    $lien="cours1.php";
    $titre="Fonctionnement";
    break;
    case 2 :
    $lien="cours2.php";
    $titre="Langages";
    break;
    case 3 :
    $lien="cours3.php";
    $titre="Cours";
    break;
  }
  echo '<li><a href="'.$lien.'">'.$titre.'</a></li>';
}

function qCategorie($categorie){
  $texte="";
  switch ($categorie) {
    case 1:
    $texte="HTML&CSS";
    break;
    case 2 :
    $texte="PHP";
  }
  echo '<li><a href="#">'.$texte.'</a>';
}
?>
