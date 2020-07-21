<?php
session_start();
if (empty($_SESSION['user_id'])){
    session_abort();
    header('Location: /login');
}

$uId = $_SESSION['user_id'];

use App\Models\Sondage;
use App\Models\ReponsesTools;
use App\Tools\DatabaseTools;
use App\Models\SondageTools;

$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");


$sTools = new SondageTools($dbTools);
$rTools = new ReponsesTools($dbTools);

if (!empty($_POST['logout'])) {
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("Location: http://localhost:9090/login");
}
try {
    $sond = $sTools->getSonById($_GET['sondageid']);
    if ($sond->getAuteurId() != $uId){
        header('Location : /home');
    }

} catch(ErrorException $e){
    header("Location: /home");
}

try {
    $rL = $rTools->getAllReponsefromS($_GET['sondageid']);
} catch (ErrorException $e){

}



if($e){
    header("Location: /home");
}

$uRlist = $sTools->checkIfRep($_GET['sondageid'], $uId );



if (!empty($_POST)){

    $rTools->setNewReponses($uId, $_POST, $_GET['sondageid']);
    header("Location: /home");

}

foreach ($uRlist as $uR) {

    if ($uR->getUserWhoRep() == $uId) {

        header("Location: /home");
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

    <div class="container mt-3 mx-4  ">

        <h4> Vous répondez au sondage : <?= $sond->getTitre() ?>  </h4>

    <hr>







                <form method="post">

              <?php
              $i = 0;
              foreach ($rL as $r){ ?>
                    <?php if ($sond->getChoixMult() != null) {
                        $i++;
                        ?>

                    <div>
                    <input class="form-check-input" type="checkbox" name="<?= $i ?>" id="check<?= $r->getId() ?>" value="<?= $r->getId() ?>">
                    <label class="form-check-label" for="check<?= $r->getId() ?>">
                        <?= $r->getName() ?>
                    </label>
                    </div>
                    <?php  } else { ?>
                         <div>
            <input class="form-check-input" type="radio" name="<?= $i ?>" id="radio<?= $r->getId() ?>" value="<?= $r->getId() ?>">
            <label class="form-check-label" for="radio<?= $r->getId() ?>">
                <?= $r->getName() ?>
                    </label>
    </div>
                <?php  }
              }
                ?>

                    <input class="btn btn-primary" type="submit" value="répondre">
                </form>





    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>    <script src="../pages/assets/owlCarousselScript/owl.carousel.min.js" type="text/javascript"></script>
    <script src="../pages/assets/owlCarousselScript/show.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>



