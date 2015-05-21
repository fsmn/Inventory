<?php
?>
<div class="row code-row" id='code-row_<?=$code->id;?>'>
<span class="code code-element code-type"><?php echo $code->var_value;?>:&nbsp;</span>
<span class="code code-element code-value"><?php echo $code->value;?></span>
<a href="<?php echo site_url("code/edit/$code->id");?>" class="btn btn-default btn-xs edit inline edit-code">Edit</a>
</div>