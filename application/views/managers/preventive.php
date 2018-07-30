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
        <li><a href="<?php echo base_url()?>managers/overviewdaysoff"><i class="fa fa-paper-plane"></i> <span>Day off status</span></a></li>
        <li><a href="<?php echo base_url()?>managers/tasks"><i class="fa fa-tasks"></i> <span>Submit Task</span></a></li>
        <li><a href="<?php echo base_url()?>managers/taskoverview"><i class="fa fa-desktop"></i> <span>Task Overview</span></a></li>
        <li class='active'><a href="<?php echo base_url()?>managers/preventive/"><i class="fa fa-list-alt"></i> <span>Preventive</span></a></li>
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
        Preventivni pregledi
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
          <label for="tip">Tip:</label>
            <select id='tip' name="tip" style='color: black;padding: 5px;'>
              <option value='all'>All</option>
              <?php foreach($types as $type):?>
                <option value='<?php echo $type->tip ?>'><?php echo $type->tip ?></option>
              <?php endforeach; ?>
            </select>
            <label for="status">Uradjen:</label>
            <select id='status' name="status" style='color: black;padding: 5px;'>
              <option value='all'>All</option>
              <option value="1">Da</option>
              <option value="0">Ne</option>
            </select>
              <a class="btn btn-success btn-sm exportdata pull-right" href="<?php echo base_url();?>managers/exportpreventive/all/all>"><span class="glyphicon glyphicon-download-alt"></span> Export to Excel</a>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="locations" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Sitecode</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Tip</th>
                      <th class="text-center">Provereni Alarmi</th>
                      <th class="text-center">Izmerena Struja</th>
                      <th class="text-center">Vizuelna Provera</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Uradjen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($sites as $row):?>
                      <tr>
                        <td class="text-center"><?php echo $row->sitecode ?></td>
                        <td class="text-center"><?php echo $row->name ?></td>
                        <td class="text-center"><?php echo $row->tip ?></td>
                        <td class="text-center"><?php echo $row->provereni_alarmi ?></td>
                        <td class="text-center"><?php echo $row->izmerena_struja ?></td>
                        <td class="text-center"><?php echo $row->vizuelna_provera ?></td>
                        <td class="text-center"><?php echo $row->status ?></td>
                        <?php if($row->uradjen==0):?>
                        <td class="text-center"><small class="label label-danger">NE</small></td> 
                        <?php else:?>
                        <td class="text-center"><small class="label label-success">DA</small></td>
                        <?php endif;?>                                                 
                      </tr>                    
                    <?php endforeach; ?>
                    </tbody>                  
              </table>
            </div>
        </div>
        </div> 
      </div> 
    </div>
  </div>
   <div class="overlay" id="overlay">
        <i class="fa fa-circle-o-notch fa-spin"></i>
  </div>
</div>
  </section>
  <!-- /.content -->
</div>
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Created by ebogdkr
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>
</div>
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
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>js/jquery.fileupload.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
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
var currentlocation;
var baseurl = '<?php echo base_url();?>';
  $(function () {
    $('#locations').DataTable({
      "paging": true,
      "pageLength": 10,
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
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });

    function reinitializeTable() {
      $('#locations').DataTable({
        "paging": true,
        "pageLength": 10,
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
$('#tip').on('change', function() {
      var formData = new FormData();
      formData.append('tip',$( "#tip option:selected" ).val());
      formData.append('status',$( "#status option:selected" ).val());
      $(".exportdata").attr("href", baseurl + 'managers/exportpreventive/' + $( "#tip option:selected" ).val() + '/' + $( "#status option:selected" ).val());
      $.ajax({         
        type: 'POST',
        url: '<?php echo base_url(); ?>managers/populatepreventive',
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(result){ 
          $("#locations").dataTable().fnDestroy();
          $('#locations').html(result.table);
          reinitializeTable();
          $('.ajax').prop('disabled',false);          
        }
      });
});
$('#status').on('change', function() {
      var formData = new FormData();
      formData.append('tip',$( "#tip option:selected" ).val());
      formData.append('status',$( "#status option:selected" ).val());
      console.log($( "#status option:selected" ).val());
      $(".exportdata").attr("href", baseurl + 'managers/exportpreventive/' + $( "#tip option:selected" ).val() + '/' + $( "#status option:selected" ).val());
      $.ajax({         
        type: 'POST',
        url: '<?php echo base_url(); ?>managers/populatepreventive',
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(result){ 
          $("#locations").dataTable().fnDestroy();
          $('#locations').html(result.table);
          reinitializeTable();
          $('.ajax').prop('disabled',false);          
        }
      });
}); 
</script>
</body>
</html>
