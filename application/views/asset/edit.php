<?php

?>
<form id="asset_editor" name="asset_editor"
	action="<? echo site_url("asset/$action"); ?>" method="post">
	<input type="hidden" name="kAsset" id="kAsset"
		value="<?=getValue($asset, 'kAsset')?>" /> <input type="hidden"
		name="action" id="action" value="<?=$action?>" />
	<p>
		<label for="product">Product Name&nbsp;</label> <input type="text"
			id="product" name="product" value="<?=getValue($asset, 'product');?>" />
	</p>
	<p>
		<label for="name">Asset Name</label> <input type="text" id="name"
			name="name" value="<?=getValue($asset, 'name');?>" />
	</p>

	<p>
		<label for="version">Version&nbsp;</label> <input type="text"
			id="version" name="version" value="<?=getValue($asset, 'version');?>" />
	</p>

	<p>
		<label for="type">Type&nbsp;</label> <span id='typeField'> <?=form_dropdown('type', $typePairs, getValue($asset, 'type'), 'id="type"');?>
		</span>
	</p>
	<p>
		<label for="serial_number">Serial Number&nbsp;</label> <input
			type="text" name="serial_number"
			value="<?=getValue($asset,'serial_number');?>"
			id="serial_number-<?=getValue($asset,"kAsset","0");?>"
			class="serial_number" />
	</p>
	<p>
		<label for="year_acquired">Year Acquired</label> <span
			id="yearAquiredField"> <input type="text" id="year_acquired"
			name="year_acquired" value="<?=getValue($asset,"year_acquired");?>"
			size="5" />
		</span>
	</p>
	<p>
		<label for="source">Source</label> <span id="sourceField"> <input
			type="text" id="source" name="source"
			value="<?=getValue($asset,"source");?>" />
		</span>
	</p>
	<p>
		<label for="status">Status&nbsp;</label> <span id='statusField'> <?=form_dropdown('status', $statusPairs, getValue($asset, 'status'), 'id="status"');?>
		</span>
	</p>
	<div id="year_removed_block"
	<? if(getValue($asset, 'status') != "Deacquisitioned" && getValue($asset, 'status') != "Destroyed" && getValue($asset, 'status') != "Stolen"){echo "style='display:none'";}?>>
		<label for="year_removed">Year Removed</label> <input type="text"
			id="year_removed" name="year_removed"
			value="<?=getValue($asset,"year_removed");?>" size="5" />
	</div>
	<p>
		<label for="kDeveloper">Developer&nbsp;</label> <span
			id='developerField'> <?=form_dropdown('kDeveloper', $developerPairs, getValue($asset, 'kDeveloper'), 'id="kDeveloper"')?>
		</span>
	</p>
	<p>
	<label for="po">Purchase Order</label>
	<span id="poField"><input
			type="text" id="po" name="po" size="5"
			value="<?=getValue($asset,"po");?>" /></span>
	</p>
	<p>
		<? if($action == "update"){ ?>
		<input type="hidden" name="ajax" id="ajax" value="1" /> <span
			class="button asset_save">Save</span>&nbsp;<span
			class="button delete asset_delete">Delete</span>
		<? }elseif($action == "insert") {?>
		<input type="submit" class="button" value="Add Asset" />
		<? }?>

	</p>
</form>
