<?php


namespace App\Models;


class SondageTools
{

    private $databaseTools;

    public function __construct($databaseTools)
    {
        $this->databaseTools = $databaseTools;
    }

    public function newInv()
    {
     $params = [
         ["paramKey" => "", "paramValue" => ""]
     ];
        $this->databaseTools->insertQuery('INSERT INTO invite values ()', $params);

        return $this->databaseTools->lastId();
    }



    public function hydrateSforUp($son, $data){
        $date = new \DateTime();
        foreach ($data as $d){

        $son->setTitre($d['titre']);
        $son->setDescription($d['description']);

        $son->setDateFin(($d['date_fin']));


        if($d['choix_mult'] == '1'){
            $son->setChoixMult(1);
        } else {
            $son->setChoixMult(null);
        }
        }





        return $son;
    }



    public function hydrateSon($son, $data, $inv){

       $now = new \DateTime();

       $son->setTitre($data['name']);
       $son->setAuteurId($_SESSION['user_id']);
       if (!empty($data['description'])){
           $son->setDescription($data['description']);
       }


       $son->setProjetId($data['choicePro']);
       $son->setInviteId($inv->getId());
        $son->setDateCrea($now->format('Y-m-d'));
        if(!empty($data['dateFin'])){
            $son->setDateFin($data['dateFin']);
        }
        if($data['choixMult'] == 'oui'){
            $son->setChoixMult(1);
        }



        return $son;
    }

    public function hydrateinvU($inv, $invU, $data){

        foreach ($invU as $iu){
            $invU->setInviteId($inv->getId());
            $invU->setUserId($data['invite']);
        }


        return $invU;
    }

    public function newInvU($invU, $i){

            $params = [
                ['paramKey' => ":invite_id", "paramValue" => $invU->getInviteId()],

                ['paramKey' => ":user_id", "paramValue" => $invU->getUserId()[$i]],

            ];



        $this->databaseTools->insertQuery("INSERT INTO invite_user (invite_id, user_id) VALUES (:invite_id, :user_id)", $params);

    }

    public function newSon($son){
        $params = [
            ["paramKey" => ":auteur_id" , "paramValue" => $son->getAuteurId()],
            ["paramKey" => ":projet_id" , "paramValue" => $son->getProjetId()],
            ["paramKey" => ":invite_id" , "paramValue" => $son->getInviteId()],
            ["paramKey" => ":titre" , "paramValue" => $son->getTitre()],
            ["paramKey" => ":description" , "paramValue" => $son->getDescription() ],
            ["paramKey" => ":date_crea" , "paramValue" => $son->getDateCrea()],
            ["paramKey" => ":date_fin" , "paramValue" => $son->getDateFin() ],
            ["paramKey" => ":choix_mult" , "paramValue" => $son->getChoixMult() ]
        ];


        $this->databaseTools->setAttribute();
        $this->databaseTools->insertQuery("INSERT INTO sondage  
        (auteur_id, projet_id, invite_id, titre, description, date_crea, date_fin, choix_mult) values 
        (:auteur_id, :projet_id, :invite_id, :titre, :description, :date_crea, :date_fin, :choix_mult)", $params);

    //    print_r($this->databaseTools->getError());

    }

    public function getAllSonWnoRofUser($id){
      $results = $this->databaseTools->executeQuery("SELECT * from sondage where isConf is null AND  auteur_id = '$id'" );
      $emSon = [];
      foreach ($results as $result){
            $son = new Sondage();
            $son->setTitre($result['titre']);
            $son->setId($result['id']);
            array_push($emSon, $son);
        }
         return $emSon;



}

public function getSonById($id){

    $results =  $this->databaseTools->executeQuery("SELECT * from sondage WHERE  id = '$id' ");

    $son = new Sondage();

    $sond = $this->hydrateSforUp($son, $results);



    return $sond;


}

public function getSonByUser($id, $d){

      $results =  $this->databaseTools->executeQuery("SELECT * from sondage WHERE isConf is null AND auteur_id = '$id' AND id = '$d' ");

      $son = new Sondage();


     $sond = $this->hydrateSforUp($son, $results);



     return $sond;





}

public function updateSon($data, $id){
       $son = new Sondage();

       $son->setTitre($data['name']);
       $son->setDescription($data['description']);
       if ($data['choixMult'] == 'oui') {
           $son->setChoixMult(1);
       }else {
           $son->setChoixMult(null);
       }

       $t = $son->getTitre();
       $d = $son->getDescription();
       $cm = $son->getChoixMult();
       if ($cm != null){
       $this->databaseTools->executeQuery("UPDATE sondage set titre = '$t', description = '$d', choix_mult = '$cm' where id = '$id' ");
       } else {
           $this->databaseTools->executeQuery("UPDATE sondage set titre = '$t', description = '$d', choix_mult = null where id = '$id' ");
       }
}

    public function setSontoConf($id){

        $son = new Sondage();

        $son->setIsConf(1);

        $c = $son->getIsConf();

        $this->databaseTools->executeQuery("UPDATE sondage set isConf = $c where id = '$id'");
    }

    public function getAllSonR($id){
        $results = $this->databaseTools->executeQuery("SELECT * from sondage where isConf is not null AND  auteur_id = '$id'" );

        $sond = [];
        foreach ($results as $result){
            $son = new Sondage();
            $son->setTitre($result['titre']);
            $son->setId($result['id']);
            $son->setChoixMult($result['choix_mult']);
            array_push($sond, $son);
        }
        return $sond;



    }

    public function checkIfRep($sId, $uId){

        $results = $this->databaseTools->executeQuery("SELECT * from repondant where sondage_id = '$sId' and user_who_rep_id = '$uId'");



        $uRList = [];

        foreach ($results as $result){
            $ur = new Repondant();
            $ur->setUserWhoRep($result['user_who_rep_id']);
            $ur->setSondageId($result['sondage_id']);
            array_push($uRList, $ur);

        }

        return $uRList;
    }



}