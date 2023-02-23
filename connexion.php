<?php
//demarage session
session_start();
//connexion BDD
require_once 'config.php';
//si dans l'input si des données existent
if (isset($_POST['email']) && isset($_POST['password'])) {
    //Protection contre des éventuelle injection sql sur l'input password
    $email = htmlspecialchars($_POST['email']);
    //Protection contre des éventuelle injection sql sur l'input email
    $password = htmlspecialchars($_POST['password']);
    //On vérifie si la personne est déjà inscrite dans notre BDD
    $check = $bdd->prepare("SELECT pseudo, email,password FROM utilisateursc WHERE email= ?");
    //Puis ont, mais cela dans un tableau et on renseigne notre email.
    $check->execute([$email]);
    //On stocke les données dans data on va rechercher avec fetch
    $data = $check->fetch();
    //Avec rowCount on vérifie s'il y a déjà dans la table ou pas 
    $row = $check->rowCount();
    //Si la valeur de rowCount == 1 c'est que la personne existe 
    if ($row == 1) {
        //On vérifie le format de l'adresse mail et qu'elle est bien valide.
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //on hash le mot de passe
            $password = hash('sha256', $password);
            //Ensuite, on fait une vérification le === est pour éviter certaines failles.
            if ($data['password'] === $password) {
                //Création d'une session qui a pour valeur le pseudo de la personne
                $_SESSION['user'] = $data['pseudo'];
                //une fois fais redirection
                header("Location: landing.php");
            } else {
                //si le mot de passe est faux 
                header("Location: index.php?login_err=password");
            }
        } else {
            //si l'email est faux 
            header("Location: index.php?login_err=email");
        }
    } else {
        //Si la personne n'existe pas, on la redirige ver index.php
        header("Location: index.php?login_err=already");
    }
} else {
    //Si dans l'input les données n'existent pas, on renvoie vers l'index
    header("Location: index.php");
}
