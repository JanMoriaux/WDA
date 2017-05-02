<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 22/04/2017
 * Time: 20:53
 */
require_once ROOT . '/models/database/CRUD/ProductDb.php';

class HomeController
{
    public function index()
    {

        //title en sidebar zetten
        $title = 'Thuispagina';
        $categorySidebar = true;

        if ($products = ProductDb::getAll()) {

            //vier willekeurige uitgelichte producten
            $highlightedProducts = array();


            foreach ($products as $product) {
                if ($product->isHighLighted()) {
                    array_push($highlightedProducts, $product);
                }
            }
            shuffle($highlightedProducts);
            $highlightedProducts = array_slice($highlightedProducts, 0, 4);


            //4 nieuwste producten
            $newProducts = array();
            usort($products, function ($a, $b) {
                if ($a->getDateAdded() > $b->getDateAdded())
                    return -1;
                else if ($a->getDateAdded() < $b->getDateAdded()) {
                    return 1;
                } else {
                    return 0;
                }
            });
            $newProducts = array_slice($products, 0, 4);
        }


        $view = ROOT . '/views/Home/index.php';
        require_once ROOT . '/views/layout.php';

    }

    public
    function error()
    {
        $title = 'Fout';
        $view = ROOT . '/views/Home/error.php';

        require_once ROOT . '/views/layout.php';
    }
}

?>