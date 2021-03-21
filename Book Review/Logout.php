<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-12-08
 * Time: 2:01 PM
 */


    session_start();
    session_destroy();
    header("Location: Login.php");
    die();

