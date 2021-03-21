<?php
	session_start(); 	// start PHP session!
?>


<?php
if (!isset($_SESSION["accept"]))
{
    header("Location: Disclaimer.php");
    exit( );

}
elseif(!isset($_SESSION["name"]))
	{
        header("Location: CustomerInfo.php");
        exit( );
	}

	?>








<?php include("./Lab4Common/Functions.php"); ?>

<?php include("./Lab4Common/Header.php"); ?>

<?php
//initialize variables

$validDepositCalculator = 0;
$principal = $rate = $years = "";
$validPrincipal = $validRate = $validYears = "";

$confirmationMessage = "";



if (isset($_POST["btnSubmit"]))
{
    //capture form fields into variables

    $principal = ($_POST["principal"]);
    $rate = ($_POST["rate"]);
    $years = ($_POST["years"]);


    $validPrincipal = ValidatePrincipal($principal);
    $validRate= ValidateRate($rate);
    $validYears= ValidateYears($years);

    $validDepositCalculator = ValidateDepositCalculatorForm($validPrincipal, $validRate, $validYears);

    $confirmationMessage = ConfirmationMessage($phone, $email);

}


if (!isset($_POST["btnSubmit"]) || $validDepositCalculator == 0) {

    ?>
<div class="col-xs-12 col-sm-12">
    <h1>Deposit Calculator</h1>
    <hr>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="form-group">
        <div class="form-group row">
            <label for="principal" class="col-sm-2 col-form-label">Principal Amount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="principal" id="principal" placeholder="0" value="<?php echo $principal; ?>">

                <span class="text-danger"><?php echo $validPrincipal; ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="rate" class="col-sm-2 col-form-label">Interest Rate (%)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="rate" id="rate" placeholder="0%" value="<?php echo $rate; ?>">
                <span class="text-danger"><?php echo $validRate; ?></span>

            </div>
        </div>
        <div class="form-group row">
            <label for="years" class="col-sm-2 col-form-label">Years to Deposit</label>
            <div class="dropown">
                <select class="dropdown" name="years" id="years">
                    <option class="dropdown-item" value="0"<?php if(isset($years) && $years=="0") { echo " selected"; } ?>>0</option>
                    <option class="dropdown-item" value="1"<?php if(isset($years) && $years=="1") { echo " selected"; } ?>>1</option>
                    <option class="dropdown-item" value="2"<?php if(isset($years) && $years=="2") { echo " selected"; } ?>>2</option>
                    <option class="dropdown-item" value="3"<?php if(isset($years) && $years=="3") { echo " selected"; } ?>>3</option>
                    <option class="dropdown-item" value="4"<?php if(isset($years) && $years=="4") { echo " selected"; } ?>>4</option>
                    <option class="dropdown-item" value="5"<?php if(isset($years) && $years=="5") { echo " selected"; } ?>>5</option>
                    <option class="dropdown-item" value="6"<?php if(isset($years) && $years=="6") { echo " selected"; } ?>>6</option>
                    <option class="dropdown-item" value="7"<?php if(isset($years) && $years=="7") { echo " selected"; } ?>>7</option>
                    <option class="dropdown-item" value="8"<?php if(isset($years) && $years=="8") { echo " selected"; } ?>>8</option>
                    <option class="dropdown-item" value="9"<?php if(isset($years) && $years=="9") { echo " selected"; } ?>>9</option>
                    <option class="dropdown-item" value="10"<?php if(isset($years) && $years=="10") { echo " selected"; } ?>>10</option>
                    <option class="dropdown-item" value="11"<?php if(isset($years) && $years=="11") { echo " selected"; } ?>>11</option>
                    <option class="dropdown-item" value="12"<?php if(isset($years) && $years=="12") { echo " selected"; } ?>>12</option>
                    <option class="dropdown-item" value="13"<?php if(isset($years) && $years=="13") { echo " selected"; } ?>>13</option>
                    <option class="dropdown-item" value="14"<?php if(isset($years) && $years=="14") { echo " selected"; } ?>>14</option>
                    <option class="dropdown-item" value="15"<?php if(isset($years) && $years=="15") { echo " selected"; } ?>>15</option>
                    <option class="dropdown-item" value="16"<?php if(isset($years) && $years=="16") { echo " selected"; } ?>>16</option>
                    <option class="dropdown-item" value="17"<?php if(isset($years) && $years=="17") { echo " selected"; } ?>>17</option>
                    <option class="dropdown-item" value="18"<?php if(isset($years) && $years=="18") { echo " selected"; } ?>>18</option>
                    <option class="dropdown-item" value="19"<?php if(isset($years) && $years=="19") { echo " selected"; } ?>>19</option>
                    <option class="dropdown-item" value="20"<?php if(isset($years) && $years=="20") { echo " selected"; } ?>>20</option>
                </select>
                <span class="text-danger"><?php echo $validYears; ?></span>

            </div>


        </div>
        <hr>
            <div class="col-xs-12 col-sm-12">
            <input class="btn btn-primary" type="submit" name="btnSubmit" value="Calculate"/>
            <span style="padding-left:3em"></span>
            <!--                   <input type="submit" name="btnClear" value="Clear"/>-->
            <input class="btn btn-primary"
                   type="reset"
                   name="reset"
                   onclick="location.href='DepositCalculator.php'; " value="Clear">
        </div>

        </fieldset>
    </form>
</div>

    <?php
}
else
{

    ?>
<div class="col-xs-12 col-sm-12">
    <h1>Deposit Calculator</h1>
    <hr>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="form-group">
        <div class="form-group row">
            <label for="principal" class="col-sm-2 col-form-label">Principal Amount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="principal" id="principal" placeholder="0" value="<?php echo $principal; ?>">

                <span class="text-danger"><?php echo $validPrincipal; ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="rate" class="col-sm-2 col-form-label">Interest Rate (%)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="rate" id="rate" placeholder="0%" value="<?php echo $rate; ?>">
                <span class="text-danger"><?php echo $validRate; ?></span>

            </div>
        </div>
        <div class="form-group row">
            <label for="years" class="col-sm-2 col-form-label">Years to Deposit</label>
            <div align="left" class="dropown">
                <select class="dropdown" name="years" id="years">
                    <option class="dropdown-item" value="0"<?php if(isset($years) && $years=="0") { echo " selected"; } ?>>0</option>
                    <option class="dropdown-item" value="1"<?php if(isset($years) && $years=="1") { echo " selected"; } ?>>1</option>
                    <option class="dropdown-item" value="2"<?php if(isset($years) && $years=="2") { echo " selected"; } ?>>2</option>
                    <option class="dropdown-item" value="3"<?php if(isset($years) && $years=="3") { echo " selected"; } ?>>3</option>
                    <option class="dropdown-item" value="4"<?php if(isset($years) && $years=="4") { echo " selected"; } ?>>4</option>
                    <option class="dropdown-item" value="5"<?php if(isset($years) && $years=="5") { echo " selected"; } ?>>5</option>
                    <option class="dropdown-item" value="6"<?php if(isset($years) && $years=="6") { echo " selected"; } ?>>6</option>
                    <option class="dropdown-item" value="7"<?php if(isset($years) && $years=="7") { echo " selected"; } ?>>7</option>
                    <option class="dropdown-item" value="8"<?php if(isset($years) && $years=="8") { echo " selected"; } ?>>8</option>
                    <option class="dropdown-item" value="9"<?php if(isset($years) && $years=="9") { echo " selected"; } ?>>9</option>
                    <option class="dropdown-item" value="10"<?php if(isset($years) && $years=="10") { echo " selected"; } ?>>10</option>
                    <option class="dropdown-item" value="11"<?php if(isset($years) && $years=="11") { echo " selected"; } ?>>11</option>
                    <option class="dropdown-item" value="12"<?php if(isset($years) && $years=="12") { echo " selected"; } ?>>12</option>
                    <option class="dropdown-item" value="13"<?php if(isset($years) && $years=="13") { echo " selected"; } ?>>13</option>
                    <option class="dropdown-item" value="14"<?php if(isset($years) && $years=="14") { echo " selected"; } ?>>14</option>
                    <option class="dropdown-item" value="15"<?php if(isset($years) && $years=="15") { echo " selected"; } ?>>15</option>
                    <option class="dropdown-item" value="16"<?php if(isset($years) && $years=="16") { echo " selected"; } ?>>16</option>
                    <option class="dropdown-item" value="17"<?php if(isset($years) && $years=="17") { echo " selected"; } ?>>17</option>
                    <option class="dropdown-item" value="18"<?php if(isset($years) && $years=="18") { echo " selected"; } ?>>18</option>
                    <option class="dropdown-item" value="19"<?php if(isset($years) && $years=="19") { echo " selected"; } ?>>19</option>
                    <option class="dropdown-item" value="20"<?php if(isset($years) && $years=="20") { echo " selected"; } ?>>20</option>
                </select>
                <span class="text-danger"><?php echo $validYears; ?></span>

            </div>


        </div>
        <hr>



            <div class="col-xs-12 col-sm-12">
            <input class="btn btn-primary" type="submit" name="btnSubmit" value="Calculate"/>
            <span style="padding-left:3em"></span>
            <!--                   <input type="submit" name="btnClear" value="Clear"/>-->
            <input class="btn btn-primary"
                   type="reset"
                   name="reset"
                   onclick="location.href='DepositCalculator.php'; " value="Clear">
        </div>

        </fieldset>
    </form>
</div>

    <?php






    print <<<Mark
         
        
			<p align="center">Following is the result of the calculation:</p>
					<table border="1" class="table">
						<tr><th>Year</th><th>Principal at Year Start</th><th>Interest for the Year</th></tr>
</div>

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

<br><br>



<?php include("./Lab4Common/Footer.php");?>

