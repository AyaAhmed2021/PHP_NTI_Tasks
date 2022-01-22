<?php
//for guest users
if(!empty($_SESSION['user'])){
    header('location:index.php');
}