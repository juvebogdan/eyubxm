 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
  <th class="text-center">Subject</th>
  <th class="text-center">Description</th>
  <th class="text-center">Assigned to</th>
  <th class="text-center">Status</th>
  <th class="text-center">Deadline</th>
  <th class="text-center">Created</th>
  <th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php foreach($tasks as $row):?>
<tr>
  <td class="text-center"><?php echo $row->subject ?></td>
  <td class="text-center"><?php echo $row->description ?></td>
  <td class="text-center"><?php echo $row->assignedto ?></td>
  <?php if(date_diff($today,DateTime::createFromFormat('Y-m-d', $row->deadline))->invert == 1):?>
  <td class="text-center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Overdue</small></td> 
  <?php else:?>
  <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
  <?php endif;?>
  <td class="text-center"><?php echo $row->deadline ?></td>
  <td class="text-center"><?php echo $row->datum ?></td>
  <td class="text-center"><button class="btn btn-info btn-sm taskedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>                      
</tr>
<?php endforeach;?>                  
</tbody> 