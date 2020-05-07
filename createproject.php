<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "projects";

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

if(isset($_POST['createproject'])){ 
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

     if (empty($_POST['projectdescription'])) {
      $error = true;
      $_SESSION['error'][] = 'Description is required.';
    } else {
      $projectdescription = test_input(strtolower($_POST['projectdescription']));
    }

    if (empty($_POST['projectlocation'])) {
      $error = true;
      $_SESSION['error'][] = 'Location is required.';
    } else {
      $projectlocation = test_input(strtolower($_POST['projectlocation']));
    }

    if (empty($_POST['datestart'])) {
      $error = true;
      $_SESSION['error'][] = 'Date is required.';
    } else {
      $datestart = $_POST['datestart'];
    }

    if (empty($_POST['dateend'])) {
      $error = true;
      $_SESSION['error'][] = 'Date is required.';
    } else {
      $dateend = $_POST['dateend'];
    }

  $status = 'on going';
  $result = $conn->prepare("INSERT INTO project(name, description, location, datestart, dateend, status, owner, timestamp) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
  $result->bind_param("ssssssis", $projectname, $projectdescription, $projectlocation, $datestart, $dateend, $status, $userid, $timestamp);
  $result->execute();
  $result->close();

  $result2 = mysqli_query($conn, "SELECT * FROM project where `name` = '$projectname'");
  $row = mysqli_fetch_assoc($result2);
  $projID = $row['id'];
  $role = 'project manager';

  if (!empty($_POST["projectteam"])){
    $numberteam = count($_POST["projectteam"]);
    for($i=0; $i<$numberteam; $i++) {
      if(trim($_POST["projectteam"][$i] != '')) {
        $teams = $_POST["projectteam"][$i];
        $result = $conn->prepare("INSERT INTO projectteams(projectID, teamID) VALUES(?, ?)");
        $result->bind_param("ii", $projID, $teams);
        $result->execute();
        $result->close();

        $result3 = mysqli_query($conn, "SELECT * FROM teammembers where `teamID` = '$teams'");
        while ($row1 = mysqli_fetch_array($result3)) {
          $teamusers = $row1['userID'];
          $result = $conn->prepare("INSERT INTO projectmembers(projectID, userID) VALUES(?, ?)");
          $result->bind_param("ii", $projID, $teamusers);
          $result->execute();
          $result->close();
        }
      }
    }

    $sql = $conn->prepare("UPDATE projectmembers SET role = ? where userID = ? and projectID = ?");
    $sql->bind_param("sii", $role, $userid, $projID,);
    $sql->execute();
    $sql->close();

  } else {
    $sql = $conn->prepare("INSERT INTO projectmembers(projectID, userID, role) VALUES(?, ?, ?)");
    $sql->bind_param("iis", $projID, $userid, $role,);
    $sql->execute();
    $sql->close();

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
            <h1>Create Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="createproject.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="projectname">Project Name</label>
                    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                    <input type="text" class="form-control" id="projectname" name="projectname" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="projectdescription">Description</label>
                    <input type="text" class="form-control" id="projectdescription" name="projectdescription" placeholder="Enter Description">
                  </div>
                  <div class="form-group">
                    <label for="projectdescription">Location</label>
                    <input type="text" class="form-control" id="projectlocation" name="projectlocation" placeholder="Enter Location">
                  </div>
                  <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Date Start</label>
                      <input type="date" class="form-control" id="datestart" name="datestart">
                    </div></div>
                    <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Date End</label>
                      <input type="date" class="form-control" id="dateend" name="dateend">
                    </div></div>
                  </div>
                    <div class="form-group">
                      <label>Select Teams</label>
                      <select name="projectteam[]" class="select2" multiple="multiple" data-placeholder="Select Team" style="width: 100%;">
                        <?php $team = mysqli_query($conn, "SELECT * from team");?>
                        <?php foreach($team as $teamID): ?>
                          <option value="<?= $teamID['id']; ?>"><?= ucfirst($teamID['name']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="createproject">Submit</button>
                </div>
              </form>
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
