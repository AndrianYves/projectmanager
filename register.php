<?php 
  include 'includes/conn.php';
  include 'includes/session.php';

  include 'includes/header.php'; 

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

if(isset($_POST['register'])){ 
  mysqli_autocommit($conn, false);
  $error = false;

  if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $_SESSION['error'][] = 'Invalid email format.'; 
    } else {
      $email = strtolower($_POST['email']);
    }
  }

  if (empty($_POST['firstname'])) {
    $error = true;
    $_SESSION['error'][] = 'Firstname is required.';
  } elseif (preg_match("/([%\$#\*]+)/", $_POST['firstname'])) {
    $error = true;
    $_SESSION['error'][] = 'Firstname is invalid.';
  } else {
    $firstname = test_input(strtolower($_POST['firstname']));
  }

  if (empty($_POST['lastname'])) {
    $error = true;
    $_SESSION['error'][] = 'Lastname is required.';
  } elseif (preg_match("/([%\$#\*]+)/", $_POST['lastname'])) {
    $error = true;
    $_SESSION['error'][] = 'Lastname is invalid.';
  } else {
    $lastname = test_input(strtolower($_POST['lastname']));
  }

  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);
  $usedtologin = '4';

  if ($password == $cpassword) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO users(email, password, firstname, lastname, usedtologin) VALUES(?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $email, $hashedPassword, $firstname, $lastname, $usedtologin);
    $sql->execute();
    $sql->close();

    $sql1 = mysqli_query($conn, "SELECT * from users where email = '$email'");
    $row1 = mysqli_fetch_assoc($sql1);
    $id = $row1['id'];
    $image = 'avatar.png';

    $sql = $conn->prepare("INSERT INTO aboutme(userID, image) VALUES(?, ?)");
    $sql->bind_param("ss", $id, $image);
    $sql->execute();
    $sql->close();

  } else {
    $error = true;
    $_SESSION['error'][] = 'Password not matched.';
  }

  if(!$error){
    mysqli_commit($conn);
    $_SESSION['success'] = 'Register Succesful';
    header('location: login.php');
  } else {
    mysqli_rollback($conn);
  }

}

if($user['usedtologin'] != '1'){
    
     header('location: index.php');
}


?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Project Management</b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="First name" name="firstname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Last name" name="lastname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="cpassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
<!--           <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
<!--           <div class="col-4"> -->
            <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
<!--           </div> -->
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
