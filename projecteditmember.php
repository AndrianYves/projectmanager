<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projets";

  $memID = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT * from projectmembers join users on users.id = projectmembers.userID where projectmembers.id = '$memID'");
  $row = mysqli_fetch_assoc($sql);

  if(isset($_POST['save'])){ 
    mysqli_autocommit($conn, false);
    $error = false;
      
    if (empty($_POST['editrole'])) {
      $error = true;
      $_SESSION['error'][] = 'Role is required.';
    } else {
      $editrole = strtolower($_POST['editrole']);
    }

    $roleID = strtolower($_POST['roleID']);

    $result = $conn->prepare("UPDATE projectmembers SET role = ? where id = ?");
    $result->bind_param("si", $editrole, $roleID);
    $result->execute();
    $result->close();

      $sql1 = mysqli_query($conn, "SELECT * from projectmembers join users on users.id = projectmembers.userID where projectmembers.id = '$roleID'");
      $row1 = mysqli_fetch_assoc($sql1);

    if($editrole == 'project manager'){
      $result = $conn->prepare("UPDATE project SET owner = ? where id = ?");
      $result->bind_param("ii", $row1['userID'], $row1['projectID']);
      $result->execute();
      $result->close();
    }

    if(!$error){
      mysqli_commit($conn);
      $_SESSION['success'] = 'Role Updated';
    } else {
      mysqli_rollback($conn);
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
            <h1>Edit Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo ucwords($row['firstname']);?> <?php echo ucwords($row['lastname']);?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="projecteditmember.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="projectname">Role</label>
                    <input type="hidden" class="form-control" id="roleID" name="roleID" value="<?php echo ucwords($memID);?>">
                    <input type="text" class="form-control" id="editrole" name="editrole" value="<?php echo ucwords($row['role']);?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="save">Save</button>
                </div>
              </form>
            </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
