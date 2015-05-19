<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// list.php Chris Dart Mar 24, 2015 4:19:10 PM chrisdart@cerebratorium.com
$grand_total = 0;
?>

<table class="table table-responsive">
	<thead>
		<tr>
			<th>PO</th>
			<th>Vendor</th>
			<th>Date</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
<?foreach($pos as $po): ?>
<tr>
			<td><a href="<?=site_url("po/view/$po->po");?>"><?=$po->po;?></a></td>
			<td><a href="<?=site_url("vendor/view/$po->vendor_id");?>"><?=$po->vendor;?></a>
			</td>
			<td>
<?=format_date($po->po_date);?>
</td>
			<td>
			<?php if(isset($po->total)):?>
<?=get_as_price($po->total);?>
<?php endif; ?>
</td>
		</tr>
		<?php if(isset($po->total)):?>
<? $grand_total += $po->total;?>
<?php  endif; ?>
<? endforeach;?>
</tbody>
	<tfoot>
		<tr>
			<th colspan=3></th>
			<th>
<?=get_as_price($grand_total);?>
</th>
		</tr>
	</tfoot>

</table>