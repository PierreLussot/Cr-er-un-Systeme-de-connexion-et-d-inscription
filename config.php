<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=exercices", "root", "root");
    echo "connexion etablie ";
} catch (PDOException $e) {
    echo "Echec de la connexion: " . $e->getMessage();
}
