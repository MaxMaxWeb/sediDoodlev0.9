<?php


namespace App\Models;


class InviteUser
{
    public $inviteId;
    public $userId;

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



}