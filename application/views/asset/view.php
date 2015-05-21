<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// view.php Chris Dart Mar 17, 2015 2:45:59 PM chrisdart@cerebratorium.com

?>
<h4 class='asset-header' id='asset-header_<?=$asset->id; ?>'>
	<a href="<?php echo site_url("asset/view/$asset->id");?>"
		id='<?=$asset->id?>'>
<?=$asset->product;?>&nbsp;
<?=$asset->version != ''?$asset->version:"";?>
<?=$asset->name!=''?"&nbsp;($asset->name)":""; ?></a>
</h4>
<div>
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
if(!$is_inline && IS_ADMIN){
$buttons [] = array (
		"text" => "Delete",
		"href" => site_url ( "asset/delete" ),
		"id" => sprintf ( "delete-asset_%s", $asset->id ),
		"class" => array (
				"asset-delete",
				"delete",
				implode ( " ", get_button_style ( "delete" ) ) 
		),
);
}
echo create_button_bar ( $buttons );
?>
<div class='asset-details' id='details_<?=$asset->id?>'>

		<p>
			<b>Name:&nbsp;</b>
	<?=$asset->name?>
</p>
		<p>
			<b>Version:&nbsp;</b>
	<?=$asset->version?>
</p>
		<p>
			<b>Type: </b>&nbsp;
	<?=$asset->type?>
</p>
<? if(!empty($asset->serial_number)): ?>
<p>
			<b>Serial Number: </b>&nbsp;
	<?=$asset->serial_number?>
</p>
<? endif; ?>
<p>
			<b>Year:&nbsp;</b>
	<?=$asset->year_acquired;?>
</p>
		<p>
			<b>Source:&nbsp;</b>
	<?=$asset->source;?>
</p>
		<p>

			<b>Status:&nbsp;</b>
	<?=$asset->status?>
	<?
	
	if ($asset->status == "Deacquisitioned" || $asset->status == "Destroyed" || $asset->status == "Stolen") {
		print " in $asset->year_removed";
	}
	?>
</p>
		<p>
			<b>Developer:</b>&nbsp;<a
				href="<?=site_url("vendor/view/$asset->vendor_id"); ?>"><?=$asset->vendor?></a>
		</p>
<? if(get_value($asset,"po")):?>
<p>
			<b>Purchase Order: </b>&nbsp;<a
				href="<?=site_url("po/view/$asset->po");?>"><?=$asset->po;?></a>
		</p>
<? endif; ?>

</div>


	<fieldset class='code-list list'>
		<legend>Codes</legend>
		<div id='codes_<?=$asset->id?>' class="code-rows"><?php
		$data ['asset_id'] = $asset->id;
		$data ['codes'] = $asset->codes;
		$this->load->view ( 'code/list', $data );
		
		?>
</div>
	</fieldset>

	<fieldset class="code-list list">
		<legend>Files</legend>
		<div id='files_<?=$asset->id?>'>
<?php

$data ['asset_id'] = $asset->id;
$data ['files'] = $asset->files;
$this->load->view ( 'file/list', $data );
?>
</div>
	</fieldset>
</div>