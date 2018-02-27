<?php
?>
<form name="po-approval" class="form-inline" method="post" action="<?php echo site_url("po/request_approval");?>">
	<input type="hidden" name="request_form" value="1" />
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<div class="form-group">
		<label for="approver_id">Request Approval from:&nbsp;</label>
<?php echo form_dropdown("approver_id",$approvers);?>
</div>
<div class="form-group">
<label for="message">Message</label>
<input type="text" id="note" name="note" placeholder="Enter a note describing the PO here" style="width:20em"/>
</div>
<div>
	<button type="submit" class="btn btn-default">Submit Request</button>
</div>
</form>