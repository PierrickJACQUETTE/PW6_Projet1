<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Modif Profil de livisoo</title>
  <link  href="style.css" rel="stylesheet" />
</head>
<body>
  <div class="bloc_page">
    <header>
      <?php include 'header.php' ;?>
    </header>
    <?php

    if(estConnecte()){
      $req = $bdd->prepare('SELECT Password,Email,Name FROM User WHERE User_id="'.$_SESSION['userid'].'"');
      $req->execute();
      $dn = $req->fetch();
      $usernamesignup = $dn['Name'];
      $passwordsignup = $dn['Password'];
      $id = $_SESSION['userid'];
      $emailsignup = $dn['Email'];
      $supprimeCompte= false;
      if(is_null($_POST['usernamesignup'])){
        $usernamesignup=stripslashes(htmlentities(trim($_POST['usernamesignup'])));
      }
      if(is_null($_POST['emailsignup'])){
        echo "test";  ?><br><?php
        $email=stripslashes(htmlentities(trim($_POST['emailsignup'])));
        $req = $bdd->prepare('SELECT User_id FROM User WHERE Email="'.$email.'"');
        $req->execute();
        $dn2 = $req->rowCount();
        $dn2=$req->fetch();
        if($dn2==0){
          $emailsignup=$email;
        }
        else if($_SESSION['userid']==$dn2['User_id']){
          $message = 'Pas de modification';
          $form=true;
        }
        else{
          $form = true;
          $message = 'Un autre utilisateur utilise d&eacute;j&agrave; l\'adresse email que vous d&eacute;sirez utiliser.';
        }
      }
      if(isset($_POST['passwordsignup'])&&isset($_POST['passwordsignup_confirm'])){
        if(stripslashes($_POST['passwordsignup'])==stripslashes($_POST['passwordsignup_confirm'])){
          $passwordsignup=sha1(stripslashes($_POST['passwordsignup']));
        }
        else{
          $form = true;
          $message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
        }
        if(strlen($_POST['passwordsignup'])<=8){
          $form = true;
          $message = 'Le mot de passe que vous avez entr&eacute; contient moins de 8 caract&egrave;res.';
        }
      }
      if(isset($_POST['suppCompte'])){
        $supprimeCompte=true;
        if($_POST['suppCompte']=="oui"){
          $req = $bdd->prepare('DELETE FROM User WHERE User_id="'.$_SESSION['userid'].'"');
          if($req->execute()){
            ?>
            <div class="message">Votre profil est bien supprim&eacute.        </div>
            <?php
            unset($_SESSION['username'], $_SESSION['userid']);
            redirection("connexion.php","2");
          }
          else{
            $message = 'Une erreur est survenue lors de la suppression.';
          }
        }
        else{
          redirection("profil.php","0");
        }$form = true;
      }
    }
    if($supprimeCompte==false){
      $req = $bdd->prepare('UPDATE User SET Name="'.$usernamesignup.'", Email="'.$emailsignup.'", Password="'.$passwordsignup.'" WHERE User_id="'.$id.'"');
      if($req->execute()&&!isset($message)){
        $_SESSION['username'] = $dn['Name']=$usernamesignup;
        $form = false;
        ?>
        <div class="message">Votre profil est mis &agrave; jour.
          <div class="corps">
            <meta http-equiv='refresh' content='2;profil.php' />
          </div>
          <?php
        }
      }
      if($form){
        if(isset($message)){
          echo '<div class="message">'.$message.'</div>';
          redirection("profil.php","2");
        }
      }
      ?>
    </div>
  </body>
  </html>
