
<?php
session_start(); 	// start PHP session!

include("./Common/Functions.php");
include("./Common/PageHeader.php");
include ("Common/Classes.php");


//send user to right page if logged in
if (isset($_SESSION["GoTo"]))
{
    $redirect = $_SESSION["GoTo"];
}

//initialize variables

$validUser = false;
$customerID = $userPassword = "";
$validID =  $validRepeatPass = "";
$loginError = "";


if (isset($_POST["btnSubmit"]))
{
    //capture form fields into variables

    $customerID = htmlspecialchars($_POST["customerID"]);
    $userPassword = htmlspecialchars($_POST["password"]);
//TODO check if matches the encrypted password (not working)
    //
    $encryptedPassword = password_hash($userPassword, PASSWORD_BCRYPT);


//        run functions and put results into variables. error message or empty string is returned

    $validID = ValidateLoginID($customerID);
    $validPassword = ValidateLoginPassword($encryptedPassword);
    $validLogin = ValidateLogin($validID, $validPassword);

    if ($validLogin == true)
    {

        //TODO if passwords matched this would validate both username and password
        //Checks if users are in teh database (compares username then password
        //not secure, I know.
        $stmt = $myPdo->prepare("SELECT * FROM Customer WHERE UserId=:userID LIMIT 1");
        // Parameterize the query
        $stmt->bindValue(':userID', $customerID, PDO::PARAM_STR);
        // Execute the query and return the results into $row
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Ensure that a row was returned
        if ($row) {

            //same thing nested for password
            $pstmt = $myPdo->prepare("SELECT * FROM Customer WHERE Password=:password LIMIT 1");
            $pstmt->bindValue(':password', $userPassword, PDO::PARAM_STR);
            $pstmt->execute();
            $passRow = $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($passRow) {
                // Successful login

                //create customer object from database columns
                $customerObject = new Customer($row['UserId'],$row['Name'],$row['Password']);
//                TODO putting customer object into session to check user's logged in status
                $_SESSION["customerObject"] = $customerObject;
            }
            else {
                // Invalid password
                $loginError = "Incorrect Password";
                $validLogin = false;
            }
        } else {
            // Invalid username
            $loginError = "Incorrect  ID";
            $validLogin = false;
        }
    }
}

?>

<div class="container">

    <?php

    if (!isset($_POST["btnSubmit"]) || $validLogin == false) {

        ?>
        <h1 align="center">Login</h1>
        <hr>
        <p>Please Enter your User ID and Password</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


            <fieldset class="form-group padded">
                <span class="text-danger"><?php echo $loginError; ?></span>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Student ID: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="customerID" id="customerID" placeholder="000000" value="<?php echo $cutomerID;?>">
                        <span class="text-danger"><?php echo $validID; ?></span>

                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Password: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="password" id="password" placeholder="***********" value="<?php echo $studentPassword;?>">
                        <span class="text-danger"><?php echo $validPassword; ?></span>

                    </div>
                </div>

                <hr>

                <div class="container">
                    <div class="form-group row">
                        <input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit"/>
                        <span style="padding-left:3em"></span>
                        <input class="btn btn-primary"
                               type="reset"
                               name="reset"
                               onclick="location.href='Login.php'; " value="Clear">
                    </div>
                </div>

            </fieldset>
        </form>

        <?php

    }
    else
    {
        //redirect to appropriate page after login
        if ($redirect == "ShoppingCart.php")
        {
            header("Location: ShoppingCart.php");
            exit();
        }
        else
        {
            header("Location: BookCatalog.php");
            exit();
        }

    }
    ?>

</div>

<br><br><br><br><br>


<?php include("./Common/PageFooter.php");?>
