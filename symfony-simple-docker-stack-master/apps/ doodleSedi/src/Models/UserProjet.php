<?php


namespace App\Models;


class UserProjet
{
    public $id;
    public $projetName;
    public $projetId;
    public $userName;
    public $userId;

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }



    /**
     * @return mixed
     */
    public function getProjetName()
    {
        return $this->projetName;
    }

    /**
     * @return mixed
     */
    public function getProjetId()
    {
        return $this->projetId;
    }

    /**
     * @param mixed $projetId
     */
    public function setProjetId($projetId)
    {
        $this->projetId = $projetId;
    }

    /**
     * @param mixed $projetName
     */
    public function setProjetName($projetName)
    {
        $this->projetName = $projetName;
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



}