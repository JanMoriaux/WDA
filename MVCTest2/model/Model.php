<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/04/2017
 * Time: 21:07
 */
include_once("model/Book.php");

class Model{
    public function getBookList(){

        return array(
            "Jungle Book" => new Book("Jungle Book","R. Kipling", "A classic book"),
            "Moonwalker" => new Book("Moonwalker",'J. Walker', ""),
            "PHP for Dummies" => new Book("PHP for Dummies", "Some Smart Guy", "")
        );
    }

    public function getBook($title){
        //we use the previous function to get all the books and the we return the requested one.
        //in a real life scenario this will be through a db select command
        $allBooks = $this->getBookList();
        return $allBooks['title'];
    }

}
