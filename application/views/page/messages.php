<?php defined('BASEPATH') OR exit('No direct script access allowed');

// alert alert-s.php Chris Dart Mar 6, 2015 12:37:04 PM chrisdart@cerebratorium.com
if(!isset($message)){
    $message = FALSE;
}
// MESSAGE Area
if($this->session->flashdata("warning") ||  $message):?>
<div class="alert alert-warning" id="warning">
<? $message = $message?$message:$this->session->flashdata("warning");?>
<?=$this->session->flashdata("warning");?>
</div>
<? endif; ?>
<? if($this->session->flashdata("success")):?>
<div class="alert alert-success" id="success">
<?=$this->session->flashdata("success");?>
</div>
<? endif; ?>
<? if($this->session->flashdata("info")):?>
<div class="alert alert-info" id="info">
<?=$this->session->flashdata("info");?>
</div>
<? endif; ?>
<? if($this->session->flashdata("danger")):?>
<div class="alert alert-danger" id="danger">
<?=$this->session->flashdata("danger");?>
</div>
<? endif;