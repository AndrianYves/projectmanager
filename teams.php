<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "teams";
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Teams</li>
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
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="100">Team Name</th>
                    <th width="50">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $getAllOrders = mysqli_query($conn, "SELECT * from team");
                    while($row = mysqli_fetch_assoc($getAllOrders)) {
                    ?>
                      <tr>
                        <td><?php echo ucwords($row['name']); ?></td>
                        <td><?php echo ucwords($row['description']); ?></td>
                        <td><?php echo ucwords($row['owner']); ?></td>
                        <td> 
                          <a href='evaluationview.php?id=<?php echo $row['applicantID']; ?>'><i class='fas fa-eye' class='btn btn-danger btn-rounded form-check-label'></i></a> | 
                          <a href='evaluationview.php?id=<?php echo $row['applicantID']; ?>'><i class='fas fa-eye' class='btn btn-danger btn-rounded form-check-label'></i></a> | 
                          <a href='evaluationview.php?id=<?php echo $row['applicantID']; ?>'><i class='fas fa-eye' class='btn btn-danger btn-rounded form-check-label'></i></a>
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
