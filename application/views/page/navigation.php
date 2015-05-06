<?php defined('BASEPATH') OR exit('No direct script access allowed');

// navigation.php Chris Dart Mar 6, 2015 12:45:16 PM chrisdart@cerebratorium.com

$buttons[] = array("text"=>"Home","href"=>site_url(""),"style"=>"default");
$buttons[] = array("text"=>"Assets","href"=>site_url("asset"),"style"=>"default");
//$buttons[] = array("text"=>"New Asset","href"=>site_url("asset/create"),"style"=>"new","class"=>"create-asset create");
$buttons[] = array("text"=>"POs","href"=>site_url(""),"style"=>"default");
//$buttons[] = array("text"=>"New PO","href"=>site_url("po/create"),"style"=>"new","class"=>"create-po create");
$buttons[] = array("text"=>"Vendors","href"=>site_url("asset"),"style"=>"default");

echo create_toolbar($buttons);