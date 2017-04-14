<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 3/04/2017
 * Time: 21:11
 */

class Book{
    public $title;
    public $author;
    public $description;

    public function __construct($title,$author,$description)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
    }
}