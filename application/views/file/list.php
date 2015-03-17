<?php
$buttons[] = array("text"=>"Attach File","class"=>"new-asset-file btn-xs","style"=>"new","id"=>"new-asset-file_$asset_id");
echo create_button_bar($buttons,"toolbar");?>
<? foreach($files as $file):?>
<div class="row file-row" id="file-row_<?=$asset_id;?>">
<a href="<?php echo base_url("uploads/$file->filename") ?>" target="_blank">
<?=$file->description?>
</a>
<? echo create_button(array("text"=>"Delete","style"=>"delete","class"=>"delete-file btn-xs","id"=>"delete-file_$file->id"));?>

</div>
<? endforeach;