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


//Check if user is logged in
if(!isset($_SESSION["customerObject"]))
{
    $_SESSION["GoTo"] = "BookCatalog.php";
    header("Location: Login.php");
    exit();
}


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
//array of book objects not in users shopping cart
$bookList = getBookList($customerID);


//print_r($bookList);

if (isset ($add))
{
    //increment $i, for each element of the $copies array
    for ($i = 0; $i < sizeof($copies); $i++)
    {
        //TODO NOTE: if the copies array has more than 0 elements, put it in a session and go to next page
        //exit to stop this page from continuing + clear error message
        if ($copies[$i] > 0)
        {
            $errorMessage = "";
            $_SESSION['copies'] = $copies;
//
            print_r($copies);

            $bookID = $i+1;
            $insertCopies = ($copies[$i]);

            //check whether the shopping cart has a selected book
            $shoppingCartStatus = checkShoppingCartDb($customerID, $bookID);

            if ($shoppingCartStatus == "exists")
                {
                    //TODO Should put book ID into associative array, but for now I am just taking the index of
                    //TODO  the array and adding one because that will be the same as the book ID. I know that that will not work after first additions though
                    updateShoppingCartDB($customerID, $bookID, $insertCopies);

                    //redirect
                    header("Location: ShoppingCart.php");
                    exit();
                }
            elseif($shoppingCartStatus == "none")
                {
                    //insert new row if values don't already exist
                    insertShoppingCartDb($customerID, $bookID, $insertCopies);

                    //redirect
                    header("Location: ShoppingCart.php");
                    exit();
                }
//





        }
        else
        {
            //if there are 0 elements in the array, display error and don't redirect
            $errorMessage = "You must select at least 1 copy of 1 book";
        }
    }

}








?>



<p>Enter the number of copies for books you want to buy and click "Add to Shopping Cart" button</p>
<h4 style="color: darkred"> <?php echo $errorMessage; ?></h4>

<form action="BookCatalog.php" method="post">
    <table class='table' border="1">
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Copies</th>

        </tr>
<!--        --><?php
//
//        // index items of array
        $i = 0;
//        //foreach item as: 'Head First PHP & MySQL' => 64.35,
        foreach ($bookList as $book) {
           $id = $book->getId();
           $title = $book->getTitle();
           $description = $book->getDescription();
           $price = $book ->getPrice();


            echo "<tr>";
            echo "<td><a href='BookDetail.php?BookId=$id'>$title</a> </td><td>$$price</td>";
            //This line was from Wei Gong's lecture/ demonstration
            echo "<td align='center'><input type='number' name='copies[]' value='".(isset($copies) ? $copies[$i] : '')."' size='2'/></td>";
            // if copies is set, the value is... the element of copies we are at or it's empty. also append this to the list
            echo "</tr>";
            //increment index
            $i++;

        }
//
//        ?>
    </table>

    <br/>
    <input type='submit' class='btn btn-primary btn-lg' name='add' value='Add to Shopping Cart'/>
</form>
<?php include("./Common/PageFooter.php");?>
