<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "settings";

   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

  if (isset($_POST['save'])) {
     $conn->autocommit(FALSE);
      $error = false;
      $allowed = array('image/JPEG', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

      $id = test_input(strtolower($_POST['id']));

      $position = test_input(strtolower($_POST['position']));
      $education = test_input(strtolower($_POST['education']));
      $location = test_input(strtolower($_POST['location']));
      $skills = test_input(strtolower($_POST['skills']));
      $notes = test_input(strtolower($_POST['notes']));

    if (!empty($_FILES['image']['name'])) {
      if ($_FILES['image']['size'] > 2097152) {
        $error = true;
        $_SESSION['error'][] = 'Tesda Driver Certificate image size must be less than 2MB.';
      }

      if (in_array($_FILES['image']['type'], $allowed)){
        move_uploaded_file($_FILES["image"]["tmp_name"],"dist/img/".$id.'.'.pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $image = $_FILES['image']['name'];
        $result2 = $conn->prepare("UPDATE aboutme SET image = ? where userID = ?");
        $result2->bind_param("si", $image, $id);
        $result2->execute();
        $result2->close();
      } else {
        $error = true;
        $_SESSION['error'][] = 'Image must be png and jpg only.';
      }
    }


    $result = $conn->prepare("UPDATE aboutme SET title = ?, education = ?, location = ?, skills = ?, notes = ? where userID = ?");
    $result->bind_param("sssssi", $position, $education, $location, $skills, $notes, $id);
    $result->execute();
    $result->close();

    if (!$error) {
      $conn->autocommit(TRUE);
      $_SESSION['success'] = 'Applicant Updated';
    } else {
      $conn->rollback();
    }
      
  }

?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Position</label>
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">
                    <input type="text" class="form-control" name="position" placeholder="Enter position" value="<?php if(!empty($user['title'])){echo ucwords($user['title']);}?>">
                  </div>
                  <div class="form-group">
                    <label for="">Education</label>
                    <input type="text" class="form-control" name="education" placeholder="Enter education" value="<?php if(!empty($user['education'])){echo ucwords($user['education']);}?>">
                  </div>
                  <div class="form-group">
                    <label for="">Location</label>
                    <input type="text" class="form-control" name="location" placeholder="Enter location" value="<?php if(!empty($user['location'])){echo ucwords($user['location']);}?>">
                  </div>
                  <div class="form-group">
                    <label for="">Skills</label>
                    <textarea class="form-control" rows="3" name="skills" placeholder="Enter skills" value="<?php if(!empty($user['skills'])){echo ucfirst($user['skills']);}?>"><?php if(!empty($user['skills'])){echo ucfirst($user['skills']);}?></textarea>
                  </div>
                   <div class="form-group">
                    <label for="">Notes</label>
                    <textarea class="form-control" rows="3" name="notes" placeholder="Enter notes" value="<?php if(!empty($user['notes'])){echo ucfirst($user['notes']);}?>"><?php if(!empty($user['notes'])){echo ucfirst($user['notes']);}?></textarea>
                  </div>
                  <?php if(empty($_SESSION['picture'])):?>
                  <div class="form-group">
                    <label for="">Upload Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" value="<?php echo $user['image'];?>">
                        <label class="custom-file-label" for=""><?php if(!empty($user['image'])){echo ucfirst($user['image']);}?></label>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="save">Save</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->



        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'includes/footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
