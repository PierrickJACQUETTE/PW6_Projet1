<?php

function tableExists($pdo, $table) {
  try {
    $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
  } catch (Exception $e) {
    return FALSE;
  }
  return $result !== FALSE;
}

function tableCreate($pdo,$file){
  $requetes = '';
  $contenuFile = file($file);
  foreach($contenuFile as $lecture) {
    if(substr(trim($lecture), 0, 2) != '--') {
      $requetes .= $lecture;
    }
  }
  $qr = $pdo->exec($requetes);
}

function tableDataInsert($pdo,$file,$table,$champ){
  $row = 1;
  if (($handle = fopen($file, "r")) !== FALSE){
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){
      $num = count($data);
      $ligne = '';
      for ($c=0; $c < $num; $c++){
        if($c==$num-1){
          $ligne=$ligne.$data[$c];
        }
        else{
          $ligne=$ligne.$data[$c].',';
        }
      }
      $r = 'INSERT INTO '.$table.'('.$champ.') VALUES ('.$ligne.')';
      $pdo->prepare($r)->execute();
    }
    fclose($handle);
  }
  else{
    echo 'ERREUR DANS LE REMPLISSAGE DE LA TABLE : '.$table;
    echo ' PROBLEME OUVERTURE DU FICHIER : '.$file;
  }
}

?>
