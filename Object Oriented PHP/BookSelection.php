<?php
session_start(); 	// start PHP session!

include ("Common/Class_Lib.php");
include ("Common/Header.php");


//open file using extended class
//regex + object creation + array creation happening here
$bookFile = new BookFile("Contents/BookList.txt");
$bookList = $bookFile->getBookList();


//isPostBack equivalent
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 if (isset($_SESSION['sorting']))
 {
     $sorting = $_SESSION['sorting'];
 }
}
else
{
    $sorting = ($_GET["sort"]);
}



if ($sorting == "ID")
{
    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {

        echo "ID ASCENDING SORT!";
        usort($bookList, array('Book','idAscending'));
        $_SESSION['sorting'] = $sorting;
        $_SESSION['order'] = "descending";
    }
    else
    {
        echo "ID DESCENDING SORT!";
        usort($bookList, array('Book','idDescending'));
        $_SESSION['sorting'] = $sorting;
        $_SESSION['order'] = "ascending";
    }


}

if ($sorting == "Title")
{

    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {
        usort($bookList, array('Book','titleAscending'));
        echo "TITLE ASCENDING SORT!";
        $_SESSION['sorting'] = $sorting;
        $_SESSION['order'] = "descending";
    }
    else
    {
        usort($bookList, array('Book','titleDescending'));
        echo "TITLE DESCENDING SORT!";
        $_SESSION['order'] = "ascending";
        $_SESSION['sorting'] = $sorting;
    }

}

if ($sorting == "Price")
{
    if ($_SESSION['order'] == "ascending" || $_SESSION['order'] == null)
    {
        echo "PRICE ACSENDING SORT!";
        usort($bookList, array('Book','priceAscending'));
        $_SESSION['sorting'] = $sorting;
        $_SESSION['order'] = "descending";

    }
    else
    {
        echo "PRICE DESCENDING SORT!";
        usort($bookList, array('Book','priceDescending'));
        $_SESSION['sorting'] = $sorting;
        $_SESSION['order'] = "ascending";
    }


}



extract($_POST);

//initialize variables
$errorMessage="";
$valid = 0;






//when they click buy...
if (isset ($buy))
{
    //increment $i, for each element of the $copies array
    for ($i = 0; $i < sizeof($copies); $i++)
    {
        //if the copies array has more than 0 elements, put it in a session and go to next page
        //exit to stop this page from continuing + clear error message
        if ($copies[$i] > 0)
        {
            $errorMessage = "";
            $_SESSION['copies'] = $copies;
            header("Location: Confirmation.php");
            exit();
        }
        else
        {
            //if there are 0 elements in the array, display error and don't redirect
            $errorMessage = "You must select at least 1 copy of 1 book";
        }
    }

}
//if the $back button was clicked at this point, put the copies session/ array into a variable
elseif (isset($back))
{
    $copies = $_SESSION['copies'];

}


?>


<div class='container'>

<h3>Select the number of copies for books you want to buy and click Buy button</h3>
<!--display either empty string or error message depending-->
<h4 style="color: darkred"> <?php echo $errorMessage; ?></h4>




<form action="BookSelection.php" method="post">
    <table class='table' border="1">
        <tr>
            <th><a href="BookSelection.php?sort=ID">ID</a></th>
            <th><a href="BookSelection.php?sort=Title">Title</a></th>
            <th><a href="BookSelection.php?sort=Price">Price</a></th>
            <th>Copies</th>

        </tr>
        <?php

        // index items of array
        $i = 0;
        //foreach item as: 'Head First PHP & MySQL' => 64.35,
        foreach ($bookList as $book) {
           $id = $book->getId();
           $title = $book->getTitle();
           $price = $book ->getPrice();


            echo "<tr>";
            echo "<td>$id</td><td>$title</td><td>$$price</td>";
            //This line was from Wei Gong's lecture/ demonstration
            echo "<td align='center'><input type='number' name='copies[]' value='".(isset($copies) ? $copies[$i] : '')."' size='2'/></td>";
            // if copies is set, the value is... the element of copies we are at or it's empty. also append this to the list
            echo "</tr>";
            //increment index
            $i++;

        }
        $_SESSION["bookList"] = $bookList;

        ?>
    </table>

    <br/>
    <input type='submit' class='btn btn-primary btn-lg' name='buy' value='buy'/>
</form>

</div>


<?php include("Common/Footer.php");?>





<!--Make table headers hyperlinks like in asp.net and get values from them then use usort to sort obtained values-->

