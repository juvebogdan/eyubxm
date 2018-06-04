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
        <li class='active'><a href="<?php echo base_url()?>bxmtime/sickleave"><i class="fa fa-heartbeat"></i> <span><?php echo $this->lang->line('Sick leave') ?></span></a></li>
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
        <?php echo $this->lang->line('Sick Leave') ?>
        <small><?php echo $this->lang->line('Submit sick leave') ?></small>
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
            <h3 class="box-title"><?php echo $this->lang->line('Sick Leave') ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo form_open('', 'class="form-horizontal" id="overtime"'); ?>
            <div class="box-body" id="inputform">
              <div class="row">
                <div class="col-md-6">
                    <label><?php echo $this->lang->line('Start Date') ?>:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="datestart" class="form-control pull-right" id="datepickerstart" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <label><?php echo $this->lang->line('End Date') ?>:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="dateend" class="form-control pull-right" id="datepickerend" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-md-6 -->
              </div>
              <div class="row">
                <div class="col-md-12">
                      <label><?php echo $this->lang->line('Sick Leave Type') ?></label>
                      <select class="form-control select2" name="sicktype" style="width: 100%;">
                        <option value="trudnicko">Trudnicko</option>
                        <option value="porodiljsko">Porodiljsko</option>
                        <option value="bolovanje_do_70">Bolovanje do 70</option>
                        <option value="bolovanje_do_80">Bolovanje do 80</option>
                        <option value="bolovanje_do_90">Bolovanje do 90</option>
                        <option value="bolovanje_do_100">Bolovanje do 100</option>
                        <option value="bolovanje_preko_70">Bolovanje preko 70</option>
                        <option value="bolovanje_preko_100">Bolovanje preko 100</option>
                      </select>                
                </div>              
              </div>
              <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                  <label>
                    <input type="checkbox" name="doznake" class="flat-red">
                    Doznake
                  </label>                                  
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
              <h3 class="box-title"><?php echo $this->lang->line('Sickleave History') ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="overtimetable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Signum</th>
                      <th class="text-center"><?php echo $this->lang->line('Workdays') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Start Date') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('End Date') ?></th>
                      <th class="text-center">Doznake</th>
                      <th class="text-center"><?php echo $this->lang->line('Type') ?></th>
                      <th class="text-center">Status</th>
                      <th class="text-center"><?php echo $this->lang->line('Comment') ?></th>
                      <th class="text-center"><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($sickleave_table as $row):?>
                    <tr>
                      <td class="text-center"><?php echo $row->signum ?></td>
                      <td class="text-center"><?php echo $row->workdays ?></td>
                      <td class="text-center"><?php echo $row->start_date ?></td>
                      <td class="text-center"><?php echo $row->end_date ?></td>
                      <?php if($row->doznake == 0):?>
                      <td class="text-center"><span class="glyphicon glyphicon-remove"></span></td>
                      <?php elseif($row->doznake == 1):?>
                      <td class="text-center"><span class="glyphicon glyphicon-ok"></span></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->sicktype ?></td>  
                      <?php if($row->status == 0):?>
                      <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
                      <?php elseif($row->status == 1):?>
                      <td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
                      <?php elseif($row->status == 2):?>
                      <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
                      <?php endif;?>
                      <td class="text-center"><?php echo $row->comment ?></td>
                      <?php if($row->status == 0):?>
                      <td class="text-center">
                      <button class="btn btn-info btn-sm sickedit" id="<?php echo $row->id;?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;
                      <a href="<?php echo base_url('bxmtime/deletesickleave/'. $row->id);?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;
                      </td>
                      <?php else:?>
                      <td class="text-center">
                      <button class="btn btn-info btn-sm sickedit" id="<?php echo $row->id;?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;
                      <a href="<?php echo base_url('bxmtime/deletesickleave/'. $row->id);?>" class="btn btn-danger btn-sm disabled"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;                      
                      </td>                        
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
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
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
    $('#datepickerstart').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    $('#datepickerend').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });        
    //Datemask2 mm/dd/yyyy
    $("#datepickerstart").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("#datepickerend").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/addsickleave',
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
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    }); 
    //Modal
    $('body').on('click', 'button.sickedit', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/sickleavemodal/' + id,
            method: "post",
            dataType: 'json',
            success: function(result){        
              $('#modalcontent').html(result.result);
              $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
              }); 
              $('#datepickeredit').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy'
              });  
              $("#datepickeredit").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});                                               
              $('#modal').modal('show');
              //console.log(result);
            }
        });
      });
    });

    $('body').on('click', 'button.submitedit', function(e) {
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/sickleaveedit',
            method: "post",
            data: $('#sickedit').serialize(),
            dataType: 'json',
            beforeSend: function() {
              $('#successalert').remove();
            },
            success: function(result){        
                if ($('#successalert').length == 0) {
                  $("#overtimetable").dataTable().fnDestroy();
                  $('#mymodal').prepend(result.message);
                  $('#overtimetable').html(result.table);
                  reinitializeTable();
                  //console.log(result);
                }
            }
        });
      });
    });          
    
</script>
</body>
</html>
