<?php defined('BASEPATH') OR exit('No direct script access allowed');

// utility.php Chris Dart Mar 17, 2015 6:34:08 PM chrisdart@cerebratorium.com
$user = $this->ion_auth->user()->row();
$buttons[] = array("text"=>sprintf("%s %s", $user->first_name,  $user->last_name),"class"=>array("edit dialog"),"href"=>site_url("auth/edit_user/" . $user->id),"style"=>"link");
if(IS_ADMIN){
		$buttons[] = array("text"=>"Manage Users", "style"=>"link","href"=>site_url("auth") );
}
$buttons[] = array("text"=>"Log Out","href"=>site_url("auth/logout"),"style"=>"link", "tag"=>"a");
echo create_button_bar($buttons,"toolbar",array("class"=>"utility"));