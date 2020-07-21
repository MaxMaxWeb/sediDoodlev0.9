<?php
session_start();

if (empty($_SESSION['user_id'])){
    session_abort();
    header('Location: /login');
}

use App\Models\InviteTools;
use App\Models\ProjetTools;
use App\Models\ReponsesTools;
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
$rTools = new ReponsesTools($dbTools);







if (!empty($_POST['logout'])){
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("Location: /login");
}


$results = $iTools->getNbOfInvite($_GET['sondageid']);

foreach ($results as $result){
   $nInv = count($result);
}

$rL = $rTools->getAllReponsefromS($_GET['sondageid']);

$rCountTab = [];

foreach ($rL as $r){
    $rCount = $rTools->getNbofR($r->getId());
    array_push($rCountTab, $rCount[0]);
}

$sum = array_sum($rCountTab);

$i = 0;





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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
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

    <div class="container text-center">
            <div class="container">
                <div id="graph">

                </div>



            </div>

    </div>







    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>    <script src="../pages/assets/owlCarousselScript/owl.carousel.min.js" type="text/javascript"></script>

    <script src="../pages/assets/owlCarousselScript/show.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: 'graph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                <?php foreach ($rL as $r) {


                ?>

                { label: <?= json_encode($r->getName()) ?>, value: <?php if ($rCountTab[$i] == null){
              echo json_encode(0);
            } else {
                echo json_encode($rCountTab[$i]*100/$sum);
           }
                if ($i < count($rL)){
                    echo '},';
                } else {
                    echo '}';
                }
                $i++;
                } ?>

            ],


            formatter: function (value) { return (value) + '%'; },
            // The name of the data record attribute that contains x-values.
            xkey: 'label',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        //    formatter: function (value) { return value+"%"}
        });

        </script>


</body>
</html>
