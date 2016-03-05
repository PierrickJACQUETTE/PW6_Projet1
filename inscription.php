<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <script src="http://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="script.js"></script>
  <title>Inscription à livisoo</title>
  <link  href="style.css" rel="stylesheet" />
</head>
<body>
  <div class="bloc_page">
    <header>
      <?php include 'header.php' ;?>
    </header>
    <?php
    if(isset($_POST['usernamesignup'], $_POST['emailsignup'], $_POST['passwordsignup'], $_POST['passwordsignup_confirm'])){
      if(get_magic_quotes_gpc()){
        $_POST['usernamesignup'] = stripslashes(htmlentities(trim($_POST['usernamesignup'])));
        $_POST['passwordsignup'] = stripslashes($_POST['passwordsignup']);
        $_POST['passwordsignup_confirm'] = stripslashes($_POST['passwordsignup_confirm']);
        $_POST['emailsignup'] = stripslashes(htmlentities(trim($_POST['emailsignup'])));
      }
      if($_POST['passwordsignup']==$_POST['passwordsignup_confirm']){
        if(strlen($_POST['passwordsignup'])>=8){
          $usernamesignup = $_POST['usernamesignup'];
          $passwordsignup = sha1($_POST['passwordsignup']);
          $emailsignup = $_POST['emailsignup'];
          $req = $bdd->prepare('SELECT User_id FROM User WHERE Email="'.$emailsignup.'"');
          $req->execute();
          $dn = $req->rowCount();
          if($dn==0){
            $req = $bdd->prepare('SELECT Max(User_id) FROM User');
            $req->execute();
            $rep = $req->fetch();
            $id = $rep['Max(User_id)']+1;
            $dateChamp = date('Y-m-j H:i:s');
            $req = $bdd->prepare('INSERT into User(User_id, Name, Password, Email,Date) values ('.$id.', "'.$usernamesignup.'", "'.$passwordsignup.'", "'.$emailsignup.'","'.$dateChamp.'")');
            if($req->execute()){
              $form = false;
              ?>
              <div class="message">Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.<br />
                <a href="connexion.php">Se connecter</a></div>
                <?php
              }
              else{
                $form = true;
                $message = 'Une erreur est survenue lors de l\'inscription.';
              }
            }
            else{
              $form = true;
              $message = 'Un autre utilisateur utilise d&eacute;j&agrave; l\'adresse email que vous d&eacute;sirez utiliser.';
            }
          }
          else{
            $form = true;
            $message = 'Le mot de passe que vous avez entr&eacute; contient moins de 8 caract&egrave;res.';
          }
        }
        else{
          $form = true;
          $message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
        }
      }
      else{
        $form = true;
      }
      if($form){
        if(isset($message)){
          echo '<div class="message">'.$message.'</div>';
        }
        ?>
        <div class="corps">
          <?php include 'formulaire.php';?>
        </div>
        <?php
      }
      ?>
    </div>
  </body>
  </html>
