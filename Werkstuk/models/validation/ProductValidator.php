<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 20/04/2017
 * Time: 13:09
 */
require_once 'ObjectValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/WDA/Werkstuk/models/entities/Product.php';

class ProductValidator extends ObjectValidator
{
    /**
     * @var Product het product dat moet gevalideerd worden
     */
    protected $product;

    protected $requiredFields = array('name','description','image','price','highLighted','categoryId','inStock');
    protected $numericFields = array('price','categoryId','inStock');
    protected $nameFields = array('name');
    protected $fieldLengths = array(
        'name' => [2,255],
        'description' => [2,255],
        'image' => [3,255],
    );
    protected $strictPosInts = array('inStock','categoryId');
    protected $fieldBoundaries = array(
        'price' => [0.01,50000]
    );

    /**
     * ProductValidator constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $this->setProduct($product);
    }

    /**
     * @param $product het Product object dat moet gevalideerd worden
     * Deze functie gaat na of de meegegeven parameter een Product object is en
     * valideert het object indien waar.
     * Indien niet waar, wordt een foutboodschap toegevoegd aan de array met foutboodschappen
     */
    public function setProduct($product){
        if (isset($product) && !empty($product)) {
            if (get_class($product) === 'Product') {
                $this->product = $product;
                $this->updateErrorsAndValues();
            } else {
                $this->errors[0] = $this->errorValues['object'];
            }
        } else {
            $this->errors[0] = $this->errorValues['object'];
        }
    }

    /**
     * reset de foutboodschappen voor alle veldnamen naar lege strings
     */
    protected function setErrors()
    {
        $this->errors = array(
            'name' => '',
            'description' => '',
            'image' => '',
            'price' => '',
            'highLighted' => '',
            'categoryId' => '',
            'inStock' => ''
        );
    }

    /**
     * zet de waarden voor alle veldnamen naar de attribuutwaarden van het te valideren Product object
     */
    protected function setValues()
    {
        // We willen het priceveld valideren als float en hier correcte foutmeldingen (min en max waarden
        // met twee cijfers na de komma).
        // => decimale komma in punt wijzigen => indien numeriek, price value += .0 om er een float van te maken
        // => afronden to 2 cijfers na de komma
        $this->product->setPrice(str_replace(',','.',$this->product->getPrice()));
        if(is_numeric($this->product->getPrice())){
            $this->product->setPrice($this->product->getPrice() + .0);
            $this->product->setPrice(round($this->product->getPrice(),2,PHP_ROUND_HALF_UP));
        }

        $this->values = array(
            'name' => $this->product->getName(),
            'description' => $this->product->getDescription(),
            'image' => $this->product->getImage(),
            'price' => $this->product->getPrice(),
            'highLighted' => $this->product->isHighLighted(),
            'categoryId' => $this->product->getCategoryId(),
            'inStock' => $this->product->getInStock()
        );

    }

    /**
     * parent::validate():
     * Validatie van verplichte-, numerieke-, naam- en strikt positieve gehele velden, lengten en grenzen
     *  voor veldwaarden.
     *
     * daarnaast class specifieke validatie:
     * image
     * categoryId
     */
    protected function validate(){
       parent::validate();

       $this->validateImage();
       $this->validateCategoryId();
    }

    protected function validateImage(){
        if(empty($this->errors['image']) && !ValidationRules::isValidImageFileName($this->values['image'])){
            $this->errors['image'] = $this->errorValues['image'];
            $this->values['image'] = '';
        }
    }

    protected function validateCategoryId(){
        //TODO nagaan of categoryid in db

    }




}