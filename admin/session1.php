<?php 

//home.php

session_start();

if(!isset($_SESSION['user_session_id']))
{
    header('location:../index.php');
}

?>