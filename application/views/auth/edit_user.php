<? if(!$ajax): ?>
<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>
<? endif;?>
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

<div class="form-group">
            <?php echo form_label("First Name:", 'first_name');?> <br />
           <?php $first_name['class'] = "form-control";?>
            <?php echo form_input($first_name,array("class"=>"form-control"));?>
      </div>

<div class="form-group">
            <?php echo form_label("Last Name:", 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </div>

<div class="form-group"
            <?php echo form_label("Password:", 'password');?> <br />
            <?php echo form_input($password);?>
      </div>

<div class="form-group"></div>
            <?php echo form_label("Confirm Password:", 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </div>

<?php if ($this->ion_auth->is_admin()): ?>

<h3>Member of Groups</h3>
<?php foreach ($groups as $group):?>
<div class="checkbox">
<label class="checkbox">
              <?php
		$gID = $group ['id'];
		$checked = null;
		$item = null;
		foreach ( $currentGroups as $grp ) {
			if ($gID == $grp->id) {
				$checked = ' checked="checked"';
				break;
			}
		}
		?>
              <input type="checkbox" name="groups[]" class="
	value="<?php echo $group['id'];?>" <?php echo $checked;?>>
              <?php echo $group['name'];?>
              </label>
              </div>
<?php endforeach?>

      <?php endif ?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

<p><?php echo form_submit('submit', "Save User","class='btn default'");?></p>

<?php echo form_close();?>
