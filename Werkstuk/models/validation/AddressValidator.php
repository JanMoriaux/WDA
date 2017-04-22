<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 13:58
 */

require_once 'ObjectValidator.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/entities/Address.php';


//class voor het valideren van Address objecten
//genereert foutboodschappen indien meegegeven object niet valid is
class AddressValidator extends ObjectValidator
{
    //Address Object dat moet gevalideerd worden
    protected $address;

    protected $requiredFields = array('street', 'number', 'postalCode', 'city');
    protected $numericFields = array('number', 'postalCode');
    protected $strictPosInts = array('postalCode','number');
    protected $nameFields = array('street', 'city');
    protected $fieldLengths = array(
        'street' => [2,255],
        'city' => [2, 255]
    );
    protected $fieldBoundaries = array(
        'postalCode' => [1000,9999]
    );


    //ctor
    public function __construct($address)
    {
        $this->setAddress($address);
    }

    //gaat na of het meegegeven object een Address object is
    //indien ja: Address validatie
    //indien nee: foutboodschap toevoegen aan eerste element van errors array
    public function setAddress($address)
    {
        if (isset($address) && !empty($address)) {
            if (get_class($address) === "Address") {
                $this->address = $address;
                $this->updateErrorsAndValues();
            } //foutboodschap indien geen geldig object
            else {
                $this->errors[0] = $this->errorValues['object'];
            }
        } else {
            $this->errors[0] = $this->errorValues['object'];
        }

    }

    //initiële waarden van de errors array
    protected function setErrors()
    {
        $this->errors = [
            'street' => '',
            'number' => '',
            'bus' => '',
            'postalCode' => '',
            'city' => ''
        ];
    }

    //propertywaarden van het Address object worden ingevuld in values array
    protected function setValues()
    {
        $this->values = [
            'street' => $this->address->getStreet(),
            'number' => $this->address->getNumber(),
            'bus' => $this->address->getBus(),
            'postalCode' => $this->address->getPostalCode(),
            'city' => $this->address->getCity()
        ];
    }

    public function validate()
    {
        //validatie van verplichte-, numerieke-, strikt positieve- en namevelden en lengte en grenzen van velden
        parent::validate();

        //extra validatie
        $this->validateBusNumber();
    }


    protected function validateBusNumber(){
        //'bus' is geen verplicht veld, enkel valideren indien aanwezig
        if (isset($this->values['bus']) && !empty($this->values['bus'])) {
            if (!ValidationRules::isValidBusNumber($this->values['bus'])) {
                $this->errors['bus'] = $this->errorValues['bus'];
                $this->values['bus'] = '';
            }
        }
    }
}