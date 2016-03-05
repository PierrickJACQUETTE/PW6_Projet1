<?php
include('config.php');
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Connexion à livisoo</title>
  <link  href="style.css" rel="stylesheet" />
</head>
<body>
  <div class="bloc_page">
    <header>
      <?php include 'header.php'; ?>
    </header>
    <?php
    if(estConnecte()){
      unset($_SESSION['username'], $_SESSION['userid']);
      echo 'Vous avez bien &eacute;t&eacute; d&eacute;connect&eacute;.';
      redirection("connexion.php","1");
    }
    else{
      if(isset($_POST['username'], $_POST['password'])){
        if(get_magic_quotes_gpc()){
          $username = stripslashes(htmlentities(trim($_POST['username'])));
          $password = sha1(stripslashes($_POST['password']));
        }
        else{
          $username = htmlentities(trim($_POST['username']));
          $password = sha1($_POST['password']);
        }
        $req = $bdd->prepare('SELECT Password,User_id,Name FROM User WHERE Email="'.$username.'"');
        $req->execute();
        $dn = $req->fetch();
        if($dn['Password']==$password and $req->rowCount()>0){
          $form = false;
          $_SESSION['username'] = $dn['Name'];
          $_SESSION['userid'] = $dn['User_id'];
          ?>
          <div class="message">Vous avez bien &eacute;t&eacute; connect&eacute;. Vous pouvez acc&eacute;der &agrave; votre espace membre.<br />
            <?php
            redirection("index.php","2");
          }
          else{
            $form = true;
            $message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
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
            <section class="formulaire">
              <form action="connexion.php" method="post">
                <h2>Connexion</h2>
                <p>
                  <label for="username" class="uname"  > Votre email </label>
                  <input id="username" name="username" required="required" type="email" placeholder="name@google.com"/>
                </p>
                <p>
                  <label for="password" class="youpasswd" > Votre mot de passe </label>
                  <input id="password" name="password" required="required" type="password" placeholder="ad!98dfsD" />
                </p>
                <p class="sign button">
                  <input type="submit" value="Connexion" />
                </p>
                <p>
                  Vous inscrire ?
                  <a href="inscription.php">Inscription</a>
                </p>
              </form>
            </section>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </body>
  </html>
