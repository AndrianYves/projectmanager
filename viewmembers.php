<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
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
            <h1>Teams</h1>
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
                <h3 class="card-title">Simple Full Width Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Position</th>
                      <th style="width: 10px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>John Wick</td>
                      <td>Project Manager</td>
                      <td><a href="profile.php"><span class="badge bg-info">View Profile</span></a></td>
                    </tr>
                    <tr>
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
