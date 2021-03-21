<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-10-29
 * Time: 10:32 AM
 */

class Class_Lib
{
}

class Book
{
    private $id;
    private $title;
    private $price;


    public function __construct($id, $title, $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;

    }


    //Getters and Setters
    /**Getters and setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }






    //sorting functions
    public static function idAscending($a, $b)
    {
        return strcmp($a->id, $b->id);
    }
    public static function idDescending($b, $a)
    {
        return strcmp($a->id, $b->id);
    }



    public static function titleAscending($a, $b)
    {
        return strcmp($a->title, $b->title);
    }

    public static function titleDescending($a, $b)
    {
        return strcmp($b->title, $a->title);
    }



    public static function priceAscending($a, $b)
    {
        //sorting found on https://stackoverflow.com/a/2852669
        return ($a->price-$b->price) ? ($a->price-$b->price)/abs($a->price-$b->price) : 0;
    }
    public static function priceDescending($b, $a)
    {
        //sorting found on https://stackoverflow.com/a/2852669
        return ($a->price-$b->price) ? ($a->price-$b->price)/abs($a->price-$b->price) : 0;
    }




}

class BookFile extends SplFileObject {
    public function __construct($filePath)
    {
        parent::__construct($filePath);
    }

    public function getBookList()
    {
        $bookList = array();

        //iterate through each line of the file
        foreach($this as $book)
        {

            //identify ID and put into $id
            $idRegex = "/([A-Z]){2}([0-9]){4}/";
            (preg_match($idRegex, $book, $idMatches));
            $fullID = $idMatches[0];
            $id = rtrim($fullID);
            //printf($id. "</br>");


            //identify title, trim characters and put into $title
            $titleRegex = "/\W.+?([$]|\(\bFree\b)/"; //Should work when only looking at 1 line
            (preg_match($titleRegex, $book, $titleMatches));
            $fullTitle = $titleMatches[0];
            $title = rtrim($fullTitle, (" $") . ('" (\Free"'));
            //printf($title. "</br>");


            //identify price, trim characters, convert Free to 0
            $priceRegex = "/[$]([0-9\W]{2}[.0-9]*)|(\(\bFree\b)/";
            (preg_match($priceRegex, $book, $priceMatches));
            $fullPrice = $priceMatches[0];
            $price = substr($fullPrice, 1);
            if ($price == "Free")
            {
                $price = 0;
            }


            $newBook = new Book($id, $title, $price);

            $bookList[] = $newBook;

        }
        return $bookList;
    }

}






