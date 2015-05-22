<?php defined('BASEPATH') OR exit('No direct script access allowed');

// footer.php Chris Dart Mar 6, 2015 2:21:46 PM chrisdart@cerebratorium.com

?>
<footer>
<?php if(isset($is_front)): ?>
<span id="ci-version">
<?="CI Version: v" . CI_VERSION;?>,
</span>
<span class='app-name'><?=APP_NAME;?>: <?=APP_VERSION;?></span>

<?php endif; ?>
</footer>