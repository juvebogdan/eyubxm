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
        <li><a href="<?php echo base_url()?>bxmtime/overview"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('Overview') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/vacation"><i class="fa fa-calendar-o"></i> <span><?php echo $this->lang->line('Vacation') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/sickleave"><i class="fa fa-heartbeat"></i> <span><?php echo $this->lang->line('Sick leave') ?></span></a></li>
        <li class="active"><a href="<?php echo base_url()?>bxmtime/taskoverview"><i class="fa fa-desktop"></i> <span><?php echo $this->lang->line('Task Overview') ?></span></a></li>                       
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
        <?php echo $this->lang->line('Task Overview') ?>
        <small><?php echo $this->lang->line('All active tasks') ?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
  <div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
          <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Select files...</span>
              <!-- The file input field used as target for the file upload widget -->
              <input id="fileupload" type="file" name="files[]" multiple>
          </span>
          <br>
          <br>
          <!-- The global progress bar -->
          <div id="progress" class="progress">
              <div class="progress-bar progress-bar-success"></div>
          </div>
          <!-- The container for the uploaded files -->
          <div id="files" class="files"></div>
          <br>        
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
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>js/jquery.fileupload.js"></script>
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
            url: '<?php echo base_url(); ?>bxmtime/taskmodal/' + id,
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
            url: '<?php echo base_url(); ?>bxmtime/tasksolve',
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
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = "<?php echo base_url(); ?>preventive/upload"
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            console.log(data);
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
</body>
</html>
