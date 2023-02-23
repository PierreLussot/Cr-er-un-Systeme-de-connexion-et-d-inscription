<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace membre</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bodyCard">
    <div class="login-form">
        <div class="card shadow-lg " style="width: 18rem;">
            <img src="img/Pierre.png" class="card-img-top" alt="...">

            <div class="card-body">
                <h5 class="card-title">Bonjour <?= $_SESSION['user'] ?></h5>
                <p class="card-text">Bonjour, j'ai actuellement un bac +2, et je suis à la recherche d'une alternance
                    pour septembre afin de finaliser mon cursus par un bac +5 pour septembre 2023.
                    Voici quelques liens en dessous afin de me contacter </p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <a href="https://github.com/PierreLussot">Github <i class="fa-brands fa-github"></i></a></li>
                    <li class="list-group-item"> <a href="https://www.linkedin.com/in/pierre-lussot-b34158217/">linkedin <i class="fa-brands fa-linkedin"></i></a> </li>
                </ul>
                <br>
                <a href="deconnexion.php" class="btn btn-danger btn-lg">Deconnexion</a>

            </div>
        </div>
    </div>
</body>

</html>