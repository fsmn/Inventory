<?php
?>
<h3><?php echo $title; ?></h3>
<form id="order-search" class="editor form-dialog" action="<?php echo site_url("po/search"); ?>" method="get" name="order-search">
	<input type="hidden" name="is_search" value=1 />
	<div>
		<div class="column">
			<label for="po">Purchase Order: </label>
			<input type="text" name="po" id="po" style="width: 4em" value="<?php echo $refine?get_cookie($po, 'po'):""; ?>" />
		</div>

		<div class="column">
			<label for="po_date">Order Date</label>
			<input type="date" name="po_date" id="po_date" style="width: auto;" value="<?php echo $refine?get_cookie('po_date'):"";?>" />
		</div>
	</div>
	<div>
		<div class="column">
			<label for="order_method">Order Method: </label>
			<span id="order-method-view"> <?php
			echo form_dropdown ( 'method', $methods, $refine?get_cookie ( 'method' ):"", 'id="method"' );
			?></span>
		</div>
		<div class="column">
			<label for="payment_type">Payment Type: </label>
			<span id="payment-type-view"> <?php
			echo form_dropdown ( 'payment_type', $payment_types, $refine?get_cookie ( 'payment_type' ):"", 'id="payment_type"' );
			?></span>
		</div>
	</div>
	<div>
		<div class="column">
			<label for="ordered_by">Ordered By: </label>
	<?php echo form_dropdown('ordered_by',$users,$refine?get_cookie("ordered_by"):"");?>
	</div>
		<div class="column">
			<label for="billing_contact">Billing Contact: </label>
		<?php echo form_dropdown('billing_contact',$users,$refine?get_cookie('billing_contact'):"");?>
	</div>
	<div class="column">
		<label for="vendor_id">Vendor: <?php echo get_cookie("vendor_id");?> </label>
		<?php echo form_dropdown('vendor_id',$vendors,$refine?get_cookie('vendor_id'):"");?>
	</div>
	</div>
	<div>
		<div class="column">
			<label for="category">Order Category: </label>
			<span id="category-view"> <?php echo form_dropdown ( 'category', $categories, $refine?get_cookie('category' ):"" , 'id="category"' );?> </span>
		</div class="column">
		<div class="column">
			<label for="quote">Vendor Quote Number: </label>
			<input type="text" name="quote" id="quote" style="width: auto;" value="<?php echo $refine?get_cookie( 'quote'):"";?>" />
		</div>
	</div>
	<div>
		<div class="column">
			<label for="description">Description of Item</label>
			<input type="text" name="description" id="description" value="<?php echo $refine?get_cookie('description'):"";?>" />
		</div>
		<div class="column">
			<label for="sku">SKU</label>
			<input type="text" name="sku" id="sku" value="<?php echo $refine?get_cookie('sku'):"";?>" />
		</div>
	</div>
	<div>
		
<div class="column">
				<input type="submit" class="btn btn-default search" value="Search" />
			</div>
			<div class="column">
				<a href="<?php echo site_url("po/search");?>"
					title="reset this search">Reset</a>
			</div>
			</div>
</form>

<?php if($pos):?>
<?php $this->load->view("po/list",array("pos"=>$pos));?>

<?php endif;
