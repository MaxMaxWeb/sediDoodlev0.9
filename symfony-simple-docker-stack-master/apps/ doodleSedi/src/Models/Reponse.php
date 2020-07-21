<?php


namespace App\Models;


class Reponse
{
    public $id;
    public $sondageId;
    public $name;

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
    public function getSondageId()
    {
        return $this->sondageId;
    }

    /**
     * @param mixed $sondageId
     */
    public function setSondageId($sondageId)
    {
        $this->sondageId = $sondageId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}