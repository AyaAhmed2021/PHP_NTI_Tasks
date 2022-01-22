<?php
if (!isset($_POST['login'])) {
    header('location:404.php');
}
include_once "../../layouts/header.php";
include_once "../requests/Validation.php";
include_once "../models/User.php";

// $success=[];
#email validation
$emailvalidation = new Validation('email', $_POST['email']);
$emailRequiredResult = $emailvalidation->required();
$emailpattern = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';
if (empty($emailRequiredResult)) {
    $emailRegex = $emailvalidation->pattern($emailpattern);
    if (!empty($emailRegex)) {
        $_SESSION['errors']['email']['Regex'] = $emailRegex;
    } 
}else {
    $_SESSION['errors']['email']['Required'] = $emailRequiredResult;
}

#password Validation 
$passwordvalidation = new Validation('password', $_POST['password']);
$passwordRequiredResult = $passwordvalidation->required();
$passwordpattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
if (empty($passwordRequiredResult)) {
    $passwordRegex = $passwordvalidation->pattern($passwordpattern);
    if (!empty($passwordRegex)) {
        $_SESSION['errors']['password']['Regex'] = $passwordRegex;
    }
} else {
    $_SESSION['errors']['password']['Required'] = $passwordRequiredResult;
}

// print_r($_SESSION);die;

//login user
if (empty($_SESSION['errors'])) {
    $userObj = new User;
    $userObj->setEmail($_POST['email']);
    $userObj->setPassword($_POST['password']);
    $result = $userObj->login();
    // print_r($result);
    if ($result) {
        // print_r($result);die;
        $user = $result->fetch_object();

        if($user->status ==1){
            //verified
            if(isset($_POST['remember_me'])){
                setcookie('remember_me',$_POST['email'],time() + (24*60*60)*12,'/');
            }
            $_SESSION['user']=$user;
            // print_r($_SESSION['user']);die;
            header('location:../../index.php');
        }else if($user->status ==0){
            //not verified
            $_SESSION['user_email']=$_POST['email'];
            header('location:../../check-code.php');

        }else {
            // status =2 blocked
            $_SESSION['errors']['login']['blocked'] = "<div class='alert alert-danger'>sorry your account has been blocked</div>";
        }
    } else {
        $_SESSION['errors']['login']['login_failed'] = "<div class='alert alert-danger'>Wrong Attemped</div>";
    }
}

header('location:../../login.php');
