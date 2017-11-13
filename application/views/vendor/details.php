<?php
?><fieldset>
	<legend>
		<a href="<?php echo site_url("vendor/view/$vendor->id");?>">
<?php echo get_value($vendor,"name",get_value($vendor,"vendor")); ?></a>
	</legend>
<div id="vendor-view">
<?php if($contact = get_value($vendor,"contact",FALSE)):?>
<div class="attribute contact"><?php echo $contact; ?></div>
<?php endif; ?>
<?php if($address = get_value($vendor,"address",FALSE)): ?>
<div class='attribute address'><?php echo $address;?>
<?php if($locality = get_value($vendor,"locality",FALSE)): ?>
<br /><?php echo $vendor->locality;?>
<?php endif; ?>
</div>
<?php endif; ?>
<?php if($url = get_value($vendor,"url",FALSE)): ?>
<div class="attribute url">
			<a href='<?php echo $url; ?>' target='_blank'><?php echo $url;?></a>
		</div>
<?php endif; ?>
<?php if($phone = get_value($vendor,"phone",FALSE)): ?>
<div class="attribute phone">
			<label for="phone">Phone: </label>
<?php echo $phone; ?>
</div>
<?php endif; ?>
<?php if($fax = get_value($vendor,"fax",FALSE)): ?>
<div class="attribute fax">
			<label for="fax">Fax: </label>
<?php echo $fax; ?>
</div>
<?php endif; ?>
<?php if($email = get_value($vendor,"email",FALSE)): ?>
<div class="attribute email">
			<label for="email">Email: </label>
			<a href="mailto:<?php echo $email;?>"><?php echo $email; ?></a>
		</div>
<?php endif; ?>
<?php if($customer_id = get_value($vendor,"customer_id",FALSE)): ?>
<div class="attribute customer-id">
			<label for="customer_id">Customer ID: </label>
<?php echo $customer_id; ?>
</div>
<?php endif; ?>
</div>

</fieldset>