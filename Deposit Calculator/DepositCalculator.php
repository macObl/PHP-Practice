<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <title>Results</title>
    </head>


    <body>
    <h1>Thank you, <?php PRINT($_GET["name"]); ?> for using our deposit calculator!</h1>
    <hr>


    <?php
    extract( $_GET );

    $valid = true;
    $errorMsg = "";
//    $contactMethod = (isset($email));


    $name = trim($name);
    if ( strlen($name) == 0)				//see below for another way of checking if a string is empty.
    {
        $valid = false;
        $errorMsg .= "Name field can not be blank.<br/><br/>";
    }

    $postalCode = trim($postalCode);
    if ( strlen($postalCode) == 0)
    {
        $valid = false;
        $errorMsg .= "Postal Code field can not be blank.<br/><br/>";
    }


    $phone = trim($phone);
    if ( strlen($phone) == 0)
    {
        $valid = false;
        $errorMsg .= "Phone Number field can not be blank.<br/><br/>";
    }

    $email = trim($email);
    if ( strlen($email) == 0)
    {
        $valid = false;
        $errorMsg .= "Email field can not be blank.<br/><br/>";
    }






    $principal = trim($principal);
    if ( strlen($principal) == 0)				//see below for another way of checking if a string is empty.
    {
        $valid = false;
        $errorMsg .= "Principal Amount field can not be blank.<br/><br/>";
    }
    elseif ( !is_numeric($principal) )
    {
        $valid = false;
        $errorMsg .= "Principal Amount must be a numeric number.<br/><br/>";
    }
    elseif ($principal <= 0)
    {
        $valid = false;
        $errorMsg .= "Principal Amount must be greater than 0.<br/><br/>";
    }

    $rate = trim($rate);
    if ( strlen($rate) == 0)
    {
        $valid = false;
        $errorMsg .= "Interest Rate field can not be blank.<br/><br/>";
    }
    elseif ( !is_numeric($rate) )
    {
        $valid = false;
        $errorMsg .= "Interest Rate must be a numeric number.<br/><br/>";
    }
    elseif ($rate < 0)
    {
        $valid = false;
        $errorMsg .= "Interest Rate can not be negative.<br/><br/>";
    }

    $years = trim($years);
    if ( strlen($years) == 0 || !is_numeric($years) )
    {
        $valid = false;
        $errorMsg .= "Must select number of years to deposit.<br/><br/>";
    }
    elseif ($years < 0)
    {
        $valid = false;
        $errorMsg .= "Number of years to deposit must be greater then 0.<br/><br/>";
    }
    elseif ($years > 20)
    {
        $valid = false;
        $errorMsg .= "Number of years to deposit can not be greater then 20.<br/><br/>";
    }


//put radio buttons into ISSET

        if (isset($_POST["contactMethod"])
        {
            if ($contactMethod == "phone" and isset($morning))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow morning at $phone";
            }

            if ($contactMethod == "phone" and isset($afternoon))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow afternoon at $phone";
            }

            if ($contactMethod == "phone" and isset($night))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow night at $phone";
            }

            if ($contactMethod == "phone" and isset($morning) and isset($afternoon))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow morning or afternoon at $phone";
            }

            if ($contactMethod == "phone" and isset($morning) and isset($night))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow morning or evening at $phone";
            }

            if ($contactMethod == "phone" and isset($afternoon) and isset($night))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow afternoon or evening at $phone";
            }

            if ($contactMethod == "phone" and isset($morning) and isset($afternoon) and isset($night))
            {
                $confirmationMessage = "Our customer service representative will call you tomorrow morning, afternoon, or evening at $phone";
            }

            if ($contactMethod=="email")
            {
                $confirmationMessage = "Our customer service representative will email you tomorrow at $email";
            }


        }
        else
            {
                $errorMsg .= "You have not selected a contact method";

}




    if (!$valid)
    {

        print <<<Mark
			<p>However, we can not calculate the payments because you entered the following invalid data:</p>
			<span class='error'>$errorMsg </span>
			
			<p>Please use the back button of your browser to go back to the previous page to correct these errors and submit again.</p>
Mark;
    }
    else
    {

        print <<<Mark
            <h4>$confirmationMessage</h4>
        
			<p>Following is the result of the calculation:</p>
					<table border="1">
						<tr><th>Year</th><th>Principal at Year Start</th><th>Interest for the Year</th></tr>
Mark;
        $runningPrincipal = $principal;
        for($i = 1; $i <= $years; ++$i)
        {
            $interest = $runningPrincipal * $rate * 0.01;
            printf ("<tr><td>%s</td><td>\$%.2f</td><td>\$%.2f</td></tr>", $i, $runningPrincipal, $interest);
            $runningPrincipal += $interest;
        }

        echo "</table>";

    }
    ?>
    </body>
</html>



