<?php defined('BASEPATH') OR exit('No direct script access allowed');

// utility.php Chris Dart Mar 17, 2015 6:34:08 PM chrisdart@cerebratorium.com

$buttons[] = array("text"=>"Log Out","href"=>site_url("auth/logout"),"style"=>"link", "tag"=>"a");
echo create_button_bar($buttons,"toolbar",array("class"=>"utility"));