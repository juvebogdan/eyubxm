<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/header');?>
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
        <li><a href="<?php echo base_url()?>bxmtime/taskoverview"><i class="fa fa-desktop"></i> <span><?php echo $this->lang->line('Task Overview') ?></span></a></li>
        <li class="active"><a href="<?php echo base_url()?>preventive/"><i class="fa fa-list-alt"></i> <span>Preventive</span></a></li>                       
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
        <div class="box-header">
              <h3 class="box-title">Lokacije</h3>
              <input type="text" id="searchbox" class='pull-right' style="color: black;"><label class='pull-right'>Search: </label>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="locations" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Sitecode</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Tip</th>
                      <th class="text-center">Opis</th>
                      <th class="text-center">Uradjen</th>
                      <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($sites as $row):?>
                      <tr>
                        <td class="text-center"><?php echo $row->sitecode ?></td>
                        <td class="text-center"><?php echo $row->name ?></td>
                        <td class="text-center"><?php echo $row->tip ?></td>
                        <td class="text-center"><?php echo $row->opis ?></td>
                        <?php if($row->uradjen==0):?>
                        <td class="text-center"><small class="label label-danger">NE</small></td> 
                        <?php else:?>
                        <td class="text-center"><small class="label label-success">DA</small></td>
                        <?php endif;?>  
                        <?php if($row->uradjen==0):?>
                        <td class="text-center"><button class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
                        <?php else:?>
                        <td class="text-center"><button disabled class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td> 
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

    <div class="modal modal-primary fade" id='modal'>
      <div class="modal-dialog">
        <div class="modal-content" id="modalcontent">

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <div class="alert alert-success alert-flash" role="alert" id='flash' style='display: none;'>
    <strong>Success</strong>
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
  $(function () {
    table = $('#locations').DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": false,
      "searching": true,
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
    $("#searchbox").keyup(function() {
       //table.fnFilter(this.value);
       table.search(this.value).draw();
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

  $('body').on('click', 'button.preventivecancel', function(e) {
    $('#modal').modal('hide');
  }); 

   $('body').on('click', 'button.problemedit', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>preventive/preventivemmodal/' + id,
            method: "post",
            dataType: 'json',
            success: function(result){        
              $('#modalcontent').html(result.result);                                               
              $('#modal').modal('show');
              currentlocation = e.currentTarget.id;
              $(function () {
                  'use strict';
                  var url = "<?php echo base_url(); ?>preventive/upload"
                  $('#fileupload').fileupload({
                      url: url,
                      //dataType: 'json',
                      done: function (e, data) {
                          if (data.result == 'Morate odabrati datum') {
                            $('#files').empty();
                            $.each(data.files, function (index, file) {
                                $('<p/>').text(data.result).appendTo('#files');
                            });
                            $('#progress .progress-bar').css('width',0);
                          }
                          else {
                            $('#files').empty();
                            $('<p/>').text('Success').appendTo('#files');
                            $('.preventivesubmit').prop('disabled', false);
                          }
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
            }
        });
      });
    });

    $('body').on('click', 'button.preventivesubmit', function(e) {
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>preventive/submitpregled/',
            data: $('#preventiveform').serialize(),
            method: "post",
            //dataType: 'json',
            beforeSend: function() {
              $('.preventivesubmit').prop('disabled',true);
            },             
            success: function(result){       
              $("#locations").dataTable().fnDestroy();
              $('#locations').html(result.table);
              reinitializeTable();
              $('.preventivesubmit').prop('disabled',false);
              flash();
            }
        });
      });
    });

    function reinitializeTable() {
      table = $('#locations').DataTable({
        "paging": true,
        "pageLength": 10,
        "lengthChange": false,
        "searching": true,
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
      $('body').on('keyup', '#searchbox', function(e) {table.search(this.value).draw();});
    } 
$('body').on('focus', "#datepicker", function() {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    //Datemask2 mm/dd/yyyy
    $("#datepicker").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
});
$('#modal').on('hidden.bs.modal', function () {
    $.ajax({
        url: '<?php echo base_url(); ?>preventive/checkimages/' + currentlocation,
        method: "post",
        dataType: 'json',             
        success: function(result){       
          console.log(result);
        }
    });
})
</script>
</body>
</html>
