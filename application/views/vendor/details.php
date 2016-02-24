<?php

?><fieldset><legend><a href="<?=site_url("vendor/view/$vendor->id");?>">
<?php echo get_value($vendor,"name",$vendor->vendor); ?></a>
</legend>
 <?// $this->load->view("vendor/navigation",array("id"=>$vendor->vendor_id)); ?>

<div id="vendor-view">
<? if($contact = get_value($vendor,"contact",FALSE)):?>
<div class="attribute contact"><?=$contact; ?></div>
<? endif; ?>
<? if($address = get_value($vendor,"address",FALSE)): ?>
<div class='attribute address'><?php echo $address;?>
<? if($locality = get_value($vendor,"locality",FALSE)): ?>
<br/><?=$vendor->locality;?>
<? endif; ?>
</div>
<? endif; ?>
<? if($url = get_value($vendor,"url",FALSE)): ?>
<div class="attribute url">
<a href='<?php echo $url; ?>' target='_blank'><?=$url;?></a>
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
<? if($email = get_value($vendor,"email",FALSE)): ?>
<div class="attribute email">
<label for="email">Email: </label>
<a href="mailto:<?php echo $email;?>"><?php echo $email; ?></a>
</div>
<? endif; ?>
<? if($customer_id = get_value($vendor,"customer_id",FALSE)): ?>
<div class="attribute customer-id">
<label for="customer_id">Customer ID: </label>
<?=$customer_id; ?>
</div>
<? endif; ?>
</div>

</fieldset>