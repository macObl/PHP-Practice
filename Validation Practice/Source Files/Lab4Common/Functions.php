<?php



//DISCLAIMER=========================================================================================================
//================================================================================================================

function validateTerms($accept)
{
    if ($accept != "accept")
    {
        return "You must accept the terms and conditions!";
    }
    else{
        return "";
    }
}




//CUSTOMER INFO=====================================================================================================
//================================================================================================================

function ValidateName($name) {
    $name = trim($name);

    if ( strlen($name) == 0)
    {
        return "Name field can not be blank.<br/><br/>";
    }
    else
    {
        return "";
    }
}

function ValidatePostalCode($postalCode) {
    $postalCode = trim($postalCode);

    $postalCodeRegex = "/[a-z][0-9][a-z]\s*[0-9][a-z][0-9]/i";

    //do I need $matches here at all?
    if (preg_match($postalCodeRegex, $postalCode, $matches))
    {
        return "";
    }
    else
    {
        return "Invalid post code! <br/><br/>";
    }

}

function ValidatePhone($phone) {
    $phone = trim($phone);

    $phoneRegex = "/^([1]-)?[2-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{4}$/i";
    if (preg_match($phoneRegex, $phone, $matches))
    {
        return "";

    }
    else
    {
        return "Phone Number has been entered incorrectly!<br/><br/>";
    }

}

function ValidateEmail($email) {
    $email = trim($email);

    $emailRegex = "\"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-zA-Z]{2,4})$\"";

    if (preg_match($emailRegex, $email))
    {
        return "";
    }
    else
    {
        return "Your email has been entered incorrectly!<br/><br/>";
    }
}

function ValidateContact()
{
    //        $contactMethod = ($_POST["contactMethod"]);

    if (!isset($_POST["contactMethod"]))
    {
        return"You have not selected a contact method";
    }

    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" and !isset($_POST["morning"]) && !isset($_POST["afternoon"]) && !isset($_POST["evening"]))
    {
        return "If you select phone, you must select a time to call!";
    }
    else
    {
        return "";
    }

}

//    is there a more elegant way to do this?

function ConfirmationMessage($phone, $email)
{
    if (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && !isset($_POST["afternoon"]) && !isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow morning at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && isset($_POST["afternoon"]) && !isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow afternoon at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && !isset($_POST["afternoon"]) && isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow night at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && isset($_POST["afternoon"]) && !isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow morning or afternoon at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (isset($_POST["morning"])) && !isset($_POST["afternoon"]) && isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow morning or evening at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && (!isset($_POST["morning"])) && isset($_POST["afternoon"]) && isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow afternoon or evening at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "phone" && isset($_POST["morning"]) && isset($_POST["afternoon"]) && isset($_POST["evening"]))
    {
        return "Our customer service representative will call you tomorrow morning, afternoon, or evening at $phone";
    }
    elseif (isset($_POST["contactMethod"]) && ($_POST["contactMethod"]) == "email")
    {
        return "Our customer service representative will email you tomorrow at $email";
    }
}


function ValidateCustomerInfoForm($validName, $validPostalCode, $validPhone, $validEmail, $validContact)
{
    if ($validName == "" && $validPostalCode == "" && $validPhone == "" && $validEmail == "" && $validContact == "")
    {
        $valid = 1;
        return $valid;
    }
    else
    {
        $valid = 0;
        return $valid;
    }
}



//DEPOSIT CALCULATOR================================================================================================================
//================================================================================================================

function ValidatePrincipal($principal) {
    $principal = trim($principal);
    if ( strlen($principal) == 0)
    {
        return "Principal Amount field can not be blank.<br/><br/>";
    }
    elseif ( !is_numeric($principal) )
    {
        return "Principal Amount must be a numeric number.<br/><br/>";
    }
    elseif ($principal <= 0)
    {
        return "Principal Amount must be greater than 0.<br/><br/>";
    }
    else
    {
        return "";
    }
}


function ValidateRate($rate) {
    $rate = trim($rate);

    if ( strlen($rate) == 0)
    {
        return "Interest Rate field can not be blank.<br/><br/>";
    }
    elseif ( !is_numeric($rate) )
    {
        return "Interest Rate must be a numeric number.<br/><br/>";
    }
    elseif ($rate < 0)
    {
        return "Interest Rate can not be negative.<br/><br/>";
    }
    else
    {
        return "";
    }
}

function ValidateYears($years) {
    $years = trim($years);


    if ( strlen($years) == 0 || !is_numeric($years) )
    {
        return "Must select number of years to deposit.<br/><br/>";
    }
    elseif ($years <= 0)
    {
        return "Number of years to deposit must be greater then 0.<br/><br/>";

    }
    elseif ($years > 20)
    {
        return "Number of years to deposit can not be greater then 20.<br/><br/>";

    }
    else
    {
        return "";
    }
}


function ValidateDepositCalculatorForm($validPrincipal, $validRate, $validYears)
{
    if ($validPrincipal == "" && $validRate == "" && $validYears == "")
    {
        $valid = 1;
        return $valid;
    }
    else
    {
        $valid = 0;
        return $valid;
    }
}