<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 25/04/2017
 * Time: 13:57
 */
require_once ROOT . '/models/viewmodels/UserLoginViewModel.php';
require_once ROOT . '/models/validation/UserLoginViewModelValidator.php';
require_once ROOT . '/models/database/CRUD/CategoryDb.php';

class UserController
{
    //POST /index.php?controller=User&action=login
    public function login(){
        //sessie starten indien dit niet het geval is
        if(session_status() == PHP_SESSION_NONE ){
            session_start();
        }

        //indien al aangelogd, gaan we naar homepage
        if(isset($_SESSION['user'])){
            call('Home','index');
        }
        //validatie van de loginform
        else{
            //errors en values op ''
            $errors = array();
            $values = array();

            //indien POST gaan we de form valideren
            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $userName = null;
                $password = null;

                if(isset($_POST['userName'])){
                    $userName = $_POST['userName'];
                }
                if(isset($_POST['password'])){
                    $password = $_POST['password'];
                }

                $loginViewModel = new UserLoginViewModel($userName,$password);
                $loginViewModelValidator = new UserLoginViewModelValidator($loginViewModel);

                $errors = $loginViewModelValidator->getErrors();
                $values = $loginViewModelValidator->getValues();

                //foutboodschappen controleren en user opvragen indien valid
                $valid=true;
                foreach($errors as $error){
                    if($error !== ''){
                        $valid = false;
                        break;
                    }
                }

                //indien valid gaan we terug naar Home page
                //anders wordt een uitgebreider formulier getoond
                if($valid){
                    $userLoggedIn = false;

                    if($user = UserDb::getByUsernameAndPassword($values['userName'],$values['password'])){
                        //nieuwe sessie starten indien we hiervoor met een andere gebruikersnaam waren ingelogd
                        session_unset();
                        session_destroy();
                        session_start();

                        $_SESSION['user'] = $user;
                        $_SESSION['admin'] = $user->isAdmin();
                        $userLoggedIn = true;
                        call('Home','index');
                    }
                } else{
                    //voor sidebar
                    $categories = CategoryDb::getAll();


                    $view = ROOT . '/views/User/login.php';
                    require_once ROOT . '/views/layout.php';
                }
            }
        }
    }

    public function logout(){
        if(session_status() == PHP_SESSION_NONE ){
            session_start();
        }
        session_unset();
        session_destroy();
        call('Home','index');
    }

}