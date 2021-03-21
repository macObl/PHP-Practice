<?php
session_start(); 	// start PHP session!
?>


<?php include("./Lab4Common/Functions.php"); ?>

<?php


if (isset($_POST["btnSubmit"]))
{

    $accept = ($_POST["accept"]);
    $errorTerms = validateTerms($accept);


    if ($errorTerms == "")
    {

        $_SESSION["accept"] = $accept;


        header("Location: CustomerInfo.php");
        exit();



    }
}
?>

<?php include("./Lab4Common/Header.php"); ?>


<h1 align="center">Terms and Conditions</h1>

<p align="center">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque hendrerit eleifend sem ultrices scelerisque. Suspendisse libero mi, tincidunt sed vehicula finibus, volutpat molestie sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In magna mauris, volutpat blandit scelerisque venenatis, tempus sed augue. Etiam sodales tempus bibendum. Donec vitae arcu in enim commodo dictum eu vel odio. Mauris fringilla laoreet maximus. Maecenas eu quam feugiat, porta nisi sit amet, faucibus elit. Donec dignissim tortor id quam interdum fringilla. Nullam vel porttitor est, eget dictum nulla. Aenean sit amet felis sed sem laoreet faucibus vestibulum id dui.

    Donec tristique vehicula mauris ut suscipit. Nullam sodales dictum dolor, sed luctus mi cursus et. Nullam lobortis felis non fringilla maximus. Nam pretium eros nec arcu tempus venenatis. Cras dictum auctor mauris quis condimentum. Quisque accumsan, lectus et consectetur luctus, ipsum lorem tincidunt nisi, nec venenatis purus leo non ipsum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;<br>

    Integer ligula est, facilisis <br>id quam vel, imperdiet aliquet mauris. Duis faucibus neque eu magna mattis iaculis. Phasellus sagittis ipsum et ante lobortis, vel lobortis odio ultricies. Suspendisse bibendum, lorem ac volutpat tempor, nibh massa dictum lectus, nec aliquam massa est sed ligula. Morbi a elementum tellus, ornare commodo lorem. Vivamus varius aliquam tortor, ac maximus est gravida eu. Morbi sit amet condimentum nisi. Suspendisse finibus, enim a pulvinar tempus, lacus augue dignissim enim, eu mollis diam erat et mi. Ut rutrum dictum dictum. Sed rutrum mi in orci volutpat pellentesque.

    Aenean gravida pharetra venenatis. Proin convallis porttitor nunc, ac facilisis est sodales et. Pellentesque ultrices egestas augue a aliquet. Curabitur sit amet nibh eleifend, suscipit sem vel, sodales erat. Vivamus euismod mauris vitae nisl varius, id mollis orci dictum. Maecenas faucibus enim eget nunc condimentum ultricies. Mauris et lectus sit amet lacus finibus auctor. Nullam rutrum ligula varius enim rhoncus efficitur.<br>

    Donec vel nulla nunc. Sed a tellus <br> quis magna scelerisque mattis. Sed eu enim feugiat, vestibulum risus ut, molestie nibh. Aenean volutpat nulla et diam lacinia, eu semper augue pellentesque. Mauris viverra magna sit amet tincidunt vestibulum. Fusce auctor eleifend quam, sit amet lacinia turpis laoreet dapibus. Vestibulum lobortis, nisi nec commodo scelerisque, lorem lacus lobortis ante, a aliquet sem felis ut leo. Sed vulputate tempus dolor. Morbi egestas laoreet nisi id mattis. Sed eros nibh, aliquet non placerat nec, imperdiet sit amet tellus.

    Generated 5 paragraphs, 399 words, 2713 bytes of Lorem Ipsum
</p>

<br><br><br><br><br>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div align="center" class="checkbox">
        <label>
            <input id="accept" type="checkbox" name="accept" value="accept">Accept
        </label>
    </div>

    <div align="center">
        <span class="text-danger"><?php echo $errorTerms; ?></span>
    </div>
    <div align="center">
        <input class="btn btn-primary" type="submit" name="btnSubmit" value="Start"/>
        <span style="padding-left:3em"></span>

    </div>
</form>





<?php include("./Lab4Common/Footer.php");?>

