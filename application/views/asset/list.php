<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h3>Assets</h3>
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