<?php
$buttons[] = array("text"=>"Attach File","class"=>"create inline btn-xs","style"=>"new","id"=>"new-file_$id","href"=>site_url("file/create/$entity_type/$id"));
echo create_button_bar($buttons);?>
<ul class="list-group">
<? foreach($files as $file):?>
<li class="row file-row list-group-item" id="file-row_<?=$id;?>">
<a href="<?php echo base_url("uploads/$file->filename") ?>" target="_blank">
<?=$file->description?>&nbsp;<i class='fa fa-cloud-download'></i>
</a>

<? echo create_button_bar(array(array("text"=>"Delete","style"=>"delete","class"=>"delete-file delete inline btn-xs","id"=>"delete-file_$file->id","href"=>site_url("file/delete/$file->id"))));?>

</li>
<? endforeach;?>
</ul>