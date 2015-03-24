<?php defined('BASEPATH') OR exit('No direct script access allowed');

// navigation.php Chris Dart Mar 24, 2015 4:15:09 PM chrisdart@cerebratorium.com

$buttons[] = array("text"=>"Edit Vendor","style"=>"edit","class"=>"edit-vendor edit btn-sm","id"=>"edit-vendor_$id","href"=>site_url("vendor/edit/$id"));
$buttons[] = array("text"=>"View Orders","style"=>"default","class"=>"view-orders btn-sm","id"=>"view-orders_$id","href"=>site_url("vendor/view/$id"));
$buttons[] = array("text"=>"New Order","style"=>"new","class"=>"new-order create btn-sm","id"=>"new-po_$id","href"=>site_url("po/create/$id"));
echo create_button_bar($buttons);