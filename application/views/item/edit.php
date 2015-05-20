<?php
$item_count = get_value ( $item, 'item_count', 0 );
$price = get_value ( $item, 'price', 0 );
$total = get_as_price ( strval ( $item_count ) * strval ( $price ) );

?>
<form id="item_editor" class="form-horizontal" action="<?=site_url("item/$action")?>" method="post" name="item_editor">
	<input type="hidden" name="id" id="id" value="<?=get_value($item, 'id')?>"/>
	<input type="hidden" name="po_id" id="po_id" value="<?=get_value($item, 'po_id',$po_id); ?>"/>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="po">PO:&nbsp;<?=$po?>&nbsp;</label>
		<div class="col-sm-8"><input type="text" class="form-control" name="po" id="po" required style="width: 4em" value="<?=get_value($item, 'po', $po);?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="item_count">Count: </label>
		<div class="col-sm-8"><input type="text" class="form-control" name="item_count" id="item_count" required style="width: 3em" value="<?=get_value($item, 'item_count');?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="sku">Item Number:</label>
		<div class="col-sm-8"><input type="text" class="form-control" name="sku" required id="sku" style="width: auto" value="<?=get_value($item, 'sku'); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="description">Description: </label>
		<div class="col-sm-8">
		<textarea id="description" class="form-control" required name="description" style="width: auto; height: 70px; scrollbar: auto"><?=get_value($item, 'description');?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="category">Category: </label>
<?=form_dropdown('category', $categories, get_value($item, 'category'), 'id="category" class="form-control"');?>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="price">Unit Price: $</label>
		<div class="col-sm-8"><input type="text" class="form-control" required name="price" id="price" style="width: 5em" value="<?=get_value($item, 'price')?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="total">Total: </label>
		<div class="col-sm-8"><input type="text" class="form-control" name="total" readonly id="total" style="width: 5em" value="<?=$total?>"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-4"><input type="submit" class="button save_item <?=$action;?> <?=implode(" ",get_button_style($action));?>" value="<?=ucfirst($action);?>" />
		</div>
	</div>
</form>

