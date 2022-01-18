<?php
$title = "Register";
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once "layouts/breadcrumb.php";
include_once "app/requests/Validation.php";

if($_POST){
    // print_r($_POST); die;

    #emailvalidation 
    $validation = new Validation('email', $_POST['email']);
    $emailRequiredResult = $validation->required();
    $pattern = '//';
    $emailRegex = $validation->pattern($pattern);
    $emaiUnique = $validation->unique('Users');

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
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="first_name" placeholder="first_name" value = "<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];}?>">
                                        <input type="text" name="last_name" placeholder="last_name" value = "<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];}?>">
                                        <input type="number" name="phone" placeholder="mobile no." value = "<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>">                                        
                                        <input type="password" name="password" placeholder="Password">
                                        <input type="password" name="confirm_password" placeholder="confirm Password">
                                        <select name="gender" class="form-control">
                                            <option <?= isset($_POST['gender']) && ($_POST['gender']=='m') ?'selected' : ''?> value="m">male</option>
                                            <option <?= isset($_POST['gender']) && ($_POST['gender']=='f') ?'selected' : ''?> value="f">female</option>
                                        </select><br>

                                        <input name="email" placeholder="Email" type="email" value = "<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
                                        <?= (empty($emailRequiredResult))? "" : $emailRequiredResult; ?>
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