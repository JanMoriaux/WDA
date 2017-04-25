<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 24/04/2017
 * Time: 19:40
 */


//require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/validation/ProductValidator.php';
require_once ROOT . '/models/validation/UserLoginViewModelValidator.php';
require_once ROOT . '/models/validation/CategoryValidator.php';


class AdminController
{
    //GET index.php?controller=Admin&action=index
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //verwerking van eventuele post-data van login form
        $errors = array();
        $values = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userName = null;
            $password = null;

            if (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
            }
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
            }

            $loginViewModel = new UserLoginViewModel($userName, $password);
            $loginViewModelValidator = new UserLoginViewModelValidator($loginViewModel);

            $errors = $loginViewModelValidator->getErrors();
            $values = $loginViewModelValidator->getValues();

            //foutboodschappen controleren en user opvragen indien valid
            $valid = true;
            foreach ($errors as $error) {
                if ($error !== '') {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $userLoggedIn = false;

                if ($user = UserDb::getByUsernameAndPassword($values['userName'], $values['password'])) {
                    //nieuwe sessie starten indien we hiervoor met een andere gebruikersnaam waren ingelogd
                    session_unset();
                    session_destroy();
                    session_start();


                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();
                    $userLoggedIn = true;
                }
            }
        }

        //title en sidebar zetten
        $title = 'Portaal Beheerder';
        $adminfunctions = true;

        //views laden
        $view = ROOT . '/views/Admin/index.php';
        require_once ROOT . '/views/layout.php';
    }

    //actions voor Product administratie

    //GET index.php?controller=Admin&action=productOverview
    public function productOverview()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //title sidebar zetten
        $title = "Overzicht producten";
        $adminfunctions = true;

        //model = alle producten uit db
        $products = ProductDb::getAll();

        //views laden
        $view = ROOT . '/views/Admin/productOverview.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=showProduct&id=x
    public function showProduct()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //zetten van title en sidebar
        $title = "Detail Product ";
        $adminfunctions = true;

        //model is product met bepaald id
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            if ($product = ProductDb::getById($_GET['id'])) {
                $title = $title . $product->getId();
            }
        }

        //views laden
        $view = ROOT . '/views/Admin/showProduct.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=editProduct&id=x
    //POST
    public function editProduct()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //zetten van form action
        $currentAction = 'editProduct';

        //title sidebar zetten
        $title = "Wijzig Product";
        $adminfunctions = true;


        //GET request
        //model is product met bepaald id
        $product = null;
        $errors = array();
        $values = array();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (isset($_GET['id']) && $_GET['id']) {
                //product met id uit de database halen
                if ($product = ProductDb::getById($_GET['id'])) {
                    //productId in title
                    $title = $title . ' ' . $product->getId();

                    //errors (normaal allemaal lege waarden) en values van ons product kunnen uit ProductValidator
                    //worden gehaald en ingevuld worden in de form
                    $pv = new ProductValidator($product);

                    $values = $pv->getValues();
                }
            }
            //POST request
            //bij POST worden de ingevulde waarden gevalideerd door ProductValidator
            //indien geldig -> update van product in db en terug naar admin productoverzicht
            //indien ongeldig -> errors en values uit ProductValidor halen en form met geldige waarden
            // en foutboodschappen terug tonen
        } else {

            $product = $this->getProductFromPost();

            //errors an values worden geset door ProductValidator
            $pv = new ProductValidator($product);
            $errors = $pv->getErrors();
            $values = $pv->getValues();

            $valid = true;
            foreach ($errors as $error) {
                if ($error != '') {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $productUpdated = false;


                //file uploaden en in images map zetten
                $targetDir = ROOT . '/images/';
                $target = $targetDir . $_FILES['image']['name'];
                $source = $_FILES['image']['tmp_name'];
                if (move_uploaded_file($source, $target)) {

                    //wanneer image bestand is toegevoegd kunnen we het product aanpassen
                    if (ProductDb::update($product)) {
                        $productUpdated = true;
                    }
                    //
                }
            }
        }

        //views laden
        $view = ROOT . '/views/Admin/editProduct.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=insertProduct
    //POST index.php?controller=Admin&action=insertProduct
    public function insertProduct()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //zetten van eventuele form action
        $currentAction = 'insertProduct';

        //title sidebar zetten
        $adminfunctions = true;
        $title = "Toevoegen Product";

        //foutboodschappen en veldwaarden leeg
        $errors = array();
        $values = array();

        //POST request
        $product = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $product = $this->getProductFromPost();

            //errors en values worden geset door ProductValidator
            $pv = new ProductValidator($product);
            $errors = $pv->getErrors();
            $values = $pv->getValues();

            //indien geen foutboodschappen is het product valid en wordt het
            //toegevoegd aan db
            $valid = true;
            foreach ($errors as $error) {
                if ($error != '') {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $productInserted = false;

                //file uploaden en in images map zetten
                $targetDir = ROOT . '/images/';
                $target = $targetDir . $_FILES['image']['name'];
                $source = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($source, $target)) {
                    //wanneer image bestand is toegevoegd kunnen we het product toevoegen
                    if (ProductDb::insert($product)) {
                        $productInserted = true;
                        $values = array();
                    }
                }
            }
        }

        $view = ROOT . '/views/Admin/insertProduct.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=deleteProduct&id=x
    //POST index.php?controller=Admin&action=deleteProduct
    public function deleteProduct()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //title en sidebar zetten
        $adminfunctions = true;
        $title = 'Verwijder Product ';
        $product = null;
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (isset($_GET['id']) && $_GET['id']) {
                if ($product = ProductDb::getById($_GET['id'])) {
                    $title = $title . $product->getId();
                }
            }
        } else {
            if (isset($_POST['id']) && $_POST['id']) {
                $productDeleted = false;
                if ($product = ProductDb::getById($_POST['id'])) {
                    $title = $title . $product->getId();
                }
                if (ProductDb::deleteById($_POST['id'])) {
                    $productDeleted = true;
                }
            }
        }

        $view = ROOT . '/views/Admin/deleteProduct.php';
        require_once ROOT . '/views/layout.php';
    }

    //actions voor Category administratie

    //GET /index.php?controller=Admin&action=categoryOverview
    public function categoryOverview()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //indien geen admin ingelogd laten we index van het admin portaal zien
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            call('Admin', 'index');
        }

        //title and sidebar zetten
        $title = 'Overzicht Categorieën';
        $adminfunction = true;

        //model zetten
        $allCategories = CategoryDb::getAll();

        $view = ROOT . '/views/Admin/categoryOverview.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET /index.php?controller=Admin&action=editCategory&id=x
    //GET /index.php?controller=Admin&action=editCategory
    public function editCategory()
    {
        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //zetten van form action
        $currentAction = 'editCategory';

        //title sidebar zetten
        $title = "Wijzig Categorie";
        $adminfunctions = true;


        //GET request
        //model is Category met bepaald id
        $category = null;
        $errors = array();
        $values = array();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (isset($_GET['id']) && $_GET['id']) {
                //product met id uit de database halen
                if ($category = CategoryDb::getById($_GET['id'])) {

                    //productId in title
                    $title = $title . ' ' . $category->getId();

                    //errors (normaal allemaal lege waarden) en values van ons product kunnen uit CategoryValidator
                    //worden gehaald en ingevuld worden in de form
                    $cv = new CategoryValidator($category);
                    $values = $cv->getValues();
                }
            }
            //POST request
            //bij POST worden de ingevulde waarden gevalideerd door CategoryValidator
            //indien geldig -> update van product in db en terug naar admin categoryoverzicht
            //indien ongeldig -> errors en values uit CategoryValidator halen en form met geldige waarden
            // en foutboodschappen terug tonen
        } else {

            $category = $this->getCategoryFromPost();

            //errors en values worden geset door ProductValidator
            $cv = new CategoryValidator($category);
            $values = $cv->getValues();
            $errors = $cv->getErrors();


            $valid = true;
            foreach ($errors as $error) {
                if ($error != '') {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $categoryUpdated = false;
                if (CategoryDb::update($category)) {
                    $categoryUpdated = true;
                }
            }
        }


        //views laden
        $view = ROOT . '/views/Admin/editCategory.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET /index.php?controller=Admin&action=insertCategory&id=x
    //GET /index.php?controller=Admin&action=insertCategory
    public function insertCategory()
    {

        //is admin aangelogd?
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');

        //zetten van eventuele form action
        $currentAction = 'insertCategory';

        //title sidebar zetten
        $adminfunctions = true;
        $title = "Toevoegen Category";

        //foutboodschappen en veldwaarden leeg
        $errors = array();
        $values = array();

        //POST request
        $category = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $category = $this->getCategoryFromPost();


            //errors en values worden geset door Categoryvalidator
            $cv = new CategoryValidator($category);
            $errors = $cv->getErrors();
            $values = $cv->getValues();

            //indien geen foutboodschappen is het Category valid en wordt ze
            //toegevoegd aan db
            $valid = true;
            foreach ($errors as $error) {
                if ($error != '') {
                    $valid = false;
                    break;
                }
            }

            if ($valid) {
                $categoryAdded = false;

                if (CategoryDb::insert($category)) {
                    $categoryAdded = true;
                    $values = array();
                }
            }
        }

        $view = ROOT . '/views/Admin/insertCategory.php';
        require_once ROOT . '/views/layout.php';
    }

    protected function getProductFromPost()
    {
        $id = $name = $description = $image = $price = $highLighted = $categoryId = $inStock = null;

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['description'])) {
            $description = $_POST['description'];
        }
        if (isset($_FILES['image'])) {
            $image = $_FILES['image']['name'];
        }
        if (isset($_POST['price'])) {
            $price = $_POST['price'];
        }
        if (isset($_POST['highLighted'])) {
            $highLighted = $_POST['highLighted'];
        }
        if (isset($_POST['categoryId'])) {
            $categoryId = $_POST['categoryId'];
        }
        if (isset($_POST['inStock'])) {
            $inStock = $_POST['inStock'];
        }

        return new Product($id, $name, $description, $image, $price, $highLighted,
            $categoryId, $inStock, new DateTime());
    }

    protected function getCategoryFromPost()
    {
        $id = $description = null;

        if (isset($_POST['id']))
            $id = $_POST['id'];
        if (isset($_POST['description']))
            $description = $_POST['description'];

        return new Category($id, $description);
    }
}