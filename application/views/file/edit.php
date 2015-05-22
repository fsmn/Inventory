<?php
?>
<div class="row code-row new-row" id='file-row-new_<?php echo $asset_id?>'>

<?php echo form_open_multipart("file/attach","class='form-inline'");?>
<input type="hidden" name="asset_id" id="asset_id" value="<?=$asset_id?>" />
	<input type="hidden" name="id" id="id" value="<?=get_value($file,'id');?>" />
	<div class="form-group">
		<label for="description" class="sr-only">Description: </label>
		<input type="text" name="description" id="description" class="form-control" value="<?=get_value($file,'description');?>" placeholder="Description" />
		<label for="userfile" class="sr-only">Attach a File</label>
		<input type="file" name="userfile" class="form-control" size="20" />
		<input type="submit" class='btn btn-default btn-xs' value="Upload" />
	</div>
	</form>
</div>