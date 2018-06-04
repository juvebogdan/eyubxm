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
        <li><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a>
        <li class='active'><a href="<?php echo base_url()?>managers/tasks"><i class="fa fa-tasks"></i> <span>Submit Task</span></a></li>
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
        Submit Task
        <small>Submit a task</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
  <div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Task</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo form_open('', 'class="form-horizontal" id="task"'); ?>
            <div class="box-body" id="inputform">
              <div class="row">
                <div class="col-md-6">
                  <label>Task Subject:</label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <input type="text" class="form-control" placeholder="Subject" name="subject">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <label>Deadline:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date" class="form-control pull-right" id="datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-md-6 -->
              </div>
              <div class="row">
                <div class="col-md-12">
                      <label>Assign to:</label>
                      <select class="form-control select2" name="assignemployee" style="width: 100%;">
                          <?php foreach($employees as $row):?>
                            <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                          <?php endforeach;?>
                      </select>                
                </div>              
              </div>
              <div class="row">
                <div class="col-md-12">
                    <label>Task Description</label>
                    <textarea class="form-control" name="description" rows="6" placeholder="Description"></textarea>
                </div>              
              </div>              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <button type="submit" class="btn btn-default">Cancel</button>
            <button type="button" class="btn btn-primary btn-lrg ajax pull-right" title="Ajax Request">
              <i class="fa fa-sign-in"></i>&nbsp; Submit
            </button>
            </div>
            <!-- /.box-footer -->
          <?php echo form_close(); ?>
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
    $('.ajax').click(function(){
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>managers/addtask',
            method: "post",
            data: $('#task').serialize(),
            dataType: 'json',
            beforeSend: function() {
              $('#successalert').remove();
              $('.ajax').prop('disabled',true);
            },
            success: function(result){        
              if ($('#successalert').length == 0) {
                $('#inputform').prepend(result.message);
                $('.ajax').prop('disabled',false);
                //console.log(result);
              }
              
            }
        });
      });

    }); 
</script>
</body>
</html>
