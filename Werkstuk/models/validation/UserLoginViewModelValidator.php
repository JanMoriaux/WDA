<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 11:19
 */
require_once ROOT . '/models/validation/ObjectValidator.php';
require_once ROOT . '/models/viewmodels/UserLoginViewModel.php';

class UserLoginViewModelValidator extends ObjectValidator
{
    /**
     * @var UserLoginViewModel
     */
    protected $loginViewModel;

    /**
     * @var array met namen van verplichte velden
     */
    protected $requiredFields = array('userName','password');

    /**
     * UserLoginViewModelValidator constructor.
     * @param $loginViewModel
     */
    public function __construct($loginViewModel)
    {
        $this->setLoginViewModel($loginViewModel);
    }

    /**
     * @param $loginViewModel UserLoginViewModel object dat moet gevalideerd worden
     * Deze functie gaat na of de meegegeven parameter een Product object is en
     * valideert het object indien waar.
     * Indien niet waar, wordt een foutboodschap toegevoegd aan de array met foutboodschappen
     */
    public function setLoginViewModel($loginViewModel){
        if(isset($loginViewModel)){
            if(get_class($loginViewModel) === "UserLoginViewModel"){
                $this->loginViewModel = $loginViewModel;
                $this->updateErrorsAndValues();
            } else{
                $this->errors[0] = $this->errorValues['object'];
            }
        } else{
            $this->errors[0] = $this->errorValues['object'];
        }
    }

    /**
     * reset de foutboodschappen voor alle veldnamen naar lege strings
     */
    protected function setErrors()
    {
        $this->errors = array(
            'userName' => '',
            'password' => ''
        );
    }

    /**
     * zet de waarden voor alle veldnamen naar de attribuutwaarden van het te valideren object
     */
    protected function setValues()
    {
        $this->values = array(
            'userName' => $this->loginViewModel->getUserName(),
            'password' => $this->loginViewModel->getPassword()
        );
    }

    /**
     * validatie van geauthorizeerde user
     */
    protected function validate()
    {
        parent::validate();

       $this->validateUser();
    }

    protected function validateUser(){
        if(empty($this->errors['userName']) && empty($this->errors['password'])){

            if(!ValidationRules::isAuthorizedUser(
                $this->values['userName'],$this->values['password'])){

                $this->errors['userName'] = $this->errorValues['noUser'];
                $this->values['password'] = '';
            }
        }
    }

}