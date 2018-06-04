<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
<th class="text-center">Signum</th>
<th class="text-center">Working Days</th>
<th class="text-center">Vacation Type</th>
<th class="text-center">Period</th>
<th class="text-center">Status</th>
<th class="text-center">Action</th>
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
<td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
<td class="text-center"><button class="btn btn-info btn-sm vacationedit" id="<?php echo $row->id ?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
</tr>
<?php endforeach;?>
</tbody>ndforeach;?>
</tbody>  