<?php
session_start(); 	// start PHP session!

include("Common/Class_Lib.php");
include ("Common/Header.php");

$bookFile = new BookFile("Contents/BookList.txt");
$bookList = $bookFile->getBookList();
//$bookList =  $_SESSION["bookList"] ;

$sorting = $_SESSION['sorting'];


if ($sorting == "ID")
{
    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {

        echo "ID ASCENDING SORT!";
        usort($bookList, array('Book','idAscending'));
        $_SESSION['sorting'] = $sorting;
//        $_SESSION['order'] = "descending";
    }
    else
    {
        echo "ID DESCENDING SORT!";
        usort($bookList, array('Book','idDescending'));
        $_SESSION['sorting'] = $sorting;
//        $_SESSION['order'] = "descending";
    }


}

if ($sorting == "Title")
{

    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {
        usort($bookList, array('Book','titleAscending'));
        echo "TITLE ASCENDING SORT!";
        $_SESSION['sorting'] = $sorting;
//        $_SESSION['order'] = "descending";
    }
    else
    {
        usort($bookList, array('Book','titleDescending'));
        echo "TITLE DESCENDING SORT!";
        $_SESSION['order'] = "ascending";
//        $_SESSION['sorting'] = $sorting;
    }

}

if ($sorting == "Price")
{
    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {
        echo "PRICE ACSENDING SORT!";
        usort($bookList, array('Book','priceAscending'));
        $_SESSION['sorting'] = $sorting;
//        $_SESSION['order'] = "descending";

    }
    else
    {
        echo "PRICE DESCENDING SORT!";
        usort($bookList, array('Book','priceDescending'));
        $_SESSION['sorting'] = $sorting;
//        $_SESSION['order'] = "ascending";
    }


}




//if the session doesn't exists, send them back to first page (no need to exit)
if(!isset($_SESSION['copies']))
{
    header("Location: BookSelection.php");
}
?>

<h2>Thank you, please review your selection</h2>

<table class='table' border="1">
    <tr><th>ID</th><th>Title</th><th>Price</th><th>Copies</th><th>Total</th></tr>
    <?php
    //These lines were from Wei Gong's lecture/ demonstration

    $i = 0;
    $copies = $_SESSION['copies'];
    $total = 0;
    foreach ($bookList as $book) {
        $id = $book->getId();
        $title = $book->getTitle();
        $price = $book ->getPrice();

        //$copies[$i] = how many copies were selected
       if ($copies[$i] > 0)
       {
           //subtotal = book price x number of copies for that index
           $subTotal = $price * $copies[$i];
           //
           echo "<tr><td>$id</td><td>$title</td><td>$$price</td><td>$copies[$i]</td><td>$$subTotal</td></tr>";
           $total += $price * $copies[$i];
       }
       $i++;
    }
    echo "<tr><th colspan='4' style='text-align: right'>Grand Total: </th><td>\$$total</td></tr>";
    ///////////////////////////////////////////////////////////
?>
</table>

</br></br>

<?php
////echo $sorting;
//echo $url = "BookSelection.php?sort=".$sorting;
//?>
<!--make sure button is in a form. Post to selection page, not this one $back will be set when you do this-->
<form action="BookSelection.php" method="post">
    <input type='submit'  class='btn btn-primary' name='back' value='Back'/>

</form>


<?php include("Common/Footer.php");?>

