<?php
$buttons [] = array (
		"text" => "Edit",
		"style" => "edit",
		"class" => "btn-xs edit inline edit-code",
		"href" => site_url ( "code/edit/$code->id" ) 
);
$buttons [] = array (
		"text" => "Delete",
		"style" => "delete",
		"class" => "btn-xs delete inline delete-code",
		"href" => site_url ( "code/delete/$code->id" ),
		"id" => "delete-code_$code->id" 
);

?>
<div class="row code-row" id='code-row_<?php echo $code->id;?>'>
	<span class="code code-element code-type"><?php echo $code->var_value;?>:&nbsp;</span>
	<span class="code code-element code-value"><?php echo $code->value;?></span>
<?php echo create_button_bar($buttons);?>
</div>