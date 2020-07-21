<?php


namespace App\Models;
use App\Tools\DatabaseTools;

class UserTools
{
    private $databaseTools;

    public function __construct($databaseTools)
    {
        $this->databaseTools = $databaseTools;
    }

    public function getAllUsers(){
        $results = $this->databaseTools->executeQuery('SELECT * from user');
        $users = [];
        foreach ($results as $result){
            $user = new User();
            $user->setId($result['id']);
            $user->setName($result['name']);

            array_push($users, $user);
        }
        return $users;
    }

    public function hydrateUser($data, $user){
        $user->setName($data['name']);
        $user->setPassword(hash('sha512', $_POST['pswd']));

        return $user;
    }

    public function newUser($user){
        $params = [
            ["paramKey" => ":name", "paramValue" => $user->getName()],
            ["paramKey" => ":password", "paramValue" => $user->getPassword()],
        ];
        $this->databaseTools->insertQuery('INSERT INTO user (name, password) values (:name, :password)', $params);
    }






}