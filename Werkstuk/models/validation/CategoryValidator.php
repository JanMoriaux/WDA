<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 15:32
 */
require_once 'ObjectValidator.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/entities/Category.php';

class CategoryValidator extends ObjectValidator
{
    /**
     * @var Category
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
    }
}