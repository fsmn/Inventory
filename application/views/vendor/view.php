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
<a href='<?php echo $vendor->url; ?>' target='_blank'><?=$url;?></a>
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
<?php if($vendor->type):?>
<label for="attribute type">Type:</label>
<?php $types = ucfirst_array(get_value($vendor,"type",array()));?>
<?php echo implode(", ",$types);?>
<?php endif;?>
<? if($customer_id = get_value($vendor,"customer_id",FALSE)): ?>
<div class="attribute customer-id">
<label for="customer_id">Customer ID: </label>
<?=$customer_id; ?>
</div>
<? endif; ?>
</div>
<?php if($vendor->pos):?>
<div class="order-block">
<h3>Orders</h3>
<? $this->load->view("po/list",array("pos"=>$vendor->pos));?>
</div>
<?php endif;?>
<?php if($vendor->assets):?>
<?php $this->load->view("asset/list",array("assets"=>$vendor->assets));?>
<?php endif; 