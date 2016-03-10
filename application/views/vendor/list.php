<?php defined('BASEPATH') or exit('No direct script access allowed');
// list.php Chris Dart Mar 9, 2015 3:57:09 PM chrisdart@cerebratorium.com

?>
<div class="filter">
<input type="text" name="vendor-filter" id="vendor-filter"/>

</div>
<div class="vendor-list">
<? foreach ($vendors as $vendor) :
    ?>
<div class="block vendor-block column">
	<h4><a href="<?=site_url("vendor/view/$vendor->id");?>"><?= $vendor->name; ?></a></h4>
	<?php $this->load->view("vendor/navigation",array("id"=>$vendor->id,"vendor"=>$vendor));?>
	<!--<ul class="list-group">
   <? foreach ($vendor->assets as $asset): ?>
       <li
			class="list-group-item asset-item"
			id="asset-item_<?=$asset->id;?>">
       <?=$asset->product;?><?=$asset->name?sprintf(" (%s)",$asset->name):"";?>
       </li>
    <? endforeach; ?>
        </ul>-->
        
</div>
<? endforeach; ?>
<aside class="details-block float">
</aside>
</div>

<script>
$(document).on("keyup","#vendor-filter",function(){
my_value = $(this).val();
$(".vendor-block").hide();
$("h4 a:contains('" + my_value + "')").parents(".vendor-block").show();
});

</script>