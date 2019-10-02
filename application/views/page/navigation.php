<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// navigation.php Chris Dart Mar 6, 2015 12:45:16 PM chrisdart@cerebratorium.com

$buttons [] = array (
		"text" => "Home",
		"href" => site_url ( "" ),
		"style" => "default" 
);

$buttons [] = array (
		"text" => "Timesheet <i class='fa fa-clock-o'></i>",
		"href" => site_url ( "timesheet" ),
		"style" => "default" 
);

if ($this->ion_auth->in_group ( 1 )) {
	$buttons [] = array (
			"text" => "Assets",
			"href" => site_url ( "asset" ),
			"style" => "default" 
	);
}
$buttons [] = array (
		"text" => "POs",
		"href" => site_url ( "po" ),
		"style" => "default" 
);
$buttons [] = array (
		"text" => "Vendors",
		"href" => site_url ( "vendor" ),
		"style" => "default" 
);

$buttons [] = array (
		"text" => "New Vendor",
		"href" => site_url ( "vendor/create" ),
		"style" => "new",
		"class" => "create-vendor create dialog" 
);

$buttons [] = array (
		"text" => "New PO",
		"href" => site_url ( "po/create" ),
		"style" => "new",
		"class" => "create-po create dialog" 
);
if ($this->ion_auth->in_group ( 1 )) {
	$buttons [] = array (
			"text" => "New Asset",
			"href" => site_url ( "asset/create" ),
			"style" => "new",
			"class" => "create-asset create dialog" 
	);
}
echo create_toolbar ( $buttons );