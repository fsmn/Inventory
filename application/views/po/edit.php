<?php
echo $vendor_id;
?>
<form id="order_editor" class="editor" action="<?=site_url("po/$action"); ?>"
	method="post" name="order_editor">
	<input type="hidden" name="id" value="<?=get_value($po,"id");?>"/>
	<input type="hidden" name="user_id" value="<?=$this->ion_auth->get_user_id();?>"/>
<p><label for="vendor_id">Vendor: </label> <span id="vendor-view"><?=form_dropdown('vendor_id', $vendors, get_value($po, 'vendor_id', $vendor_id), 'id="vendor_id"');
?></span></p>
<?php if($action == "update"):?>
<p><label for="po">Purchase Order: </label><input type="text"
	name="po" id="po" readonly style="width: 4em"
	value="<?=get_value($po, 'po'); ?>"/> <span id="valid-po"></span></p>
<p><label for="new-po">New Purchase Order#: </label><input type="text"
	name="new-po" id="new-po" style="width: 4em"
	value="<?=get_value($po, 'po'); ?>"/> <span id="valid-new-po"></span></p>
<?php else: ?>
<p><label for="po">Purchase Order: </label><input type="text"
	name="po" id="po" style="width: 4em"
	value="<?=get_value($po, 'po'); ?>"/> <span id="valid-po"></span></p>

<?php endif;?>
<p><label for="po_date">Order Date</label> <input type="date"
	name="po_date" id="po_date" style="width: auto;"
	value="<?=get_value($po, 'po_date',date("Y-m-d"));?>" /></p>
<p><label for="order_method">Order Method: </label><span
	id="order-method-view"> <?php
	echo form_dropdown('method', $methods, get_value($po, 'method'), 'id="method"');
	?></span></p>
<p><label for="payment_type">Payment Type: </label><span
	id="payment-type-view"> <?php
	echo form_dropdown('payment_type', $payment_types, urlencode(get_value($po, 'payment_type')), 'id="payment_type"');
	?></span></p>


<p><label for="billing_contact">Billing Contact: </label><input
	type="text" name="billing_contact" id="billing_contact"
	style="width: auto;"
	value="<?=get_value($po, 'billing_contact', 'Garth Morrisette'); ?>"/></p>
<p></p>
<p><label for="category">Order Category: </label> <span
	id="category-view"> <?=form_dropdown('category', $categories, urlencode(get_value($po, 'category')), 'id="category"');
	?> </span></p>
<p><label for="quote">Vendor Quote Number: </label> <input type="text"
	name="quote" id="quote" style="width: auto;"
	value="<?=get_value($po, 'quote')?>"/></p>
<p><input type="submit" class="save_order <?=$action;?> <?=implode(" ",get_button_style($action));?>" value="<?=ucfirst($action);?>" />

</form>
