<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 8/05/2017
 * Time: 12:58
 */
require_once ROOT . '/models/entities/Email.php';
require_once ROOT . '/models/validation/ValidationRules.php';
require_once ROOT . '/models/validation/ObjectValidator.php';

class EmailValidator extends ObjectValidator
{
    /**
     * @var Email
     */
    protected $email;

    protected $requiredFields = array('emailaddress', 'message');
    protected $fieldLengths = array(
        'message' => [2, 5000],
    );

    public function __construct($email)
    {
      $this->setEmail($email);
    }

    public function setEmail($email){
        if (isset($email) && !empty($email)) {
            if (get_class($email) === "Email") {
                $this->email = $email;
                $this->updateErrorsAndValues();
            } //foutboodschap indien geen geldig object
            else {
                $this->errors[0] = $this->errorValues['object'];
            }
        } else {
            $this->errors[0] = $this->errorValues['object'];
        }
    }

    protected function setErrors()
    {
        $this->errors = array(
            'emailaddress' =>'',
            'message' => ''
        );
    }

    protected function setValues(){
        $this->values = array(
            'emailaddress' =>$this->email->getEmailaddress(),
            'message' => $this->email->getMessage()
        );
    }

    public function validate(){
        parent::validate();

        //validatie van het emailadres
        $this->validateEmailAddress();
    }

    protected function validateEmailAddress()
    {
        if (empty($this->errors['emailaddress']) && !ValidationRules::isValidEmailAddress($this->values['emailaddress'])) {
            $this->errors['emailaddress'] = 'Geen geldig email-adres';
            $this->values['emailaddress'] = '';
        }
    }


}