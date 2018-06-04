 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
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