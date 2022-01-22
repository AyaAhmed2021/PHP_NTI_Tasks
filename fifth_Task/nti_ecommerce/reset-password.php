<?php
$title = "ResetPassword";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
if(empty($_SESSION['user_email'])){
    header('location:login.php');
}
include_once "app/requests/Validation.php";
include_once "app/models/User.php";

if ($_POST) {
    $errors = [];
    #password Validation 
    $passwordvalidation = new Validation('password', $_POST['password']);
    $passwordRequiredResult = $passwordvalidation->required();
    $passwordpattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (empty($passwordRequiredResult)) {
        $passwordRegex = $passwordvalidation->pattern($passwordpattern);
        if (empty($passwordRegex)) {
            //confirm password value
            $passwordconfirmedvalidation = new Validation('confirm_password', $_POST['confirm_password']);
            $passwordconfirmRequired = $passwordconfirmedvalidation->required();
            if (empty($passwordconfirmRequired)) { //if not empty
                $confirmPasswordRegex = $passwordconfirmedvalidation->pattern($passwordpattern);
                if (empty($confirmPasswordRegex)) {
                    $passwordConfirmation = $passwordvalidation->confirmation($_POST['confirm_password']);
                    if (!empty($passwordConfirmation)) {
                        $errors['confirmPassword']['confirmation'] = $passwordConfirmation;
                    }
                } else {
                    $errors['confirmPassword']['Regex'] = $confirmPasswordRegex;
                }
            } else {
                $errors['confirmPassword']['Required'] = $passwordconfirmRequired;
            }
        } else {
            $errors['Password']['Regex'] = $passwordRegex;
        }
    } else {
        $errors['password']['Required'] = $passwordRequiredResult;
    }

    if (empty($errors)) {
        $userObject = new User;
        $userObject->setEmail($_SESSION['user_email']);
        $userObject->setPassword($_POST['password']);
        $result = $userObject->updatePasswordByEmail();
        // print_r($result);
        if ($result) {
            // update password
            unset($_SESSION['user_email']);
            $success = '<div class="alert alert-success">Your Password Has been Updated</div>';
            header('Refersh:3; url=login.php');
        } else {
            // no update 
            $errors['noUpdate'] = '<div class="alert alert-danger"> something went wrong</div>';
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
                            <h4> reset password </h4>
                        </a>
                    </div>
                    <?= isset($success)? $success:" "?>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (!empty($errors['password'])) {
                                            foreach ($errors['password'] as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>

                                        <input type="password" name="confirm_password" placeholder="confirm Password">
                                        <?php
                                        if (!empty($errors['confirmPassword'])) {
                                            foreach ($errors['confirmPassword'] as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box text-center">
                                            <button type="submit"><span>reset</span></button>
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