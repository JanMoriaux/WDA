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
        if (isset($_SESSION['user'])) {
           call('Home','index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //errors en values op ''
            $errors = array();
            $values = array();

            $userName = $password = $keeploggedin = null;

            if (isset($_POST['userName'])) {
                $userName = trim($_POST['userName']);
            }
            if (isset($_POST['password'])) {
                $password = trim($_POST['password']);
            }
            if(isset($_POST['keeploggedin'])){
                $keeploggedin = trim($_POST['keeploggedin']);
            }


            $loginViewModel = new UserLoginViewModel($userName, $password);
            $loginViewModelValidator = new UserLoginViewModelValidator($loginViewModel);

            $errors = $loginViewModelValidator->getErrors();
            $values = $loginViewModelValidator->getValues();

            //indien valid gaan we terug naar vorige pagina
            //anders wordt formulier opnieuw getoond
            if ($this->isValidPost($errors)) {
                $userLoggedIn = false;

                if ($user = UserDb::getByUsernameAndPassword(md5($values['userName']), md5($values['password']))) {
                    $this->startSession();
                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();

                    //als gebruiker ingelogd wil blijven maken we semi-permanente cookie aan,
                    //geldig voor zeven dagen
                    if($keeploggedin){
                        setcookie('keeploggedin',
                            "{$user->getUserName()}:{$user->getPassword()}",
                            time() + 60 *60 *24*7);
                    }

                    $this->returnToPreviousPage();

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
        $this->startSession();
        session_unset();
        session_destroy();

        //keeploggedin cookie verwijderen
        setcookie('keeploggedin','',time() -1);


        call('Home','index');
    }

    //registratie van een nieuwe gebruiker
    public function register(){

        //title & sidebar
        $categorySidebar = true;
        $title = 'Registreren';

        //post komt terug in deze action voor validatie
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $errors = array();
            $values = array();

            $firstName = $lastName = $userName = $password =
            $repeatPassword = $email = $keeploggedin =null;

            //nieuwe UserRegistrationViewModel aanmaken en valideren
            if(isset($_POST['firstName'])){
                $firstName = trim($_POST['firstName']);
            }
            if(isset($_POST['lastName'])){
                $lastName = trim($_POST['lastName']);
            }
            if(isset($_POST['userName'])){
                $userName = trim($_POST['userName']);
            }
            if(isset($_POST['password'])){
                $password = trim($_POST['password']);
            }
            if(isset($_POST['repeatPassword'])){
                $repeatPassword = trim($_POST['repeatPassword']);
            }
            if(isset($_POST['email'])){
                $email = trim($_POST['email']);
            }
            if(isset($_POST['keeploggedin'])){
                $keeploggedin = $_POST['keeploggedin'];
            }



            $userRegistrationViewModel = new UserRegistrationViewModel(null, $firstName, $lastName, $userName,
                $password, $email, null, null, false, $repeatPassword);
            $urvmValidator = new UserRegistrationViewModelValidator($userRegistrationViewModel);
            $errors = $urvmValidator->getErrors();
            $values = $urvmValidator->getValues();

            if($this->isValidPost($errors)){

                //password en userName hash
                $user = $urvmValidator->getUser();
                $user->setUserName(md5($user->getUserName()));
                $user->setPassword(md5($user->getPassword()));

                //als user is toegevoegd aan de database: inloggen en eventueel cookie setten
                if($userAdded = UserDb::insertWithoutAddressIds($urvmValidator->getUser())){
                    $values=array();
                    $this->startSession();

                    $user = UserDb::getByUsernameAndPassword(md5($userName),md5($password));

                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();

                    if($keeploggedin){
                        setcookie('keeploggedin',
                            "{$user->getUserName()}:{$user->getPassword()}",
                            time() + 60 *60 *24*7);
                    }
                }
            };
        }

        $view = ROOT . '/views/User/register.php';
        require_once ROOT . '/views/layout.php';
    }
}