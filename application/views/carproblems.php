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
        <li><a href="<?php echo base_url()?>bxmtime/cars"><i class="fa fa-car"></i> <span>Dodavanje vozila</span></a></li>
        <li><a href="<?php echo base_url()?>bxmtime/kilometraza"><i class="fa fa-dashboard"></i> <span>Kilometraza</span></a></li>         
        <li class='active'><a href="<?php echo base_url()?>bxmtime/carproblems"><i class="fa fa-legal"></i> <span>Problemi sa vozilima</span></a></li>                              
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
        Aktivni problemi
        <small>Aktivni problemi</small>
      </h1>
    </section>

    <!-- Main content -->
  <section class="content">
  <div class="box box-danger collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title">Dodaj Problem</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>  
  <div class="box-body">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo form_open('', 'class="form-horizontal" id="carproblem"'); ?>
            <div class="box-body" id="inputform">
              <div class="row">
                <div class="col-md-12">
                    <label>Registracija:</label>
                    <select class="form-control select2" name="register" style="width: 100%;">
                      <?php foreach($cars as $row):?>
                        <option value="<?php echo $row->registracija ?>"><?php echo $row->registracija ?></option>
                      <?php endforeach;?>
                    </select> 
                  <!-- /input-group -->
                </div>                               
                <!-- /.col-md-6 -->
              </div>
             <div class="row">
                <div class="col-md-12">
                    <label>Opis problema</label>
                    <textarea class="form-control" name="description" rows="6" placeholder="Opis"></textarea>
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
  </div>
  <div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Spisak Problema</h3>
  </div>  
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid box-primary">
        <div class="box-header">
              <h3 class="box-title">Spisak problema</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
              <table id="carproblems" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">Registracija</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Opis</th>
                      <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($carproblems as $row):?>
                      <tr>
                        <td class="text-center"><?php echo $row->registracija ?></td>
                        <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i><?php echo $this->lang->line('Pending') ?></small></td>
                        <td class="text-center"><?php echo $row->description ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
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
    $('#carproblems').DataTable({
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

   $('body').on('click', 'button.problemedit', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/problemmodal/' + id,
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

    $('body').on('click', 'button.problemsolve', function(e) {
      var id = e.currentTarget.id;
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/problemsolve',
            data: $('#problemeditform').serialize(),
            method: "post",
            dataType: 'json',
            beforeSend: function() {
              $('.problemsolve').prop('disabled',true);
            },             
            success: function(result){       
              $("#carproblems").dataTable().fnDestroy();
              $('#mymodal').prepend(result.message);
              $('#carproblems').html(result.table);
              reinitializeTable();
              $('.problemsolve').prop('disabled',false);
            }
        });
      });
    });


    $('.ajax').click(function(){
      Pace.track(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>bxmtime/addcarproblem',
            method: "post",
            data: $('#carproblem').serialize(),
            dataType: 'json',
            beforeSend: function() {
              $('#successalert').remove();
              $('.ajax').prop('disabled',true);
            },
            success: function(result){        
              if ($('#successalert').length == 0) {
                $("#carproblems").dataTable().fnDestroy();
                $('#inputform').prepend(result.message);
                $('#carproblems').html(result.table);
                reinitializeTable();
                $('.ajax').prop('disabled',false);
                //console.log(result);
              }
              
            }
        });
      });

    });
    function reinitializeTable() {
      $('#carproblems').DataTable({
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
</script>
</body>
</html>
