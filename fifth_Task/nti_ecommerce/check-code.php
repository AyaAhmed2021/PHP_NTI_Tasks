<?php
$title = "CheckCode";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
if(empty($_SESSION['user_email'])){
    header('location:login.php');
}
include_once "app/requests/Validation.php";
include_once "app/models/User.php";

// check query string 
$avaliablePages = ['register', 'forget'];
if ($_GET) {
    // print_r($_GET);die;
    if ($_GET['page']) {
        if (!in_array($_GET['page'], $avaliablePages)) {
            header('location:app/post/404.php');
            die;
        }
    } else {
        header('location:app/post/404.php');
        die;
    }
} else {
    header('location:app/post/404.php');
    die;
}

if ($_POST) {
    $errors = [];
    $codevalidation = new Validation('code', $_POST['code']);
    $codeRequiredResult = $codevalidation->required();
    if (empty($codeRequiredResult)) {
        if (strlen($_POST['code']) != 5) {
            $errors['digit'] = '<div class="alert alert-danger"> the code must be 5 Digits</div>';
        }
    } else {
        $errors['required'] = $codeRequiredResult;
    }

    if (empty($errors)) {
        $userObject = new User;
        $userObject->setCode($_POST['code']);
        $userObject->setEmail($_SESSION['user_email']);
        $result = $userObject->checkcode();
        // print_r($_SESSION);die;
        // print_r($result);die;
        if ($result) {
            $userObject->setStatus(1);
            date_default_timezone_set('Africa/Cairo');
            $userObject->setEmail_verfied_at(date('Y-m-d H:i:s'));
            $updateResult = $userObject->makeuserverified();

            if ($updateResult) {
                if ($_GET['page'] == 'register') {
                    unset($_SESSION['user_email']);
                    header('location:login.php');
                } elseif ($_GET['page'] == 'forget') {
                    header('location:reset-password.php');  
                }
            } else {
                $errors['noUpdate'] = '<div class="alert alert-danger"> something went wrong</div>';
            }
        } else {
            $errors['wrong'] = '<div class="alert alert-danger"> wrong code</div>';
        }
    }
}

?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Verfiy Code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="number" min="10000" max="99999" name="code" placeholder="enter your verification code">
                                        <?php
                                        if (!empty($errors)) {
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                        <div class="button-box text-center">
                                            <button type="submit"><span>Verfiy</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer_scripts.php";
?>