<?php

//FUNCTIONS//////////////////////////////////////////////////////////////

//ACCESS THE DATABASE//////////////////////////////////////////////////////////////
$dbConnection = parse_ini_file("Common/db_connection.ini");
extract($dbConnection);
$myPdo = new PDO($dsn, $user, $password);



//BookCatalog.php

function getBookList($customerID)
{


    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $books = array();

    $stmt = $myPdo->prepare("SELECT BookId, Title, Price FROM Book WHERE BookId NOT IN 
                  (SELECT BookId FROM ShoppingCart WHERE CustomerId =:userId)");
    $stmt->execute(['userId' => $customerID]);
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//make book objects for table
    foreach ($stmt as $row) {

        $book = new Book($row['BookId'],$row['Title'],$row['Description'],$row['Price']);

        $books[] = $book;

    }
    return $books;

}

//for checking if a selection already exists in the shopping cart
function checkShoppingCartDb($customerID, $bookID){

    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);



    $stmt = $myPdo->prepare("SELECT * FROM ShoppingCart WHERE UserId=:userID AND BookId=:bookID");
    $stmt->execute(['userId' => $customerID, 'bookID'=>$bookID]);

    if ($stmt)
    {
        return "exists";
    }
    else
    {
        return "none";
    }



}

//for inserting new selections into shopping cart if they don't exist
function insertShoppingCartDb($customerID, $bookID, $insertCopies){
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $books = array();

    $stmt = $myPdo->prepare("INSERT INTO `BookStore`.`ShoppingCart` (`CustomerId`, `BookId`, `Copies`) VALUES (?, ?, ?);
");
    $stmt->execute([$customerID, $bookID, $insertCopies]);


}

//update Shopping Cart if it already exists
function updateShoppingCartDb($customerID, $bookID, $insertCopies)
{
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);



    $stmt = $myPdo->prepare("UPDATE ShoppingCart SET Copies =:copies WHERE CustomerId =:customerID AND BookId =bookID");
    $stmt->execute(['copies'=>$insertCopies,'customerId' => $customerID,'bookID'=>$bookID]);

}


//Gets book information and returns book objects only for books in specific user's shopping cart
function getSelectedBooks($userID)
{
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

    $books = array();

    $stmt = $myPdo->prepare("SELECT * FROM Book JOIN ShoppingCart ON ShoppingCart.BookId = Book.BookId WHERE ShoppingCart.CustomerId=customerID");
    $stmt->execute(['customerID' => $userID]);
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//make book objects for table
    foreach ($stmt as $row) {

        $book = new Book($row['BookId'],$row['Title'],$row['Description'],$row['Price']);

        $books[] = $book;

    }
    return $books;

}

function deleteBookFromCart($bookID, $userID)
{
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);


    $stmt = $myPdo->prepare("DELETE FROM ShoppingCart WHERE BookId =:bookId AND CustomerId =:userId");
    $stmt->execute(['bookID'=>$bookID,'userId' => $userID]);
}


function getBookInfo($bookID)
{
    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);


    $stmt = $myPdo->prepare("SELECT Title, Description FROM Book WHERE BookId=:bookId");
    $stmt->execute(['bookId' => $bookID]);

    foreach ($stmt as $row) {

        $book = new BookInfo($row['Title'],$row['Description']);
        return $book;


    }
}










//LOGIN=====================================================================================================
//================================================================================================================

function ValidateLoginID($studentID) {
    $studentID = trim($studentID);

    if ( strlen($studentID) == 0)
    {
        return "Student ID cannot be blank.";
    }
    else
    {
        return "";
    }
}

function ValidateLoginPassword($studentPassword) {
    $studentPassword = trim($studentPassword);

    if ( strlen($studentPassword) == 0)
    {
        return "Password cannot be blank.";
    }
    else
    {
        return "";
    }
}

function ValidateLogin($validID, $validPassword) {
    if ($validID == "" && $validPassword == "")
    {
        return true;
    }
    else
    {
        return false;
    }

}

