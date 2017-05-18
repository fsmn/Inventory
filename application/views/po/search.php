<?php
?>
<form id="order-search" class="editor form-dialog" action="<?php echo site_url("po/search"); ?>" method="get" name="order-search">
	<input class="form-control" type="hidden" name="is_search" value=1 />
	<div>
		<div class="column">
			<label for="po">PO#:</label>
			<input class="form-control" type="text" name="po" id="po" style="width: 5em" value="<?php echo $this->input->get($po, 'po'); ?>" />
		</div>



		<div class="column mobile-clear">
			<label for="start_date">Date Range</label>
			<span style="white-space: nowrap;">
				<input class="form-control" type="date" name="start_date" id="date_start" style="width: auto;"
					value="<?php echo $this->input->get("start_date");?>"
				/>
				&nbsp;-&nbsp;
				<input class="form-control" type="date" name="end_date" id="date_end" style="width: auto;"
					value="<?php echo $this->input->get("end_date");?>"
				/>
			</span>

		</div>
	</div>
	<div>
		<div class="column details no-wrap">
			<label for="description">Description of Item</label>
			<input class="form-control" type="text" name="description" id="description" style="width: 100%"
				value="<?php echo $this->input->get('description');?>"
			/>
		</div>
		<div class="column">
			<label for="sku">SKU</label>
			<input class="form-control" type="text" name="sku" id="sku" value="<?php echo $this->input->get('sku');?>" />
		</div>
	</div>
	<div>
		<div class="column">
			<label for="order_method">Order Method: </label>
			<span id="order-method-view"> <?php
			echo form_dropdown ( 'method', $methods, $this->input->get ( 'method' ), 'id="method" class="form-control"' );
			?></span>
		</div>
		<div class="column">
			<label for="payment_type">Payment Type: </label>
			<span id="payment-type-view"> <?php
			echo form_dropdown ( 'payment_type', $payment_types, $this->input->get ( 'payment_type' ), 'id="payment_type" class="form-control"' );
			?></span>
		</div>
		<div class="column">
			<label for="orderer_id">Ordered By: </label>
	<?php echo form_dropdown('orderer_id',$users,$this->input->get("orderer_id"), 'class="form-control"');?>
	</div>
		<div class="column no-wrap">
			<label for="vendor_id">Vendor: </label>
		<?php echo form_dropdown('vendor_id',$vendors,$this->input->get('vendor_id'),'class="form-control"');?>
	</div>
	</div>
	<!-- <div>
		<div class="column">
			<label for="category">Order Category: </label>
			<span id="category-view"> <?php echo form_dropdown ( 'category', $categories, $this->input->get('category' ) , 'id="category" class="form-control"' );?> </span>
		</div class="column">
		<div class="column">
			<label for="quote">Vendor Quote Number: </label>
			<input class="form-control" type="text" name="quote" id="quote" style="width: auto;" value="<?php echo $this->input->get( 'quote');?>" />
		</div>
	</div>  -->

	<div>

		<div class="column">
			<input type="submit" class="btn btn-default search" value="Search" />
		</div>
		<div class="column">
			<a href="<?php echo site_url("po/search");?>" title="reset this search" class="btn btn-link">Reset</a>
		</div>
	</div>
</form>

<?php if($pos):?>
<?php $this->load->view("po/list",array("pos"=>$pos));?>

<?php endif;
