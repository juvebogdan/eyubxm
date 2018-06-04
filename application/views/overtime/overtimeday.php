<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/header');?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo $this->lang->line('OPTIONS') ?></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview active">
          <a href="#"><i class="fa fa-clock-o"></i> <span><?php echo $this->lang->line('Overtime') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>"><?php echo $this->lang->line('Overtime Day') ?></a></li>
            <li><a href="<?php echo base_url()?>bxmtime/overtimenight"><?php echo $this->lang->line('Overtime Night') ?></a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url()?>bxmtime/overview"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('Overview') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/vacation"><i class="fa fa-calendar-o"></i> <span><?php echo $this->lang->line('Vacation') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/sickleave"><i class="fa fa-heartbeat"></i> <span><?php echo $this->lang->line('Sick leave') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/taskoverview"><i class="fa fa-desktop"></i> <span><?php echo $this->lang->line('Task Overview') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/cars"><i class="fa fa-car"></i> <span>Dodavanje vozila</span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/kilometraza"><i class="fa fa-dashboard"></i> <span>Kilometraza</span></a></li>         
        <li><a href="<?php echo base_url()?>bxmtime/carproblems"><i class="fa fa-legal"></i> <span>Problemi sa vozilima</span></a></li>                       
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
        <?php echo $this->lang->line('Overtime Day') ?>
        <small><?php echo $this->lang->line('Submit daily overtime work') ?></small>
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
            <h3 class="box-title"><?php echo $this->lang->line('Overtime Day') ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo form_open('', 'class="form-horizontal" id="overtime"'); ?>
            <div class="box-body" id="inputform">
              <div class="row">
                <div class="col-md-6">
                  <label><?php echo $this->lang->line('Hours') ?>:</label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hourglass"></i></span>
                  <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('Number of overtime hours') ?>" name="overtime">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <label><?php echo $this->lang->line('Date') ?>:</label>
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
                  <label><?php echo $this->lang->line('Ticket Number') ?>:</label>
                  <input type="text" name="ticket" class="form-control" placeholder="<?php echo $this->lang->line('Ticket Number') ?>">
                </div>            
              </div>
              <div class="row">
                <div class="col-md-12">
                    <label><?php echo $this->lang->line('Description') ?></label>
                    <textarea class="form-control" name="description" rows="10" placeholder="<?php echo $this->lang->line('Short description optional') ?>"></textarea>
                </div>              
              </div>              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <button type="submit" class="btn btn-default"><?php echo $this->lang->line('Cancel') ?></button>
            <button type="button" class="btn btn-primary btn-lrg ajax pull-right" title="Ajax Request">
              <i class="fa fa-sign-in"></i>&nbsp; <?php echo $this->lang->line('Submit') ?>
            </button>
            </div>
            <!-- /.box-footer -->
          <?php echo form_close(); ?>
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid box-primary">
        <div class="box-header">
              <h3 class="box-title"><?php echo $this->lang->line('Overtime for') ?> <?php echo date('F Y'); ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Signum</th>
                      <th class="text-center"><?php echo $this->lang->line('Overtime Hours') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Ticket Number') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Description') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Date') ?></th>
                      <th class="text-center">Status</th>
                      <th class="text-center"><?php echo $this->lang->line('Comment') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($overtime_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->number ?></td>
                      <td class="text-center"><?php echo $row->ticket_number ?></td>
                      <td class="text-center"><?php echo $row->description ?></td>
                      <td class="text-center"><?php echo $row->date ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><a href="<?php echo base_url('bxmtime/delete/'. $row->id . '/' . $row->identifier);?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>
                      <?php else:?>
                      <td class="text-center"><a href="<?php echo base_url('bxmtime/delete/'. $row->id . '/' . $row->identifier);?>" class="btn btn-danger btn-sm disabled"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>                        
                      <?php endif;?>
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
      "pageLength": 6,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "bDestroy": true,
      "language": {
        "paginate": {
          "previous": "<?php echo $this->lang->line('Previous') ?>",
          "next": "<?php echo $this->lang->line('Next') ?>"
        }
      }      
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
    $('.ajax').click(function(){
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/addovertime/overtimeday',
            method: "post",
            data: $('#overtime').serialize(),
            dataType: 'json',
            beforeSend: function() {
              $('#successalert').remove();
              $('.ajax').prop('disabled',true);
            },
            success: function(result){        
              if ($('#successalert').length == 0) {
                $("#overtimetable").dataTable().fnDestroy();
                $('#inputform').prepend(result.message);
                $('#overtimetable').html(result.table);
                reinitializeTable();
                $('.ajax').prop('disabled',false);
                //console.log(result);
              }
              
            }
        });
      });

    });
    function reinitializeTable() {
      $('#overtimetable').DataTable({
        "paging": true,
        "pageLength": 6,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "bDestroy": true,
        "language": {
          "paginate": {
            "previous": "<?php echo $this->lang->line('Previous') ?>",
            "next": "<?php echo $this->lang->line('Next') ?>"
          }
        }      
      });
    }  
</script>
</body>
</html>
