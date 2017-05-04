<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 21/04/2017
 * Time: 12:50
 */

require_once ROOT . '/models/entities/User.php';

class UserRegistrationViewModel extends User
{
    /**
     * @var string
     */
    protected $repeatPassword;

    /**
     * UserRegistrationViewModel constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $userName
     * @param string $password
     * @param string $email
     * @param int $facturationAddressId
     * @param int $deliveryAddressId
     * @param bool $admin
     * @param $repeatPassword
     */
    public function __construct($id, $firstName, $lastName, $userName, $password, $email, $facturationAddressId,
                                $deliveryAddressId, $admin, $repeatPassword)
    {
        parent::__construct($id, $firstName, $lastName, $userName, $password, $email,
            $facturationAddressId, $deliveryAddressId, $admin);

        $this->repeatPassword = $repeatPassword;
    }

    /**
     * @return string
     */
    public function getRepeatPassword(){
        return $this->repeatPassword;
    }

    /**
     * @param $repeatPassword
     */
    public function setRepeatPassword($repeatPassword){
        $this->repeatPassword = $repeatPassword;
    }


}