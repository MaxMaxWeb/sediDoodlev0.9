<?php


namespace App\Models;


class RepondantReponse
{
    public $repondantId;
    public $reponseId;

    /**
     * @return mixed
     */
    public function getRepondantId()
    {
        return $this->repondantId;
    }

    /**
     * @param mixed $repondantId
     */
    public function setRepondantId($repondantId)
    {
        $this->repondantId = $repondantId;
    }

    /**
     * @return mixed
     */
    public function getReponseId()
    {
        return $this->reponseId;
    }

    /**
     * @param mixed $reponseId
     */
    public function setReponseId($reponseId)
    {
        $this->reponseId = $reponseId;
    }


}