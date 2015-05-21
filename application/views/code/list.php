<?php
$buttons[] = array("text"=>"New Code","class"=>"btn-xs new-code inline dialog","id"=>"new-code_$asset_id","style"=>"new","href"=>site_url("code/create/$asset_id"));
print create_button_bar($buttons,"toolbar");
?>
<? foreach($codes as $code):?>
<?php $this->load->view("code/row",array("code"=>$code));?>
<? endforeach;