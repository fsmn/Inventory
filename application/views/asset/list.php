<?php defined('BASEPATH') OR exit('No direct script access allowed');
$header = "Assets";
if(isset($po)){
	$header = sprintf("<a href='%s' title='View the related asset for these assets'>%s for PO# %s</a>",site_url("/po/view/$po"),$header,$po);
}
?>
<h3><?php echo $header;?></h3>
<div class="asset-block">
	<ul class="list-group">
 <? foreach ($assets as $asset): ?>
       <li class=""
			id="asset-item_<?=$asset->id;?>">
			<a href="<?php echo site_url("asset/view/$asset->id");?>" class="view-inline list-group-item asset-item">
       <?=$asset->product;?><?=$asset->name?sprintf(" (%s)",$asset->name):"";?></a>
       </li>
    <? endforeach; ?>
    </ul>
</div>
</div>
<aside class="details-block float"></aside>