<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 16:57
 */
require_once('User.php');
require_once('ObjectValidator.php');
require_once('AddressValidator.php');


//class voor het valideren van User objecten
//genereert foutboodschappen indien meegegeven object niet valid is
class UserValidator extends ObjectValidator
{
    //User object dat moet gevalideerd worden
    protected $user;

    protected $requiredFields = array('id', 'firstName', 'lastName', 'userName', 'password', 'email', 'isAdmin');
    protected $numericFields = array('id');
    protected $strictPosInts = array('id');
    protected $nameFields = array('firstName', 'lastName');
    protected $fieldLenghts = array(
        'firstName' => [2, 255],
        'lastName' => [2, 255],
        'userName' => [3, 15],
        'password' => [8, 16],
        'email' => [3, 254]
    );

    //moeten als address gevalideerd worden
    protected $addresses = array('facturationAddress', 'deliveryAddress');

    //ctor
    public function __construct($user)
    {
        $this->user = $this->setUser($user);
    }

    //gaat na of het meegegeven object een User object is
    //indien ja: User validatie
    //indien nee: foutboodschap toevoegen aan eerste element van errors array
    public function setUser($user)
    {
        if (isset($user) && !empty($user)) {
            if (get_class($user) === 'User') {
                $this->user = $user;
                $this->updateErrorsAndValues();
            } else {
                $this->errors[0] = $this->errorMessages['object'];
            }
        } else {
            $this->errors[0] = $this->errorMessages['object'];
        }
    }

    // initiële waarden van de errors array
    protected function setErrors()
    {
        $this->errors = [
            'id' => '',
            'firstName' => '',
            'lastName' => '',
            'userName' => '',
            'password' => '',
            'email' => '',
            'facturationAddress' => null,
            'deliveryAddress' => null,
            'isAdmin' => ''
        ];
    }

    //propertywaarden van het User object worden ingevuld in values array
    protected function setValues()
    {
        $this->values = [
            'id' => $this->user->getId(),
            'firstName' => $this->user->getFirstName(),
            'lastName' => $this->user->getLastName(),
            'userName' => $this->user->getUserName(),
            'password' => $this->user->getPassword(),
            'email' => $this->user->getEmail(),
            'facturationAddress' => $this->user->getFacturationAddress(),
            'deliveryAddress' => $this->user->getDeliveryAddress(),
            'isAdmin' => $this->user->isAdmin()
        ];
    }

    function validate()
    {

        //validatie van verplichte-, numerieke-, strikt positieve- en namevelden en lengte van velden
        parent::validate();


        //extra validatie
        //userName
        $this->validateUserName();
        //password
        $this->validatePassword();
        //email
        $this->validateEmailAddress();
        //eventueel adressen indien ingevuld in formulier
        //TODO samen valideren van adressen en gebruikersinfo, of worden adressen enkel bij plaatsen bestelling ingediend??????
        //TODO opzoeken van adresnummers in db??
        $this->validateAddresses();

    }

    protected function validateUserName()
    {
        if (empty($this->errors['userName']) && !ValidationRules::isValidUserName($this->values['userName'])) {
            $this->errors['userName'] = $this->errorMessages['userNameRegex'];
            $this->values['userName'] = '';
        }
    }

    protected function validatePassword()
    {
        //TODO ViewModel validatie voor repeatpasswordField????
        if (empty($this->errors['password']) && !ValidationRules::isValidPassword($this->values['password'])) {
            $this->errors['password'] = $this->errorMessages['passwordRegex'];
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

    //
    protected function validateAddresses(){
        foreach ($this->addresses as $fieldName) {
            if (isset($this->values[$fieldName]) && !empty($this->values[$fieldName])) {
                $addressValidator = new AddressValidator($this->values[$fieldName]);
                $this->errors[$fieldName] = $addressValidator->getErrors();
                $this->values[$fieldName] = $addressValidator->getValues();
            }
            unset($addressValidator);
        }
    }

}