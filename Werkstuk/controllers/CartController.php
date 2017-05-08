<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 8:54
 */
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/entities/Order.php';
require_once ROOT . '/models/validation/AddressValidator.php';
require_once ROOT . '/models/database/CRUD/PaymentMethodDb.php';
require_once ROOT . '/models/database/CRUD/DeliveryMethodDb.php';
require_once ROOT . '/models/database/CRUD/ProductDb.php';
require_once ROOT . '/models/database/CRUD/AddressDb.php';
require_once ROOT . '/models/database/CRUD/OrderDetailDb.php';
require_once ROOT . '/models/database/CRUD/OrderDb.php';


class CartController extends Controller
{
    protected $currentController = 'Cart';

    /**
     * POST: index.php?controller=Cart&action=addProduct
     */
    public function addProduct()
    {
        $this->setControllerAndActionSessionVariables('addProduct');

        //OrderDetail aan de cart toevoegen indien POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //werd er een id voor het toe te voegen product meegegeven?
            if (isset($_POST['id'])) {

                //indien cart nog niet bestaat een nieuwe sessievariabele aanmaken
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = new ShoppingCart();
                }
                $cart = $_SESSION['cart'];

                //indien product nog niet voorkomt in cart sessievariabele voegen
                //we een OrderDetail toe aan de cart met quantity 1
                $orderDetail = $cart->getOrderDetail($_POST['id']);
                if (!$orderDetail) {
                    $cart->addOrderDetail($_POST['id'], 1);
                }
            }
        }

        //terugkeren naar vorige controller en action
        $this->returnToPreviousPage();
    }

    //GET: index.php?controller=Cart&action=overview
    public function overview()
    {

        $this->setControllerAndActionSessionVariables('overview');

        //title en sidebar
        $title = 'Overzicht Winkelmandje';
        $categorySidebar = true;

        //associatieve array met keys= producten in cart en values=hoeveelheden
        $orderDetails = array();
        if (isset($_SESSION['cart']) && $_SESSION['cart']) {

            $cart = $_SESSION['cart'];
            $orderDetails = $cart->getOrderDetails();

        }

        $view = ROOT . '/views/Cart/overview.php';
        require_once ROOT . '/views/layout.php';
    }

    //POST: index.php?controller=Cart&action=deleteProduct
    //product verwijderen uit winkelmandje
    public function deleteProduct()
    {

        $this->setControllerAndActionSessionVariables('deleteProduct');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {

                if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $_SESSION['cart']->removeOrderDetail($_POST['id']);
                }

            }
        }

        $this->returnToPreviousPage();
    }

    //POST: index.php?controller=Cart&action=increaseUnits
    //aantal eenheden van een bepaald product in cart vermeerderen
    public function increaseUnits()
    {

        $this->setControllerAndActionSessionVariables('increaseUnits');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {

                if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $orderDetail = $_SESSION['cart']->getOrderDetail($_POST['id']);
                    $orderDetail->addUnit();
                }

            }
        }

        $this->returnToPreviousPage();
    }

    //POST: index.php?controller=Cart&action=decreaseUnits
    //aantal eenheden van een bepaald product in cart verlagen
    public function decreaseUnits()
    {

        $this->setControllerAndActionSessionVariables('decreaseUnits');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {

                if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
                    $orderDetail = $_SESSION['cart']->getOrderDetail($_POST['id']);
                    $orderDetail->removeUnit();
                }

            }
        }
        $this->returnToPreviousPage();

    }

    //GET: index.php?controller=Cart&action=createOrder
    public function createOrder()
    {

        $this->setControllerAndActionSessionVariables('createOrder');
        $this->setSideBarAndTitle('Bestelling aanmaken');

        $errorMessage = '';

        //nagaan of er een gebruiker is ingelogd, anders redirect naar
        //login pagina
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            $errorMessage = 'U dient zich aan te melden om verder te gaan';
            $view = ROOT . '/views/User/login.php';
        } else {
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                $cart = $_SESSION['cart'];

                //indien er artikels in het winkelmandje zitten voegen we een nieuwe
                // Order sessionvariabele toe en gaan we door naar invoer van het besteladres
                if ($cart->getOrderDetails() !== null && count($cart->getOrderDetails()) > 0) {

                    $_SESSION['order'] = new Order(null,
                        null,
                        $cart,
                        null,
                        null,
                        null,
                        null,
                        null,
                        0,
                        null
                    );

                    call('Cart', 'addDeliveryAddress');
                } else {
                    $errorMessage = 'Geen producten in het winkelmandje. Er kan geen bestelling aangemaakt worden.';
                    call('Home', 'index');  //indien geen producten in winkelmandje gaan we naar home
                }
            } else {
                call('Home', 'index');
            }
        }
        require_once ROOT . '/views/layout.php';

    }

    public function addDeliveryAddress()
    {
        $this->setControllerAndActionSessionVariables('addDeliveryAddress');
        $this->checkUserAndOrderSessionVariables();
        $this->setSideBarAndTitle('Leveringsadres invoeren');
        //title en sidebar
        $title = 'Leveringsadres invoeren';
        $checkoutzone = true;

        $errorMessage = '';
        $errors = $values = array();


        //bij GET tonen we het formulier en eventueel reeds ingevoerde waarden van het adres
        //bij POST eerst valideren
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $order = $_SESSION['order'];

            if ($order->getDeliveryAddress() !== null) {
                $av = new AddressValidator($order->getDeliveryAddress());
                $values = $av->getValues();
            }

        } else {

            $address = $this->getAddressFromPost();
            $av = new AddressValidator($address);

            $errors = $av->getErrors();
            $values = $av->getValues();

            //indien valid adres voegen we dit toe aan de Order session variabele
            //en kijken we of facturatieadres hetzelfde is
            //indien niet gaan we over tot invullen van facturatieadres
            if ($this->isValidPost($errors)) {


                $_SESSION['order']->setDeliveryAddress($address);

                if (isset($_POST['addressesaresame']) && $_POST['addressesaresame']) {

                    $_SESSION['order']->setFacturationAddress($address);

                    //simuleren van een GET request naar de volgende action
                    //om te voorkomen dat POTS validatie gebeurt
                    unset($_POST);
                    $_SERVER['REQUEST_METHOD'] = 'GET';

                    call('Cart', 'chooseDeliveryPaymentAndAcceptTerms');

                } else {

                    //simuleren van een GET request naar de volgende action
                    //om te voorkomen dat POTS validatie gebeurt
                    unset($_POST);
                    $_SERVER['REQUEST_METHOD'] = 'GET';

                    call('Cart', 'addFacturationAddress');
                }
            }
        }


        $view = ROOT . '/views/Cart/addDeliveryAddress.php';

        require_once ROOT . '/views/layout.php';
    }

    public function addFacturationAddress()
    {
        $this->setControllerAndActionSessionVariables('addFacturationAddress');
        $this->checkUserAndOrderSessionVariables();
        $this->setSideBarAndTitle('Facturatieadres invoeren');

        $errorMessage = '';
        $errors = $values = array();

        //bij GET tonen we het formulier
        //bij POST eerst valideren
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $order = $_SESSION['order'];

            if ($order->getFacturationAddress() !== null) {
                $av = new AddressValidator($order->getFacturationAddress());
                $values = $av->getValues();
            }

        } else {

            $address = $this->getAddressFromPost();
            $av = new AddressValidator($address);

            $errors = $av->getErrors();
            $values = $av->getValues();

            //indien valid adres voegen we dit toe aan de Order session variabele
            //en kijken we of facturatieadres hetzelfde is
            //indien niet gaan we over tot invullen van facturatieadres
            if ($this->isValidPost($errors)) {
                $_SESSION['order']->setFacturationAddress($address);

                //simuleren van een GET request naar de volgende action
                //om te voorkomen dat POTS validatie gebeurt
                unset($_POST);
                $_SERVER['REQUEST_METHOD'] = 'GET';
                call('Cart', 'chooseDeliveryPaymentAndAcceptTerms');
            }
        }

        $view = ROOT . '/views/Cart/addFacturationAddress.php';
        require_once ROOT . '/views/layout.php';
    }

    public function chooseDeliveryPaymentAndAcceptTerms()
    {
        $this->setControllerAndActionSessionVariables('chooseDeliveryPaymentAndAcceptTerms');
        $this->checkUserAndOrderSessionVariables();
        $this->setSideBarAndTitle('Verzend- en betaalopties kiezen');

        $errorMessage = '';

        //bij post nagaan of betalings-, verzendopties zijn aangevinkt
        //en algemene voorwaarden geaccepteerd werden
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if (!isset($_POST['deliveryMethod']) || empty($_POST['deliveryMethod'])) {
                $errorMessage = $errorMessage . 'Gelieve een leveringsmethode aan te vinken<br />';
            }
            if (!isset($_POST['paymentMethod']) || empty($_POST['paymentMethod'])) {
                $errorMessage = $errorMessage . 'Gelieve een betaalmethode aan te vinken<br />';
            }
            if (!isset($_POST['acceptTerms']) || empty($_POST['acceptTerms'])) {
                $errorMessage = $errorMessage . 'Gelieve de algemene voorwaarde te accepteren<br />';
            }


            //als alles aangevinkt is updaten we de Order sessionvariabele
            //en gaan we naar een laatste controlepagina voor bestelling
            if (empty($errorMessage)) {
                $_SESSION['order']->setDeliveryMethodId($_POST['deliveryMethod']);
                $_SESSION['order']->setPaymentMethodId($_POST['paymentMethod']);
                $_SESSION['order']->setTermsAccepted($_POST['acceptTerms']);

                call('Cart', 'reviewOrder');
            }
        }

        $paymentMethods = PaymentMethodDb::getAll();
        $deliveryMethods = DeliveryMethodDb::getAll();

        $view = ROOT . '/views/Cart/chooseDeliveryPaymentAndAcceptTerms.php';

        require_once ROOT . '/views/layout.php';

    }

    public function reviewOrder()
    {
        $this->setControllerAndActionSessionVariables('reviewOrder');
        $this->checkUserAndOrderSessionVariables();
        $this->setSideBarAndTitle('Nazicht bestelling');

        $errorMessage = '';

        //indien leveringsadres niet gezet is tonen we een waarschuwing
        if ($_SESSION['order']->getDeliveryAddress() === null) {
            $errorMessage = $errorMessage . 'Het leveringsadres is niet ingevoerd<br />';
        }
        //indien facturatieadres niet gezet is tonen we een waarschuwing
        if ($_SESSION['order']->getFacturationAddress() === null) {
            $errorMessage = $errorMessage . 'Het facturatieadres is niet ingevoerd<br />';
        }
        //indien leveringsmethode niet gezet is tonen we een waarschuwing
        if (empty($_SESSION['order']->getDeliveryMethodId())) {
            $errorMessage = $errorMessage . 'Gelieve een leveringsmethode te kiezen<br />';
        }
        //indien betaalwijze niet gezet is tonen we een waarschuwing
        if (empty($_SESSION['order']->getPaymentMethodId())) {
            $errorMessage = $errorMessage . 'Gelieve een betaalwijze te kiezen<br />';
        }
        //indien de algemene voorwaarden niet aanvaard zijn tonen we een waarschuwing
        if (empty($_SESSION['order']->isTermsAccepted())) {
            $errorMessage = $errorMessage . 'Gelieve de algemene voorwaarden te accepteren<br />';
        }

        //indien geen errors wordt het model de Order sessievariabele
        $order = null;
        if (empty($errorMessage)) {
            $order = $_SESSION['order'];
        }

        $view = ROOT . '/views/Cart/reviewOrder.php';
        require_once ROOT . '/views/layout.php';
    }

    public function placeOrder()
    {
        $this->setControllerAndActionSessionVariables('placeOrder');
        $this->checkUserAndOrderSessionVariables();
        $this->setSideBarAndTitle('Overzicht bestelling');

        $errorMessage = '';

        if(isset($_SESSION['order']) && !empty($_SESSION['order'])){
            $order = $_SESSION['order'];

            //indien er niet bij levering wordt betaald zetten we de
            //status van de bestelling op betaald
            $order->getPaymentMethodId() != 3 ? $order->setPayed(true) : $order->setPayed(false);

            //de userid aan de order toevoegen
            $order->setUserId($_SESSION['user']->getId());


            //order in database, we krijgen het id terug
            //hiermee maken we een nieuwe sessievariabele aan voor het bestellingsoverzicht
            $orderId = OrderDb::insert($order);

            if ($orderId) {
                $_SESSION['orderSummary'] = OrderDb::getById($orderId);
                unset($_SESSION['order']);
                unset($_SESSION['cart']);
            } else {
                $errorMessage =
                    'Er heeft zich een probleem voorgedaan bij het plaatsen van uw bestelling.<br />';
            }
        } else{
            $errorMessage = 'Bestelling niet teruggevonden';
        }

        $view = ROOT . '/views/Cart/placeOrder.php';
        require_once ROOT . '/views/layout.php';
    }

    protected function getAddressFromPost()
    {
        $id = $street = $number = $bus = $postalCode = $city = null;

        if (isset($_POST['id']))
            $id = trim($_POST['id']);
        if (isset($_POST['street']))
            $street = trim($_POST['street']);
        if (isset($_POST['number']))
            $number = trim($_POST['number']);
        if (isset($_POST['bus']))
            $bus = trim($_POST['bus']);
        if (isset($_POST['postalCode']))
            $postalCode = trim($_POST['postalCode']);
        if (isset($_POST['city']))
            $city = trim($_POST['city']);

        return new Address(null, $street, $number, $bus, $postalCode, $city);
    }

    protected function checkUserAndOrderSessionVariables()
    {
        $this->startSession();

        //indien geen User sessievariabele gaan we naar login
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            $errorMessage = 'U dient zich aan te melden om verder te gaan';
            call('User', 'login');
        }
        //indien geen Order sessievariabele gaan we naar Home Page
        if (!isset($_SESSION['order']) || empty($_SESSION['order'])) {
            call('Home', 'index');
        }
    }

    protected
    function setSideBarAndTitle($text)
    {

        global $checkoutzone;
        global $title;

        $checkoutzone = true;
        $title = $text;
    }

}