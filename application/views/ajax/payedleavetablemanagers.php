<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
  <th class="text-center">Signum</th>
  <th class="text-center">Working Days</th>
  <th class="text-center">Period</th>
  <th class="text-center">Description</th>
  <th class="text-center">Status</th>
  <th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php foreach($payedleave_table as $row):?>
<tr>
  <td class="text-center"><?php echo $row->signum ?></td>
  <td class="text-center"><?php echo $row->workdays ?></td>
  <td class="text-center"><?php echo $row->start_date . " - " . $row->end_date ?></td>
  <td class="text-center"><?php echo $row->description ?></td>
  <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>
  <td class="text-center"><button class="btn btn-info btn-sm payedleaveedit" id="<?php echo $row->id ?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>
</tr>
<?php endforeach;?>
</tbody>  