<?php
$buttons[] = array("text"=>"New Code","class"=>"btn-xs new-code","id"=>"new-code_$asset_id","style"=>"new");
print create_button_bar($buttons,"toolbar");
?>
<? foreach($codes as $code):?>

<div class="row code-row" id='code-row_<?=$asset_id;?>'>
<? echo live_field("type",$code->type,"code",$code->id,array("envelope"=>"span"));?>
<? echo live_field("value", $code->value, "code", $code->id, array("envelope"=>"span"));?>

</div>
<? endforeach;