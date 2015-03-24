<?php
?>
<form name="vendor_editor" id="vendor_editor" class="editor" action="<? echo site_url("vendor/$action"); ?>"
	method="post">
	<input type="hidden" name="id"
	id="id" value="<?php echo get_value($vendor, 'id'); ?>"/>
<p><label for="name">Vendor</label> <input type="text"
	name="name" id="name" style="width: auto"
	value="<?php echo get_value($vendor, 'name'); ?>"/></p>
<p><label for="contact">Contact</label> <input type="text"
	name="contact" id="contact" style="width: auto"
	value="<?php echo get_value($vendor, 'contact'); ?>"/></p>
<p><label for="address">Address</label> <textarea
	id="address" name="address"
	style="width: auto; height: 5ex"><?php echo get_value($vendor, 'address'); ?></textarea></p>
<p><label for="locality">City State &amp; Zip</label> <input
	type="text" name="locality" id="locality"
	style="width: auto" value="<?php echo get_value($vendor, 'locality'); ?>"/></p>
<p><label for="url">URL</label> <input type="text"
	name="url" id="url" style="width: auto"
	value="<?php echo get_value($vendor, 'url'); ?>"/></p>
<p><label for="phone">Phone</label> <input type="text"
	name="phone" id="phonw" style="width: auto"
	value="<?php echo get_value($vendor, 'phone'); ?>"/></p>
<p><label for="fax">Fax</label><input type="text" name="fax"
	id="fax" style="width: auto"
	value="<?php echo get_value($vendor, 'fax'); ?>"/></p>
<p><label for="email">Email</label> <input type="email"
	name="email" id="email" style="width: auto"
	value="<?php echo get_value($vendor, 'email'); ?>"/></p>
<p><label for="customer_id">Customer ID</label> <input type="text"
	name="customer_id" id="customer_id" style="width: auto"
	value="<?php echo get_value($vendor, 'customer_id'); ?>"/></p>
<p><input type="submit" class="btn save_vendor <?=$action;?> <?=implode(" ",get_button_style($action));?>" value="<?=ucfirst($action);?>"/></p>
</form>
