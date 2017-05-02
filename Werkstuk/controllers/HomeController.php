<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:53
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/controllers/Controller.php';

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

    //geeft een array terug van 4 random uitgelichte producten
    private function getHighLightedProducts($products){
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
    private function getNewProducts($products){

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
}

?>