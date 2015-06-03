<?php defined('BASEPATH') OR exit('No direct script access allowed');

// index.php Chris Dart Mar 6, 2015 12:32:10 PM chrisdart@cerebratorium.com
if(!isset($body_classes)){
	$body_classes = array("not_front");
}
if($this->ion_auth->in_group(1)){
	$body_classes[] = "admin";
	$body_classes[] = "editor";
}elseif($this->ion_auth->in_group(array(1,2))){
	$body_classes[] = "editor";
}else{
	$body_classes[] = "viewer";
}

$body_classes[] = $this->uri->segment(1);
if(!isset($title)){
    $window_title = APP_NAME;
}else{
    $window_title = sprintf("%s | %s",$title, APP_NAME);
}
if(!isset($target)){
    $target = "welcome_message";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$window_title;?></title>
<? $this->load->view("page/head");?>

<body class="<?=implode(" ", $body_classes);?>">
<div class="page-wrapper">
<div class="page">
<header class="header">
</header>
<? if($this->ion_auth->logged_in()):?>
<nav>
<? $this->load->view("page/utility");?>
<? $this->load->view("page/navigation");?>
</nav>
<? endif;?>
<? $this->load->view("page/messages"); ?>
<div class="content">
<h1 class="title"><?php echo $title; ?></h1>
<? $this->load->view($target);?>
</div>
<? $this->load->view("page/footer");?>
</div>
</div>
<div id="popup"></div>
</body>
</html>