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

//Protect from users not logged in
if(!isset($_SESSION["customerObject"]))
{
    $_SESSION["GoTo"] = "ShoppingCart.php";
    header("Location: Login.php");
    exit();
}


//if the session doesn't exists, send them back to first page (no need to exit)
if(!isset($_SESSION['copies']))
{
    header("Location: BookCatalog.php");
}



extract($_POST);


//TODO Would get name like this if login worked
//$customerName = $_SESSION['Customer']->getName();
$customerName = "Wei Gong";
//$customerID = $_SESSION['Customer']->getID();
$customerID = "gongw";

$copies = $_SESSION["copies"];
//print_r($copies);
//TODO Getting selected books from ShoppingCart Table
$selectedBooks = getSelectedBooks($customerID);
//print_r($selectedBooks);



//TODO My copies session from the last page is still being displayed and interfering with the value I'm trying to capture and insert into the DB
//TODO If I had more time I would fix that and update things correctly

//Updating Shopping Cart with button
if (isset ($update))
{
    //increment $i, for each element of the $copies array
    for ($i = 0; $i < sizeof($copies); $i++)
    {
        //if the copies array has more than 0 elements, put it in a session and go to next page
        //exit to stop this page from continuing + clear error message
        if ($copies[$i] > 0 && (intval($copies[$i]) == true))
        {
            $errorMessage = "";
            $_SESSION['copies'] = $copies;
//
            //TODO need to get book ID from list somehow for these queries to work
            $bookID = $i+1;
//            $bookID = 2;
            $insertCopies = ($copies[$i]);

            //check whether the shopping cart has a selected book
            $shoppingCartStatus = checkShoppingCartDb($customerID, $bookID);


            if ($shoppingCartStatus == "exists")
            {
                //Should put book ID into associative array, but for now I am just taking the index of
                // the array and adding one because that will be the same as the book ID. I know that that will not work after first additions though
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


        }
        //trying to use intval to validate input is a positive integer
        elseif(($copies[$i] == "0") || (intval($copies[$i]) == false))
        {
//              //If I was getting book ID from a reliable place I could identify the book correctly

//            $bookID = $i+1;
            $bookID = 2;

            //delete selection if 0 is entered
            deleteBookFromCart($bookID, $customerID);

        }
        else
        {
            //if there are 0 elements in the array, display error and don't redirect
            $errorMessage = "You must select at least 1 copy of 1 book";
        }
    }

}








?>


<body>
<h1><?php echo $customerName ?>'s Shopping Cart</h1>
<h3>To change the number of copies to purchase, enter the new number and click Update button. <br>
To remove and book from the shopping cart, change the number of copies to 0 and click Update button</h3>

<table border="1">
    <tr><th>Title</th><th>Price</th><th>Copies</th></tr>
    <?php
    //These lines were from Wei Gong's lecture/ demonstration


    //These lines were from Wei Gong's lecture/ demonstration

    $i = 0;
    $copies = $_SESSION['copies'];
    $total = 0;
    foreach ($selectedBooks as $book) {
        $id = $book->getId();
        $title = $book->getTitle();
        $description = $book->getDescription();
        $price = $book ->getPrice();

        //$copies[$i] = how many copies were selected
       if ($copies[$i] > 0)
       {
           //subtotal = book price x number of copies for that index

           //
           echo "<tr><td>$title</td><td>$$price</td>

            <td>
            <input type='number' name='copies[]' value='".(isset($copies) ? $copies[$i] : '')."'>
            </td></tr>";

       }
       $i++;
    }
    ///////////////////////////////////////////////////////////
    ?>
</table>

</br></br>

<!--make sure button is in a form. Post to selection page, not this one $back will be set when you do this-->
<form action="ShoppingCart.php" method="post">
    <input type='submit'  class='button' name='Update' value='update'/>

</form>
</body>
<?php include("./Common/PageFooter.php");?>

