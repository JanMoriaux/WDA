<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 21/04/2017
 * Time: 12:55
 */
require_once 'UserValidator.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] .
    '/WDA/Werkstuk/models/viewmodels/UserRegistrationViewModel.php';

/**
 * Class UserRegistrationViewModelValidator
 * Voor validatie van het User registratieformulier,
 * voegt een repeatPassword validatie toe een de validatie in
 * de UserValidator class
 */
class UserRegistrationViewModelValidator extends UserValidator
{
    /**
     * @var string bevat naast de User-type property van de superklasse ook een property voor
     * de waarde van het repeatPassword veld van het registratieformulier
     */
    protected $repeatPassword;

    /**
     * @var array met de namen van de verplichte velden in het registratieformulier
     */
    protected $requiredFields = array('firstName', 'lastName', 'userName', 'password', 'repeatPassword', 'email');
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
        'repeatPassword' => [8,16],
        'email' => [3, 254]
    );

    /**
     * UserRegistrationViewModelValidator constructor.
     * @param $userViewModel UserRegistrationViewModel
     * Nieuwe User aanmaken met de veldwaarden die overeenkomen met een User-property.
     * Daarnaast ook de repeatPassword property uit het formulier halen.
     */
    public function __construct($userViewModel)
    {
        parent::__construct(new User($userViewModel->getId(),$userViewModel->getFirstName(),
            $userViewModel->getLastName(),$userViewModel->getUserName(),$userViewModel->getPassword(),
            $userViewModel->getEmail(), $userViewModel->getFacturationAddressId(),
            $userViewModel->getDeliveryAddressId(),$userViewModel->isAdmin()));

            $this->setRepeatPassword($userViewModel->getRepeatPassword());
    }

    /**
     * @param $repeatPassword string met de waarde van het repeatPassword veld
     */
    public function setRepeatPassword($repeatPassword){
        $this->repeatPassword = $repeatPassword;
        $this->updateErrorsAndValues();
    }

    /**
     * Voegt nog een element toe aan de errors array van de superclass met een eventuele
     * foutboodschap voor het repeatPassword veld
     */
    protected function setErrors()
    {
        parent::setErrors();
        $this->errors['repeatPassword'] = '';
    }

    /**
     * Voegt nog een element toe aan de values array van de superclass met
     * de waarde van het repeatPassword veld
     */
    protected function setValues()
    {
        parent::setValues(); //
        $this->values['repeatPassword'] = $this->repeatPassword;
    }

    /**
     * Voegt validatie van het repeatPasword veld toe aan de validatie uit de superclass
     */
    protected function validate(){
        parent::validate();

        //extra validatie repeatPassword en password
        $this->validateRepeatPassword();
    }

    /**
     * repeatPassword veldwaarde valideren als password en nagaan of password en repeatPassword
     * waarden overeenkomen
     */
    protected function validateRepeatPassword(){

        if(empty($this->errors['repeatPassword']) &&
            !ValidationRules::isValidPassword($this->values['repeatPassword'])){
            $this->errors['repeatPassword'] = $this->errorValues['passwordRegex'];
            $this->values['repeatPassword'] = '';
         }

        //als waarden voor de passwoorden geldig zijn, kijken of ze hetzelfde zijn
        if(empty($this->errors['password']) && empty($this->errors['repeatPassword'])){
            if($this->values['password'] !== $this->values['repeatPassword']){
                $this->errors['password'] = $this->errorValues['passwordNotSame'];
                $this->values['repeatPassword'] = '';
            }
        }
    }


}