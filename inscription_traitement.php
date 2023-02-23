<?php
//demarage session
session_start();
//connexion BDD
require_once 'config.php';
//si dans l'input si des données existent
if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    //Protection contre des éventuelle injection sql sur l'input pseudo,email,password,password_retype
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    $check = $bdd->prepare('SELECT pseudo, email,password FROM utilisateurs WHERE email= ?');
    //Puis ont, mais cela dans un tableau et on renseigne notre email.
    $check->execute([$email]);
    //On stocke les données dans data on va rechercher avec fetch
    $data = $check->fetch();
    //Avec rowCount on vérifie s'il y a déjà dans la table ou pas 
    $row = $check->rowCount();
    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
    //on verifie si la personne n'est pas dans la BDD
    if ($row == 0) {
        //verification de la longeur de la chaine de caractere pseudo,email
        if (strlen($pseudo) <= 100) {
            if (strlen($email) <= 100) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($password === $password_retype) {
                        $password = hash('sha256', $password);
                        $ip = $_SERVER['REMOTE_ADDR'];

                        $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)');

                        $insert->execute(array(
                            'pseudo' => $pseudo,
                            'email' => $email,
                            'password' => $password,
                            'ip' => $ip
                        ));
                        header("Location: inscription.php?reg_err=success");
                    } else {
                        header("Location: inscription.php?reg_err=password");
                    }
                } else {
                    header("Location: inscription.php?reg_err=email");
                }
            } else {
                header("Location: inscription.php?reg_err=email_length");
            }
        } else {
            header("Location: inscription.php?reg_err=pseudo_length");
        }
    } else {
        //sinon on fais une redirection
        header("Location: inscription.php?reg_err=already");
    }
}
