<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/header'); ?>
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
        <li class="active"><a href="<?php echo base_url()?>managers/overview"><i class="fa fa-users"></i> <span>Overview</span></a></li>
        <li><a href="<?php echo base_url()?>managers/vacation"><i class="fa fa-calendar-o"></i> <span>Vacation</span></a></li>
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
        <small>All approved overtime work</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
  <div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid box-primary">
        <div class="box-header finda">
            <select id='overtimeperiod' name="overtimeperiod" style='color: black;padding: 5px;'>
              <option></option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
              <a class="btn btn-success btn-sm exportdata pull-right" href="<?php echo base_url();?>managers/export/<?php echo date('m')?>"><span class="glyphicon glyphicon-download-alt"></span> Export to Excel</a>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Signum</th>
                      <th class="text-center">Overtime Hours</th>
                      <th class="text-center">Ticket Number</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Overtime Type</th>
                      <th class="text-center">Comment</th>
                      <th class="text-center">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($overtime_table_day as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->number ?></td>
                      <td class="text-center"><?php echo $row->ticket_number ?></td>
                      <td class="text-center"><?php echo $row->description ?></td>
                      <td class="text-center"><?php echo $row->date ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> Approved</small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Declined</small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->overtime_type ?></td>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <td class="text-center">Overtime Day</td>
                    </tr>
                  <?php endforeach;?>
                  <?php foreach($overtime_table_night as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->number ?></td>
                      <td class="text-center"><?php echo $row->ticket_number ?></td>
                      <td class="text-center"><?php echo $row->description ?></td>
                      <td class="text-center"><?php echo $row->date ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> Approved</small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Declined</small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->overtime_type ?></td>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <td class="text-center">Overtime Night</td>
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
<!-- page script -->
<script>
var table;
var baseurl = '<?php echo base_url();?>';
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
      function reinitializeTable() {
      $('#overtimetable').DataTable({
        "paging": true,
        "pageLength": 10,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "bDestroy": true,      
      });
    }
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

$('#overtimeperiod').on('change', function() {
      var formData = new FormData();
      formData.append('period',$( "#overtimeperiod option:selected" ).val());
      $(".exportdata").attr("href", baseurl + 'managers/export/' + $( "#overtimeperiod option:selected" ).val());
      $.ajax({         
        type: 'POST',
        url: '<?php echo base_url(); ?>managers/populateoverview',
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(result){ 
          $("#overtimetable").dataTable().fnDestroy();
          $('#overtimetable').html(result.table);
          reinitializeTable();
          $('.ajax').prop('disabled',false);          
        }
      });
});


</script>
</body>
</html>
