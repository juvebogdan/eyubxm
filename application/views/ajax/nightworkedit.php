   <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php echo form_open('', 'class="form-horizontal" id="overtimeeditform"'); ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Approving</h4>
</div>
<div class="modal-body" id="mymodal">
<div class="row">
 <div class="col-md-12">
    <label>Hours:</label>
    <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-hourglass"></i></span>
    <input type="text" class="form-control" placeholder="Number of overtime hours" name="overtime" value="<?php echo $nightworkedit[0]->number; ?>">
    </div>
    <!-- /input-group -->
  </div>   
</div> 
<div class="row">
  <div class="col-md-12">
      <label>Comment</label>
      <textarea class="form-control" name="description" rows="3" placeholder="Short comment"></textarea>
      <input type="hidden" name="id" value="<?php echo $nightworkedit[0]->id; ?>">
      <input type="hidden" name="user" value="<?php echo $nightworkedit[0]->signum; ?>">
      <input type="hidden" name="type" value="<?php echo $nightworkedit[0]->identifier; ?>">
  </div> 
</div>                 
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger pull-left nightworkdecline" data-dismiss="modal">Decline</button>
  <button type="button" class="btn btn-success nightworkapprove" data-dismiss="modal">Approve</button>
</div>
<?php echo form_close();?> 