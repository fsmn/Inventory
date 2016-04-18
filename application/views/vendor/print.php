<?php
if (! empty ( $vendor->contact )) :
	?>
<div><?php echo $vendor->contact;?></div>
<?php endif; ?>
<div> <?php echo $vendor->name; ?></div>
<?php if(!empty($vendor->address)):?>
<div><?php print $vendor->address;?></div>
<div><?php print $vendor->locality;?></div>
<?php endif; ?>
<?php if(!empty($vendor->url)):?>
<div>
<?php echo $vendor->url;?>
</div>
<?php endif; ?>
<?php if(!empty($vendor->phone)):?>
<div>PHONE: <?php print $vendor->phone;?></div>
<?php endif?>
<?php if(!empty($vendor->fax)):?>

<div>FAX: <?php echo $vendor->fax;?></div>
<?php endif; ?>
	<?php if(!empty($vendory->customer_id))?>
<?php if(!empty($vendor->customer_id)) :?>
<div>
	Customer #: <strong><?php echo $vendor->customer_id;?></strong>
</div>
<?php endif; ?>
