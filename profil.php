<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <script src="http://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="script.js"></script>
  <title>Profil utilisateur</title>
  <link  href="style.css" rel="stylesheet" />
  <body>
    <div class="bloc_page">
      <header>
        <?php include 'header.php'; ?>
      </header>
      <?php
      if(estConnecte()){
        $id = intval($_SESSION['userid']);
        $req = $bdd->prepare('SELECT Name, Email,Credit FROM User WHERE User_id="'.$id.'"');
        $req->execute();
        if($req ->rowCount()>0){
          $dn = $req->fetch();
          ?>
          <div class="corps">

            <?php
            if(!estConnecte()||editProfil()!=false){
              
              include 'formulaire.php';
            }
            else {
              addGet($bdd);
              ?>
              <section class="formulaire">
                <h2> Profil de <?php echo $dn['Name'];?></h2>
                <div id="bouton_special">
                  <?php $texte="Editer" ?>
                  <p>
                    Votre nom : <?php echo $dn['Name'];?>
                    <a href="profil.php?modif=name" class="button edit"><?php echo $texte; ?></a>
                  </p>
                  <p>
                    Votre email : <?php echo $dn['Email'];?>
                    <a href="profil.php?modif=email" class="button edit"><?php echo $texte; ?></a>
                  </p>
                  <p>Votre mot de passe
                    <a href="profil.php?modif=password" class="button edit"><?php echo $texte; ?></a>
                  </p>
                  <p>Supprimer votre compte
                    <a href="profil.php?modif=suppCompte" class="button edit"><?php echo $texte; ?></a>
                  </p>
                  <p>Votre credit : <?php echo $dn['Credit'];?> unité(s)
                  </p>

                  <?php
                  listeCours($bdd,true);
                  listeCours($bdd,false);
                  ?>

                </div>
              </section>
              <?php
            }
            ?>

          </div>
          <?php
        }
        else
        {
          echo 'Cet utilisateur n\'existe pas.';
        }
      }
      else
      {
        echo 'L\'identifiant de l\'utilisateur n\'est pas d&eacute;fini, merci de vous connecter';
      }
      ?>
    </div>
  </body>
  </html>
