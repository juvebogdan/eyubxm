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
        <li><a href="<?php echo base_url()?>bxmtime/vacation"><i class="fa fa-calendar-o"></i> <span>Vacation</span></a></li>
        <li><a href="<?php echo base_url()?>managers/sickleave"><i class="fa fa-heartbeat"></i> <span>Sick Leave</span></a></li>
        <li><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a></li>
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
        <small>Karnet <?php echo date('F Y'); ?></small>
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
              <h3 class="box-title">Payroll for <?php echo date('F Y'); ?></h3>
              <a class="btn btn-success btn-sm exportdata pull-right" href="<?php echo base_url();?>managers/export"><span class="glyphicon glyphicon-download-alt"></span> Export to Excel</a>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Naziv</th>
                      <th class="text-center">Redovan rad</th>
                      <th class="text-center">Nocni rad</th>
                      <th class="text-center">Prinudni odmor</th>
                      <th class="text-center">Prekovremeno dan</th>
                      <th class="text-center">Prekovremeno noc</th>
                      <th class="text-center">Rad praznik</th>
                      <th class="text-center">Odmor</th>
                      <th class="text-center">Drzavni praznik</th>
                      <th class="text-center">Placeni odmor</th>
                      <th class="text-center">Trudnicko bolovanje</th>
                      <th class="text-center">Bolovanje do 70</th>
                      <th class="text-center">Bolovanje do 80</th>
                      <th class="text-center">Bolovanje do 90</th>
                      <th class="text-center">Bolovanje do 100</th>
                      <th class="text-center">Porodiljsko</th>
                      <th class="text-center">Bolovanje preko 70</th>
                      <th class="text-center">Bolovanje preko 100</th>
                      <th class="text-center">Vjerski praznik</th>
                      <th class="text-center">Rad vjerski</th>
                      <th class="text-center">Korekcija</th>
                      <th class="text-center">Stimulacija</th>
                      <th class="text-center">Destimulacija</th>
                      <th class="text-center">Prevoz</th>
                      <th class="text-center">Nocni praznik</th>
                      <th class="text-center">Prekovremeno praznik</th>
                      <th class="text-center">Prekovremeno praznik nocni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($karnet_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->Naziv ?></td>
                      <td class="text-center"><?php echo $row->redovan_rad ?></td>
                      <td class="text-center"><?php echo $row->nocni_rad ?></td>
                      <td class="text-center"><?php echo $row->prinudni ?></td>
                      <td class="text-center"><?php echo $row->prekovremeno_dan ?></td>
                      <td class="text-center"><?php echo $row->prekovremeno_noc ?></td>
                      <td class="text-center"><?php echo $row->rad_praznik ?></td>
                      <td class="text-center"><?php echo $row->odmor ?></td>
                      <td class="text-center"><?php echo $row->drzavni_praznik ?></td>
                      <td class="text-center"><?php echo $row->placeno ?></td>
                      <td class="text-center"><?php echo $row->trudnicko ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_do_70 ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_do_80 ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_do_90 ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_do_100 ?></td>
                      <td class="text-center"><?php echo $row->porodiljsko ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_preko_70 ?></td>
                      <td class="text-center"><?php echo $row->bolovanje_preko_100 ?></td>
                      <td class="text-center"><?php echo $row->vjerski_praznik ?></td>
                      <td class="text-center"><?php echo $row->rad_vjerski ?></td>
                      <td class="text-center"><?php echo $row->korekcija ?></td>
                      <td class="text-center"><?php echo $row->stimulacija ?></td>
                      <td class="text-center"><?php echo $row->destimulacija ?></td>
                      <td class="text-center"><?php echo $row->prevoz ?></td>
                      <td class="text-center"><?php echo $row->nocni_praznik ?></td>
                      <td class="text-center"><?php echo $row->prekovremeno_praznik ?></td>
                      <td class="text-center"><?php echo $row->prekovremeno_praznik_nocni ?></td>
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
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    //Datemask2 mm/dd/yyyy
    $("#datepicker").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); }); 
  $(document).on('click','.exportdata', function(e) { Pace.restart(); });       

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