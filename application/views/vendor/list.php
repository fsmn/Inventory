<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>
<div class="filter">
	<input type="text" name="vendor-filter" id="vendor-filter" placeholder="Case Sensitive!" />

</div>
<div class="vendor-list">
<?php foreach ( $vendors as $vendor ) :?>
<div class="block vendor-block column">
    <span class="hidden vendor-search"><?php echo strtolower($vendor->name);?></span>

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
my_value = $(this).val().toLowerCase();
if(my_value === ''){
    $(".vendor-block").show();
}else{
$(".vendor-block").hide();
$("span.vendor-search:contains('" + my_value + "')").parents(".vendor-block").show();
}
});

</script>