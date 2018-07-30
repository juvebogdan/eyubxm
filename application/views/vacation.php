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
        <li class='active'><a href="<?php echo base_url()?>bxmtime/vacation"><i class="fa fa-calendar-o"></i> <span><?php echo $this->lang->line('Vacation') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/sickleave"><i class="fa fa-heartbeat"></i> <span><?php echo $this->lang->line('Sick leave') ?></span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/taskoverview"><i class="fa fa-desktop"></i> <span><?php echo $this->lang->line('Task Overview') ?></span></a></li>
        <li><a href="<?php echo base_url()?>preventive/"><i class="fa fa-list-alt"></i> <span>Preventive</span></a></li>                      
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
        <?php echo $this->lang->line('Vacation') ?>
        <small><?php echo $this->lang->line('Submit vacation period') ?></small>
      </h1> 
      <ol class="breadcrumb">
        <li><?php echo $this->lang->line('Days off') ?>: <?php echo $employee[0]->SD ?></li>
        <li><?php echo $this->lang->line('Vacation last year') ?>: <?php echo $employee[0]->GP ?></li>
        <li><?php echo $this->lang->line('Vacation current') ?>: <?php echo $employee[0]->GT ?></li>
      </ol>          
    </section>

    <!-- Main content -->
    <section class="content">
  <div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $this->lang->line('Vacation') ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo form_open_multipart('', 'class="form-horizontal" id="overtime" method="post"'); ?>
            <div class="box-body" id="inputform">
              <div class="row">
                <!-- /.col-md-12 -->
                <div class="col-md-12">
                  <label><?php echo $this->lang->line('Date range') ?>:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date" class="form-control pull-right" id="reservation">
                  </div> 
                </div>
                <!-- /.col-md-12 -->               
              </div>
              <div class="row">
                <div class="col-md-12">
                      <label><?php echo $this->lang->line('Vacation Type') ?>:</label>
                      <select class="form-control select2" name="vacationtype" style="width: 100%;">
                        <option value="GT">Godisnji odmor trenutni</option>
                        <option value="GP">Godisnji odmor proslogodisnji</option>
                        <option value="SD">Slobodni dani</option>
                      </select>                
                </div>              
              </div>               
<!--               <div class="row">
                <div class="col-md-12" id="filesarea" style="margin-top: 10px;">
                </div>
              </div> -->           
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
<!--             <button type="button" id="addfiles" class="btn btn-primary btn-lrg"><?php echo $this->lang->line('Add More files') ?></button> -->
            <button type="submit" class="btn btn-primary btn-lrg ajax pull-right" title="Ajax Request">
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
              <h3 class="box-title"><?php echo $this->lang->line('Vacation History') ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Signum</th>
                      <th class="text-center"><?php echo $this->lang->line('Working Days') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Vacation Type') ?></th>
                      <th class="text-center">Period</th>
                      <th class="text-center">Status</th>
                      <th class="text-center"><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($vacation_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->workdays ?></td>
                      <?php if($row->vacationtype == "SD"):?>
                      <td class="text-center">Slobodni dani</td>
                      <?php elseif($row->vacationtype == "GT"):?>
                      <td class="text-center">Godisnji odmor</td>
                      <?php elseif($row->vacationtype == "GP"):?>
                      <td class="text-center">Godisnji odmor proslogodisnji</td>                      
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->start_date . " - " . $row->end_date ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
                      <?php endif;?>
                      <?php if($row->status == 0):?>
                      <td class="text-center"><a href="<?php echo base_url('bxmtime/delete_vacation/'. $row->id);?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>
                      <?php else:?>
                      <td class="text-center"><a href="<?php echo base_url('bxmtime/delete_vacation/'. $row->id);?>" class="btn btn-danger btn-sm disabled"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>                        
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
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
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
    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',
        }
    });
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(e){
      e.preventDefault();
      var formData = new FormData($('#overtime')[0]);
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/addvacation',
            method: "post",
            data: formData,
            dataType: 'json',
            contentType: false,       
            cache: false,             
            processData:false,            
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
              }
              
            }
        });
      })

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

    // $('#addfiles').on('click',function(e) {
    //     e.preventDefault();
    //     addFileInput();
    // });

    // function addFileInput() {
    //   var html = '';
    //   html += '<div class="alert alert-info">';
    //   html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    //   html += '<strong>Upload file</strong>';
    //   html += '<input type="file" name="multipleFiles[]">';
    //   html += '</div>';
    //   $('#filesarea').append(html);
    // }  
</script>
</body>
</html>
