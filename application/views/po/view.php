<?php
$order_buttons = array();
$inline_field_class = $order->approved?"readonly":"editable";
if (! $order->approved || $this->ion_auth->get_user_id() == $order->approver) {
	$order_buttons [] = array (
			"text" => "Edit",
			"style" => "edit",
			"class" => "edit-po edit dialog btn-sm",
			"href" => site_url ( "po/edit/$order->id" ) 
	);
}
if(! $order->approved && $this->ion_auth->get_user_id() != $order->approver_id){	
	$order_buttons [] = array (
			"text" => "Request Approval",
			"style" => "new",
			"class" => array (
					"request-approval",
					"dialog",
					"create",
					"btn-sm" 
			),
			"href" => site_url("po/request_approval/$order->id"), 
	);
}

if($this->ion_auth->get_user_id() == $order->approver_id && !$order->approved){
	$order_buttons[] = array(
			"text"=>"Approve",
			"style"=>"notice",
			"class"=>array("grant-approval","btn-sm"),
			"href"=>site_url("po/grant_approval/$order->id"),
	);
}
if(!$order->approved){
$order_buttons [] = array (
		"text" => "Delete Order",
		"style" => "delete",
		"class" => "delete-order delete btn-sm",
		"id" => "delete-po_$order->id",
		"href" => site_url ( "po/delete" ) 
);
}
?>
<? $po_buttons[] = array("text"=>"Print Order","style"=>"print","class"=>"print-order","id"=>"print-order_$order->id", "href"=>site_url("po/view/$order->po?print=1"),"target"=>"_blank");
print create_button_bar($po_buttons);
?>
<div id="page-box">
	<div class="address-row clearfix">
		<div class="left-box">
		<? $this->load->view('po/vendor'); ?>
		</div>
		<div class="right-box">
			<fieldset>
				<legend>Order Details</legend>
				<?=$order_buttons?create_button_bar($order_buttons):""; ?>
				<div id="order-info">
					<ul class="unformatted">
					<li><label for="approved">Is Approved:&nbsp;</label><?php echo $order->approved?"Yes":"No";?></li>
					<?php if($order->approver_id): ?>
					<li><label for="approver">Approver:&nbsp;</label>
					<?php echo $order->approver_id?$order->approver:"";?></li>
					<?php endif;?>
					<?php echo inline_field("po_date",$order,"po",array("label"=>"Order Date","type"=>"date", "envelope"=>"li", "class"=>$inline_field_class));?>
					<?php echo inline_field("method",$order,"po",array("envelope"=>"li","class"=>$inline_field_class));?>
					<?php echo inline_field("payment_type",$order,"po",array("envelope"=>"li","class"=>$inline_field_class));?>
					<li><label for="orderer_id">Ordered By:&nbsp;</label><?=$order->first_name . " " . $order->last_name; ?> 
					</li>
						<li><label for="billing_contact">Billing Contact:&nbsp;</label><?php echo $order->billing_contact;?>
					</li>
					<?php echo inline_field("category",$order,"po",array("envelope"=>"li","class"=>$inline_field_class));?>
					<?php if($order->quote):?>
					<?php echo inline_field("quote",$order,"po",array("envelope"=>"li","class"=>$inline_field_class));?>
					<?php endif; ?>
					</ul>
					<div id='files_<?=$order->id?>' class='rows file-rows'>
					<?php
$data['entity_type'] = "po";
$data ['id'] = $order->id;
$data ['files'] = $order->files;
$this->load->view ( 'file/list', $data );
?>
				</div>

			</fieldset>
		</div>
	</div>
</div>
<div class="items">
<?
if(!$order->approved){
$item_buttons [] = array (
		"text" => "Add Item",
		"style" => "new",
		"class" => "btn-xs add-item create dialog",
		"id" => "add-item_$order->id",
		"href" => site_url ( "item/create/$order->po/$order->id" ) 
);
echo create_button_bar ( $item_buttons, "toolbar" );
}
?>
<div id='item-table'>
<?php $this->load->view('item/table',array("items"=>$order->items, "approved"=>$order->approved));?>
</div>
</div>

<?php if($assets):?>
<a href="<?php echo site_url("asset/po_list/$order->po");?>" title="View ordered assets in service">View the above assets in service</a>


<?php endif;