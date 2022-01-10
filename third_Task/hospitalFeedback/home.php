<?php
$title = 'home';
include 'layouts/header.php';
if (empty($_POST['phone'])) {
    $error = '<div class="text-red fs-6">please enter your phone</div>';
}else {
    $phone = $_POST['phone'];
    $_SESSION['phone'] = $phone;
    print_r($_SESSION);
    header('location:feedBack.php');
}
?>
<div class="container">
    <form method="POST" class="position-relative">
        <div class="d-flex position-absolute" style="top: 220px; left: -80px;">
            <input type="text" class="form-control" placeholder="enter phone number" name="phone">
            <button type="submit" class="btn btn-primary" name="enter">Enter</button>
        </div>
    </form>
    

</div>


<?php
include 'layouts/footer.php';
?>