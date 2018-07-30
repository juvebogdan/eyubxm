<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>  
<thead>
<tr>
<th class="text-center">Sitecode</th>
<th class="text-center">Name</th>
<th class="text-center">Tip</th>
<th class="text-center">Opis</th>
<th class="text-center">Uradjen</th>
<th class="text-center">Akcija</th>
</tr>
</thead>
<tbody>
<?php foreach($sites as $row):?>
<tr>
<td class="text-center"><?php echo $row->sitecode ?></td>
<td class="text-center"><?php echo $row->name ?></td>
<td class="text-center"><?php echo $row->tip ?></td>
<td class="text-center"><?php echo $row->opis ?></td>
<?php if($row->uradjen==0):?>
<td class="text-center"><small class="label label-danger">NE</small></td> 
<?php else:?>
<td class="text-center"><small class="label label-success">DA</small></td>
<?php endif;?>  
<?php if($row->uradjen==0):?>
<td class="text-center"><button class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td>  
<?php else:?>
<td class="text-center"><button disabled class="btn btn-info btn-sm problemedit" id="<?php echo $row->id?>"><span class="glyphicon glyphicon-edit"></span></button>&nbsp;</td> 
<?php endif;?>                                               
</tr>                    
<?php endforeach; ?>
</tbody> 