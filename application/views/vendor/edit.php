<?php
if ($vendor) {
	$types = explode ( ",", get_value ( $vendor, "type", array () ) );
} else {
	$types = array ();
}
$vendor_types = array (
		"developer",
		"vendor" 
);
?>

<form name="vendor_editor" id="vendor_editor" class="editor form-dialog form-horizontal" action="<? echo site_url("vendor/$action"); ?>"
	method="post"
>
	<input type="hidden" name="id" id="id" value="<?php echo get_value($vendor, 'id'); ?>" />
	<div class="form-group">
		<label class="col-sm-4 control-label" for="name">Vendor</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="name" id="name" style="width: auto" value="<?php echo get_value($vendor, 'name'); ?>" required/>
		</div>
	</div>
	
<div class="form-group">
<div class="col-sm-offset-4 col-sm-8 checkbox-required">
	<?php foreach($vendor_types as $type):?>
		<div class="checkbox">
		<label> 
	<input type="checkbox" name="type[]" value="<?php echo $type; ?>" <?php echo in_array($type,$types)?"checked":"";?> aria-label="..." required />&nbsp;<?php echo ucfirst($type);?>
</label>
</div>
	<?php endforeach;?>
	</div>
				</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label" for="contact">Contact</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="contact" id="contact" style="width: auto" value="<?php echo get_value($vendor, 'contact'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="address">Address</label>
		<div class="col-sm-8">
		<textarea id="address" name="address" class="form-control" style="width: auto; height: 5ex"><?php echo get_value($vendor, 'address'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="locality">City State &amp; Zip</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="locality" id="locality" style="width: auto"
				value="<?php echo get_value($vendor, 'locality'); ?>"
			/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="url">URL</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="url" id="url" style="width: auto" value="<?php echo get_value($vendor, 'url'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="phone">Phone</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="phone" id="phone" style="width: auto" value="<?php echo get_value($vendor, 'phone'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="fax">Fax</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="fax" id="fax" style="width: auto" value="<?php echo get_value($vendor, 'fax'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="email">Email</label>
		<div class="col-sm-8">
			<input type="email" class="form-control" name="email" id="email" style="width: auto" value="<?php echo get_value($vendor, 'email'); ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="customer_id">Customer ID</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="customer_id" id="customer_id" value="<?php echo get_value($vendor,'customer_id');?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" class="btn save_vendor <?=$action;?> <?=implode(" ",get_button_style($action));?>" value="<?=ucfirst($action);?>" />
		</div>
	</div>
</form>
