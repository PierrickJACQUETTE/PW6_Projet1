$(document).ready(function() {
  var valid=true;
  var pass = false;
  $('#passwordsignup').keyup(function(){
    $('#resultPass').empty();
    $('#resultPass').html(check($(this).val()));
    pass=true;
  });
  $('#passwordsignup_confirm').keyup(function(){
    $('#resultConfPass').empty();
    $('#resultConfPass').html(check($(this).val()));
    pass=true;
  });
  if(pass==true){
    isValid();
    $('input[type="submit"]').click(function(){
      if($('#passwordsignup').val()!=$('#passwordsignup_confirm').val()){
        alert("Les deux mots de passe sont differents !!");
      }
    });
  }

  function isValid(){
    if (valid == true){
      $('input[type="submit"]').attr('disabled', false);
    }
    else{
      $('input[type="submit"]').attr('disabled', true);
    }
  }

  function check(data){
    var nbRequis =8;
    var nbRequisMax =40;
    var debut = 'Encore requis';
    var court = 'Trop court';
    var long = 'Trop long';
    var mot = 'Caractere(s)'
    var affiche = '';
    var len = data.length;
    if(len < nbRequis) {
      affiche += court+' '+debut+' '+(nbRequis-len)+' '+mot;
      valid=false;
    }
    else if(len > nbRequisMax) {
      affiche += long+' de '+(len-nbRequisMax)+' '+mot;
      valid=false;
    }
    else{
      valid=true;
    }
    if (!data.match(/.*[A-Z].*/)) {
      affiche+= ' 1 Majuscule';
      valid=false;
    }
    if (!data.match(/.*[0-9].*/)) {
      affiche+= ' 1 Chiffre';
      valid=false;
    }
    isValid();
    return affiche;
  }
});
