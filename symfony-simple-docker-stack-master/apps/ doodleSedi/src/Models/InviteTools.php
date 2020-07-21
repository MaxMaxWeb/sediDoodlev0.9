<?php


namespace App\Models;


class InviteTools
{
    private $databaseTools;

    public function __construct($databaseTools)
    {
        $this->databaseTools = $databaseTools;
    }


    public function getAllSonbyInv($id){
        $results = $this->databaseTools->executeQuery("SELECT sondage.id, sondage.choix_mult, sondage.titre from sondage 
    INNER JOIN invite_user ON sondage.invite_id = invite_user.invite_id  and invite_user.invite_id = sondage.invite_id   INNER
        JOIN user ON invite_user.user_id = '$id' and user.id = '$id' WHERE isConf is not null ");

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

    public function getNbOfInvite($id){
        $results = $this->databaseTools->executeQuery("SELECT invite_id from sondage where id = '$id'");

        return $results;
    }

}