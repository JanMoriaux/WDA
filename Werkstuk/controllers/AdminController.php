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
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/database/CRUD/OrderDb.php';
require_once ROOT . '/models/database/CRUD/DeliveryMethodDb.php';
require_once ROOT . '/models/database/CRUD/PaymentMethodDb.php';
require_once ROOT . '/models/database/CRUD/OrderDetailDb.php';


class AdminController extends Controller
{
    protected $currentController = 'Admin';

    //GET index.php?controller=Admin&action=index
    public function index()
    {
        $this->setControllerAndActionSessionVariables('index');
        $this->setSideBarAndTitle('Portaal Beheerder');

        //verwerking van eventuele post-data van login form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = array();
            $values = array();

            //post data in variabelen
            $userName = $password = $keeploggedin = null;

            if (isset($_POST['userName'])) {
                $userName = trim($_POST['userName']);
            }
            if (isset($_POST['password'])) {
                $password = trim($_POST['password']);
            }
            if (isset($_POST['keeploggedin'])) {
                $keeploggedin = trim($_POST['keeploggedin']);
            }

            $loginViewModel = new UserLoginViewModel($userName, $password);
            $loginViewModelValidator = new UserLoginViewModelValidator($loginViewModel);

            $errors = $loginViewModelValidator->getErrors();
            $values = $loginViewModelValidator->getValues();

            //foutboodschappen controleren en user opvragen indien valid
            $valid = $this->isValidPost($errors);

            if ($valid) {
                if ($user = UserDb::getByUsernameAndPassword(md5($values['userName']), md5($values['password']))) {

                    $this->startSession();

                    //nieuwe user
                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();

                    //cookie aanmaken als gebruiker wil aangemeld blijven
                    if ($keeploggedin) {
                        setcookie('keeploggedin',
                            "{$user->getUserName()}:{$user->getPassword()}",
                            time() + 60 * 60 * 24 * 7);
                    }

                    call('Home', 'index');
                }
            }
        }

        //views laden
        $view = ROOT . '/views/Admin/index.php';
        require_once ROOT . '/views/layout.php';
    }

    //actions voor Product administratie

    //GET index.php?controller=Admin&action=productOverview
    public function productOverview()
    {
        $this->setControllerAndActionSessionVariables('productOverview');
        $this->authorize();
        $this->setSideBarAndTitle('Overzicht producten');

        //model = alle producten uit db
        $products = ProductDb::getAll();

        //views laden
        $view = ROOT . '/views/Admin/productOverview.php';
        require_once ROOT . '/views/layout.php';
    }

    //GET index.php?controller=Admin&action=showProduct&id=x
    public function showProduct()
    {
        $this->setControllerAndActionSessionVariables('showProduct');
        $this->authorize();
        $this->setSideBarAndTitle('Detail Product: ');

        $product = null;
        //model is product met bepaald id
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            if ($product = ProductDb::getById($_GET['id'])) {
                global $title;
                $title = $title . $product->getName();
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
        $this->setControllerAndActionSessionVariables('editProduct');
        $this->authorize();
        $this->setSideBarAndTitle('Wijzig Product: ');

        //zetten van form action
        //$currentAction = 'editProduct';

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
                    global $title;
                    $title = $title . ' ' . $product->getName();

                    //values van ons product kunnen uit ProductValidator
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

            //errors en values worden geset door ProductValidator
            $pv = new ProductValidator($product);
            $errors = $pv->getErrors();
            $values = $pv->getValues();

            $valid = $this->isValidPost($errors);

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
        $this->setControllerAndActionSessionVariables('insertProduct');
        $this->authorize();
        $this->setSideBarAndTitle('Toevoegen Product');

        //POST request
        $product = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = array();
            $values = array();

            $product = $this->getProductFromPost();

            //errors en values worden geset door ProductValidator
            $pv = new ProductValidator($product);
            $errors = $pv->getErrors();
            $values = $pv->getValues();

            //indien geen foutboodschappen is het product valid en wordt het
            //toegevoegd aan db
            $valid = $this->isValidPost($errors);

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
        $this->setControllerAndActionSessionVariables('deleteProduct');
        $this->authorize();
        $this->setSideBarAndTitle('Verwijder product: ');

        $product = null;
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            if (isset($_GET['id']) && $_GET['id']) {
                if ($product = ProductDb::getById($_GET['id'])) {
                    global $title;
                    $title = $title . $product->getName();

                    $errorMessage = '';
                    //we kijken of er nog openstaande bestellingen zijn
                    //voor dit product: indien wel kunnen we niet verwijderen
                    if (in_array($_GET['id'], OrderDetailDb::getProductIds())) {
                        $errorMessage = 'Er zijn nog openstaande bestellingen voor dit product';
                    }
                }
            }

        } else {
            if (isset($_POST['id']) && $_POST['id']) {

                $productDeleted = false;
                if ($product = ProductDb::getById($_POST['id'])) {
                    global $title;
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
    public
    function categoryOverview()
    {
        $this->setControllerAndActionSessionVariables('categoryOverview');
        $this->authorize();
        $this->setSideBarAndTitle('Overzicht categorieën');


        //model zetten
        $allCategories = CategoryDb::getAll();

        $view = ROOT . '/views/Admin/categoryOverview.php';
        require_once ROOT . '/views/layout.php';
    }

//GET /index.php?controller=Admin&action=editCategory&id=x
//GET /index.php?controller=Admin&action=editCategory
    public
    function editCategory()
    {
        $this->setControllerAndActionSessionVariables('editCategory');
        $this->authorize();
        $this->setSideBarAndTitle('Wijzig categorie');

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
                    global $title;
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

            $valid = $this->isValidPost($errors);
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
    public
    function insertCategory()
    {
        $this->setControllerAndActionSessionVariables('insertCategory');
        $this->authorize();
        $this->setSideBarAndTitle('Toevoegen Categorie');

        //POST request
        $category = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = array();
            $values = array();
            $category = $this->getCategoryFromPost();

            //errors en values worden geset door Categoryvalidator
            $cv = new CategoryValidator($category);
            $errors = $cv->getErrors();
            $values = $cv->getValues();

            //indien geen foutboodschappen is het Category valid en wordt ze
            //toegevoegd aan db
            $valid = $this->isValidPost($errors);

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


//GET /index.php?controller=Admin&action=deleteCategory&id=x
//POST /index.php?controller=Admin&action=deleteCategory
    public
    function deleteCategory()
    {
        $this->setControllerAndActionSessionVariables('deleteCategory');
        $this->authorize();
        $this->setSideBarAndTitle('Verwijder categorie');

        $category = null;

        //GET haalt Categorie uit de database voor een detailzicht
        //indien nog producten van deze category in db, wordt een foutboodschap getoond
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (isset($_GET['id']) && $_GET['id']) {
                if ($category = CategoryDb::getById($_GET['id'])) {
                    global $title;
                    $title = $title . $category->getDescription();
                }
                if (in_array($_GET['id'], ProductDb::getCategoryIds())) {
                    $errorMessage = 'Er bestaan nog producten uit deze categorie in de database';
                }
            }
            //POST verwijdert categories uit de database
        } else {
            if (isset($_POST['id']) && $_POST['id']) {
                $categoryDeleted = false;

                if ($category = CategoryDb::getById($_POST['id'])) {
                    global $title;
                    $title = $title . $category->getId();
                    if (CategoryDb::deleteById($_POST['id'])) {
                        $categoryDeleted = true;
                    }
                }
            }
        }

        $view = ROOT . '/views/Admin/deleteCategory.php';
        require_once ROOT . '/views/layout.php';
    }

//GET: index.php?controller=Cart&action=orderOverview
    public
    function orderOverview()
    {

        $this->setControllerAndActionSessionVariables('orderOverview');
        $this->authorize();
        $this->setSideBarAndTitle('Overzicht Bestellingen');

        $errorMessage = '';
        $orders = null;
        if (!$orders = OrderDb::getAll()) {
            $errorMessage = 'Geen bestellingen teruggevonden';
        }

        $view = './views/Admin/orderOverview.php';
        require_once './views/layout.php';
    }

//GET: index.php?controller=Admin&action=showOrder&id=x
    public
    function showOrder()
    {
        $this->setControllerAndActionSessionVariables('showOrder');
        $this->authorize();
        $this->setSideBarAndTitle('Detail Bestelling:');

        $errorMessage = '';
        if (!isset($_GET['id']) && empty($_GET['id'])) { //indien geen id naar home
            call('Home', 'Index');
        }
        if (!$order = OrderDb::getById($_GET['id'])) { //indien bestelling niet teruggevonden
            $errorMessage = 'Product niet teruggevonden';
        } else {
            $user = UserDb::getById($order->getUserId());
            $products = array();
            $orderDetails = $order->getCart()->getOrderDetails();
            foreach ($orderDetails as $orderDetail) {
                $products[$orderDetail->getProductId()] = ProductDb::getById($orderDetail->getProductId());
            }
            $deliveryMethod = DeliveryMethodDb::getById($order->getDeliveryMethodId());
            $paymentMethod = PaymentMethodDb::getById($order->getPaymentMethodId());
        }
        $view = ROOT . '/views/Admin/showOrder.php';
        require_once ROOT . '/views/layout.php';
    }


    protected
    function authorize()
    {

        $this->startSession();

        //is admin aangelogd?
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'])
            call('Admin', 'index');
    }

    protected
    function setSideBarAndTitle($text)
    {

        global $adminfunctions;
        global $title;

        $adminfunctions = true;
        $title = $text;
    }

    protected
    function getCategoryFromPost()
    {
        $id = $description = null;

        if (isset($_POST['id']))
            $id = $_POST['id'];
        if (isset($_POST['description']))
            $description = trim($_POST['description']);

        return new Category($id, $description);
    }

}