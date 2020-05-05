<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

 $projectID = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT *, project.id as projID from project join users on project.owner = users.id where project.id = '$projectID'");
  $row = mysqli_fetch_assoc($sql);
  $projID = $row['projID'];

if(isset($_POST['addteam'])){ 
    mysqli_autocommit($conn, false);
    $error = false;
    $timestamp = date("Y-m-d H:i:s");
    $proID = $_POST['proID'];

  if (!empty($_POST["projectteam"])){
    $numberteam = count($_POST["projectteam"]);
    for($i=0; $i<$numberteam; $i++) {
      if(trim($_POST["projectteam"][$i] != '')) {
        $teams = $_POST["projectteam"][$i];
        $result = $conn->prepare("INSERT INTO projectteams(projectID, teamID) VALUES(?, ?)");
        $result->bind_param("ii", $proID, $teams);
        $result->execute();
        $result->close();

        $result3 = mysqli_query($conn, "SELECT * FROM teammembers where `teamID` = '$teams'");
        while ($row1 = mysqli_fetch_array($result3)) {
          $teamusers = $row1['userID'];
          $result = $conn->prepare("INSERT INTO projectmembers(projectID, userID) VALUES(?, ?)");
          $result->bind_param("ii", $proID, $teamusers);
          $result->execute();
          $result->close();
        }
      }
    }
  }

  if(!$error){
    mysqli_commit($conn);
    session_start();
    $_SESSION['success'] = 'Team Join';
    header('location: projects.php');
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
                  <dt>Description</dt>
                  <dd><?php echo ucfirst($row['description']);?></dd>
                  <dt>Date Start</dt>
                  <dd><?php echo date('F j, Y',strtotime($row['datestart']));?></dd>
                  <dt>Date End</dt>
                  <dd><?php echo date('F j, Y',strtotime($row['dateend']));?></dd>
                  <dt>Location</dt>
                  <dd><?php echo ucfirst($row['location']);?></dd>
                  <dt>Project Manager</dt>
                  <dd><?php echo ucfirst($row['firstname']);?> <?php echo ucfirst($row['lastname']);?></dd>
                  <dt>Teams</dt>
                  <?php 
                    $sql1 = mysqli_query($conn, "SELECT *, projectteams.teamID as teamID from projectteams join team on projectteams.teamID = team.id where projectID = '$projID'");
                    while($row1 = mysqli_fetch_assoc($sql1)) { ?>
                      <ul>
                  <li><?php echo ucfirst($row1['name']);?><a class="btn btn-info btn-sm" href='teammembers.php?id=<?php echo $row1['teamID']; ?>'><i class="fas fa-users"></i>Members
                        </a></li></ul>
                <?php }?>
                <dd><a class="btn btn-primary btn-sm" href='viewmembers.php?id=<?php echo $projID; ?>'><i class="fas fa-users"></i>View Member Roles
                        </a></dd>
                
                </dl>
                <?php if($row['owner'] == $id){ ?>
                <form class="form-horizontal" action="projectinfo.php" method="POST">
                <div class="row">
                  <div class="col-3">
                  <div class="form-group">
                      <label>Invite Teams</label>
                      <input type="hidden" class="form-control" id="proID" name="proID" value="<?php echo $projID; ?>">
                      <select name="projectteam[]" class="select2" multiple="multiple" data-placeholder="Select Team" style="width: 100%;">
                        <?php $team = mysqli_query($conn, "SELECT * from team");?>
                        <?php foreach($team as $teamID): ?>
                          <option value="<?= $teamID['id']; ?>"><?= ucfirst($teamID['name']); ?></option>
                        <?php endforeach; ?>
                      </select><br>
                      <button type="submit" class="btn btn-primary btn-sm" name="addteam">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
                <?php } ?>
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
