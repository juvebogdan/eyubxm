 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
<th class="text-center">Registracija</th>
<th class="text-center">Status</th>
<th class="text-center">Opis</th>
<th class="text-center">Akcija</th>
</tr>
</thead>
<tbody>
<?php foreach($carproblems as $row):?>
<tr>
  <td class="text-center"><?php echo $row->registracija ?></td>
  <td class="text-center"><small class="label label-warning"><i class="fa fa-clock-o"></i><?php echo $this->lang->line('Pending') ?></small></td>
  <td class="text-center"><?php echo $row->description ?></td>
  <td class="text-center"><button class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
</tr>                    
<?php endforeach; ?>
</tbody>  