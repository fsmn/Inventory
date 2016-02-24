<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$approved = -1;
// list.php Chris Dart Mar 24, 2015 4:19:10 PM chrisdart@cerebratorium.com
$grand_total = 0;
?>

<table class="table table-responsive">
	<thead>
		<tr>
			<th>PO</th>
			<th></th>
			<th>Vendor</th>
			<th>Category</th>
			<th>Date</th>
			<th>Approved</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $previous_po = 0;?>
		<? foreach($pos as $po): ?>
		<?php if($po->approved != $approved):?>
		<?php $approved = $po->approved;?>
			<tr><td colspan=7>Status: <?php echo $po->approved?"Approved":"Not Approved"; ?></td></tr>
		<?php endif; ?>
		<?php if($po->po != $previous_po):?>
	
		<?php $previous_po = $po->po;?>
		<tr id="po-row_<?php echo $po->po;?>">
			<td>
				<a href="<?php echo site_url("po/view/$po->po");?>" class="btn btn-default btn-xs"><?php echo $po->po;?></a>
			</td>
			<td>
				<a href="<?php echo site_url("po/details/$po->po");?>" class="po-details">Show Items</a>
			</td>
			<td>
				<a href="<?php echo site_url("vendor/view/$po->vendor_id");?>"><?php echo $po->vendor;?></a>
			</td>
			<td>
				<?php echo $po->category; ?>
			</td>
			<td>
				<?php echo format_date($po->po_date);?>
			</td>
			<td>
			<?php echo $po->approved?"Yes":"No"?>
			</td>
			<td>
				<?php $po->total = 0;?>
				<?php foreach($po->items as $item):?>
				<?php $po->total += $item->total; ?>
				<?php endforeach; ?>
				<?php $details_row = $this->load->view("item/table",array("items"=>$po->items,"hide_details"=>TRUE),TRUE);?>
				<?php if(isset($po->total)):?>
				<?php echo get_as_price($po->total);?>
				<?php endif; ?>
			</td>
		</tr>
		<tr class="details-row" id="details-row_<?php echo $po->po;?>">
			<td>
			</td>
			<td colspan=4>
				<?php echo $details_row;?>
			</td>
		</tr>
		<?php if(isset($po->total)):?>
			<? $grand_total += $po->total;?>
		<?php  endif; ?>
		<?php endif; ?>
		<? endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan=6></th>
			<th>
				<?php echo get_as_price($grand_total);?>
			</th>
		</tr>
	</tfoot>

</table>