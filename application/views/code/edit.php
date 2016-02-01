<?php

if($action == "insert"):
?>
<div class="row code-row new-row" id='code-row_new_<?php echo $asset_id?>'>
<?php endif; ?>
<form name="code-row-insert" action="<?php echo site_url("code/$action");?>" method="post">
<div class="form-group">
<input type="hidden" id="code_id" name="id" value="<?php echo get_value($code,"id");?>"/>
<input type="hidden" id="asset_id" name="asset_id" value="<?php echo $asset_id;?>"/>
<span class="code">
<?php echo form_dropdown("type",$types,get_value($code,"type"),"id='new-type' class='form-control'");?>
</span>
<span class="code code-element code-value">
<input type="text" name="value" value="<?php echo get_value($code,"value");?>" id="new-value'" class="form-control"/>
</span>
<input type="submit" name="code-submit" class="form-control btn btn-default btn-xs inline" id="submit_<?php echo $asset_id;?>" value="<?php echo ucfirst($action);?>"/>
</div>
</form>
<?php if ($action == "insert"):?>
</div>
<?php endif; 