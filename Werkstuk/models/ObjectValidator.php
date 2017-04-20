<?php


require_once('ValidationRules.php');

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 18/04/2017
 * Time: 14:26
 */
abstract class ObjectValidator
{
    /* @var array */
    //TODO extract
    protected $errorMessages = array(
        'object' => 'Geen geldig object',
        'required' => 'Verplicht veld',
        'numeric' => 'Moet een getal zijn',
        'posInt' => 'Moet een geheel getal groter dan 0 zijn',
        'minmax' => 'Moet groter of gelijk aan %d en kleiner of gelijk aan %d zijn',
        'length' => 'Bevat minimum %d en maximum %d tekens',
        'name' => 'Bevat ongeldige tekens',
        'bus' => 'Bestaat uit maximaal 3 letters',
        'userNameRegex' => 'Mag enkel bestaan uit cijfers, letters, underscores (_) en koppeltekens',
        'passwordRegex' => 'Moet bestaan uit een combinatie cijfers, letters, !, #, $, %, &, en ?',
        'emailRegex' => 'Geen geldig email-adres'

    );
    //bevat de foutboodschappen voor verschillende formuliervelden
    protected $errors = array();
    //bevat de waarden van de verschillende formuliervelden
    protected $values = array();
    //namen van de verplichte formuliervelden
    protected $requiredFields = array();
    //namen van de numerieke formuliervelden
    protected $numericFields = array();
    //namen van de formuliervelden die als naam worden gevalideerd (bv. voornaam, achternaam, straat,...'
    protected $nameFields = array();
    //namen en minimum/maximum waarden van de velden met een gerestricteerde lengte
    protected $fieldLenghts = array();
    //namen van velden met een strikt positief geheel getal als waarde
    protected $strictPosInts = array();
    //namen en minimum/maximumwaarden van velden met een gerestricteerde waarde
    protected $fieldBoundaries = array();

    //getters en setters
    public function getErrors(){
        return $this->errors;
    }
    protected abstract function setErrors();

    public function getValues(){
        return $this->values;
    }

    protected abstract function setValues();

    //zet alle foutboodschappen terug op ''
    //zet alle values gelijk aan de propertywaarden van het te valideren object
    //valideert de values en update de foutboodschappen en values (fout => value op '')
    protected function updateErrorsAndValues(){
        $this->setErrors();
        $this->setValues();
        $this->validate();
    }
    //validatie van de verplichte velden
    //validatie van de numerieke velden
    //validatie van de 'naam' velden
    //validatie van de velden met een gerestricteerde lengte
    //validatie van de velden met strikt positief geheel getal als waarde
    //validate van velden met waarde binnen bepaalde grenzen
    //rest van de validatie gebeurt in subklassen
    protected function validate(){
        $this->validateRequiredFields();
        $this->validateNumericFields();
        $this->validateNameFields();
        $this->validateFieldLengths();
        $this->validateStrictPosInts();
        $this->validateFieldBoundaries();
    }

    protected function validateRequiredFields(){
        foreach($this->requiredFields as $fieldName){
            if(!ValidationRules::valueProvided($this->values[$fieldName])){
                $this->errors[$fieldName] = $this->errorMessages['required'];
                //waarde verwijderen indien niet geldig
                $this->values[$fieldName] = '';
            }

        }
    }

    protected function validateNumericFields(){
        foreach($this->numericFields as $fieldName){
            if(empty($this->errors[$fieldName]) && !ValidationRules::isNumeric($this->values[$fieldName])){
                $this->errors[$fieldName] = $this->errorMessages['numeric'];
                //waarde verwijderen indien niet geldig
                $this->values[$fieldName] = '';
            }
        }
    }

    protected function validateNameFields(){
        foreach($this->nameFields as $fieldName){
            if(empty($this->errors[$fieldName]) && !ValidationRules::isValidName($this->values[$fieldName])){
                $this->errors[$fieldName] = $this->errorMessages['name'];
                //waarde verwijderen indien niet geldig
                $this->values[$fieldName] = '';
            }
        }
    }

    protected function validateFieldLengths(){
        foreach($this->fieldLenghts as $fieldName => $boundaries){
            if(empty($this->errors[$fieldName]) &&
                !ValidationRules::hasValidLength($this->values[$fieldName], $boundaries[0], $boundaries[1])){
                $this->errors[$fieldName] = sprintf($this->errorMessages['length'], $boundaries[0], $boundaries[1]);
                //waarde verwijderen indien niet geldig
                $this->values[$fieldName] = '';
            }
        }
    }

    protected function validateStrictPosInts(){
        foreach($this->strictPosInts as $fieldName){
            if(empty($this->errors[$fieldName]) && !ValidationRules::isStrictPosInt($this->values[$fieldName])){
                $this->errors[$fieldName] = $this->errorMessages['posInt'];
                $this->values[$fieldName] = '';
            }
        }
    }

    protected function validateFieldBoundaries(){
        foreach($this->fieldBoundaries as $fieldName => $boundaries){
            if(empty($this->errors[$fieldName]) &&
                !ValidationRules::hasValidBoundariesIncl($this->values[$fieldName],$boundaries[0],$boundaries[1])){
                $this->errors[$fieldName] = sprintf($this->errorMessages['minmax'],$boundaries[0],$boundaries[1]);
                $this->values[$fieldName] = '';
            }
        }
    }

}