   <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
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