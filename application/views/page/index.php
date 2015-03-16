<?php defined('BASEPATH') OR exit('No direct script access allowed');

// index.php Chris Dart Mar 6, 2015 12:32:10 PM chrisdart@cerebratorium.com
if(!isset($body_classes)){
    $body_classes = "";
}
if(!isset($title)){
    $title = APP_NAME;
}else{
    $title = sprintf("%s | %s",$title, APP_NAME);
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
<title><?=$title;?></title>
<? $this->load->view("page/head");?>

<body class="<?=$body_classes;?>">
<div class="page-wrapper">
<div class="page">
<header class="header">
</header>
<nav>
<? $this->load->view("page/navigation");?>
</nav>
<? $this->load->view("page/messages"); ?>
<div class="content">
<? $this->load->view($target);?>
</div>
<? $this->load->view("page/footer");?>
</div>
</div>
</body>
</html>