<?php
?>
<h2><?php printf("%s %s",$po->first_name, $po->last_name); ?> has requested your approval for a purchase from <?php echo $po->vendor->name;?></h2>
<?php if($note):?>
<p>Purpose: <?php echo $note;?></p>
<?php endif;?>
<p>Please click on the following link to review and approve this purchase order: <?php echo site_url("po/view/$po->po?approval_request=TRUE");?></p>