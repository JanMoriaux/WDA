<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:53
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/validation/EmailValidator.php';

class HomeController extends Controller
{
    protected $currentController = 'Home';

    public function index()
    {
        $this->setControllerAndActionSessionVariables('index');

        //title en sidebar zetten
        $title = 'Thuispagina';
        $categorySidebar = true;

        //model bestaat uit 2 arrays: 4 nieuwste en 4 highlighted producten
        if ($products = ProductDb::getAll()) {
            $highLighted = $this->getHighLightedProducts($products);
            $new = $this->getNewProducts($products);
        }

        $view = ROOT . '/views/Home/index.php';
        require_once ROOT . '/views/layout.php';
    }

    public function error()
    {
        $this->setControllerAndActionSessionVariables('error');

        $title = 'Fout';
        $view = ROOT . '/views/Home/error.php';

        require_once ROOT . '/views/layout.php';
    }

    //GET & POST: index.php?controller=Home&action=contact
    public function contact(){

        $this->setControllerAndActionSessionVariables('contact');

        //sidebar en title
        $title = 'Thuispagina';
        $categorySidebar = true;

        $mailReceived = false;

        //bij GET tonen we het formulier
        //bij POST sturen we de mail door en tonen een 'ontvangen' boodschap
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //validatie
            $errors = $values = array();
            $email = $this->getEmailFromPost();
            $ev = new EmailValidator($email);

            $errors = $ev->getErrors();
            $values = $ev->getValues();

            if($this->isValidPost($errors)){

                $message = $email->getEmailaddress() . '#' .$email->getMessage();
                $message = wordwrap($message, 70, "\r\n");

                if(mail('janmoriaux1@gmail.com',
                    'Tiny Clouds Contact',
                    $message,
                    "From: jan.moriaux@student.ehb.be")){
                    $successMessage = 'We hebben je bericht goed ontvangen';
                } else{
                    $errorMessage = 'Er was een probleem bij het verzenden van het bericht.' .
                        'Gelieve een mail te verzenden via onderstaand link.';
                }

            }
        }

        $view = ROOT  . '/views/Home/contact.php';
        require_once ROOT . '/views/layout.php';
    }

    //geeft een array terug van 4 random uitgelichte producten
    protected function getHighLightedProducts($products){
        $highLighted = array();
        foreach ($products as $product) {
            if ($product->isHighLighted()) {
                array_push($highLighted, $product);
            }
        }
        shuffle($highLighted);
        return array_slice($highLighted, 0, 4);
    }

    //geeft een array terug van de 4 nieuwste, niet uigelichte producten
    //(dubbels voorkomen)
    protected function getNewProducts($products){

        //eerst alle producten desceding sorteren op datum
        usort($products, function ($a, $b) {
            if ($a->getDateAdded() > $b->getDateAdded())
                return -1;
            else if ($a->getDateAdded() < $b->getDateAdded()) {
                return 1;
            } else {
                return 0;
            }
        });

        //array met de vier nieuwste producten, uitgezonderd de uitgelichte

        $new = array();
        $teller =0;

        foreach ($products as $product){
            if($teller == 4){
                break;
            }
            if(!$product->isHighlighted()){
                array_push($new,$product);
                $teller++;
            }
        }

        return $new;
    }

    protected function getEmailFromPost(){
        $emailaddress = $message = null;

        if(isset($_POST['emailaddress']))
            $emailaddress = $_POST['emailaddress'];
        if(isset($_POST['message']))
            $message = $_POST['message'];

        return new Email($emailaddress,$message);
    }

}

?>