<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=exercices", "root", "root");
    echo"OK";
} catch (PDOException $e) {
    echo "Echec de la connexion: " . $e->getMessage();
}
