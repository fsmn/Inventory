<?php
?>
<h2><?php $po->approver; ?>Has Approved Purchase Order: e-<?php echo $po->po;?></h2>
<p>You may view this purchase order at <?php echo site_url("po/view/$po->po");?></p>
<p>NOTE: Please keep this email as official record that the purchase order has been approved.</p>