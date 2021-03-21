<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-12-08
 * Time: 11:35 AM
 */




session_start(); 	// start PHP session!

include("./Common/Functions.php");
include("./Common/PageHeader.php");
include ("Common/Classes.php");

extract($_POST);
if (isset($_POST['copies']))
{
    $copies = $_POST['copies'];
}


$errorMessage = "";
//Get customer ID from Login completion
$customerID = $_SESSION['CustomerID'];

//get catalogue
$bookList = array();
//array of book objects
$bookList = getBookList($customerID);
//$copies = "";


//print_r($bookList);

$bookID = $_GET['BookId'];
$retrievedBook = getBookInfo($bookID);
$Title = $retrievedBook->getTitleInfo();
$Description = $retrievedBook->getDescriptionInfo();









?>
<h1><?php echo$Title; ?></h1>

<p><?php echo $Description;?></p>


<?php include("./Common/PageFooter.php");?>