<?php
 echo inline_field ( "year_removed", $asset, "asset", array (
		"label" => " in "
) );
if ($asset->status == "Sold"):
	echo inline_field ( "sale_price", $asset, "asset", array (
			"money" => TRUE,
	) );
endif;

