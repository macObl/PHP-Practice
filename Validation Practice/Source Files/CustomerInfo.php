<?php
session_start(); 	// start PHP session!
?>
<?php



if (!isset ($_SESSION["accept"])) {

    header("Location: Disclaimer.php");
    exit( );

    }
//    elseif (isset($_POST["name"]))
//    {
//        $_SESSION["name"] = $_POST["name"];







?>










<?php include("./Lab4Common/Functions.php"); ?>


<?php

    //initialize variables

    $validCustomerInfo = 0;
    $name = $postalCode = $phone = $email = $contactMethod = "";
    $validName = $validPostalCode = $validPhone = $validEmail = $validContact = $confirmationMessage = "";

    $confirmationMessage = "";


    if (isset($_POST["btnSubmit"]))
    {
        //capture form fields into variables

        $name = ($_POST["name"]);
        $postalCode = ($_POST["postalCode"]);
        $phone = ($_POST["phone"]);
        $email = ($_POST["email"]);


//        run functions and put results into variables. error message or empty string is returned

        $validName = ValidateName($name);
        $validPostalCode = ValidatePostalCode($postalCode);
        $validPhone = ValidatePhone($phone);
        $validEmail = ValidateEmail($email);
        $validContact = ValidateContact();
        $validCustomerInfo = ValidateCustomerInfoForm($validName, $validPostalCode, $validPhone, $validEmail, $validContact);

        $confirmationMessage = ConfirmationMessage($phone, $email);

    }

?>



<?php include("./Lab4Common/Header.php"); ?>

<?php


if (!isset($_POST["btnSubmit"]) || $validCustomerInfo == 0) {

       ?>
       <h1>Customer Information</h1>
       <hr>

       <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


           <fieldset class="form-group padded">
               <div class="form-group row">
                   <label for="name" class="col-sm-2 col-form-label">Name: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="<?php echo $name;?>">
                       <span class="text-danger"><?php echo $validName; ?></span>

                   </div>
               </div>
               <div class="form-group row">
                   <label for="postalCode" class="col-sm-2 col-form-label">Postal Code: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="A1B2C3" value="<?php echo $postalCode;?>">
                       <span class="text-danger"><?php echo $validPostalCode; ?></span>

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
                   <label for="email" class="col-sm-2 col-form-label">Email Address: </label>
                   <div class="col-sm-10">
                       <input type="text" class="form-control" name="email" id="email" placeholder="yourname@email.com" value="<?php echo $email;?>">
                       <span class="text-danger"><?php echo $validEmail; ?></span>

                   </div>
               </div>


               <hr>


               <div class="form-group2">
                   <label class="control-label col-sm-2">Contact Method</label><br>

                   <div class="radio-inline">
                       <label>
                           <input type="radio" name="contactMethod" value="phone" <?php if (isset($_POST["contactMethod"]) && $_POST["contactMethod"]  == "phone" ) {echo 'checked="checked"';} ?>>Phone</label>
                   </div>
                   <div class="radio-inline">
                       <label>
                           <input type="radio" name="contactMethod" value="email" <?php if (isset($_POST["contactMethod"]) && $_POST["contactMethod"]  == "email" ) {echo 'checked="checked"';} ?>>Email</label>
                   </div>
               </div>
               <div class="form-group2">
                   <label class="control-label col-sm-2" for="phone">If phone is selected, when can we contact you?
                       (check all applicable)<br></label>

                   <div class="checkbox">
                       <label>
                           <input id="morning" type="checkbox" name="morning" value="morning"<?php if (isset($_POST["morning"])) {echo 'checked="checked"';} ?>/>Morning
                       </label>
                       <label>
                           <input id="afternoon" type="checkbox" name="afternoon" value="afternoon"<?php if (isset($_POST["afternoon"])) {echo 'checked="checked"';} ?>/>Afternoon
                       </label>
                       <label>
                           <input id="evening" type="checkbox" name="evening" value="evening"<?php if (isset($_POST["evening"])) {echo 'checked="checked"';} ?>/>Evening
                       </label>
                   </div>
                   <span class="text-danger"><?php echo $validContact; ?></span>
               </div>
               <div class="form-group row">
                   <input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit"/>
                   <span style="padding-left:3em"></span>
<!--                   <input type="submit" name="btnClear" value="Clear"/>-->
                   <input class="btn btn-primary"
                          type="reset"
                          name="reset"
                          onclick="location.href='CustomerInfo.php'; " value="Reset">
               </div>

           </fieldset>
       </form>

      <?php

   }
   else
   {
       $_SESSION["name"] = $_POST["name"];
       $_SESSION["contact"] = $confirmationMessage;

       header("Location: DepositCalculator.php");
       exit();
   }

?>




<?php include("./Lab4Common/Footer.php");?>

