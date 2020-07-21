<?php


use App\Tools\DatabaseTools;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$loader = require '../vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];
$uri = parse_url($request, PHP_URL_PATH);

$whoops = new Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

$dbTools = new DatabaseTools("mysql", "sedi", "root", "root");



switch ($uri) {
    case '/' :
        require __DIR__ . '/pages/homepage.php';
        break;
    case '/signup':
        require __DIR__ .'/pages/signup.php';
        break;
    case '/login':
        require __DIR__ . '/pages/login.php';
        break;
    case '/home':
        require __DIR__ . '/pages/homepage.php';
        break;
    case '/projet':
        require __DIR__ . '/pages/projet.php';
        break;
    case '/sondageupdate':
        require __DIR__ . '/pages/sondageUpdate.php';
        break;
    case '/questions':
        require __DIR__.'/pages/addQuestions.php';
        break;
    case '/repondre':
        require __DIR__ .'/pages/repondre.php';
        break;
    case '/resultats':
        require __DIR__ .'/pages/resultats.php';
        break;

}

