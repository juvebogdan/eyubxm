<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/header');?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">OPTIONS</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-clock-o"></i> <span>Overtime</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>">Overtime Day</a></li>
            <li><a href="<?php echo base_url()?>managers/overtimenight">Overtime Night</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url()?>managers/overview"><i class="fa fa-users"></i> <span>Overview</span></a></li>
        <li class='active'><a href="<?php echo base_url()?>managers/vacation"><i class="fa fa-calendar-o"></i> <span>Vacation</span></a></li>
        <li><a href="<?php echo base_url()?>managers/sickleave"><i class="fa fa-heartbeat"></i> <span>Sick Leave</span></a></li> 
        <li><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a>
        <li><a href="<?php echo base_url()?>managers/tasks"><i class="fa fa-tasks"></i> <span>Submit Task</span></a></li>
        <li><a href="<?php echo base_url()?>managers/taskoverview"><i class="fa fa-desktop"></i> <span>Task Overview</span></a></li>
        <li><a href="<?php echo base_url()?>managers/kilometraza"><i class="fa fa-dashboard"></i> <span>Pregled kilometraze</span></a></li> 
        <li><a href="<?php echo base_url()?>managers/carproblems"><i class="fa fa-legal"></i> <span>Problemi sa vozilima</span></a></li> 
		<li><a href="<?php echo base_url()?>managers/cars"><i class="fa fa-car"></i> <span>Spisak vozila</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vacation
        <small>Pending vacation periods</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
  <div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid box-primary">
        <div class="box-header">
              <h3 class="box-title">Vacation</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Signum</th>
                      <th class="text-center">Working Days</th>
                      <th class="text-center">Vacation Type</th>
                      <th class="text-center">Period</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($vacation_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->workdays ?></td>
                      <?php if($row->vacationtype == "SD"):?>
                      <td class="text-center">Slobodni dani</td>
                      <?php elseif($row->vacationtype == "GT"):?>
                      <td class="text-center">Godisnji odmor</td>
                      <?php elseif($row->vacationtype == "GP"):?>
                      <td class="text-center">Godisnji odmor proslogodisnji</td>                      
                      <?php endif;?>                      
                      <td class="text-center"><?php echo $row->start_date . " - " . $row->end_date ?></td>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
                      <td class="text-center"><button class="btn btn-info btn-sm vacationedit" id="<?php echo $row->id ?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
                    </tr>
                  <?php endforeach;?>
                    </tbody>                  
              </table>
            </div>
        </div>
        </div> 
      </div> 
    </div>
  </div>
    <div class="modal modal-primary fade" id='modal'>
      <div class="modal-dialog">
        <div class="modal-content" id="modalcontent">

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

 <?php $this->load->view('footer/footer.php'); ?>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>dist/js/app.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>plugins/select2/select2.full.min.js"></script>
<!-- Pace Options -->
  <script>
    paceOptions = {
      restartOnRequestAfter: false,
      startOnPageLoad : false,
    }
  </script>
<script src="<?php echo base_url(); ?>plugins/pace/pace.min.js"></script>
<!-- page script -->
<script>
var table;
  $(function () {
    $('#overtimetable').DataTable({
      "paging": true,
      "pageLength": 3,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "bDestroy": true
    });
  });
  (function(){
    var myDiv = document.getElementById("overlay"),

      show = function(){
        setTimeout(hide, 1500); // 5 seconds
      },

      hide = function(){
        myDiv.style.display = "none";
      };

    show();
  })();
    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',
        }
    });
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
    $('body').on('click', 'button.vacationedit', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/vacationmodal/' + id,
            method: "post",
            dataType: 'json',
            success: function(result){        
              $('#modalcontent').html(result.result);                                               
              $('#modal').modal('show');
              console.log(result);
            }
        });
      });
    });

    $('body').on('click', 'button.vacationapprove', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/vacationapprove',
            data: $('#overtimeeditform').serialize(),
            method: "post",
            dataType: 'json',
            beforeSend: function() {
              $('.vacationedit').prop('disabled',true);
            },            
            success: function(result){        
              $("#overtimetable").dataTable().fnDestroy();
              $('#mymodal').prepend(result.message);
              $('#overtimetable').html(result.table);
              reinitializeTable();
              $('.vacationedit').prop('disabled',false);
            }
        });
      });
    });

    $('body').on('click', 'button.vacationdecline', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/vacationdecline',
            method: "post",
            data: $('#overtimeeditform').serialize(),
            dataType: 'json',
            beforeSend: function() {
              $('.vacationedit').prop('disabled',true);
            },            
            success: function(result){        
              $("#overtimeltable").dataTable().fnDestroy();
              $('#mymodal').prepend(result.message);
              $('#overtimetable').html(result.table);
              reinitializeTable();
              $('.vacationedit').prop('disabled',false);
              //console.log(result);
            }
        });
      });
    });
    function reinitializeTable() {
        $('#overtimetable').DataTable({
          "paging": true,
          "pageLength": 3,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "bDestroy": true
        });
    }

    $('#addfiles').on('click',function(e) {
        e.preventDefault();
        addFileInput();
    });

    function addFileInput() {
      var html = '';
      html += '<div class="alert alert-info">';
      html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      html += '<strong>Upload file</strong>';
      html += '<input type="file" name="multipleFiles[]">';
      html += '</div>';
      $('#filesarea').append(html);
    }  
</script>
</body>
</html>
