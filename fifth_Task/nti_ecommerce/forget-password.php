<?php
$title = "CheckCode";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
if(empty($_SESSION['user_email'])){
    header('location:login.php');
}
include_once "app/requests/Validation.php";
include_once "app/models/User.php";
include_once "app/services/mail.php";

if ($_POST) {
    $errors = [];
    #email validation
    $emailvalidation = new Validation('email', $_POST['email']);
    $emailRequiredResult = $emailvalidation->required();
    $emailpattern = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/';
    if (empty($emailRequiredResult)) {
        $emailRegex = $emailvalidation->pattern($emailpattern);
        if (!empty($emailRegex)) {
            $errors['regex'] = $emailRegex;
        }
    } else {
        $errors['required'] = $emailRequiredResult;
    }

    if (empty($errors)) {
        $userObject = new User;
        $userObject->setEmail($_POST['email']);
        $result = $userObject->getUserByEmail();
        // print_r($result);
        if ($result) {
            // correct email 
            $user = $result->fetch_object();
            // generate code 
            $code = rand(10000, 99999);
            // save code ,send code
            $userObject->setCode($code);
            $updateResult = $userObject->updateCodeByEmail();
            // var_dump($updateResult);die;
            if ($updateResult) {
                $subject = 'Forget Password Code';
                $body = "Hello {$_POST['first_name']} {$_POST['last_name']} <br> your Forget Password code is $code. Thank you";
                $mail = new mail($_POST['email'], $subject, $body);
                $mailResult = $mail->send();

                if ($mailResult) {
                    $_SESSION['user_email'] = $_POST['email'];
                    header('location:check-code.php?page=forget');
                } else {
                    $errors['noSend']= '<div class="alert alert-danger"> Something went wrong, please try again later</div>';
                }
            } else {
                // no update 
                $errors['noUpdate'] = '<div class="alert alert-danger"> something went wrong</div>';
            }
        } else {
            // wrong Email 
            $errors['wrong'] = '<div class="alert alert-danger"> Wrong Email</div>';
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
                            <h4> forget password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="email" name="email" placeholder="enter your email">
                                        <?php
                                        if (!empty($errors)) {
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                        <div class="button-box text-center">
                                            <button type="submit"><span>Verfiy your Email</span></button>
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