<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 13:57
 */
require_once ROOT . '/models/validation/UserLoginViewModelValidator.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/validation/UserRegistrationViewModelValidator.php';
require_once ROOT . '/models/database/CRUD/UserDb.php';

class UserController extends Controller
{
    protected $currentController = 'User';


    //POST /index.php?controller=User&action=login
    public function login()
    {
        $this->setControllerAndActionSessionVariables('login');

        if (isset($_SESSION['user'])) {
            $this->returnToPreviousPage();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //errors en values op ''
            $errors = array();
            $values = array();

            $userName = null;
            $password = null;

            $userName = $password = $keeploggedin = null;

            if (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
            }
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
            }
            if(isset($_POST['keeploggedin'])){
                $keeploggedin = $_POST['keeploggedin'];
            }

            $loginViewModel = new UserLoginViewModel($userName, $password);
            $loginViewModelValidator = new UserLoginViewModelValidator($loginViewModel);

            $errors = $loginViewModelValidator->getErrors();
            $values = $loginViewModelValidator->getValues();


            //indien valid gaan we terug naar Home page
            //anders wordt een uitgebreider formulier getoond
            if ($this->isValidPost($errors)) {
                $userLoggedIn = false;

                if ($user = UserDb::getByUsernameAndPassword(md5($values['userName']), md5($values['password']))) {

                    //als gebruiker ingelogd wil blijven maken we semi-permanente cookie aan,
                    //geldig voor zeven dagen
                    if($keeploggedin){

                        setcookie('keeploggedin',
                            "{$user->getUserName()}:{$user->getPassword()}",
                            time() + 60 *60 *24*7);
                    }

                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();

                    $userLoggedIn = true;

                    //infinite loop fix
                    if(isset($_SESSION['previousAction']) && $_SESSION['previousAction'] != 'login'){
                        $this->returnToPreviousPage();
                    } else{
                        call('Home','index');
                    }
                }
            } else {
                //sidebar & title
                $categorySidebar = true;
                $title = 'Login';


                $view = ROOT . '/views/User/login.php';
                require_once ROOT . '/views/layout.php';
            }
        }
    }


    public function logout()
    {
        $this->setControllerAndActionSessionVariables('logout');

        session_unset();
        session_destroy();

        //keeploggedin cookie verwijderen
        setcookie('keeploggedin','',time() -1);

        $this->returnToPreviousPage();
    }

    //registratie van een nieuwe gebruiker
    public function register(){

        //title & sidebar
        $categorySidebar = true;
        $title = 'Registreren';

        //post komt terug in deze actie voor validatie
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //todo move?
            $errors = array();
            $values = array();

            //nieuwe UserRegistrationViewModel aanmaken en valideren
            if(isset($_POST['firstName'])){
                $firstName = $_POST['firstName'];
            }
            if(isset($_POST['lastName'])){
                $lastName = $_POST['lastName'];
            }
            if(isset($_POST['userName'])){
                $userName = $_POST['userName'];
            }
            if(isset($_POST['password'])){
                $password = $_POST['password'];
            }
            if(isset($_POST['repeatPassword'])){
                $repeatPassword = $_POST['repeatPassword'];
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }

            $userRegistrationViewModel = new UserRegistrationViewModel(null, $firstName, $lastName, $userName,
                $password, $email, null, null, false, $repeatPassword);
            $urvmValidator = new UserRegistrationViewModelValidator($userRegistrationViewModel);
            $errors = $urvmValidator->getErrors();
            $values = $urvmValidator->getValues();

            if($this->isValidPost($errors)){

                $user = $urvmValidator->getUser();
                $user->setUserName(md5($user->getUserName()));
                $user->setPassword(md5($user->getPassword()));

                if($userAdded = UserDb::insertWithoutAddressIds($urvmValidator->getUser())){
                    $values=array();
                    $this->startSession();
                    $_SESSION['user'] = $urvmValidator->getUser();
                    $_SESSION['admin'] = $urvmValidator->getUser()->isAdmin();
                }

            };
        }

        $view = ROOT . '/views/User/register.php';
        require_once ROOT . '/views/layout.php';
    }

}