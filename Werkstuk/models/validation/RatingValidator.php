<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 4/05/2017
 * Time: 12:39
 */
require_once ROOT . '/models/validation/ObjectValidator.php';
require_once ROOT . '/models/entities/Rating.php';

//class voor het valideren van Rating objecten
//genereert foutboodschappen indien meegegeven object niet valid is
class RatingValidator extends ObjectValidator
{
    //rating object dat moet gevalideerd worden
    /**
     * @var Rating
     */
    protected $rating;

    protected $requiredFields = array('ratingValue', 'comment');
    protected $numericFields = array('ratingValue');
    protected $strictPosInts = array('ratingValue');
    protected $fieldLengths = array(
        'comment' => array(5, 1000)
    );
    protected $fieldBoundaries = array(
        'ratingValue' => array(1, 5)
    );



    public function __construct($rating)
    {
        $this->setRating($rating);
    }

    public function setRating($rating){
        if(isset($rating) && !empty($rating)){
            if(get_class($rating) === 'Rating'){
                $this->rating = $rating;
                $this->updateErrorsAndValues();
            } else{
                $this->errors[0] = $this->errorValues['object'];
            }
        } else{
            $this->errors[0] = $this->errorValues['object'];
        }
    }

    public function setErrors()
    {
        $this->errors = array(
            'productId' => '',
            'userId' => '',
            'ratingValue' => '',
            'comment' => ''
        );
    }

    public function setValues()
    {
        $this->values = array(
            'productId' => $this->rating->getProductId(),
            'userId' => $this->rating->getUserId(),
            'ratingValue' => $this->rating->getRatingValue(),
            'comment' => $this->rating->getComment()
        );
    }

    public function validate(){
        //validatie van verplichte-, numerieke-, strikt positieve- en namevelden en lengte en grenzen van velden
        parent::validate();

        //nagaan of de user al een rating aan dit product heeft gegeven
        $this->validateUniqueForUser();

    }

    protected function validateUniqueForUser(){

        if(empty($this->errors['userId']) &&
            !ValidationRules::isUniqueUserRating($this->values['userId'],$this->values['productId'])){
            $this->errors['userid'] = $this->errorValues['alreadyRated'];
        }
    }

}