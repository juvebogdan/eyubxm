<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
  <th class="text-center">Signum</th>
  <th class="text-center">Workdays</th>
  <th class="text-center">Start Date</th>
  <th class="text-center">End Date</th>
  <th class="text-center">Doznake</th>
  <th class="text-center">Type</th>
  <th class="text-center">Status</th>
  <th class="text-center">Action</th>
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
  <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
  <td class="text-center"><button class="btn btn-info btn-sm sickleaveedit" id="<?php echo $row->id ?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>
</tr>
<?php endforeach;?>
</tbody>   