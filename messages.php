<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "messages";
?>
<style type="text/css">
.modal-edbackdrop
{
    opacity:0.9 !important;
}

</style>
<body class="sidebar-mini layout-fixed hold-transition" style="height: auto;">
<div class="wrapper">
<?php 
if(isset($_POST['sendmessage'])){ 
  $sendto = $_POST['contactID'];
  $message = $_POST["send"];
  $timestamp = date("Y-m-d H:i:s");

  $sql = "INSERT INTO messages(sendto, message, timestamp) VALUES('$sendto', '$message', '$timestamp')";   
  mysqli_query($conn, $sql);
}

if(isset($_POST['createmessage'])){ 
  $contact = $_POST['contact'];
  $message = $_POST["message"];
  $timestamp = date("Y-m-d H:i:s");

  $sql = "INSERT INTO messages(sendto, message, timestamp) VALUES('$contact', '$message', '$timestamp')";   
  mysqli_query($conn, $sql);
}

if(isset($_POST['createcontact'])){ 
  $name = $_POST['name'];
  $address = $_POST["address"];
  $number = $_POST["number"];
  $image = $_FILES['image']['name'];
  move_uploaded_file($_FILES["image"]["tmp_name"],"dist/img/".$_FILES["image"]["name"]);

  $sql = "INSERT INTO contacts(name, number, address, image) VALUES('$name', '$number', '$address', '$image')";   
    mysqli_query($conn, $sql);
}

if(isset($_POST['endcall'])){ 
  $callid = $_POST['contactID'];
  $minute = $_POST["minute"] - 3;
  $timestamp = date("Y-m-d H:i:s");

  $sql = "INSERT INTO logs(sendto, duration, timestamp) VALUES('$callid', '$minute', '$timestamp')";  
      mysqli_query($conn, $sql); 

}
?>
<?php


 $id = $_GET['id'];
 if(empty($id)){
  $id = $_POST['contactID'];
 }

  $sql = mysqli_query($conn, "SELECT * FROM contacts where id = '$id'");

    while($row = mysqli_fetch_array($sql)){
    $name = $row['name'];
    }

 ?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="nav-icon fas fa-sign-out-alt"></i> Sign-out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Project Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $user['firstname']. ' '.$user['lastname']; ?></a>
        </div>
      </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <div class="row"><h6>
            <div class="col-4">
          <a href="#" class="d-block" data-toggle="modal" data-target="#message">Create Message</a>
        </div>
        <div class="col-4">
          <a href="#" class="d-block" data-toggle="modal" data-target="#contact"> Add Contact</a>
        </div>
       <div class="col-4">
          <a href="#" class="d-block" data-toggle="modal" data-target="#calls"> Call Logs</a>
        </div></h6>
      </div>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
            $sql = mysqli_query($conn, "SELECT * from contacts");
            while ($row = mysqli_fetch_array($sql)) {
          ?>

          <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="dist/img/<?php echo $row['image'];?>" class="img-circle">
              </div>
              <div class="info">
                <a href='messages.php?id=<?php echo $row['id']; ?>' class="d-block"><?php echo ucwords($row['name']);?></i></a>
              </div>
            </div>
          </li>
        <?php }?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo ucwords($name);?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">


            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-prirary cardutline direct-chat direct-chat-primary">

              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages"  style="height: 350px;">

                  <!-- Message. Default to the left -->
<!--                   <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-timestamp float-right">23 Jan 2:05 pm</span>
                    </div>
      
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>

                  </div> -->
                  <!-- /.direct-chat-msg -->
                  <?php
  $query = mysqli_query($conn, "SELECT * FROM messages where sendto = '$id'");

    while($row1 = mysqli_fetch_array($query)){?>
                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-timestamp float-left"><?php echo date("d M g:i A", strtotime($row1['timestamp']));?>
                    </div>
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo ucfirst($row1['message']);?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                          <?php } ?>
                </div>
                <!--/.direct-chat-messages-->

                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
            </div>
            <!--/.direct-chat -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<footer class="main-footer">
  <form action="index.php" method="post">
    <div class="input-group">
    <input type="text" name="send" placeholder="Type Message ..." class="form-control">
    <input type="hidden" name="contactID" value="<?php echo $id;?>" class="form-control">
    <span class="input-group-append">
    <button type="submit" class="btn btn-primary" name="sendmessage">Send</button>
    </form>
    </span>
    <a class="btn btn-success text-white" onclick="startWatch()" value="START" data-toggle="modal" data-target="#call">Call</a>
    
  </div>       
</footer>

</div>
<!-- ./wrapper -->
    <div class="modal fade" id="call" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Calling...</h4>

            </div>
            <div class="modal-body">
                <div class="card-body text-center">
                    <form action="index.php" method="post">
                                    <?php
                  $contactquery = mysqli_query($conn, "SELECT * FROM contacts where id = '$id'");

                  while($row1 = mysqli_fetch_array($contactquery)){?>
                    <img src="dist/img/<?php echo $row1['image'];?>" alt="" class="img-circle img-fluid text-center">

                  <?php } ?>

                <div id="res"><span id="min">0</span> : <span id="sec">00</span> : <span id="msec">000</span></div>
                <input type="text" name="contactID" value="<?php echo $id;?>" class="form-control" hidden>
                <input id="minute" type="number" name="minute" class="form-control" hidden>

                
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-center">
              <button type="submit" onclick="stopWatch()" class="btn btn-danger" name="endcall">End Call</button>
</form>
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <div class="modal fade" id="message">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="index.php" method="post">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="contact">
                        <option disabled selected>Select contact</option>
                        <?php $contact = mysqli_query($conn, "SELECT * from contacts");?>
                        <?php foreach($contact as $person): ?>
                          <option value="<?= $person['id']; ?>"><?= ucwords($person['name']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Message</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" placeholder="Enter message..." name="message"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" name="createmessage">Send</button>
            </form>
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="contact">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Contact</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                  <form action="index.php" method="post" enctype="multipart/form-data">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Contact Number</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" placeholder="Contact Number" name="number">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Image</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="createcontact" class="btn btn-primary">Add Contact</button>
            </div>
           </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="calls">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Call Logs</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
<div class="direct-chat-messages">
 <?php
  $sql3 = mysqli_query($conn, "SELECT * FROM logs join contacts on logs.sendto = contacts.id");

    while($row = mysqli_fetch_array($sql3)){?>

                            <!-- Message. Default to the left -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name"><?php echo ucwords($row['name']);?></span>
                          <span class="direct-chat-timestamp"><?php echo $row['duration'];?> seconds</span>
                          <span class="direct-chat-timestamp"><?php echo date("d M g:i A", strtotime($row['timestamp']));?></span>
                        </div>

                      </div>
                      <!-- /.direct-chat-msg -->

                          <?php } ?>



                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

 <script type="text/javascript">
    var timer = null;
    var min_txt = document.getElementById("min");
    var min = Number(min_txt.innerHTML);
    var sec_txt = document.getElementById("sec");
    var sec = Number(sec_txt.innerHTML);
    var msec_txt = document.getElementById("msec"); 
    var msec = Number(msec_txt.innerHTML);

   
    function stopTimeMilliseconds(timer) {
        if (timer) { 
            clearInterval(timer);
            return timer;
        }
        else return timer;
    }
    function startTimeMilliseconds() {
        var currDate = new Date();
        return currDate.getTime();  
    }
    function getElapsedTimeMilliseconds(startMilliseconds) {
        if (startMilliseconds > 0) {
            var currDate = new Date();
            elapsedMilliseconds = (currDate.getTime() - startMilliseconds);
            return elapsedMilliseconds;
        }
     else {
        return elapsedMilliseconds = 0;
        }
    }
    function startWatch() { 
        // START TIMER
        timer = stopTimeMilliseconds(timer); 
        var startMilliseconds = startTimeMilliseconds();
        timer = setInterval(function() { 
            var elapsedMilliseconds = getElapsedTimeMilliseconds(startMilliseconds); 
            if (msec < 10) {
                msec_txt.innerHTML = "00" + msec; 
            }
            else if (msec < 100) {
                msec_txt.innerHTML = "0" + msec;
            }
            else {
                msec_txt.innerHTML = msec;
            }
            if (sec < 10) {
                sec_txt.innerHTML = "0" + sec;
            }
            else {
                sec_txt.innerHTML = sec; 
            }
            min_txt.innerHTML = min; 
            msec = elapsedMilliseconds;
            if (min >= 59 && sec >=59 && msec > 900) {
                timer = stopTimeMilliseconds(timer);
                return true;
            }
            if (sec > 59) {
                sec = 0;
                min++;
            }
            if (msec > 999) {
                msec = 0;
                sec++;
                startWatch();
            }
        }, 10);
                    var call = (timer);
    $('#minute').val(parseFloat(call));


    }
    function stopWatch() {
        // STOP TIMER
        timer = stopTimeMilliseconds(timer);

        return true;
    }
    function resetWatch() {
        // REZERO TIMER
        timer = stopTimeMilliseconds(timer);
        msec_txt.innerHTML = "000"; 
        msec = 0;
        sec_txt.innerHTML = "00"; 
        sec = 0;
        min_txt.innerHTML = "0"; 
        min = 0;
        return true;
    }
</script>

</body>
</html>
