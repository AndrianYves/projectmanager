<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "dashboard";

?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if(!empty($_SESSION['picture'])){?>
                      <img src="<?php echo $_SESSION['picture']?>" class="profile-user-img img-fluid img-circle"alt="User profile picture" style="height: 100px; width: 100px;">
                  <?php }else{?>
                      <img <?php if($user['image'] == 'avatar.png'){ echo 'src="dist/img/avatar.png"';} else { echo 'src="dist/img/'.$id.'.'.pathinfo($user["image"], PATHINFO_EXTENSION).'"';} ?> class="profile-user-img img-fluid img-circle"alt="User profile picture" style="height: 100px; width: 100px;">
                  <?php }?>

                </div>

                <h3 class="profile-username text-center"><?php echo ucwords($user['firstname']);?> <?php echo ucwords($user['lastname']);?></h3>

                <p class="text-muted text-center"><?php if(!empty($user['title'])){echo ucwords($user['title']);}?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                  <?php
                    $sql1 = "SELECT * FROM projectmembers where userID = '$id'";
                    $query = mysqli_query($conn, $sql1);
                  
                    echo "<b>Projects</b><a class='float-right'>".mysqli_num_rows($query)."</a>";
                  ?>
                  </li>
                  <li class="list-group-item">
                  <?php
                    $sql2 = "SELECT * FROM teammembers where userID = '$id'";
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
                  <?php if(!empty($user['education'])){echo ucfirst($user['education']);}?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php if(!empty($user['location'])){echo ucfirst($user['location']);}?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"> <?php if(!empty($user['skills'])){echo ucfirst($user['skills']);}?></span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted"><?php if(!empty($user['notes'])){echo ucfirst($user['notes']);}?></p>

                <a href="settings.php"><button type="button" class="btn btn-block btn-primary btn-xs">Edit</button></a>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
             <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php echo "<h3>".mysqli_num_rows($query)."</h3>";?>

                <p>My Project</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="projects.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php echo "<h3>".mysqli_num_rows($query1)."</h3>";?>

                <p>My Teams</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="teams.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
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
