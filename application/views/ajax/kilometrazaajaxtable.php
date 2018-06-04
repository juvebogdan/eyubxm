 <?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>             
<thead>
<tr>
  <th class="text-center">Registracija</th>
  <th class="text-center">Kilometraza</th>
  <th class="text-center">Datum</th>
</tr>
</thead>
<tbody>
  <?php foreach ($pregled as $reg): ?>
    <?php foreach($reg as $row): ?>
      <tr>
        <td class="text-center"><?php echo $row->registracija ?></td>
        <td class="text-center"><?php echo $row->kilometraza ?></td>
        <td class="text-center"><?php echo $row->datum ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endforeach; ?>
</tbody> 