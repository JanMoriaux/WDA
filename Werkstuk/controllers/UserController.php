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
            $valid = $this->isValidPost($errors);

            //indien valid gaan we terug naar Home page
            //anders wordt een uitgebreider formulier getoond
            if ($valid) {
                $userLoggedIn = false;

                if ($user = UserDb::getByUsernameAndPassword($values['userName'], $values['password'])) {

                    $_SESSION['user'] = $user;
                    $_SESSION['admin'] = $user->isAdmin();

                    $userLoggedIn = true;

                    //infinite loop fix
                    if($_SESSION['previousAction'] != 'login'){
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

        $this->returnToPreviousPage();
    }

}