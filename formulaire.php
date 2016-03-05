<section class="formulaire">
  <?php
  if(editProfil()!=false){
    ?>
    <h2> Profil de <?php echo $dn['Name'];?></h2>
    <?php
  }
  else{
    ?>
    <h2> Inscription </h2>
    <?php
  }
  if(!estConnecte()){
    echo '<form  action="inscription.php" method="post" autocomplete="on">';
  }
  else{
    echo '<form  action="modifProfil.php" method="post" autocomplete="on">';
  }
  ?>
  <p>
    <label for="usernamesignup" >Votre nom</label>
    <?php
    $name = '<input id="usernamesignup" name="usernamesignup" type="text" ';
    $nameFin = ' required="required" />';
    if(estConnecte()){
      if(editProfil()=="name"){
        echo $name.'value='.$dn['Name'].$nameFin;
      }
      else{
        echo $name.'style="display:none" />';
        echo ' : '.$dn['Name'];
      }
    }
    else if (isset($_POST['usernamesignup'])){
      echo $name.'value='.$_POST['usernamesignup'].$nameFin;
    }
    else{
      echo $name.'placeholder='."dupont".$nameFin;
    }
    ?>
  </p>
  <p>
    <label for="emailsignup" > Votre email</label>
    <?php
    $email = '<input id="emailsignup" name="emailsignup" type="email" ';
    $emailFin = ' required="required" />';
    if(estConnecte()){
      if(editProfil()=="email"){
        echo $email.'value='.$dn['Email'].$emailFin;
      }
      else{
        echo $email.'style="display:none" />';
        echo ' : '.$dn['Email'];
      }
    }
    else if (isset($_POST['usernamesignup'])){
      echo $name.'value='.$_POST['emailsignup'].$nameFin;
    }
    else{
      echo $email.'placeholder='."dupont@gmail.com".$emailFin;
    }
    ?>

  </p>
  <p>
    <label for="passwordsignup" >Votre mot de passe </label>
    <?php
    $password = '<input id="passwordsignup" name="passwordsignup" type="password" pattern="[^\s]{8,40}" title="Au moins 8 caracteres et pas plus de 40" ';
    $passwordConfirm = '<input id="passwordsignup_confirm" name="passwordsignup_confirm" type="password" pattern="[^\s]{8,40}"  title="Au moins 8 caracteres et pas plus de 40" ';
    $passwordFin = ' required="required" />';
    $passConfLabel = '<label for="passwordsignup_confirm" >Confirmez votre mot de passe</label>';
    $nameValider = "Valider";
    $validerDebut = '<p class="sign button">'.'<input type="submit" value=';
    $validerFin = ' /></p>';
    if(estConnecte()){
      if(editProfil()=="password"){
        echo $password.'placeholder='."f!90EO".$passwordFin;
        echo '<span id="resultPass"></span>';
        echo '<p>'.$passConfLabel;
        echo $passwordConfirm.'placeholder='."f!90EO".$passwordFin.'</p>';
        echo '<span id="resultConfPass"></span>';
      }
      else{
        echo $password.'style="display:none" />';
        echo '<span id="resultPass"></span>';
      }

      echo $validerDebut.$nameValider.$validerFin;
    }
    else{
      echo $password.'placeholder='."f!90EO".$passwordFin;
      echo '<span id="resultPass"></span>';
      echo '<p>'.$passConfLabel;
      echo $passwordConfirm.'placeholder='."f!90EO".$passwordFin;
      echo '<span id="resultConfPass"></span>'.'</p>';
      $nameValider = "Inscription";
      echo $validerDebut.$nameValider.$validerFin;
      ?>
      <p>
        Deja membre ?
        <a href="connexion.php"> Connexion </a>
      </p>
      <?php
    }
    ?>

    <p>
      <?php
      if(estConnecte()){
        if(editProfil()=="suppCompte"){
          ?>
          <label for="suppCompte"> Supprimer votre compte : </label>
          <div class="youcompte" >
            <INPUT  type= "radio" name="suppCompte" value="oui" /> Oui
            <INPUT type= "radio" name="suppCompte" value="non" /> Non
          </div>
          <?php
        }
      }
      ?>
    </p>
  </form>
</section>
