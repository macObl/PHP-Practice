    <?php
    session_start(); 	// start PHP session!
    ?>


    <?php include("./Lab4Common/Functions.php"); ?>

    <?php include("./Lab4Common/Header.php"); ?>


    <?php
//    if(isset($_SESSION["name"]) && isset($_SESSION["contact"]) && isset($_SESSION["accept"]))
//    {

        $name = $_SESSION["name"];


        $contact = $_SESSION["contact"];
        $accept = $_SESSION["accept"];


        print <<<Mark
        <br><br>
        <h1 align="center">Thank you <a class="text-primary">$name</a> for using our deposit calculation tool.</h1>
        <h2 align="center"> $contact</h2>

Mark;






//    else
//    {
//        print <<<Mark
//    <br><br>
//    <h1 align="center">Thank you for using our deposit calculation tool.</h1>
//Mark;
//    }
////    if (isset($_SESSION["name"]) || isset($_SESSION["contact"]) || isset($_SESSION["accept"]))
////    {
////        session_destroy();
////    }
    session_destroy();
    ?>





    <?php include("./Lab4Common/Footer.php");?>

