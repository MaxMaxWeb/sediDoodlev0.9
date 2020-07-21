<?php

session_start();
if (empty($_SESSION['user_id'])){
    session_abort();
    header('Location: /login');
}

$uId = $_SESSION['user_id'];

use App\Models\Sondage;
use App\Models\SondageTools;
use App\Tools\DatabaseTools;

$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");

$sonTools = new SondageTools($dbTools);

if (!empty($_POST['logout'])) {
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("Location: http://localhost:9090/login");
}


try {
    $s = $sonTools->getSonByUser($uId, $_GET['sondageid']);
}  catch(ErrorException $e){
    header("Location: /home");
}

if($e){
    header("Location: /home");
}


if (!empty($_POST)){

    $sonTools->updateSon($_POST, $_GET['sondageid']);

    header("Location: /home");
}










?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../pages/assets/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="../pages/assets/owlCarousselScript/owl.carousel.min.css" type="text/css">

    <title>Document</title>
</head>

<body>

<div class=" w-100 cadre limit">
    <nav>

    </nav>
</div>
<form method="post">
    <input type="submit" name="logout" value="logout">
</form>
<div class="d-flex">


    <div class=" side  limit">

    </div>
    <div class="container mt-3 ">
        <form method="post" name="sondage">


            <label> Nom de la question</label>
            <input type="text" name="name" required="required" class="form-control my-1" value="<?= $s->getTitre() ?>">
            <label> Description </label>
            <textarea  name="description" class="form-control my-1" placeholder="Description"> <?= $s->getDescription() ?></textarea>


            <label> Choix multiple ? </label>
            <select name="choixMult" required="required">
                <option value="oui"> Oui </option>
                <option value="non"> Non </option>
            </select>

            <input type="submit" class="btn btn-primary" value="Modifier">

    </div>





<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="../pages/assets/owlCarousselScript/owl.carousel.min.js" type="text/javascript"></script>
<script src="../pages/assets/owlCarousselScript/show.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
