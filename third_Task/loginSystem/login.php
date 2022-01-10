<?php include("layouts/header.php");


$users = [
  [
    'id' => 1,
    'name' => 'ahmed',
    'email' => 'ahmed@gmail.com',
    'password' => '123456',
    'image' => '1.png',
    'gender' => 'm'
  ],
  [
    'id' => 2,
    'name' => 'esraa',
    'email' => 'esraa@gmail.com',
    'password' => '123456',
    'image' => '2.png',
    'gender' => 'f'
  ],
  [
    'id' => 3,
    'name' => 'galal',
    'email' => 'galal@gmail.com',
    'password' => '123456',
    'image' => '3.png',
    'gender' => 'm'
  ]
];

if ($_POST) {
  $errors = [];

  if (!$_POST['email']) {
    $errors['email'] = "<div class='alert alert-danger'>E-mail is required</div>";
  }

  if (!$_POST['password']) {
    $errors['pasword'] = "<div class='alert alert-danger'>Password is required</div>";
  }

  if (empty($user)) {
    $errors['wrong'] = "<div class='alert alert-danger'> Wrong Email Or Password </div>";
  } else {
    // user authenticated
    // save data in session
    $_SESSION['user'] = $user[0];
    // redirect home page
    header('location:index.php');
  }
}
?>
<div class="container">
  <h2 class="mt-5 text-center text-success">Login</h2>
  <form class="mt-3 w-25 text-center m-auto" method="POST">
    <div class="mb-3">
      <input type="email" class="form-control" name="email" placeholder="example@blablabla.com" aria-describedby="emailHelp" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : "") ?>">
      <div id=" emailHelp" class="form-text">We'll never share your email with anyone else.
      </div>
      <?php echo (isset($errors['email']) ? $errors['email'] : "")  ?>

    </div>
    <div class="mb-3">
      <input type="password" class="form-control" name="password" placeholder="enter your password">
      <?php if (isset($errors['password'])) {
        echo $errors['password'];
      } ?>

    </div>
    <button type="submit" class="btn btn-success" name="login">Login</button>
    <?php if (isset($errors['wrong'])) {
      echo $errors['wrong'];
    } ?>

  </form>
</div>

<?php include("layouts/footer.php") ?>