<?php ?>
<div class="dropdown">
<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="caret"></span>
</button>
<ul class="dropdown-menu" aria-labelledby="dLabel" id="field_table">
<?php foreach($menu_items as $item):?>
<li><a href="#"><?php echo $item;?></a></li>
<?php endforeach;?>
</ul>
</div>