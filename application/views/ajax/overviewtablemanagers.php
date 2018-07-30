<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<thead>
<tr>
<th class="text-center">Signum</th>
<th class="text-center">Overtime Hours</th>
<th class="text-center">Ticket Number</th>
<th class="text-center">Description</th>
<th class="text-center">Date</th>
<th class="text-center">Status</th>
<th class="text-center">Overtime Type</th>
<th class="text-center">Comment</th>
<th class="text-center">Type</th>
</tr>
</thead>
<tbody>
<?php foreach($overtime_table_day as $row):?>
<tr>
<td class="text-center"><?php echo $row->signum ?></td>
<td class="text-center"><?php echo $row->number ?></td>
<td class="text-center"><?php echo $row->ticket_number ?></td>
<td class="text-center"><?php echo $row->description ?></td>
<td class="text-center"><?php echo $row->date ?></td>
<?php if($row->status == 0):?>
<td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
<?php elseif($row->status == 1):?>
<td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> Approved</small></td> 
<?php elseif($row->status == 2):?>
<td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Declined</small></td>
<?php endif;?>
<td class="text-center"><?php echo $row->overtime_type ?></td>
<td class="text-center"><?php echo $row->comment ?></td>
<td class="text-center">Overtime Day</td>
</tr>
<?php endforeach;?>
<?php foreach($overtime_table_night as $row):?>
<tr>
<td class="text-center"><?php echo $row->signum ?></td>
<td class="text-center"><?php echo $row->number ?></td>
<td class="text-center"><?php echo $row->ticket_number ?></td>
<td class="text-center"><?php echo $row->description ?></td>
<td class="text-center"><?php echo $row->date ?></td>
<?php if($row->status == 0):?>
<td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
<?php elseif($row->status == 1):?>
<td class="text-center"><small class="label label-success"><i class="fa fa-clock-o"></i> Approved</small></td> 
<?php elseif($row->status == 2):?>
<td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Declined</small></td>
<?php endif;?>
<td class="text-center"><?php echo $row->overtime_type ?></td>
<td class="text-center"><?php echo $row->comment ?></td>
<td class="text-center">Overtime Night</td>
</tr>
<?php endforeach;?>                  
</tbody>