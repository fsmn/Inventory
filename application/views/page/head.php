<?php defined('BASEPATH') OR exit('No direct script access allowed');

// head.php Chris Dart Mar 6, 2015 12:32:16 PM chrisdart@cerebratorium.com

?>
<meta http-equiv="refresh" content = "14400; url=<?php echo site_url("auth/logout");?>">
<link rel="stylesheet" media="all" href="<?=base_url("/css/normalize.css");?>">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" media="screen">

<!-- Bootstrap theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" media="screen">
<!-- FontAwesome -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" media="screen"/>

<!-- Application CSS -->
<link rel="stylesheet" media="all" href="<?=base_url("/css/main.css");?>">
<? if($this->input->get("print") == 1):?>
<link rel="stylesheet" media="all" href="<?=base_url("/css/print.css");?>">
<? endif; ?>
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
var base_url =  "<?=base_url();?>"</script>
<script src="<?=base_url("js/general.js");?>"></script>
</head>