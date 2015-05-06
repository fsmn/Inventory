<?php

?>

<h3><?=$vendor->name; ?></h3>
 <? $this->load->view("vendor/navigation",array("id"=>$vendor->id)); ?>
<div id="vendor-view">
<? if($contact = get_value($vendor,"contact",FALSE)):?>
<div class="attribute contact"><?=$contact; ?></div>
<? endif; ?>
<? if($address = get_value($vendor,"address",FALSE)): ?>
<div class='attribute address'><?$address;?>
<? if($locality = get_value($vendor,"locality",FALSE)): ?>
<br/><?=$vendor->locality;?>
<? endif; ?>
</div>
<? endif; ?>
<? if($url = get_value($vendor,"url",FALSE)): ?>
<div class="attribute url">
<a href='$vendor->url' target='_blank'><?=$url;?></a>
</div>
<? endif; ?>
<? if($phone = get_value($vendor,"phone",FALSE)): ?>
<div class="attribute phone">
<label for="phone">Phone: </label>
<?=$phone; ?>
</div>
<? endif; ?>
<? if($fax = get_value($vendor,"fax",FALSE)): ?>
<div class="attribute fax">
<label for="fax">Fax: </label>
<?=$fax; ?>
</div>
<? endif; ?>
<? if($customer_id = get_value($vendor,"customer_id",FALSE)): ?>
<div class="attribute customer-id">
<label for="customer_id">Customer ID: </label>
<?=$customer_id; ?>
</div>
<? endif; ?>
</div>
<h3>Orders</h3>
<? $this->load->view("po/list",array("pos"=>$vendor->pos));?>
<div class="asset-block">
<h3>Assets</h3>
<ul class="list-group">
 <? foreach ($vendor->assets as $asset): ?>
       <li
			class="list-group-item asset-item"
			id="asset-item_<?=$asset->id;?>">
       <?=$asset->product;?><?=$asset->name?sprintf(" (%s)",$asset->name):"";?>
       </li>
    <? endforeach; ?>
    </ul>
    </div>
    <aside class="details-block float"></aside>