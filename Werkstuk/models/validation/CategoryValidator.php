<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 15:32
 */
require_once ROOT . '/models/validation/ObjectValidator.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/models/entities/Category.php';

class CategoryValidator extends ObjectValidator
{
    /**
     * @var Category het Category object dat gevalideerd wordt
     */
    protected $category;

    protected $requiredFields = array('description');
    protected $nameFields = array('description');
    protected $fieldLengths = array(
        'description' => [2,255]
    );

    public function __construct($category)
    {
        $this->setCategory($category);
    }

    protected function setErrors()
    {
        $this->errors = array('description' => '');
    }

    protected function setValues()
    {
        $this->values= array(
            'description' => $this->category->getDescription()
        );
    }

    protected function setCategory($category){
        if(isset($category) && !empty($category)){
            if(get_class($category) === 'Category'){
                $this->category = $category;
                $this->updateErrorsAndValues();
            }
        }
    }

    protected function validate(){
        parent::validate();

        //validatie van unieke Category description
        $this->validateUniqueCategoryDescription();
    }

    protected function validateUniqueCategoryDescription(){
        if(empty($this->errors['description']) &&
            !ValidationRules::isUniqueCategoryDescription($this->category->getDescription())){
            $this->errors['description'] =
                sprintf($this->errorValues['categoryAlreadyInDb'],$this->category->getDescription());
            $this->values['description'] = '';
        }
    }
}