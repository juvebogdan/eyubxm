   <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php echo form_open('', 'class="form-horizontal" id="preventiveform"'); ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Preventivni pregled za <?php echo $site[0]->name ?></h4>
</div>
<div class="modal-body" id="mymodal"> 
<div class="row">
  <div class="col-md-12">
    <label>Provereni alarmi:</label>
    <select class="form-control select2" name="alarmi" style="width: 100%;">
      <option value="Ne">Ne</option>
      <option value="Da">Da</option>
    </select>
  </div>
  <div class="col-md-12">
    <label>Izmerena struja:</label></br>
    <input type="text" name="struja" style="width: 100%; color: black" >
  </div>  
  <div class="col-md-12">
    <label>Vizuelna provera:</label>
    <select class="form-control select2" name="visual" style="width: 100%;">
      <option value="Ne">Ne</option>
      <option value="Da">Da</option>
    </select>
  </div>
  <div class="col-md-12">
    <label>Status lokacije:</label>
    <select class="form-control select2" name="status" style="width: 100%;">
      <option value="OK">OK</option>
      <option value="info">info</option>
      <option value="minor">minor</option>
      <option value="Major">Major</option>
    </select>
  </div>  
  <div class='col-md-12'>
    <label>Datum:</label>
    <div class="input-group date">
      <div class="input-group-addon">
      <i class="fa fa-calendar"></i>
      </div>
      <input type="text" name="date" class="form-control pull-right" id="datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
    </div>
    <!-- /input-group -->    
  </div>
  <div class="col-md-12">
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
  </div>   
  <input type="hidden" name="id" value="<?php echo $site[0]->id; ?>">   
</div>                 
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default pull-left preventivecancel">Cancel</button>
  <button type="button" class="btn btn-success preventivesubmit pull-right" disabled data-dismiss="modal">Submit</button>
</div>
<?php echo form_close();?> 