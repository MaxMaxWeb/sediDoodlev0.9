<?php


namespace App\Models;


class Repondant
{
    public $id;
    public $userWhoRep;
    public $dateCrea;
    public $sondageId;

    /**
     * @return mixed
     */
    public function getSondageId()
    {
        return $this->sondageId;
    }

    /**
     * @param mixed $sondageId
     */
    public function setSondageId($sondageId): void
    {
        $this->sondageId = $sondageId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserWhoRep()
    {
        return $this->userWhoRep;
    }

    /**
     * @param mixed $userWhoRep
     */
    public function setUserWhoRep($userWhoRep)
    {
        $this->userWhoRep = $userWhoRep;
    }

    /**
     * @return mixed
     */
    public function getDateCrea()
    {
        return $this->dateCrea;
    }

    /**
     * @param mixed $dateCrea
     */
    public function setDateCrea($dateCrea)
    {
        $this->dateCrea = $dateCrea;
    }


}