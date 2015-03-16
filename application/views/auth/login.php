<div class="login center-block">
<h2><?=APP_NAME;?></h2>
<p><?php echo lang('login_subheading');?></p>
<? if($message): ?>
<div class="alert alert-warning"><?=$message;?></div>
<? endif; ?>
<?php echo form_open("auth/login");?>

  <p>
    <?php echo form_input($identity,'',"class='form-control input-lg' placeholder='email address'");?>
  </p>

  <p>
    <?php echo form_input($password,'',"class='form-control input-lg' placeholder='password'");?>
  </p>

  <p><?php echo form_submit('submit', "Login", "class='btn btn-default'");?></p>

<?php echo form_close();?>

<p><a style="font-weight:bold;" href="forgot_password">Forgot your password?</a></p>
</div>