<?php


namespace App\Models;


class Sondage
{

    public $id;
    public $auteurId;
    public $projetId;
    public $inviteId;
    public $titre;
    public $description;
    public $dateCrea;
    public $dateFin;
    public $choixMult;
    public $isConf;

    /**
     * @return mixed
     */
    public function getIsConf()
    {
        return $this->isConf;
    }

    /**
     * @param mixed $isConf
     */
    public function setIsConf($isConf)
    {
        $this->isConf = $isConf;
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
    public function getAuteurId()
    {
        return $this->auteurId;
    }

    /**
     * @param mixed $auteurId
     */
    public function setAuteurId($auteurId)
    {
        $this->auteurId = $auteurId;
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
     * @return mixed
     */
    public function getInviteId()
    {
        return $this->inviteId;
    }

    /**
     * @param mixed $inviteId
     */
    public function setInviteId($inviteId)
    {
        $this->inviteId = $inviteId;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getChoixMult()
    {
        return $this->choixMult;
    }

    /**
     * @param mixed $choixMult
     */
    public function setChoixMult($choixMult)
    {
        $this->choixMult = $choixMult;
    }




}