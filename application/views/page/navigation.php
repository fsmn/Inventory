<?php defined('BASEPATH') OR exit('No direct script access allowed');

// navigation.php Chris Dart Mar 6, 2015 12:45:16 PM chrisdart@cerebratorium.com

$buttons[] = array("text"=>"Home","href"=>site_url(""));
$buttons[] = array("text"=>"Assets","href"=>site_url("asset"));
$buttons[] = array("text"=>"POs","href"=>site_url("po"));

$buttons[] = array("text"=>"Log Out","href"=>site_url("auth/logout"),"type"=>"button","class"=>"btn-warning");
echo create_toolbar($buttons);