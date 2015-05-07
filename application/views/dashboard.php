<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$buttons[] = array("text"=>"New PO","href"=>site_url("po/create"), "style"=>"new","class"=>"create-po create");
$buttons[] = array("text"=>"New Asset","href"=>site_url("asset/create"), "style"=>"new","class"=>"create-asset create");
?>

	<h1><?=APP_NAME; ?></h1>
<? echo create_button_bar($buttons,"toolbar");?>
<p>
This is will be a dashboard where you can select tasks or look at statistics.</p>
