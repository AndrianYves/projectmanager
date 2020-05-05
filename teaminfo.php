<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "teams";

  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

 $teamID = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT * from team where id = '$teamID'");
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
            <h1><?php echo ucwords($row['name']);?></h1>
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
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Info
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl>
                  <dt>Projects</dt>
                    <?php 
                      $sql1 = mysqli_query($conn, "SELECT * from project join projectteams on projectteams.projectID = project.id where teamID = '$teamID'");
                      while($row1 = mysqli_fetch_assoc($sql1)) { ?>
                      <ul><li><?php echo ucfirst($row1['name']);?> <a class="btn btn-primary btn-sm" href='projectinfo.php?id=<?php echo $row1['projectID']; ?>'><i class="fas fa-folder"></i>View
                        </a></li></ul>
                    <?php }?>
                  <dt>Members</dt>
                  <?php 
                    $sql2 = mysqli_query($conn, "SELECT * from teammembers join users on teammembers.userID = users.id where teamID = '$teamID' order by lastname");
                    while($row2 = mysqli_fetch_assoc($sql2)) { ?>
                  <ul><li><?php echo ucwords($row2['firstname']);?> <?php echo ucwords($row2['lastname']);?></li></ul>
                <?php }?>
                </dl>
              </div>
              <!-- /.card-body -->
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
