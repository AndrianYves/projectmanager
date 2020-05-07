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

  if(isset($_POST['save'])){ 
    mysqli_autocommit($conn, false);
    $error = false;
    $timestamp = date("Y-m-d H:i:s");
    $teamid = $_POST['teamid'];

  if (!empty($_POST["addmember"])){
    $numberteam = count($_POST["addmember"]);
    for($i=0; $i<$numberteam; $i++) {
      if(trim($_POST["addmember"][$i] != '')) {
        $member = $_POST["addmember"][$i];
        $result = $conn->prepare("INSERT INTO teammembers(teamID, userID) VALUES(?, ?)");
        $result->bind_param("ii", $teamid, $member);
        $result->execute();
        $result->close();

        $result3 = mysqli_query($conn, "SELECT * FROM projectteams where `teamID` = '$teamid'");
        while ($row1 = mysqli_fetch_array($result3)) {
          $proID = $row1['projectID'];
          $result = $conn->prepare("INSERT INTO projectmembers(projectID, userID) VALUES(?, ?)");
          $result->bind_param("ii", $proID, $member);
          $result->execute();
          $result->close();
        }
      }
    }
  }

  if(!$error){
    mysqli_commit($conn);
    $_SESSION['success'] = 'Team Join';
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
                  <?php   
                    $sql3 = mysqli_query($conn, "SELECT * from teammembers where teamID = '$teamID' and userID = '$id'");
                    $row3 = mysqli_fetch_assoc($sql3);
                    if($row3['userID'] == $id){ ?>
                <form class="form-horizontal" action="teaminfo.php" method="POST">
                <div class="row">
                  <div class="col-3">
                  <div class="form-group">
                      <label>Invite Members</label>
                      <input type="hidden" class="form-control" id="teamid" name="teamid" value="<?php echo $teamID; ?>">
                      <select name="addmember[]" class="select2" multiple="multiple" data-placeholder="Select Team" style="width: 100%;">
                        <?php $mem = mysqli_query($conn, "SELECT * from users");?>
                        <?php foreach($mem as $memID): ?>
                          <option value="<?= $memID['id']; ?>"><?= ucfirst($memID['firstname']); ?> <?= ucfirst($memID['lastname']); ?></option>
                        <?php endforeach; ?>
                      </select><br>
                      <button type="submit" class="btn btn-primary btn-sm" name="save">Submit</button>
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
