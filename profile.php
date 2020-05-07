<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

 $usID = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT * from users left join aboutme on users.id = aboutme.userID where users.id = '$usID'");
  $row = mysqli_fetch_assoc($sql);
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
            <h1>View Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <h4 class="mb-2 mb-sm-0 pt-1"><a class="text-right" href="<?= $previous ?>">Back</a></h4>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo ucwords($row['firstname']);?> <?php echo ucwords($row['lastname']);?></h3>

                <p class="text-muted text-center"><?php echo ucwords($row['title']);?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                  <?php
                    $sql1 = "SELECT * FROM projectmembers where userID = '$usID'";
                    $query = mysqli_query($conn, $sql1);
                  
                    echo "<b>Projects</b><a class='float-right'>".mysqli_num_rows($query)."</a>";
                  ?>
                  </li>
                  <li class="list-group-item">
                  <?php
                    $sql2 = "SELECT * FROM teammembers where userID = '$usID'";
                    $query1 = mysqli_query($conn, $sql2);
                  
                    echo "<b>Teams</b><a class='float-right'>".mysqli_num_rows($query1)."</a>";
                  ?>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  <?php echo ucfirst($row['education']);?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo ucfirst($row['location']);?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?php echo ucfirst($row['skills']);?></span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted"><?php echo ucfirst($row['notes']);?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">History of Projects</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Project Name</th>
                      <th>Position</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                    $listproj = mysqli_query($conn, "SELECT * from project join projectmembers on project.id = projectmembers.projectID where projectmembers.userID = '2'");
                    while($row = mysqli_fetch_assoc($listproj)) {
                    ?>
                      <tr>
                        <td><?php echo ucwords($row['name']); ?></td>
                        <td><?php echo ucwords($row['role']); ?></td>
                      </tr>

                  <?php } ?>

                    <tr>
                      <td>Inventory</td>
                      <td>Project Manager</td>
                    </tr>
                    <tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

</div>
<!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
