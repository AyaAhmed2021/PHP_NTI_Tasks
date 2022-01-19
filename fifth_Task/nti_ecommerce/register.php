<?php
$title = "Register";
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once "layouts/breadcrumb.php";
include_once "app/requests/Validation.php";
include_once "app/models/User.php";

if ($_POST) {
    // print_r($_POST); die;

    #emailvalidation 
    $emailvalidation = new Validation('email', $_POST['email']);
    $emailRequiredResult = $emailvalidation->required();
    $pattern = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';
    if (empty($emailRequiredResult)) {
        $emailRegex = $emailvalidation->pattern($pattern);
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
    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (empty($passwordRequiredResult)) {
        $passwordRegex = $passwordvalidation->pattern($pattern);
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
    $pattern = '/^01[0-2]{1}[0-9]{8}/';
    if (empty($phoneRequiredResult)) {
        $emailRegex = $phonevalidation->pattern($pattern);
        if (empty($phoneRegex)) {
            $phoneUnique = $phonevalidation->unique('users');
            if (empty($phoneUnique)) {
                $success['phone'] = $_POST['phone'];
            }
        }
    }
}

if (isset($success['email']) && isset($scuess['password']) && isset($success['phone'])) {
    $userObj = new User; //userobject

    //set user data 
    $suerObj->setFirst_name($_POST['first_name']);
    $suerObj->setLast_name($_POST['last_name']);
    $suerObj->setEmail($_POST['email']);
    $suerObj->setGender($_POST['gender']);
    $suerObj->setPhone($_POST['phone']);
    $suerObj->setPassword($_POST['password']);
    $code = rand(10000, 99999);
    $userObj->setCode($code);
    $insert = $userObj->create();
    // var_dump($insert);die;
    if ($insert) {
        
    } else {
        $insertionerror = '<div class="alert alert-danger"> Something went wrong, please try again later</div>';
    }
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
                        <?= $insertionerror; ?>
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
                                        <?= (empty($passwordUnique)) ? "" : $passwordUnique; ?>

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
                                            <button type="submit"><span>Register</span></button>
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
include_once "layouts/footer-scripts.php";
?>