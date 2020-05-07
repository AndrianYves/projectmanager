<?php include 'includes/conn.php'; ?>
<?php
  session_start();
  $sql = mysqli_query($conn,"DELETE FROM projectmembers WHERE userID=".$_GET['id']."");
  $_SESSION['success'] = 'Member Removed';
  header('location: projectviewmembers.php');
?>