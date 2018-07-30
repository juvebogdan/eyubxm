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
        <li><a href="<?php echo base_url()?>managers/vacation"><i class="fa fa-calendar-o"></i> <span>Vacation</span></a></li>
        <li><a href="<?php echo base_url()?>managers/sickleave"><i class="fa fa-heartbeat"></i> <span>Sick Leave</span></a></li>
        <li class="active"><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a></li>
        <li><a href="<?php echo base_url()?>managers/tasks"><i class="fa fa-tasks"></i> <span>Submit Task</span></a></li>
        <li><a href="<?php echo base_url()?>managers/taskoverview"><i class="fa fa-desktop"></i> <span>Task Overview</span></a></li>
        <li><a href="<?php echo base_url()?>managers/preventive/"><i class="fa fa-list-alt"></i> <span>Preventive</span></a></li>
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
        Overview
        <small>Days off on <?php echo date("Y-m-d"); ?></small>
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
              <h3 class="box-title">Day off status on <?php echo date("Y-m-d"); ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Naziv</th>
                      <th class="text-center">Slobodni dani</th>
                      <th class="text-center">Godisnji odmor trenutni</th>
                      <th class="text-center">Godisnji odmor proslogodisnji</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($employee_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->name ?></td>
                      <td class="text-center"><?php echo $row->SD ?></td>
                      <td class="text-center"><?php echo $row->GT ?></td>
                      <td class="text-center"><?php echo $row->GP ?></td>
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
      "pageLength": 10,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "bDestroy": true
    });
  });
  //Initialize Select2 Elements
  $(".select2").select2();
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
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });       

    function reinitializeTable() {
        $('#overtimetable').DataTable({
          "paging": true,
          "pageLength": 10,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "bDestroy": true
        });
    }  
</script>
</body>
</html>