<?php
//for allowed users 
if(empty($_SESSION['user'])){
    header('location:login.php');
}