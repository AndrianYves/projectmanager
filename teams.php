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
<div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">My Teams</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">All Teams</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    
                  <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="20">#</th>
                    <th width="100">Team Name</th>
                    <th width="200"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $myteam = mysqli_query($conn, "SELECT *, team.id as teamID from team join teammembers on team.id = teammembers.teamID where teammembers.userID = '".$id."'");
                    while($row = mysqli_fetch_assoc($myteam)) {
                    ?>
                      <tr>
                        <td><?php echo ucwords($row['id']); ?></td>
                        <td><?php echo ucwords($row['name']); ?></td>
                        <td>
                      <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href='teaminfo.php?id=<?php echo $row['teamID']; ?>'><i class="fas fa-folder"></i>View</a>
                        <a class="btn btn-info btn-sm" href='teammembers.php?id=<?php echo $row['teamID']; ?>'><i class="fas fa-users"></i>Members</a>
                        </a>
                      </div>
                      
                    </td>
                  </tr>

                <?php } ?>
                  </tbody>
                
                </table> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                     <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="20">#</th>
                    <th width="100">Team Name</th>
                    <th width="200"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $allprojects = mysqli_query($conn, "SELECT *, team.id as teamID from team");
                    while($row1 = mysqli_fetch_assoc($allprojects)) {
                    ?>
                      <tr>
                        <td><?php echo ucwords($row1['id']); ?></td>
                        <td><?php echo ucwords($row1['name']); ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href='teaminfo.php?id=<?php echo $row1['teamID']; ?>'><i class="fas fa-folder"></i>View
                        </a>
                        <a class="btn btn-info btn-sm" href='teammembers.php?id=<?php echo $row1['teamID']; ?>'><i class="fas fa-users"></i>Members
                        </a>
<!--                         <a class="btn btn-success btn-sm" href='teamjoin.php?id=<?php echo $row1['teamID']; ?>'><i class="fas fa-users"></i>Join
                        </a> -->
                      </div>
                    </td>
                  </tr>

                <?php } ?>
                  </tbody>
                
                </table>
                </form>  
                  </div>
                </div>
              </div>
              <!-- /.card -->
              <div class="card-footer">                
            <div class="row">
              <div class="col-3">
              <a href="createteam.php"><button type="button" class="btn btn-block btn-primary">Create Team</button></a>
              </div>
            </div>
          </div><!-- /.footer -->
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
