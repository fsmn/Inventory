<?php
?>
<form name="asset-search" class="form-dialog" id="asset-search" method="get" action="<?php echo site_url("asset/search");?>">
	<input type="hidden" name="is_search" id="is_search" value="1" />
	<div>
		<label for="vendor_id">Developer&nbsp;</label>
		<span id='vendor_list'> <?=form_dropdown('vendor_id', $developers, $this->input->get("vendor_id"), 'id="vendor_id" class="form-control"')?>
		</span>
	</div>
	<div class="product-info">
		<div class="column">
			<label for="product">Product Name&nbsp;</label>
			<input type="text" class="form-control" id="product" name="product" value="<?php echo $this->input->get("product");?>" />
		</div>
		<div class="column">
			<label for="name">Asset Name</label>
			<input type="text" class="form-control"  id="name" name="name" value="<?php echo $this->input->get("name");?>" />
		</div>
		<div class="column">

			<label for="version">Version&nbsp;</label>
			<input type="text" class="form-control"  id="version" name="version" value="<?php echo $this->input->get("version");?>" />
		</div>
		<div class="column">
			<label for="serial_number">Serial Number&nbsp;</label>
			<input type="text" class="form-control"  name="serial_number" value="<?php echo $this->input->get("serial_number");?>" class="serial_number" />
		</div>
	</div>
	<div class="type-status">
		<div class="column">
			<label for="status">Status&nbsp;</label>
			<span id='status'> <?=form_dropdown('status', $statuses, $this->input->get("status"), 'id="status" class="form-control"');?>
		</span>
		</div>


		<div class="column">
			<label for="type">Type&nbsp;</label>
			<span id='type_field'> <?=form_dropdown('type', $types, $this->input->get("type"), 'id="type" class="form-control"');?>
		</span>
		</div>
		<div class="column">
			<label for="year_acquired">School Year Acquired</label>
				<input type="text" class="form-control year" id="year_acquired" name="year_acquired" value="<?php $this->input->get("year_acquired");?>" size="5" />
			&nbsp;&dash;&nbsp;
			<input type="text" class="form-control" readonly name="year-acquired-next" id="year_acquired-next" value="" size="5"/>

		</div>
		<div id="year_removed_block" class="column">
			<label for="year_removed">School Year Removed</label>
			<input type="text"  class="form-control year"  id="year_removed" name="year_removed"  value="<?php echo $this->input->get("year_removed");?>" size="5" />
			&nbsp;&dash;&nbsp;<input type="text"  class="form-control"  name="year-removed-next" id="year_removed-next" value="" readonly size="5"/>

		</div>
		<div class="source-order">
			<div class="column">
				<label for="source">Source</label>
				<span id="source">
					<input type="text"  class="form-control"  id="source" name="source" value="<?php echo $this->input->get("source"); ?>" />
				</span>
			</div>
			<div class="column">
				<label for="po">Purchase Order</label>
				<span id="po-field">
					<input type="text"  class="form-control" id="po" name="po" size="5" value="" />
				</span>
			</div>

		</div>

		<div class="actions">
			<div class="column">
				<input type="submit" class="save_order btn btn-default search" value="Search" />
			</div>
			<div class="column">
				<a href="<?php echo site_url("asset/search");?>" title="reset this search" class="btn btn-link">Reset</a>
			</div>
		</div>
	</div>
</form>

<?php if($assets):?>
<?php $this->load->view("asset/list",array("assets"=>$assets));?>


<?php endif;