<?php
$title = "LOGIN";
include "layouts/header.php";
include "app/middleware/guest.php";
include "layouts/nav.php";
include "layouts/breadcrumb.php";
?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <?php
                if (!empty($_SESSION['errors']['login'])) {
                    foreach ($_SESSION['errors']['login'] as $key => $value) {
                        echo $value;
                    }
                }
                ?>
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="app/post/login_post.php" method="post">
                                        <input type="email" name="email" placeholder="Email">
                                        <?php
                                        if (!empty($_SESSION['errors']['email'])) {
                                            foreach ($_SESSION['errors']['email'] as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (!empty($_SESSION['errors']['password'])) {
                                            foreach ($_SESSION['errors']['password'] as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me">
                                                <label>Remember me</label>
                                                <a href="forget-password.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit" name="login"><span>Login</span></button>
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
include "layouts/footer.php";
include "layouts/footer_scripts.php";
?>