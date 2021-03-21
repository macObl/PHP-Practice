<?php
include ("Common/Class_Lib.php");

session_start(); 	// start PHP session!
include("./Common/Functions.php");

//initialize variables
$validUser = false;
$studentID = $name  = $phone = $studentPassword= $repeatedPass = "";
$validID = $validName  = $validPhone = $validPassword = $validRepeatPass = "";


if (isset($_POST["btnSubmit"]))
{
    //capture form fields into variables

    $studentID = ($_POST["studentID"]);
    $name = ($_POST["name"]);
    $phone = ($_POST["phone"]);
    $studentPassword = ($_POST["password"]);
    $repeatedPass = ($_POST["repeatedPassword"]);

//        run functions and put results into variables. error message or empty string is returned

    $validID = ValidateID($studentID);
    $validName = ValidateName($name);
    $validPhone = ValidatePhone($phone);
    $validPassword = ValidatePassword($studentPassword);
    $validRepeatPass = ValidateRepeatPass($repeatedPass, $studentPassword);
    $validUser = ValidateUserCreation($validID, $validName, $validPhone, $validPassword, $validRepeatPass);

}

?>

<?php include("./Common/Header.php");?>


<div class="container">

    <?php

    if (!isset($_POST["btnSubmit"]) || $validUser == false) {

        ?>
        <h1 align="center">Sign Up</h1>
        <hr>
        <p>All Fields are Required</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


            <fieldset class="form-group padded">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Student ID: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="studentID" id="StudentID" placeholder="000000" value="<?php echo $studentID;?>">
                        <span class="text-danger"><?php echo $validID; ?></span>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $name;?>">
                        <span class="text-danger"><?php echo $validName; ?></span>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number: <br> (nnn-nnn-nnnn)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="123-456-7890" value="<?php echo $phone;?>">
                        <span class="text-danger"><?php echo $validPhone; ?></span>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Password: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="password" id="password" placeholder="***********" value="<?php echo $studentPassword;?>">
                        <span class="text-danger"><?php echo $validPassword; ?></span>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Re-enter Password: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="repeatedPassword" id="repeatedPass" placeholder="***********" value="<?php echo $repeatPassword;?>">
                        <span class="text-danger"><?php echo $validRepeatPass; ?></span>

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
                           onclick="location.href='NewUser.php'; " value="Clear">
                </div>
                </div>

            </fieldset>
        </form>

        <?php
    }
    else
    {
        //create student object
        $Student = new Student($studentID, $name, $phone, $studentPassword);
        $_SESSION["StudentObject"] = $Student;

        $myPdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //This correctly adds values to student table
        $sql = "INSERT INTO Student (StudentId, Name, Phone, Password) VALUES (?,?,?,?)";
        $stmt= $myPdo->prepare($sql);
        $stmt->execute([$studentID, $name, $phone, $studentPassword]);


        //MYSQLI way of connecting
////
//        @$link=mysqli_connect('localhost','PHPSCRIPT','1234','CST8257',3306);
//
//        if (!$link)
//        {
//
//
//            die('Connection not working: '. mysqli_connect_errno()."<br>".mysqli_connect_error());
//        }
//        else
//        {
//            echo("Connection is working?");
//            $_SESSION["dbconnection"] = "Connection is working!";
//
//        }

        header("Location: CourseSelection.php");
        exit();
    }

    ?>

</div>

<br><br><br><br><br>


<?php include("./Common/Footer.php");?>
