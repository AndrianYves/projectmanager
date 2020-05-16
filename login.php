<?php
      require_once "config.php";
      require_once "g-config.php";

      include 'includes/conn.php';
      
    if(isset($_SESSION['users'])){
      header('location: index.php');
    }

    if(isset($_POST['login'])){
        $error = false;

      if (empty($_POST['user'])) {
        $error = true;
        $_SESSION['error'][] = 'Email is required.';
      } else if (preg_match("/([%\$#\*]+)/", $_POST['user'])) {
        $error = true;
        $_SESSION['error'][] = 'Email is invalid.';
      } else {
        $user = mysqli_real_escape_string($conn, $_POST['user']);
      }

      if (empty($_POST['password'])) {
        $error = true;
        $_SESSION['error'][] = 'Password is required.';
      } else {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      }

   
      if(!$error){
          $sql = "SELECT * FROM users WHERE email = '$user'";
          $query = $conn->query($sql);
        if($query->num_rows < 1){
          $_SESSION['error'][] = 'Invalid Email/Password';
        } else {
          $row = $query->fetch_assoc();
                 if(password_verify($password, $row['password'])){
                  if($row['status'] == 'Block'){
                    $_SESSION['error'][] = 'Accont is Blocked.';
                  } else{
                    $timestamp = date("Y-m-d H:i:s");
                    $result1 = mysqli_query($conn,"UPDATE users SET lastlogin='$timestamp' WHERE email='$user'");
                    $_SESSION['users'] = $row['id'];
                    header('location: index.php');
                  }

            } else {
              $_SESSION['error'][] = 'Invalid Username/Password';
            }
          }
        
      }
    }



  $redirectURL = "http://localhost/projectmanager/fb-callback.php";
  $permissions = ['email'];
  $loginURL = $helper->getLoginUrl($redirectURL, $permissions);
  $gloginURL = $gClient->createAuthUrl();
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Project Management</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="user">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
<!--           <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
<!--           <div class="col-4"> -->
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
<!--           </div> -->
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="<?php echo $loginURL; ?>" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in with Facebook
        </a>
        <a href="<?php echo $gloginURL; ?>" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in with Google
        </a>
      </div>
      <!-- /.social-auth-links -->
<!-- 
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php include 'includes/scripts.php'; ?>



</body>
</html>
