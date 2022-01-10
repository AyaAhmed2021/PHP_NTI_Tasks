<?php
$title = 'club Subscribtion';
include 'layouts/header.php';

if (!empty($_POST['member']) && !empty($_POST['family_number'])) {
    $_SESSION['family_number'] = $_POST['family_number'];
    $_SESSION['member_name'] = $_POST['member'];
    // print_r($_POST);
    header('location:games.php');
}

?>

<div class="container mt-5 position-relative text-center">
    <form class="bg-warning border rounded w-50 position-absolute" style="left: 25%;" method="POST">
        <input type="text" class="form-control my-3" style="margin-left: 20%; width: 60%;" placeholder="enter your name" name="member">
        <input type="text" class="form-control my-3" style="margin-left: 20%; width: 60%;" placeholder="enter your family number" name="family_number">
        <button type="submit" class="btn btn-success my-3" name="subscribe">Subscribe</button>
    </form>

</div>


<?php
include 'layouts/footer.php';
?>