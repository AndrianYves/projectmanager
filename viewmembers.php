<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
 $projectID = $_GET['id'];

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
            <h1>Members</h1>
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
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="100">Full Name</th>
                      <th width="100">Role</th>
                      <th width="20" style="width: 10px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = mysqli_query($conn, "SELECT * from projectmembers join users on projectmembers.userID = users.id where projectID = '$projectID'");
                    while($row = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                      <td><?php echo ucwords($row['firstname']); ?> <?php echo ucwords($row['lastname']); ?></td>
                      <td><?php echo ucwords($row['role']); ?></td>
                      <td><a href="profile.php"><span class="badge bg-info">View Profile</span></a></td>
                    </tr>
                    <tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
