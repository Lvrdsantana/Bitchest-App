<?php

// Fonction pour générer les cotations des crypto-monnaies sur 30 jours
function generateCotations() {
    $cotations = array();

    // Liste des crypto-monnaies supportées
    $cryptoMonnaies = ["Bitcoin", "Ethereum", "Ripple", "Bitcoin Cash", "Cardano", "Litecoin", "NEM", "Stellar", "IOTA", "Dash"];

    // Générer les cotations pour chaque crypto-monnaie
    foreach ($cryptoMonnaies as $crypto) {
        $cotation = array();
        $firstCotation = getFirstCotation($crypto); // Première cotation
        $cotation[] = $firstCotation;
        for ($i = 1; $i < 30; $i++) {
            $previousCotation = $cotation[$i - 1];
            $newCotation = $previousCotation + getCotationFor($crypto); // Variation de cotation pour chaque jour
            // Assurez-vous que la cotation ne devienne pas négative
            $newCotation = max(0, $newCotation);
            $cotation[] = $newCotation;
        }
        $cotations[$crypto] = $cotation;
    }

    return $cotations;
}

/**
 * Renvoie la valeur de mise sur le marché de la crypto monnaie
 * @param $cryptoname {string} Le nom de la crypto monnaie
 */
function getFirstCotation($cryptoname){
  return ord(substr($cryptoname,0,1)) + rand(0, 10);
}

/**
 * Renvoie la variation de cotation de la crypto monnaie sur un jour
 * @param $cryptoname {string} Le nom de la crypto monnaie
 */
function getCotationFor($cryptoname){	
	return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
}

// Générer les cotations
$cotations = generateCotations();

// Convertir les cotations en format JSON
$cotationsJSON = json_encode($cotations);

// Définir l'en-tête de la réponse HTTP pour indiquer que les données sont au format JSON
header('Content-Type: application/json');

// Retourner les cotations au format JSON
echo $cotationsJSON;
?>
