<?php

class UserModel
{
    public $username = 'Guest';
    public $isGuest = true;
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function __construct() {
     
    }

    /**
     * Get all songs from database
     */
    public function getIsGuest()
    {
        return false;

    }

}
