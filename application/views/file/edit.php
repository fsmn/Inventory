<?php
?>
<div class="row code-row new-row" id='file-row-new_<?php echo $entity_id?>'>

<?php echo form_open_multipart("file/attach/$entity_type","class='form-inline'");?>
<input type="hidden" name="entity_id" id="entity_id" value="<?=$entity_id?>" />
	<input type="hidden" name="id" id="id" value="<?=get_value($file,'id');?>" />
	<div class="form-group">
		<label for="description" class="sr-only">Description: </label>
		<input type="text" name="description" id="description" class="form-control" value="<?=get_value($file,'description');?>" placeholder="Description" />
		<label for="userfile" class="sr-only">Attach a File</label>
		<input type="file" name="userfile" class="form-control" size="20" />
		<input type="submit" class='btn btn-default btn-xs' value="Upload" />
	</div>
	<?php echo form_close();?>
</div>