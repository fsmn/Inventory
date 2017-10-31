<?php
?>
<span id='file-line_<?php echo $file->id?>'>
	<a href='<?php echo base_url("uploads/$file->filename")?>' target="_blank">
<?php echo $file->description?>
</a>
	<span class='button small file_edit' id='file_<?php echo $file->id?>'>Edit</span>
</span>