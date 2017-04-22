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
     * @var string
     */
    protected $repeatPassword;

    //todo requiredfields and fieldLenghts not updating


    /**
     * UserRegistrationViewModelValidator constructor.
     * @param $userViewModel
     */
    public function __construct($userViewModel)
    {
        parent::__construct(new User($userViewModel->getId(),$userViewModel->getFirstName(),
            $userViewModel->getLastName(),$userViewModel->getUserName(),$userViewModel->getPassword(),
            $userViewModel->getEmail(), $userViewModel->getFacturationAddressId(),
            $userViewModel->getDeliveryAddressId(),$userViewModel->isAdmin()));

            $this->setRepeatPassword($userViewModel->getRepeatPassword());

            //extra repeatPassword veld toevoegen aan verschillende validatie arrays
            $this->fieldLengths['repeatPassword'] = [8,16];
    }

    public function setRepeatPassword($repeatPassword){
        $this->repeatPassword = $repeatPassword;
        $this->updateErrorsAndValues();
    }

    protected function setErrors()
    {
        parent::setErrors();
        $this->errors['repeatPassword'] = '';
    }
    protected function setValues()
    {
        parent::setValues(); //
        $this->values['repeatPassword'] = $this->repeatPassword;
    }
    protected function validate(){
        parent::validate();

        //extra validatie repeatPassword en password
        $this->validateRepeatPassword();
    }
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