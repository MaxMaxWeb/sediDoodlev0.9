<?php
session_start();

if (empty($_SESSION['user_id'])){
    session_abort();
    header('Location: /login');
}

use App\Models\InviteTools;
use App\Models\ProjetTools;
use App\Tools\DatabaseTools;
use App\Models\Projet;
use App\Models\Sondage;
use App\Models\SondageTools;
use App\Models\Invite;
use App\Models\InviteUser;


$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");
$projTools = new ProjetTools($dbTools);
$sonTools = new SondageTools($dbTools);
$iTools = new InviteTools($dbTools);



if (!empty($_POST['choicePro'])){




    $sonTools->newInv();
    $inv = new Invite();
    $invId = $sonTools->newInv();
    $inv->setId($invId);
    $son = new Sondage();
    $invU = new InviteUser();


    $son = $sonTools->hydrateSon($son, $_POST, $inv);

    $sonTools->newSon($son);

    $invU = $sonTools->hydrateinvU($inv, $invU, $_POST);


    for ($i = 0; $i <= count($invU->getUserId()) - 1; $i++){
        $sonTools->newInvU($invU, $i);
    }




}



if (!empty($_POST['logout'])){
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("Location: /login");
}

if (!empty($_POST['dateFin'])){
    $newProj = new Projet();

    $projet = $projTools->hydrateProjet($_POST, $newProj);

    $projTools->newProjet($projet);












    header('Location: /home');

}

$projets = $projTools->getAllProjetByUserId($_SESSION['user_id']);

$users = $projTools->getAllUserByProjets($projets);

$empSon = $sonTools->getAllSonWnoRofUser($_SESSION['user_id']);


$sond = $iTools->getAllSonbyInv($_SESSION['user_id']);



foreach ($sond as $s) {
    $sonTools->checkIfRep($s->getId(),$_SESSION['user_id'] );
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
    <div class="container">
        <div class="d-block">
            <div class=" mt-3">

                <div class="d-flex">
                    <h2> Sondages sans réponses</h2>

                    <i class="fas fa-plus" data-toggle="modal" data-target="#questionModal"> </i>

                </div>
                <hr>
            </div>
            <div class="d-flex justify-content-around">

                <?php if (count($empSon) <= 3){
                foreach ($empSon as $eS) { ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $eS->getTitre() ?></h5>


                            <a href="/sondageupdate?sondageid=<?=$eS->getId()?>" class="card-link">Modifier le sondage</a>
                            <span> || </span>
                            <a href="/questions?sondageid=<?=$eS->getId()?>" class="card-link">Ajoutez des réponses</a>



                        </div>
                    </div>



                <?php } ?>

            </div>

            <?php  }

            else {?>
            <div class="owl-carousel owl-theme mt-2 d-flex justify-content-between ">
                <?php foreach ($empSon as $eS) { ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $eS->getTitre() ?></h5>


                            <a href="/sondageupdate?sondageid=<?=$eS->getId()?>" class="card-link">Modifier le sondage</a>
                            <span> || </span>
                            <a href="/questions?sondageid=<?=$eS->getId()?>" class="card-link">Ajoutez des réponses</a>



                        </div>
                    </div>



                <?php } ?>


                <?php } ?>

            </div>

            <div class="mt-3">

                <div class="d-flex ">
                    <h2> Vos Projets</h2>



                    <i class="fas fa-plus" data-toggle="modal" data-target="#exampleModal"></i>


                </div>
                <hr>
                <div class="d-flex justify-content-around">
                <?php if (count($projets) <= 3){
                    foreach ($projets as $projet){?>

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $projet->getProjetName() ?></h5>


                                <a href="/projet?projetid=<?=$projet->getProjetId()?>" class="card-link">Allé au projet</a>



                            </div>
                        </div>
                    <?php } ?>
                </div>


                <?php } else { ?>
                    <div class="owl-carousel owl-theme mt-2 d-flex justify-content-between ">
                        <?php foreach ($projets as $projet){?>

                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $projet->getProjetName() ?></h5>


                                    <a href="/projet?projetid=<?=$projet->getProjetId()?>" class="card-link">Allé au projet</a>




                                </div>
                            </div>
                        <?php } ?>
                    </div>


                <?php } ?>

            </div>

            <div class="mt-5">

                <div class="d-flex ">
                    <h2> Vos Sondages en cours</h2>
                    <hr>
                </div>
                <div class="d-flex justify-content-around">

                    <?php if (count($sond) <= 3){
                    foreach ($sond as $s) { ?>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $s->getTitre() ?></h5>


                                <a href="/repondre?sondageid=<?=$s->getId()?>" class="card-link"> Répondre </a>
                                <span> || </span>
                                <a href="/resultats?sondageid=<?=$s->getId()?>" class="card-link"> Voir les résultats</a>



                            </div>
                        </div>



                    <?php } ?>

                </div>

                <?php  }

                else {?>
                <div class="owl-carousel owl-theme mt-2 d-flex justify-content-between ">
                    <?php foreach ($sond as $s) { ?>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $s->getTitre() ?></h5>


                                <a href="/repondre?sondageid=<?=$s->getId()?>" class="card-link"> Répondre </a>
                                <span> || </span>
                                <a href="/resultats?sondageid=<?=$s->getId()?>" class="card-link"> Voir les résultats</a>



                            </div>
                        </div>



                    <?php } ?>


                    <?php } ?>

                </div>





            </div>
        </div>











        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <input type="text" name="name">

                    </div>
                    <div class="modal-footer">

                        <input type="submit" class="btn btn-primary" value="nouveau projet">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Créer votre sondage</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form method="post" name="sondage">
                                <label> Nom de la question</label>
                                <input type="text" name="name" required="required" class="form-control my-1" placeholder="nom de la question">
                                <label> Description </label>
                                <textarea  name="description" class="form-control my-1" placeholder="Description"> Descritpion </textarea>

                                <label> Date de fin</label>
                                <input class="form-group" type="date" name="dateFin">
                                <label> Choix du projet </label>

                                <select name="choicePro" required="required">
                                    <?php foreach ($projets as $projet) {?>
                                        <option value="<?= $projet->getProjetId() ?>"> <?= $projet->getProjetName() ?> </option>
                                    <?php } ?>

                                </select>
                                <label> Choix multiple ? </label>
                                <select name="choixMult" required="required">
                                    <option value="oui"> Oui </option>
                                    <option value="non"> Non </option>
                                </select>
                                <div class="form-check form-check-inline">
                                    <label> Membres à inviter </label>
                                    <?php foreach ($users as $user){
                                        foreach ($user as $u) {?>

                                            <input class="form-check-input form-group"  type="checkbox" name="invite[]" id="inlineRadio<?= $u->getUserId() ?>" value="<?= $u->getUserId() ?>">
                                            <label class="form-check-label"  for="inlineRadio<?= $u->getUserId() ?>"> <?= $u->getUserName() ?> </label>


                                        <?php } ?>
                                    <?php } ?>

                                </div>






                        </div>
                        <div class="modal-footer">

                            <input type="submit" class="btn btn-primary" value="nouveau sondage">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script><script src="../pages/assets/owlCarousselScript/owl.carousel.min.js" type="text/javascript"></script>
<script src="../pages/assets/owlCarousselScript/show.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>