<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use BorderCloud\SPARQL\SparqlClient;

require_once ('./vendor/autoload.php');

$endpoint = "https://query.wikidata.org/sparql";
$sc = new SparqlClient();
$sc->setEndpointRead($endpoint);
//$sc->setMethodHTTPRead("GET");
$q = "SELECT ?item ?itemLabel ?coordinates ?URL WHERE {
  ?item (wdt:P31/(wdt:P279*)) wd:Q33506;
    wdt:P17 wd:Q155.
 SERVICE wikibase:label { bd:serviceParam wikibase:language 'pt, pt-br'. }
  OPTIONAL { ?item wdt:P856 ?URL. }
}";

$rows = $sc->query($q, 'rows');

//var_dump($rows);

$err = $sc->getErrors();
if ($err) {
    print_r($err);
    throw new Exception(print_r($err, true));
}

foreach ($rows["result"]["variables"] as $variable) {
    echo ($variable);
    echo '|';
}
echo "<br>";
$contador=1;
foreach ($rows["result"]["rows"] as $row) {
    echo $contador."|";
    foreach ($rows["result"]["variables"] as $variable) {
        if (strcmp($variable,"URL")) {
         echo($row[$variable]);
         echo '|';} else {
            echo("<a href='".$row[$variable]."'>".$row[$variable]."</a>");
         }
    }
    echo "<br>";
    $contador++;
}

