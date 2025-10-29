<?php
    function random_price(float $min = 5.0, float $max = 120.0): float {
        $cents = rand((int)round($min * 100), (int)round($max * 100));
        return $cents / 100;
    }

    function random_date(string $start, string $end): string {
        // renvoie une date ISO (YYYY-MM-DD) entre deux bornes
        $timestamp = rand(strtotime($start), strtotime($end));
        return date('Y-m-d', $timestamp);
    }

    $adjectifs = [
        "Nocturne","Enchanté","Éphémère","Merveilleux","Déroutant","Électrique","Sublime",
        "Baroque","Moderne","Intime","Grand","Lumineux","Mystérieux","Poétique","Féroce",
        "Romantique","Comique","Impromptu","Audacieux","Rêveur"
    ];

    $noms = [
        "Voyage","Mascarade","Résonance","Rêve","Odyssée","Chimère","Rhapsodie","Fugue",
        "Boulevard","Carnaval","Cabaret","Balade","Collision","Murmure","Tempête","Mirage",
        "Symphonie","Éclipse","Étreinte","Écho","Parade","Noël","Printemps","Automne","Horizon"
    ];

    $genres = [
        "théâtral","musical","de danse","d'improvisation","de marionnettes","de cirque",
        "d'opéra","humoristique","pour enfants","de magie","expérimental","poétique",
    ];

    $venues_names = [
        "Théâtre du Solstice","Salle des Fêtes","La Scène du Nord","Espace Lumière",
        "Petit Théâtre des Arts","Grande Halle","La Cartoucherie","Forum Saint-Martin",
        "La Fabrique","La Rotonde","Studio 12","L'Auditorium","Le Colombier","Le Carreau",
        "Le Cloître","Salle Henri IV","Théâtre des Remparts","La Verrière","La Nef","Le Carillon"
    ];

    $street_names = [
        "rue Victor Hugo","avenue des Arts","boulevard Saint-Germain","place de la République",
        "impasse des Lilas","ruelle du Marché","avenue du Parc","rue de la Paix",
        "allée des Tilleuls","place Jean Jaurès","rue des Écoles","place du Château",
        "quai des Vergers","boulevard des Fleurs","rue du Pont"
    ];

    $villes = [
        "Paris","Lyon","Marseille","Toulouse","Bordeaux","Lille","Nice","Nantes","Strasbourg",
        "Montpellier","Rennes","Reims","Le Havre","Saint-Étienne","Toulon","Grenoble","Dijon",
        "Angers","Nîmes","Villeurbanne"
    ];

    $spectacles = [];
    $usedTitles = [];

    $target = 100;
    for ($i = 0; $i < $target; $i++) {
        // Génération du titre unique
        $adj = $adjectifs[array_rand($adjectifs)];
        $nom = $noms[array_rand($noms)];
        $genre = $genres[array_rand($genres)];

        $titleBase = "$adj $nom";
        $title = $titleBase;
        $suffix = 1;
        while (in_array($title, $usedTitles)) {
            $title = $titleBase . " — " . $suffix;
            $suffix++;
        }
        $usedTitles[] = $title;

        // Génération du lieu
        $venue = $venues_names[array_rand($venues_names)];
        $street = $street_names[array_rand($street_names)];
        $numero = rand(1, 120);
        $ville = $villes[array_rand($villes)];
        $lieu = sprintf("%s, %d %s, %s", $venue, $numero, $street, $ville);

        // Prix et date
        $prix = random_price(5.0, 120.0);
        $date = random_date('2025-11-01', '2026-06-30');

        // Ajout dans le tableau
        $spectacles[] = [
            'id' => $i + 1,
            'nom' => $title,
            'lieu' => $lieu,
            'prix_eur' => $prix,
            'date' => $date
        ];
    }

    // On retourne le tableau final
    return $spectacles;
?>