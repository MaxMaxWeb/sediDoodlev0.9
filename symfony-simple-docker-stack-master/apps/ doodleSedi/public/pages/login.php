<?php
use App\Tools\DatabaseTools;

$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");



if(!empty($_POST)){

   $userList = $dbTools->selectByNameInTable('user', $_POST['name']);

    // Requête pour se connecter à optimiser sous forme de fonction dans les user tools

    if ($userList['password'] == hash('sha512', $_POST['pswd'])){
        session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['user_id'] = $userList['id'];
        header("Location: http://localhost:9090/home");

    }else{
        header('Location: http://localhost:9090/login');

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

    <title>Document</title>
</head>
<body>

<div class=" w-100 cadre limit">
    <nav>

    </nav>
</div>
<div class="d-flex">


    <div class=" side  limit">

    </div>
    <div class="container ">
        <form class="center" method="post" action="">
            <div class="form-group">
                <label for="formGroupExampleInput"> Nom </label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2"> mot de passe</label>
                <input type="password" name="pswd" class="form-control" id="formGroupExampleInput2" placeholder="mot de passe">
            </div>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</div>




</body>
</html>
