<?php
$title = "Register";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
include_once "layouts/nav.php";
include_once "layouts/breadcrumb.php";
include_once "app/requests/Validation.php";
include_once "app/models/User.php";
include_once "app/services/mail.php";

if ($_POST) {
    // print_r($_POST); die;

    $success = [];
    #emailvalidation 
    $emailvalidation = new Validation('email', $_POST['email']);
    $emailRequiredResult = $emailvalidation->required();
    $emailpattern = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';
    if (empty($emailRequiredResult)) {
        $emailRegex = $emailvalidation->pattern($emailpattern);
        if (empty($emailRegex)) {
            $emailUnique = $emailvalidation->unique('users');
            if (empty($emailUnique)) {
                $success['email'] = $_POST['email'];
            }
        }
    }

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
                $passwordConfirmation = $passwordvalidation->confirmation($_POST['confirm_password']);
                if (empty($passwordConfirmation)) {
                    $success['password'] = $_POST['password'];
                }
            }
        }
    }

    #phone validation

    $phonevalidation = new Validation('phone', $_POST['phone']);
    $phoneRequiredResult = $phonevalidation->required();
    $phonepattern = '/^01[0-2]{1}[0-9]{8}/';
    if (empty($phoneRequiredResult)) {
        $phoneRegex = $phonevalidation->pattern($phonepattern);
        if (empty($phoneRegex)) {
            $phoneUnique = $phonevalidation->unique('users');
            if (empty($phoneUnique)) {
                $success['phone'] = $_POST['phone'];
            }
        }
    }
    // print_r($success);die;

    if (isset($success['email']) && isset($success['password']) && isset($success['phone'])) {
        $userObj = new User; //userobject
        // echo 'is set';
        //set user data 
        $userObj->setFirst_name($_POST['first_name']);
        $userObj->setLast_name($_POST['last_name']);
        $userObj->setEmail($_POST['email']);
        $userObj->setGender($_POST['gender']);
        $userObj->setPhone($_POST['phone']);
        $userObj->setPassword($_POST['password']);
        $code = rand(10000, 99999);
        $userObj->setCode($code);
        // echo 'is set2';
        // echo $code;
        $insert = $userObj->create();
        // var_dump($insert);
        if ($insert) {
            // echo "insert";
            $subject = 'Verification Code';
            $body = "Hello {$_POST['first_name']} {$_POST['last_name']},<br> your verification code is $code. Thank you";
            $mail = new mail($_POST['email'], $subject, $body);
            $mailResult = $mail->send();

            if ($mailResult) {
                $_SESSION['user_email'] = $_POST['email'];
                header('location:check-code.php?page=register');die;
            } else {
                $insertionerror = '<div class="alert alert-danger"> Something went wrong, please try again later</div>';
            }
        } else {
            $insertionerror = '<div class="alert alert-danger"> Something went wrong, please try again later</div>';
        }
    }
    // else {
    //     echo 'not success';
    // }
}


?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <?= isset($insertionerror) ?  $insertionerror : ""; ?>
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="first_name" placeholder="first_name" value="<?php if (isset($_POST['first_name'])) {
                                                                                                                    echo $_POST['first_name'];
                                                                                                                } ?>">
                                        <input type="text" name="last_name" placeholder="last_name" value="<?php if (isset($_POST['last_name'])) {
                                                                                                                echo $_POST['last_name'];
                                                                                                            } ?>">
                                        <input type="number" name="phone" placeholder="mobile no." value="<?php if (isset($_POST['phone'])) {
                                                                                                                echo $_POST['phone'];
                                                                                                            } ?>">
                                        <?= (empty($phoneRequiredResult)) ? "" : $phoneRequiredResult; ?>
                                        <?= (empty($phoneRegex)) ? "" : $phoneRegex; ?>
                                        <?= (empty($phoneUnique)) ? "" : $phoneUnique; ?>

                                        <input type="password" name="password" placeholder="Password">
                                        <?= (empty($passwordRequiredResult)) ? "" : $passwordRequiredResult; ?>
                                        <?= (empty($passwordRegex)) ? "" : $passwordRegex; ?>

                                        <input type="password" name="confirm_password" placeholder="confirm Password">
                                        <?= (empty($passwordconfirmRequired)) ? "" : $passwordconfirmRequired; ?>

                                        <select name="gender" class="form-control">
                                            <option <?= isset($_POST['gender']) && ($_POST['gender'] == 'm') ? 'selected' : '' ?> value="m">male</option>
                                            <option <?= isset($_POST['gender']) && ($_POST['gender'] == 'f') ? 'selected' : '' ?> value="f">female</option>
                                        </select><br>

                                        <input name="email" placeholder="Email" type="email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                        <?= (empty($emailRequiredResult)) ? "" : $emailRequiredResult; ?>
                                        <?= (empty($emailRegex)) ? "" : $emailRegex; ?>
                                        <?= (empty($emailUnique)) ? "" : $emailUnique; ?>
                                        <div class="button-box">
                                            <button type="submit" name="btnSumbit"><span>Register</span></button>
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
include_once "layouts/footer.php";
include_once "layouts/footer_scripts.php";
?>