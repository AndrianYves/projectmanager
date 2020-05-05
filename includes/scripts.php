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
      <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

<script src="plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  $(function() {  
    <?php
     if(isset($_SESSION['success'])){
      echo "toastr.success('".$_SESSION['success']." ')";
        unset($_SESSION['success']);
      }

    ?>  
  });

</script>
<?php
  if(isset($_SESSION['error'])){
    foreach($_SESSION['error'] as $error) {
      echo "<script type='text/javascript'>
              $(function() { 
             toastr.error('".$error."');});</script>";
      }
    unset($_SESSION['error']);
  }
?> 

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>