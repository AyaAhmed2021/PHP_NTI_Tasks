<?php
$title = "My Account";
include_once "layouts/header.php";
include_once "app/middleware/auth.php";
include_once "app/models/User.php";

// print_r($_SESSION['user']);
$userObj = new User;
$userObj->setEmail($_SESSION['user']->email);

if (isset($_POST['personal-info'])) {
    // print_r($_POST);
    // die;
    // print_r($_FILES);die;

    $errors = [];
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['phone'])) {
        $errors['all'] = '<div class="alert alert-danger text-center">All fields are required</div>';
    }

    $userObj->setFirst_name($_POST['first_name']);
    $userObj->setLast_name($_POST['last_name']);
    $userObj->setPhone($_POST['phone']);
    $userObj->setGender($_POST['gender']);

    // print_r($_FILES);die;
    // print_r($_POST['image']);die;


    if ($_FILES['image']['error'] == 0) {
        // image size 
        $maxSize = 10 ** 6; //1Mega 
        if ($_FILES['image']['size'] > $maxSize) {
            $errors['imgSize'] = '<div class="alert alert-danger">the image Size must be less than 1 MB</div>';
        }
        // image extension 
        $extensions = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $availableExtensions = ['jpg, png, jpeg'];
        if (!in_array($extensions, $availableExtensions)) {
            $errors['imgExtension'] = '<div class="alert alert-danger">not valid image extension, the image estension must be jpg, png or jpeg</div>';
        }

        if (empty($errors)) {
            // upload image
            $photoName = uniqid() . '.' . $extensions;
            $photoPath = "assets/img/user/$photoName";
            move_uploaded_file($_FILES['image']['tmp_name'], $photoPath);
            // set image
            $userObj->setImage($photoName);
            $_SESSION['user']->image = $photoName;
        }
    }
    if (empty($errors)) {
        $result = $userObj->update();
        $_SESSION['user']->first_name = $_POST['first_name'];
        $_SESSION['user']->last_name = $_POST['last_name'];
        $_SESSION['user']->phone = $_POST['phone'];
        $_SESSION['user']->gender = $_POST['gender'];
        if ($result) {
            $success = '<div class="alert alert-success text-center">Updated Successfully</div>';
        } else {
            $errors['no update'] = '<div class="alert alert-danger text-center">Something went wrong</div>';
        }
    }
}

if (isset($_POST['password-update'])) {
    // print_r($_POST);
    // die;

    $userObj->setPassword($_POST['new-password']);
    $result = $userObj->updatePasswordByEmail();
    if($result){
        $success = '<div class="alert alert-success text-center">Updated Successfully</div>';
    }else{
        $errors['no update'] = '<div class="alert alert-danger text-center">Something went wrong</div>';
    }
}

include_once "layouts/nav.php";
include_once "layouts/breadcrumb.php";

$result = $userObj->getUserByEmail();
$user = $result->fetch_object();




?>

<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse show">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <form method="POST" enctype="multipart/form-data">
                                            <?php
                                            if (!empty($errors)) {
                                                foreach ($errors as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            if (isset($success)) {
                                                echo $success;
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="col-4 offset-4">
                                                        <img src="assets/img/user/<?= $user->image ?>" alt="" id="image" class="w-75 rounded-circle" style="cursor: pointer;">
                                                        <input type="file" name="image" id="file" class="d-none">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" value="<?= $user->first_name ?>" name="first_name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" value="<?= $user->last_name ?>" name="last_name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input type="email" value="<?= $user->email ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>phone</label>
                                                        <input type="number" value="<?= $user->phone ?>" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>gender</label>
                                                        <select name="gender" class="form-control">
                                                            <option <?= $user->gender == 'm' ? 'selected' : '' ?> value="m">male</option>
                                                            <option <?= $user->gender == 'f' ? 'selected' : '' ?> value="f">female</option>
                                                        </select><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="personal-info">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form class="billing-information-wrapper" method="POST">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                            <h5>Your Password</h5>
                                        </div>
                                        <form method="POST">
                                            <?php
                                            if (!empty($errors)) {
                                                foreach ($errors as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            if (isset($success)) {
                                                echo $success;
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label> Old Password</label>
                                                        <input type="password" name="old-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label> New Password</label>
                                                        <input type="password" name="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="confirm-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="password-update">Update</button>
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
</div>
<!-- my account end -->


<?php
include_once "layouts/footer.php";
include_once "layouts/footer_scripts.php";
?>
<script>
    // document.getElementById('image').click(function(){
    //     document.getElementById('file').click();
    // });
    $('#image').on('click', function() {
        $('#file').click();
    });
</script>