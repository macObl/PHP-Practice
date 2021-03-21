<?php
function getRestaurantXML(){
    return $xml = simplexml_load_file('restaurant_reviews.xml');   
}

function onRestaurantChanged(){
    $selected_name = $_POST['drpRestaurant'];
    $_SESSION["selection"]=$selected_name;
}




?>

