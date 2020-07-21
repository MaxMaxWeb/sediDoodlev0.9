<?php


namespace App\Models;


class ProjetTools
{
    private $databaseTools;

    public function __construct($databaseTools)
    {
        $this->databaseTools = $databaseTools;
    }

    public function getAllProjet()
    {
        $results = $this->databaseTools->executeQuery('SELECT * from projet');
        $projets = [];
        foreach ($results as $result) {
            $projet = new Projet();
            $projet->setId($result['id']);
            $projet->setName($result['name']);

            array_push($projets, $projet);
        }
        return $projets;
    }

    public function getAllProjetFromAUser($id){
        if(!is_int($id)){
            header('Location: /home');
        }
        $results = $this->databaseTools->executeQuery("SELECT * FROM projet  INNER JOIN projetDeUser ON projetDeUser.projet = projet.id WHERE projetDeUser.user = '$id' ");

        $projets = [];
        foreach ($results as $result) {
            $projet = new Projet();

            $projet->setName($result['name']);

            array_push($projets, $projet);
        }
        return $projets;
    }

    public function hydrateProjet($data, $projet)
    {
        $projet->setName($data['name']);


        return $projet;
    }

    public function newProjet($projet)
    {
        $params = [
            ["paramKey" => ":name", "paramValue" => $projet->getName()],



        ];



        $this->databaseTools->insertQuery('INSERT INTO projet (name) values (:name)', $params);
    }

    public function getAllProjetByUserId($id){

       $results = $this->databaseTools->executeQuery("SELECT * FROM projet  INNER JOIN user_projet ON user_projet.projet_id = projet.id 
        WHERE user_projet.user_id = '$id'");
       if (is_bool($results)){
           header('Location: /home');
       }
       $projets = [];
       foreach ($results as $result){
           $projet = new UserProjet();
           $projet->setProjetName($result['name']);
           $projet->setProjetId($result['id']);
           array_push($projets, $projet);
       }
       return $projets;
    }

    public function getAllUserByProjetId($id){

        $results = $this->databaseTools->executeQuery("SELECT * FROM user  INNER JOIN user_projet ON user_projet.user_id = user.id WHERE user_projet.projet_id = '$id'");

        if (is_bool($results)){
            header('Location: /home');
            die();
        }
        $users = [];
        foreach ($results as $result){
            $user = new UserProjet();
            $user->setUserName($result['name']);
            $user->setUserId($result['id']);
            array_push($users, $user);
        }
        return $users;
    }

    public function getProjetById($id){
        $results = $this->databaseTools->executeQuery("SELECT * FROM projet WHERE id = '$id' ");
        $projets = [];
        foreach ($results as $result){
        $projet = new Projet();
        $projet->setId($result['id']);
        $projet->setName($result['name']);
        array_push($projets, $projet);
        }
        return $projets;
    }


    public function getAllUserByProjets($projets){
        $users = [];

        foreach ($projets as $projet){

          $user =  $this->getAllUserByProjetId($projet->getProjetId());


        }

        array_push($users, $user);

        return $users;

    }





}