<?php defined('BASEPATH') OR exit('No direct script access allowed');

// navigation.php Chris Dart Mar 24, 2015 4:15:09 PM chrisdart@cerebratorium.com

$buttons[] = array("text"=>"Edit Vendor","style"=>"edit","class"=>"edit-vendor edit dialog btn-sm","id"=>"edit-vendor_$id","href"=>site_url("vendor/edit/$id"));
if(in_array("vendor", explode(",",get_value($vendor,"type",array())))){
	$buttons[] = array("text"=>"New Order","style"=>"new","class"=>"new-order create dialog btn-sm","id"=>"new-po_$id","href"=>site_url("po/create/$id"));
	
}
if(in_array("developer", explode(",",get_value($vendor,"type",array())))){

$buttons[] = array("text"=>"New Asset","style"=>"new","class"=>"new-asset create dialog btn-sm","id"=>"new-po_$id","href"=>site_url("asset/create/$id?vendor_id=$id"));
}

echo create_button_bar($buttons);