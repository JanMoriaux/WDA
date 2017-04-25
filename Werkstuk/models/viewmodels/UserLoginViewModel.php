<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 11:18
 */
class UserLoginViewModel
{
    /**
     * @var string
     */
    protected $userName;
    /**
     * @var string
     */
    protected $password;

    /**
     * UserLoginViewModel constructor.
     * @param string $userName
     * @param string $password
     */
    public function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}