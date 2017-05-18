<?php
?>
<form id="asset_editor" class="form-horizontal form-dialog" name="asset_editor" action="<? echo site_url("asset/$action"); ?>" method="post">
	<input type="hidden" name="id" id="id" value="<?=get_value($asset, 'id')?>" />
	<input type="hidden" name="action" id="action" value="<?=$action?>" />
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="vendor_id">Developer&nbsp;</label>
		<div class="col-sm-8"> <?=form_dropdown('vendor_id', $developers, get_value($asset, 'vendor_id',$vendor_id), 'id="vendor_id" class="form-control"')?></div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="product" class="col-sm-4 control-label no-wrap">Product Name&nbsp;</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="product" name="product" required value="<?=get_value($asset, 'product');?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="name">Asset Name</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="name" name="name" value="<?=get_value($asset, 'name');?>" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="version">Version&nbsp;</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="version" name="version" value="<?=get_value($asset, 'version');?>" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="type">Type&nbsp;</label>
		<div class="col-sm-8">
		 <?=form_dropdown('type', $types, get_value($asset, 'type'), 'id="type" required class="form-control"');?>
	</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="serial_number">Serial Number&nbsp;</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="serial_number" value="<?=get_value($asset,'serial_number');?>"
				id="serial_number-<?=get_value($asset,"id","0");?>" class="serial_number"
			/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="year_acquired">Year Acquired</label>
		<div class="col-sm-8">
			<input type="text" class="form-control year" id="year_acquired" name="year_acquired" required value="<?=get_value($asset,"year_acquired");?>"
				size="5"
			/>
			&nbsp;-&nbsp;
			<input type="text" class="form-control" name="year-acquired-next" id="year_acquired-next" value="" readonly size=5 />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="source">Source</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="source" name="source" value="<?=get_value($asset,"source");?>" />
		</div>
	</div>
	<div id="purchase_price_block" class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="purchase_price">Purchase Price</label>
		<div class="col-sm-8">
			$
			<input type="text" class="form-control price" id="purchase_price" name="purchase_price"
				value="<?php echo get_value($asset,"purchase_price");?>"
			/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="status">Status&nbsp;</label>
		<div class="col-sm-8"> <?=form_dropdown('status', $statuses, get_value($asset, 'status'), 'id="status" class="form-control"');?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="location">Location&nbsp;</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="location" value="<?=get_value($asset,'location');?>"
				id="location-<?=get_value($asset,"id","0");?>" class="location"
			/>
		</div>
	</div>
	<div id="year_removed_block"
		class="form-group <? if(get_value($asset, 'status') == "Active" || get_value($asset, 'status') == "Inactive"){echo "style='display:none'";}?>"
	>

		<label class="col-sm-4 control-label no-wrap" for="year_removed">Year Removed</label>
		<div class="col-sm-8">
			<input type="number" class="form-control year" id="year_removed" name="year_removed" value="<?=get_value($asset,"year_removed");?>" size="5" />
			&nbsp;-&nbsp;
			<input type="text" class="form-control" name="year-removed_next" id="year_removed-next" value="" readonly size=5 />
			<br />

		</div>
	</div>
	<div id="sale_price_block" class="form-group" <?php get_value($asset,"status") != "Sold"?"style='display:none'":""?>>
		<label class="col-sm-4 control-label no-wrap" for="sale_price">Sale Price</label>
		<div class="col-sm-8">
			$
			<input type="text" class="form-control price" id="sale_price" name="sale_price" value="<?php echo get_value($asset,"sale_price");?>" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="po">Purchase Order</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="po" name="po" size="5" value="<?=get_value($asset,"po");?>" />
		</div>
	</div>
	<div class="form-group">
		<input type="hidden" name="ajax" id="ajax" value="1" />
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" class="form-control <?=$action;?> <?=implode(" ",get_button_style($action));?>" value="<?=ucfirst($action);?>" />
		</div>
	</div>
</form>
