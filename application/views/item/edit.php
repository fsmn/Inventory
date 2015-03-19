<?php
$item_count = get_value($item, 'item_count', 0);
$price = get_value($item, 'price', 0);
$total = get_as_price(strval($item_count) * strval($price));

?>
<form
	id="item_editor"
	action="<?=site_url("item/$action")?>"
	method="post"
	name="item_editor">
	<input
		type="hidden"
		name="id"
		id="id"
		value="<?=get_value($item, 'id')?>">
		<input
		type="hidden"
		name="po_id"
		id="po_id"
		value="<?=get_value($item, 'po_id',$po_id); ?>">
		<p>
		<label for="po">PO:&nbsp;<?=$po?>&nbsp;</label>
	<input
		type="text"
		name="po"
		id="po"
		required
		style="width: 4em"
		value="<?=get_value($item, 'po', $po);?>">
		</p>
	<p>
		<label for="item_count">Count: </label><input
			type="text"
			name="item_count"
			id="item_count"
			required
			style="width: 3em"
			value="<?=get_value($item, 'item_count');?>">
	</p>
	<p>
		<label for="sku">Item Number:</label><input
			type="text"
			name="sku"
			required
			id="sku"
			style="width: auto"
			value="<?=get_value($item, 'sku'); ?>">
	</p>
	<p>
		<label for="description">Description: </label>
		<textarea
			id="description"
			required
			name="description"
			style="width: auto; height: 70px; scrollbar: auto"><?=get_value($item, 'description');?></textarea>
	</p>
	<p>
		<label for="category">Category: </label> <span class="category-div">
<?=form_dropdown('category', $categories, get_value($item, 'category'), 'id="category"');?>
</span>
	</p>
	<p>
		<label for="price">Unit Price: $</label> <input
			type="text"
			required
			name="price"
			id="price"
			style="width: 5em"
			value="<?=get_value($item, 'price')?>">
	</p>
	<p>
		<label for="total">Total: </label> <input
			type="text"
			name="total"
			readonly
			id="total"
			style="width: 5em"
			value="<?=$total?>">
	</p>
</form>
<p>
	<input
		type="submit"
		class="button save_item <?=$action;?> <?=implode(" ",get_button_style($action));?>"
		value="<?=ucfirst($action);?>" />
</p>
