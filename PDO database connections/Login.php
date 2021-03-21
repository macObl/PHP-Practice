
<?php
session_start(); 	// start PHP session!

include("./Common/Functions.php");
include("./Common/Header.php");
include ("Common/Class_Lib.php");

if (isset($_SESSION["GoTo"]))
{
    $redirect = $_SESSION["GoTo"];
}

//initialize variables

$validUser = false;
$studentID = $studentPassword = "";
$validID =  $validRepeatPass = "";
$loginError = "";


if (isset($_POST["btnSubmit"]))
{
    //capture form fields into variables

    $studentID = ($_POST["studentID"]);
    $studentPassword = ($_POST["password"]);

//        run functions and put results into variables. error message or empty string is returned

    $validID = ValidateLoginID($studentID);
    $validPassword = ValidateLoginPassword($studentPassword);
    $validLogin = ValidateLogin($validID, $validPassword);

    if ($validLogin == true)
    {
        //Checks if users are in teh database (compares username then password
        //not secure, I know.
        $stmt = $myPdo->prepare("SELECT * FROM Student WHERE StudentId=:studentID LIMIT 1");
        // Parameterize the query
        $stmt->bindValue(':studentID', $studentID, PDO::PARAM_STR);
        // Execute the query and return the results into $row
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Ensure that a row was returned
        if ($row) {

            //same thing nested for password
            $pstmt = $myPdo->prepare("SELECT * FROM Student WHERE Password=:password LIMIT 1");
            $pstmt->bindValue(':password', $studentPassword, PDO::PARAM_STR);
            $pstmt->execute();
            $passRow = $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($passRow) {
                // Successful login

                //create student object from database columns
                $studentObject = new Student($row['StudentId'],$row['Name'],$row['Phone'],$row['Password']);
                $_SESSION["StudentObject"] = $studentObject;
            }
            else {
                // Invalid password
                $loginError = "Incorrect Password";
                $validLogin = false;
            }
        } else {
            // Invalid username
            $loginError = "Incorrect Student ID";
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
        <p>You need to <a href="NewUser.php">SIGN UP</a> if you are a new user!</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


            <fieldset class="form-group padded">
                <span class="text-danger"><?php echo $loginError; ?></span>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Student ID: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="studentID" id="StudentID" placeholder="000000" value="<?php echo $studentID;?>">
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
        if ($redirect == "CurrentRegistration.php")
        {
            header("Location: CurrentRegistration.php");
            exit();
        }
        else
        {
            header("Location: CourseSelection.php");
            exit();
        }

    }
    ?>

</div>

<br><br><br><br><br>


<?php include("./Common/Footer.php");?>
