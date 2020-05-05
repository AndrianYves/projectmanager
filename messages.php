<?php 
  include 'includes/session.php';
  include 'includes/header.php'; 
  $current = "messages";
?>
<body class="hold-transition sidebar-mini layout-fixed">
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
  <?php include 'includes/navbar.php'; ?>

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

  <?php include 'includes/scripts.php'; ?>
</body>
</html>
