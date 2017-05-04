<?php

/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 2/05/2017
 * Time: 21:49
 */
class Controller
{
    protected $currentController = '';

    protected function startSession(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    protected function returnToPreviousPage(){
        $this->startSession();

        if (isset($_SESSION['previousController']) && isset($_SESSION['previousAction'])) {
            //vorige controller en action uit session halen

            $previousController = $_SESSION['previousController'];
            $previousAction = $_SESSION['previousAction'];


            //controller en action session variabelen verwijderen
            unset($_SESSION['previousController']);
            unset($_SESSION['previousAction']);

        } else {
            //indien geen sessie variabelen aanwezig keren we terug naar Homepage
            $previousController = 'Home';
            $previousAction = 'index';
        }

        //terug naar vorige view
        call($previousController, $previousAction);
    }

    //de session variables 'previousController' en 'previousAction' worden
    //gebruikt voor navigatie: bv. klikken op een add to cart => opgevangen door Cartcontroller,
    //die product aan winkelwagen toevoegt en dan de vorige action weer oproept
    protected function setControllerAndActionSessionVariables($currentAction){
        $this->startSession();
        if(isset($_SESSION['currentController'])){
            $_SESSION['previousController'] = $_SESSION['currentController'];
        }
        if(isset($_SESSION['currentAction'])){
            $_SESSION['previousAction'] = $_SESSION['currentAction'];
        }
        if(isset($_SESSION['currentId'])){
            $_SESSION['previousId'] = $_SESSION['currentId'];
        }

        $_SESSION['currentController'] = $this->currentController;
        $_SESSION['currentAction'] = $currentAction;

    }

    protected function isValidPost($errors)
    {
        foreach ($errors as $error) {
            if ($error !== '') {
                return false;
                break;
            }
        }
        return true;
    }

}