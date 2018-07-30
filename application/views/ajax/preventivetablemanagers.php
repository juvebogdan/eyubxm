<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>  
<thead>
<tr>
<th class="text-center">Sitecode</th>
<th class="text-center">Name</th>
<th class="text-center">Tip</th>
<th class="text-center">Provereni Alarmi</th>
<th class="text-center">Izmerena Struja</th>
<th class="text-center">Vizuelna Provera</th>
<th class="text-center">Status</th>
<th class="text-center">Uradjen</th>
</tr>
</thead>
<tbody>
<?php foreach($sites as $row):?>
<tr>
<td class="text-center"><?php echo $row->sitecode ?></td>
<td class="text-center"><?php echo $row->name ?></td>
<td class="text-center"><?php echo $row->tip ?></td>
<td class="text-center"><?php echo $row->provereni_alarmi ?></td>
<td class="text-center"><?php echo $row->izmerena_struja ?></td>
<td class="text-center"><?php echo $row->vizuelna_provera ?></td>
<td class="text-center"><?php echo $row->status ?></td>
<?php if($row->uradjen==0):?>
<td class="text-center"><small class="label label-danger">NE</small></td> 
<?php else:?>
<td class="text-center"><small class="label label-success">DA</small></td>
<?php endif;?>                                                 
</tr>                    
<?php endforeach; ?>
</tbody> 