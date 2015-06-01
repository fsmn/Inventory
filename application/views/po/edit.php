<?php
?>
<form id="order-editor" class="form-dialog form-horizontal" action="<?=site_url("po/$action"); ?>" method="post" name="order-editor">
	<input type="hidden" name="id" value="<?=get_value($po,"id");?>" />
	<input type="hidden" name="orderer_id" value="<?php echo get_value($po,"orderer_id",$this->ion_auth->get_user_id());?>" />
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="vendor_id">Vendor: </label>
		<div class="col-sm-8" id="vendor-view"><?=form_dropdown ( 'vendor_id', $vendors, get_value ( $po, 'vendor_id', $vendor_id ), 'id="vendor_id" class="form-control"' );?></div>
	</div>
<?php if($action == "update"):?>
<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="po">Purchasase Order: </label>
		<input type="text" class="form-control" name="po" id="po" readonly style="width: 4em" value="<?=get_value($po, 'po'); ?>" />
		<div class="col-sm-8" id="valid-po">&nbsp;</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="new-po">New Purchase Order#: </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="new-po" id="new-po" style="width: 4em" value="<?=get_value($po, 'po'); ?>" />
			<span id="valid-new-po" class="fa"></span>
		</div>
	</div>
<?php else: ?>
<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="po">Purchase Order: </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="po" id="po" style="width: 5em" value="<?=get_value($po, 'po'); ?>" />
			<span id="valid-po" class="fa"></span>
		</div>
	</div>

<?php endif;?>
<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="po_date">Order Date</label>
		<input type="date" class="form-control" name="po_date" id="po_date" style="width: auto;" value="<?=get_value($po, 'po_date',date("Y-m-d"));?>" />
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="order_method">Order Method: </label>
		<div class="col-sm-8" id="order-method-view"> <?php
		echo form_dropdown ( 'method', $methods, get_value ( $po, 'method' ), 'id="method" class="form-control"' );
		?></div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="payment_type">Payment Type: </label>
		<div class="col-sm-8" id="payment-type-view"> <?php
		echo form_dropdown ( 'payment_type', $payment_types, urlencode ( get_value ( $po, 'payment_type' ) ), 'id="payment_type" class="form-control"' );
		?></div>
	</div>


	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="billing_contact">Billing Contact: </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="billing_contact" id="billing_contact" readonly style="width: auto;"
				value="<?=get_value($po, 'billing_contact', BILLING_CONTACT); ?>"
			/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="category">Order Category: </label>
		<div class="col-sm-8" id="category-view"> <?=form_dropdown ( 'category', $categories, urlencode ( get_value ( $po, 'category' ) ), 'id="category" class="form-control"' );?> </div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="quote">Vendor Quote Number: </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="quote" id="quote" style="width: auto;" value="<?=get_value($po, 'quote')?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" class="form-control save_order <?=$action;?> <?=implode(" ",get_button_style($action));?>"
				value="<?=ucfirst($action);?>"
			/>
		</div>
	</div>
</form>
