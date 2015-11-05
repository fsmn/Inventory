<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$total_time = 0;

$buttons[] = array("text"=>"New Entry","href"=>base_url("timesheet/create?ajax=1"),"style"=>"new","class"=>"btn btn-default create dialog");
$buttons[] = array("text"=>"Search","href"=>base_url("timesheet/search?ajax=1"),"style"=>"search","class"=>"btn btn-default create dialog");
?>
<?php echo create_button_bar($buttons);?>
<div class='table-responsive'>
<table class='table'>
<tbody>
<?php $current_day = FALSE; ?>
<?php foreach($entries as $entry): ?>
<tr>
<td>
<?php echo create_button(array("text"=>"Edit","class"=>"button edit dialog insert","href"=>base_url("timesheet/edit/$entry->id?ajax=1")));?>
</td>
<td class='day'>
<?php if($current_day != $entry->day): ?>
<?php echo format_date($entry->day,'standard'); ?>
<?php $current_day = $entry->day; ?>
<?php endif; ?>
</td>
<td>
<?php echo $entry->start_time; ?>
</td>
<td>
<?php echo $entry->end_time; ?>
</td>
<td>
<?php $time_passed = (strtotime($entry->day . $entry->end_time) - strtotime($entry->day . $entry->start_time))/3600;
$total_time += $time_passed;
echo round($time_passed,2);;?>
</td>
<td>
<?php echo $entry->var_value; ?>
</td>
<td>
<?php echo $entry->details; ?>
</td>

</tr>

<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
<th>
</th>
<th>
</th>
<th colspan=2>
Total Time
</th>
<th>
<?php echo round($total_time,2);?>
</th>
<th>
</th>
<th>
</th>
</tr>
</tfoot>
</table>
</div>
