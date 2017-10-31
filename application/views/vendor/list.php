<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>
<div class="filter">
	<input type="text" name="vendor-filter" id="vendor-filter" />

</div>
<div class="vendor-list">
<?php foreach ( $vendors as $vendor ) :?>
<div class="block vendor-block column">
		<h4>
			<a href="<?php echo site_url("vendor/view/$vendor->id");?>"><?php echo  $vendor->name; ?></a>
		</h4>
	<?php $this->load->view("vendor/navigation",array("id"=>$vendor->id,"vendor"=>$vendor));?>

</div>
<?php endforeach; ?>
<aside class="details-block float"></aside>
</div>

<script>
$(document).on("keyup","#vendor-filter",function(){
my_value = $(this).val();
$(".vendor-block").hide();
$("h4 a:contains('" + my_value + "')").parents(".vendor-block").show();
});

</script>