<?php
?>
<span id='file-line_<?=$file->id?>'>
	<a href='<?php echo base_url("uploads/$file->filename")?>' target="_blank">
<?=$file->description?>
</a>
	<span class='button small file_edit' id='file_<?=$file->id?>'>Edit</span>
</span>