<?php defined('BASEPATH') OR exit('No direct script access allowed');
$header = "Assets";
if(isset($po)){
	$header = sprintf("<a href='%s' title='View the related asset for these assets'>%s for PO# %s</a>",site_url("/po/view/$po"),$header,$po);
}
$current_status = "";
?>
<h3><?php echo $header;?></h3>
<a href="<?php echo $_SERVER['REQUEST_URI']. "&export=true"; ?>" class="btn btn-default">Export <i class="fa fa-download"></i></a>

<div class="asset-block">
	<ul class="list-group">
 <? foreach ($assets as $asset): ?>
 <?php if($current_status !=$asset->status):?>
 <li><h4><?php echo $asset->status;?></h4>
 <?php $current_status = $asset->status;?>
 <?php endif;?>
       <li class=""
			id="asset-item_<?=$asset->id;?>">
			<a href="<?php echo site_url("asset/view/$asset->id");?>" class="view-inline list-group-item asset-item">
       <?=$asset->product;?><?=$asset->name?sprintf(" (%s)",$asset->name):"";?></a>
       </li>
    <? endforeach; ?>
    </ul>
</div>
<aside class="details-block float"></aside>