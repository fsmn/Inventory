<?php
$buttons[] = array("text"=>"Attach File","class"=>"create inline btn-xs","style"=>"new","id"=>"new-file_$id","href"=>site_url("file/create/$entity_type/$id"));
echo create_button_bar($buttons,"toolbar");?>
<? foreach($files as $file):?>
<div class="row file-row" id="file-row_<?=$id;?>">
<a href="<?php echo base_url("uploads/$file->filename") ?>" target="_blank">
<?=$file->description?>
</a>

<? echo create_button(array("text"=>"Delete","style"=>"delete","class"=>"delete-file delete inline btn-xs","id"=>"delete-file_$file->id","href"=>site_url("file/delete/$file->id")));?>

</div>
<? endforeach;