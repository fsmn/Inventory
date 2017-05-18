<?php
?>

<h3><?=$vendor->name; ?></h3>
<? $this->load->view("vendor/navigation",array("id"=>$vendor->id)); ?>
<?php $this->load->view("vendor/details",array("vendor"=>$vendor));?>
<?php if($vendor->type):?>
<label for="attribute type">Type:</label>
<?php $types = ucfirst_array(get_value($vendor,"type",array()));?>
<?php echo implode(", ",$types);?>
<?php endif;?>
<?php if($vendor->pos):?>
<div class="order-block">
	<h3>Orders</h3>
<? $this->load->view("po/list",array("pos"=>$vendor->pos));?>
</div>
<?php endif;?>
<?php if($vendor->assets):?>
<?php $this->load->view("asset/list",array("assets"=>$vendor->assets));?>

<?php endif; 