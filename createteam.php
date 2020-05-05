<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "teams";

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
    
    if (empty($_POST['teamname'])) {
      $error = true;
      $_SESSION['error'][] = 'Name is required.';
    } else {
      $teamname = strtolower($_POST['teamname']);
    }

  $sql = $conn->prepare("INSERT INTO team(name) VALUES(?)");
  $sql->bind_param("s", $teamname);
  $sql->execute();
  $sql->close();

  $result = mysqli_query($conn, "SELECT * FROM team where `name` = '$teamname'");
  $row = mysqli_fetch_assoc($result);
  $teamID = $row['id'];

  if (!empty($_POST["teammember"])){
    $numberteam = count($_POST["teammember"]);
    for($i=0; $i<$numberteam; $i++) {
      if(trim($_POST["teammember"][$i] != '')) {
        $teams = $_POST["teammember"][$i];
        $result = $conn->prepare("INSERT INTO teammembers(teamID, userID) VALUES(?, ?)");
        $result->bind_param("ii", $teamID, $teams);
        $result->execute();
        $result->close();
      }
    }
  }

  $result = $conn->prepare("INSERT INTO teammembers(teamID, userID) VALUES(?, ?)");
  $result->bind_param("ii", $teamID, $userid);
  $result->execute();
  $result->close();

  if(!$error){
    mysqli_commit($conn);
    $_SESSION['success'] = 'Team Created';
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
            <h1>Create Team</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Team</li>
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
              <form class="form-horizontal" action="createteam.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="projectname">Team Name</label>
                    <input type="hidden" class="form-control" id="userid" name="userid" value="<?php echo $id; ?>">
                    <input type="text" class="form-control" id="teamname" name="teamname" placeholder="Enter Name">
                  </div>
                    <div class="form-group">
                      <label>Select a Member</label>
                      <select name="teammember[]" class="select2" multiple="multiple" data-placeholder="Select Team" style="width: 100%;">
                        <?php $member = mysqli_query($conn, "SELECT * from users where id != '$id' order by lastname");?>
                        <?php foreach($member as $userID): ?>
                          <option value="<?= $userID['id']; ?>"><?= ucfirst($userID['firstname']); ?> <?= ucfirst($userID['lastname']); ?></option>
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
