<?php

echo "EXTRAINDO DADOS DA WIKIDATA <BR><BR>";
$response = file_get_contents('https://www.wikidata.org/w/api.php?format=json&action=wbsearchentities&search=Machado%20de%20Assis&language=en');




$response = json_decode($response);

//var_dump($response);

// separa somente o array dos elementos retornados pela busca
$busca = $response->search;

var_dump($busca);

foreach ($busca as $resultado){

  echo "<br>";
  echo "$resultado->id $resultado->label";
  echo "<br>";

} 
?>