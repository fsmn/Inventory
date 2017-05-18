<?php
// Business office notification of approval
?>
<p>This is to notify you that purchase order <?php echo $po->po;?> has been approved.
The purchase may not yet have been made, but <?php printf("%s %s",$po->first_name, $po->last_name); ?>  submitted purchase order e-<?php echo $po->po; ?> to <?php echo $po->approver; ?> for approval. 
<?php echo $po->approver;?> has approved the purchase. You may view the details of this order or print it at <?php echo site_url("po/view/$po->po");?>.</p>