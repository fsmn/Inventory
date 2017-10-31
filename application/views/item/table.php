<?php
if (! isset ( $print )) {
	$print = "FALSE";
}

if (! isset ( $hide_details )) {
	$hide_details = FALSE; // option to hide items like buttons and totals.
}
?>
<table class="item-list list table table-hover table-responsive">
	<thead>
		<tr>
			<th class='count'>CT</th>
			<th class='item-number'>Item#</th>
			<th class='description'>Description</th>
			<th class='category'>Category</th>
			<th class='price currency'>Price</th>
			<th class='total currency'>Total</th>
			<th class="clear"></th>


		</tr>
	</thead>
	<tbody>
		<?php
		
$grand_total = 0;
		foreach ( $items as $item ) :
			$buttons = array ();
			$buttons [] = array (
					"text" => "Edit",
					"style" => "edit",
					"class" => "edit-item edit dialog btn-xs",
					"id" => "edit-item_$item->id",
					"href" => site_url ( "item/edit/$item->id" ) 
			);
			
			$buttons [] = array (
					"text" => "Delete",
					"style" => "delete",
					"class" => "delete-item delete btn-xs",
					"id" => "delete-item_$item->id",
					"href" => site_url ( "item/delete" ) 
			);
			$total = strval ( $item->item_count ) * strval ( $item->price );
			?>
	
		<tr class="list" id="item-row_<?php echo $item->id?>">
			<td><?php echo $item->item_count;?></td>
			<td><?php echo $item->sku;?></td>
			<td><?php echo $item->description;?></td>
			<td><?php echo $item->category;?></td>
			<td style="text-align: right"><?php echo get_as_price($item->price);?></td>
			<td style="text-align: right"><?php echo get_as_price(strval($item->item_count)*strval($item->price));?></td>

			<?php $grand_total += $total;?>

		<td class="clear">
			<?php echo !$print || (!$hide_details && !$approved)?create_button_bar($buttons):""; ?>
		</td>
		</tr>
				<?php endforeach; 	?>
		</tbody>
		<?php if(isset($item) && !$hide_details):?>
		<tfoot>
		<tr>
			<td style="text-align: right" colspan="6">
				Total:
				<span id="total_<?php echo $item->po?>"><?php echo get_as_price($grand_total);?></span>
			</td>
			<td></td>
		</tr>
	</tfoot>
<?php endif;?>
</table>
