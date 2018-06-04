   <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php echo form_open('', 'class="form-horizontal" id="taskeditform"'); ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Solve task</h4>
</div>
<div class="modal-body" id="mymodal"> 
<div class="row">
  <div class="col-md-12">
      <label>Comment</label>
      <textarea class="form-control" name="description" rows="6" placeholder="Short comment"></textarea>
      <input type="hidden" name="id" value="<?php echo $taskedit[0]->id; ?>">
      <input type="hidden" name="user" value="<?php echo $taskedit[0]->assignedto; ?>">
  </div> 
</div>                 
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success tasksolve" data-dismiss="modal">Close Task</button>
</div>
<?php echo form_close();?> 