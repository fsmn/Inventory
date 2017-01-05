<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// view.php Chris Dart Mar 17, 2015 2:45:59 PM chrisdart@cerebratorium.com
if (! isset ( $inline_edit )) {
	$inline_edit = FALSE;
}
?>

<div class="entity">
<?php
$buttons [] = array (
		"text" => "Edit",
		"href" => site_url ( "asset/edit/$asset->id" ),
		"class" => array (
				"edit",
				"dialog" 
		),
		"style" => "edit" 
);
if ($this->ion_auth->in_group(1)) {
	$buttons [] = array (
			"text" => "Delete",
			"href" => site_url ( "asset/delete" ),
			"id" => sprintf ( "delete-asset_%s", $asset->id ),
			"class" => array (
					"asset-delete",
					"delete",
					implode ( " ", get_button_style ( "delete" ) ) 
			) 
	);
}
if (! $is_inline) {
	echo create_button_bar ( $buttons );
}

?>

<h4 class='asset-header entity-header header' id='asset-header_<?php echo $asset->id; ?>'>
		<a href="<?php echo site_url("asset/view/$asset->id");?>" id='<?php echo $asset->id?>'>
<?php echo $asset->product;?>&nbsp;
<?php echo $asset->version != ''?$asset->version:"";?>
<?php echo $asset->name!=''?"&nbsp;($asset->name)":""; ?></a>
	</h4>
	<div class='asset-details details' id='details_<?php echo $asset->id?>'>
		<p>
			<b>Developer:</b>&nbsp;
			<a href="<?php echo site_url("vendor/view/$asset->vendor_id"); ?>"><?php echo $asset->vendor?></a>
		</p>
	<?php echo inline_field("product",$asset,"asset");?>
	<?php echo inline_field("name",$asset,"asset");?>
	<?php echo inline_field("version",$asset,"asset");?>
	<?php echo inline_field("type",$asset,"asset");?>
		
<? if(!empty($asset->serial_number)): ?>
	<?php echo inline_field("serial_number",$asset,"asset");?>
<? endif; ?>
<?php echo inline_field("year_acquired",$asset,"asset");?>
<?php echo inline_field("source",$asset,"asset");?>
<?php echo inline_field("purchase_price",$asset,"asset",array("money"=>TRUE));?>
<p>
<?php echo inline_field("location",$asset,"asset");?>
</p>
		<p>
<?php echo inline_field("status",$asset,"asset");?>
		
	<? if ($asset->status != "Active" && $asset->status != "Inactive"):?>
  <?php $this->load->view("asset/status", array("asset"=>$asset));?>
  <?php endif;?>
	</p>

<?php if(get_value($asset,"po")):?>

<p>
			<b>Purchase Order: </b>&nbsp;
			<a href="<?php echo site_url("po/view/$asset->po");?>"><?php echo $asset->po;?></a>
		</p>
<? endif; ?>

</div>


	<fieldset class='code-list list'>
		<legend>Codes</legend>
		<div id='codes_<?php echo $asset->id?>' class="rows code-rows"><?php
		$data ['asset_id'] = $asset->id;
		$data ['codes'] = $asset->codes;
		$this->load->view ( 'code/list', $data );
		
		?>
</div>
	</fieldset>

	<fieldset class="code-list list">
		<legend>Files</legend>
		<div id='files_<?php echo $asset->id?>' class='rows file-rows'>
<?php
$data['entity_type'] = "asset";
$data ['id'] = $asset->id;
$data ['files'] = $asset->files;
$this->load->view ( 'file/list', $data );
?>
</div>
	</fieldset>
</div>
