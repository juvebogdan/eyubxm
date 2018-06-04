 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
  <th class="text-center">Registracija</th>
  <th class="text-center">Tip vozila</th>
  <th class="text-center">Kilometraza</th>
  <th class="text-center">Marka automobila</th>
</tr>
</thead>
<tbody>
<?php foreach($cars as $row):?>
  <tr>
    <td class="text-center"><?php echo $row->registracija ?></td>
    <td class="text-center"><?php echo $row->tip ?></td>
    <td class="text-center"><?php echo $row->kilometraza ?></td>
    <td class="text-center"><?php echo $row->marka ?></td>
  </tr>                     
<?php endforeach; ?>
</tbody> 