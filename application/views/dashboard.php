<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$buttons [] = array(
		"text"=>"Timesheet <i class='fa fa-clock-o'></i>",
		"href"=>site_url("timesheet"),
		"style"=>"default",
);
$buttons[] = array("text"=>"New PO","href"=>site_url("po/create"), "style"=>"new","class"=>"create-po create dialog");
if($this->ion_auth->in_group(1)){
$buttons[] = array("text"=>"New Asset","href"=>site_url("asset/create"), "style"=>"new","class"=>"create-asset create dialog");
}
?>

<? echo create_button_bar($buttons,"toolbar");?>