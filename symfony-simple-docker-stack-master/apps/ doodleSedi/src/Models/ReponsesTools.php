<?php


namespace App\Models;


class ReponsesTools
{
    private $databaseTools;

    public function __construct($databaseTools)
    {
        $this->databaseTools = $databaseTools;
    }

    public function newRList($d, $id){
        $rList = [];
        for ($i = 1; $i <= count($d); $i++){
            $r = new Reponse();
            $r->setName($d['r'.$i]);
            $r->setSondageId($id);

            array_push($rList, $r);
        }

        return $rList;
    }

    public function setQuestion($r){

        $params = [
            ['paramKey' => ":sondage_id", "paramValue" => $r->getSondageId()],

            ['paramKey' => ":name", "paramValue" => $r->getName()],
        ];

        $this->databaseTools->insertQuery("INSERT INTO reponse (sondage_id, name) VALUES (:sondage_id, :name)", $params);

    }
    public function hydrateRl($rl, $data){

        foreach ($data as $d){

            $rl->setId($d['id']);
            $rl->setName($d['name']);


        }





        return $rl;
    }

    public function getAllReponsefromS($id){

       $results = $this->databaseTools->executeQuery("SELECT * FROM reponse WHERE sondage_id = '$id'");
        $rL = [];
       foreach ($results as $result){
           $r = new Reponse();
           $r->setId($result['id']);
           $r->setName($result['name']);
           array_push($rL, $r);
       }

       return $rL;

    }

    public function setNewReponses($uid, $data, $sId){

        $now = new \DateTime();
        $uRep = new Repondant();
        $uRep->setUserWhoRep($uid);
        $uRep->setDateCrea($now->format('Y-m-d'));
        $uRep->setSondageId($sId);


        $repList = [];


        $params = [
            ["paramKey" => ":user_who_rep_id", "paramValue" => $uRep->getUserWhoRep()],
            ["paramKey" => ":date_crea", "paramValue" => $uRep->getDateCrea()],
            ["paramKey" => ":sondage_id", "paramValue" => $uRep->getSondageId()]

        ];

        $this->databaseTools->insertQuery("INSERT INTO repondant (user_who_rep_id, date_crea, sondage_id) VALUES 
                                                                      (:user_who_rep_id, :date_crea, :sondage_id)", $params);
        $rId = $this->databaseTools->lastId();

        for ($i = 0; $i <= array_key_last($data); $i++){
            if(!empty($data[$i])){
                $repRep = new RepondantReponse();

                $repRep->setRepondantId($rId);
                $repRep->setReponseId($data[$i]);
                array_push($repList, $repRep);
            }

        }

        foreach ($repList as $rL){

            $params = [
                ["paramKey" => ":repondant_id", "paramValue" => $rL->getRepondantId()],
                ["paramKey" => ":reponse_id", "paramValue" => $rL->getReponseId()]
            ];
            $this->databaseTools->insertQuery("INSERT INTO repondant_reponse (repondant_id, reponse_id) VALUES 
                                                                (:repondant_id, :reponse_id)", $params );

        }



    }

    public function getNbofR($rId){

        return $this->databaseTools->countRep($rId);
    }








}