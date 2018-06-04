   <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<?php echo form_open('', 'class="form-horizontal" id="sickedit"'); ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title"><?php echo $this->lang->line('Edit Sick Leave') ?></h4>
</div>
<div class="modal-body" id="mymodal">
<div class="row">
  <div class="col-md-12">
      <label><?php echo $this->lang->line('End Date') ?>:</label>
    <div class="input-group date">
      <div class="input-group-addon">
      <i class="fa fa-calendar"></i>
      </div>
      <input type="text" name="dateendedit" class="form-control pull-right" id="datepickeredit" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
    </div>
    <!-- /input-group -->
  </div>
</div> 
<div class="row" style="margin-top: 10px;">
  <div class="col-md-12">
    <label>
    <?php if($sickedit[0]->doznake == 1): ?>
      <input type="checkbox" name="doznake" class="flat-red checked">
    <?php else: ?>
      <input type="checkbox" name="doznake" class="flat-red">
    <?php endif; ?>
      Doznake
    </label> 
    <input type="hidden" name="id" value="<?php echo $sickedit[0]->id; ?>">                                 
  </div>  
</div>                 
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
  <button type="button" class="btn btn-outline submitedit"><?php echo $this->lang->line('Save changes') ?></button>
</div>
<?php echo form_close();?> 