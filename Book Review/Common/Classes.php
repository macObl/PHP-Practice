<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-12-08
 * Time: 11:34 AM
 */
Class Customer {
    private $id;
    private $name;
    private $password;

    public function __construct($id, $name, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    public function getID() {
        return $this->id;
    }

    public function getName () {
        return $this->name;
    }

    public function getStrippedName () {
        return str_replace(' ', '', $this->name);
    }


    public function getPassword() {
        return $this->password;
    }
}


class Book
{
    private $id;
    private $title;
    private $description;
    private $price;

    /**
     * Book constructor.
     * @param $id
     * @param $title
     * @param $description
     * @param $price
     */
    public function __construct($id, $title, $description, $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }



    //Getters and Setters

    /**Getters and setters
     * /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */

}

Class BookInfo
{
 private $title;
 private $description;

    /**
     * BookInfo constructor.
     * @param $title
     * @param $description
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitleInfo()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescriptionInfo()
    {
        return $this->description;
    }


}