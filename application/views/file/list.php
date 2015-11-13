<?php
$buttons[] = array("text"=>"Attach File","class"=>"create inline btn-xs","style"=>"new","id"=>"new-file_$id","href"=>site_url("file/create/$entity_type/$id"));
echo create_button_bar($buttons);?>
<p></p>
<div class="btn-group rows file-rows" id="files_<?echo $id;?>">
<? foreach($files as $file):?>
<div class="file-row"  id="file-row_<?=$file->id;?>">
  <button type="button" class="btn btn-default dropdown-toggle row" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="download <?php echo $file->filename;?>">
    <?php echo "$file->description"?> <i class="fa fa-file-pdf-o"></i> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo base_url("uploads/$file->filename");?>" target="_blank">Download <i class="fa fa-download"></i></a></li>
        <li role="separator" class="divider"></li>
    <li><a href="<?php echo site_url("file/delete/$file->id");?>" id="delete-file_<?php echo $file->id;?>" class="delete-file delete inline">Delete <i class="fa fa-exclamation-triangle"></i></a></li>
  </ul>
  </div>
  <?php endforeach;?>
</div>