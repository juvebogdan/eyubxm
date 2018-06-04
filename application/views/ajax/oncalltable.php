 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
<th class="text-center">Signum</th>
<th class="text-center">Period</th>
<th class="text-center">Status</th>
<th class="text-center"><?php echo $this->lang->line('Comment') ?></th>
<th class="text-center"><?php echo $this->lang->line('Action') ?></th>
</tr>
</thead>
<tbody>
<?php foreach($oncall_table as $row):?>
<tr>
<td class="text-center"><?php echo $row->signum ?></td>
<td class="text-center"><?php echo $row->start_date . " - " . $row->end_date ?></td>
<?php if(($row->status == 0 && $row->directorapprove == 1) || ($row->status == 0 && $row->directorapprove == 0)):?>
<td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Pending') ?></small></td>
<?php elseif($row->status == 1 && $row->directorapprove == 0):?>
<td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Waiting Director Approve') ?></small></td>        
<?php elseif($row->status == 1 && $row->directorapprove == 1):?>
<td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Approved') ?></small></td> 
<?php elseif($row->status == 2 || $row->directorapprove == 2):?>
<td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('Declined') ?></small></td>
<?php endif;?>
<td class="text-center"><?php echo $row->comment ?></td>
<?php if($row->status == 0):?>
<td class="text-center"><a href="<?php echo base_url('bxmtime/delete_oncall/'. $row->id);?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>
<?php else:?>
<td class="text-center"><a href="" class="btn btn-danger btn-sm disabled"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;</td>  
<?php endif;?>
</tr>
<?php endforeach;?>
</tbody>