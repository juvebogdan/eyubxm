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
        <li><a href="<?php echo base_url()?>managers/overview"><i class="fa fa-users"></i> <span>Overview</span></a></li>
        <li><a href="<?php echo base_url()?>managers/vacation"><i class="fa fa-calendar-o"></i> <span>Vacation</span></a></li>
        <li><a href="<?php echo base_url()?>managers/sickleave"><i class="fa fa-heartbeat"></i> <span>Sick Leave</span></a></li> 
        <li><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a>
        <li><a href="<?php echo base_url()?>managers/tasks"><i class="fa fa-tasks"></i> <span>Submit Task</span></a></li>
        <li class="active"><a href="<?php echo base_url()?>managers/taskoverview"><i class="fa fa-desktop"></i> <span>Task Overview</span></a></li>
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
        Task Overview
        <small>All active tasks</small>
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
              <h3 class="box-title">Active tasks</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="tasktable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Subject</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Assigned to</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Deadline</th>
                      <th class="text-center">Created</th>
                      <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($tasks as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->subject ?></td>
                      <td class="text-center"><?php echo $row->description ?></td>
                      <td class="text-center"><?php echo $row->assignedto ?></td>
                      <?php if(date_diff($today,DateTime::createFromFormat('Y-m-d', $row->deadline))->invert == 1):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Overdue</small></td> 
                      <?php else:?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->deadline ?></td>
                      <td class="text-center"><?php echo $row->datum ?></td>
                      <td class="text-center"><button class="btn btn-info btn-sm taskedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>                      
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
<!-- page script -->
<!-- Pace Options -->
  <script>
    paceOptions = {
      restartOnRequestAfter: false,
      startOnPageLoad : false,
    }
  </script>
<script src="<?php echo base_url(); ?>plugins/pace/pace.min.js"></script>
<script>
var table;
  $(function () {
    $('#tasktable').DataTable({
      "paging": true,
      "pageLength": 15,
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

  $(document).ajaxStart(function() { Pace.restart(); });

    $('body').on('click', 'button.taskedit', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/taskmodal/' + id,
            method: "post",
            dataType: 'json',
            success: function(result){        
              $('#modalcontent').html(result.result);                                               
              $('#modal').modal('show');
              //console.log(result);
            }
        });
      });
    });

    $('body').on('click', 'button.tasksolve', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/tasksolve',
            data: $('#taskeditform').serialize(),
            method: "post",
            dataType: 'json',
            beforeSend: function() {
              $('.tasksolve').prop('disabled',true);
            },             
            success: function(result){        
              $("#tasktable").dataTable().fnDestroy();
              $('#mymodal').prepend(result.message);
              $('#tasktable').html(result.table);
              reinitializeTable();
              $('.tasksolve').prop('disabled',false);
            }
        });
      });
    });
    function reinitializeTable() {
        $('#tasktable').DataTable({
          "paging": true,
          "pageLength": 15,
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
