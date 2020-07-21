<?php

use Whoops\Exception\ErrorException;
session_start();
if (empty($_SESSION['user_id'])){
    session_abort();
    header('Location: http://localhost:9090/login');
}

use App\Models\ProjetTools;
use App\Tools\DatabaseTools;
use App\Models\Projet;


$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");
$projTools = new ProjetTools($dbTools);
$i = 0;


if (!empty($_POST['logout'])) {
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("Location: http://localhost:9090/login");
}
try {
    $users = $projTools->getAllUserByProjetId($_GET['projetid']);
} catch (mysqli_sql_exception $e){
   $fail = true;

}


foreach ($users as $user){


    if($user->getUserId() == $_SESSION['user_id']){
        $script = true;

    }
    else {
        $script = false;
        header("Location: http://localhost:9090/home");
        
    }
}

if ($script != false){
    try{
    $projet = $projTools->getProjetById($_GET['projetid']);
    } catch(ErrorException $e){
        header("Location: http://localhost:9090/home");
    }

    if($e){
        header("Location: http://localhost:9090/home");
    }



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
    <div class="d-block">
        <div class="ml-5 mt-3">

            <div class="d-flex justify-content-around">

                <?php
                if (!empty($projet)){
                foreach ($projet as $proj) {?>
                <h2> <?= $proj->getName() ?> </h2>
            </div>
            <hr>

                <?php
                }
                } else  {?>
                    <p> Aucun projet trouvé </p>
                <?php } ?>









        </div>

        <div class="ml-5 mt-3">






        </div>

    </div>




</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
