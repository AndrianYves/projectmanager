<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

  if(isset($_POST['join'])){ 
    mysqli_autocommit($conn, false);
    $userid=$_POST['userid'];
    $error = false;
    $timestamp = date("Y-m-d H:i:s");

    if (empty($_POST['projectname'])) {
      $error = true;
      $_SESSION['error'][] = 'Name is required.';
    } else {
      $projectname = test_input(strtolower($_POST['projectname']));
    }

  if(!$error){
    mysqli_commit($conn);
    $_SESSION['success'] = 'Project Created';
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
            <h1>Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Projects</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">My Projects</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
<table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="20">#</th>
                    <th width="100">Project Name</th>
                    <th width="100">Project Manager</th>
                    <th width="50">Status</th>
                    <th width="200"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $availprojects = mysqli_query($conn, "SELECT *, project.id as projID from project join users on project.owner = users.id where owner = '$id'");
                    while($row = mysqli_fetch_assoc($availprojects)) {
                      if ($row['status'] == 'on going'){  
                        $color ='info';
                      } elseif($row['status'] == 'finished') {
                        $color ='success';
                      } else {
                        $color ='danger';
                      }
                    ?>
                      <tr>
                        <td><?php echo ucwords($row['projID']); ?></td>
                        <td><?php echo ucwords($row['name']); ?></td>
                        <td><?php echo ucwords($row['firstname']); ?> <?php echo ucwords($row['lastname']); ?></td>
                        <td><span class="badge bg-<?php echo $color; ?>"><?php echo ucwords($row['status']); ?></span></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href='projectinfo.php?id=<?php echo $row['projID']; ?>'><i class="fas fa-folder"></i>View</a>
                        <a class="btn btn-info btn-sm" href='projectviewmembers.php?id=<?php echo $row['projID']; ?>'><i class="fas fa-users"></i>Members</a>
                        </a>
                      </div>
                      
                    </td>
                  </tr>

                <?php } ?>
                  </tbody>
                
                </table> 
              </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
              <div class="card-footer">                
            <div class="row">
              <div class="col-3">
              <a href="createproject.php"><button type="button" class="btn btn-block btn-primary">Create Project</button></a>
              </div>
            </div>
          </div><!-- /.footer -->
        </div>
        <!-- /.card -->

        
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
