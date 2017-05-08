<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 12:57
 */
class Email
{
    /**
     * @var string
     */
    protected $emailaddress;
    /**
     * @var string
     */
    protected $message;

    /**
     * Email constructor.
     * @param string $emailaddress
     * @param string $message
     */
    public function __construct($emailaddress, $message)
    {
        $this->emailaddress = $emailaddress;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * @param string $emailaddress
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}