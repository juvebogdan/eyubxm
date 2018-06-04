<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/header'); ?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo $this->lang->line('OPTIONS') ?></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
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
        <li class='active'><a href="<?php echo base_url()?>bxmtime/overview"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('Overview') ?></span></a></li>
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
        <?php echo $this->lang->line('Overview') ?>
        <small><?php echo $this->lang->line('All approved overtime work') ?></small>
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
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <td class="text-center"><?php echo $this->lang->line('Overtime Day') ?></td>
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
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <td class="text-center"><?php echo $this->lang->line('Overtime Night') ?></td>
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
</script>
</body>
</html>
