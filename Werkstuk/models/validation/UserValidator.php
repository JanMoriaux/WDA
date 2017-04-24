<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 16:57
 */


require_once 'ObjectValidator.php';

require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/entities/User.php';


class UserValidator extends ObjectValidator
{
    /**
     * @var User het object dat gavalideerd wordt
     */
    protected $user;

    /**
     * @var array met de namen van de verplichte velden
     */
    protected $requiredFields = array('firstName', 'lastName', 'userName', 'password', 'email');
    /**
     * @var array met de namen van de velden die als 'name' gevalideerd worden
     */
    protected $nameFields = array('firstName', 'lastName');
    /**
     * @var array met de minimum- en maximumlengten van gerestricteerde veldnamen
     */
    protected $fieldLengths = array(
        'firstName' => [2, 255],
        'lastName' => [2, 255],
        'userName' => [3, 15],
        'password' => [8, 16],
        'email' => [3, 254]
    );

    /**
     * UserValidator constructor.
     * @param $user User object dat gevalideerd wordt
     */
    public function __construct($user)
    {
        $this->setUser($user);
    }

    //gaat na of het meegegeven object een User object is
    //indien ja: User validatie
    //indien nee: foutboodschap toevoegen aan eerste element van errors array
    /**
     * @param $user User
     * gaat na of het meegegeven object een User object is
     * indien ja: User validatie
     * indien nee: foutboodschap toevoegen aan eerste element van errors array
     */
    protected function setUser($user)
    {
        if (isset($user) && !empty($user)) {
            if (get_class($user) === 'User') {
                $this->user = $user;
                $this->updateErrorsAndValues();
            } else {
                $this->errors[0] = $this->errorValues['object'];
            }
        } else {
            $this->errors[0] = $this->errorValues['object'];
        }
    }

    /**
     * @return User het User object dat werd gevalideerd
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * set de foutboodschappen op lege strings
     */
    protected function setErrors()
    {
        $this->errors = [
            'firstName' => '',
            'lastName' => '',
            'userName' => '',
            'password' => '',
            'email' => '',
        ];
    }

    /**
     * propertywaarden van het User object worden ingevuld in values array
     */
    protected function setValues()
    {
        $this->values = [
            'firstName' => $this->user->getFirstName(),
            'lastName' => $this->user->getLastName(),
            'userName' => $this->user->getUserName(),
            'password' => $this->user->getPassword(),
            'email' => $this->user->getEmail(),
            'isAdmin' => $this->user->isAdmin()
        ];
    }

    /**
     * parent::validate() -> validatie van verplichte-, numerieke-, strikt positieve- en namevelden en lengte van velden
     * daarna validatie van de User specifieke velden
     */
    protected function validate()
    {

        //
        parent::validate();


        //extra validatie
        //userName
        $this->validateUserName();
        //password
        $this->validatePassword();
        //email
        $this->validateEmailAddress();
        //is userName uniek?
        $this->validateUniqueUsername();
    }

    protected function validateUserName()
    {
        if (empty($this->errors['userName']) && !ValidationRules::isValidUserName($this->values['userName'])) {
            $this->errors['userName'] = $this->errorValues['userNameRegex'];
            $this->values['userName'] = '';
        }
    }

    protected function validatePassword()
    {
        if (empty($this->errors['password']) && !ValidationRules::isValidPassword($this->values['password'])) {
            $this->errors['password'] = $this->errorValues['passwordRegex'];
            $this->values['password'] = '';
        }
    }

    protected function validateEmailAddress()
    {
        if (empty($this->errors['email']) && !ValidationRules::isValidEmailAddress($this->values['email'])) {
            $this->errors['email'] = 'Geen geldig email-adres';
            $this->values['email'] = '';
        }
    }

    protected function validateUniqueUsername(){
        if (empty($this->errors['userName']) && !ValidationRules::isUniqueUserName($this->values['userName'])) {
            $this->errors['userName'] = sprintf($this->errorValues['userNameAlreadyInDb'],$this->values['userName']);
            $this->values['userName'] = '';
        }
    }

}