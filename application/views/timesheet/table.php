<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class='table-responsive'>
<table class='table'>
<?php $current_day = FALSE; ?>
<?php foreach($entries as $entry): ?>
<tr>
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
<?php echo $entry->category; ?>
</td>
<td>
<?php echo $entry->details; ?>
</td>
<td>
<?php echo create_button(array("text"=>"Edit","class"=>"button edit dialog insert","href"=>base_url("timesheet/edit/$entry->id?ajax=1")));?>
</td>
</tr>

<?php endforeach; ?>

</table>
<?php echo create_button_bar(array(array("text"=>"New Entry","href"=>base_url("timesheet/create?ajax=1"),"class"=>"btn btn-default create dialog insert")));?>
</div>