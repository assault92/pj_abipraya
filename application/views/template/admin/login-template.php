<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title><?php echo $site_title; ?></title>
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/css/normalize.css'); ?>">    
    <link rel="stylesheet" href="<?php echo base_url('admin/css/login.css'); ?>">    
    <script type="text/javascript" src="<?php echo base_url('/admin/js/prefixfree.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/js/functions.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('shared/js/jquery-1.11.0.min.js'); ?>"></script>
  </head>

  <body>

    <div id="content" class="login">
	   <h1>Login</h1>
	     <div class="wrapper">
		      <div class="content">
			<?php echo count($content) > 0 ? $content[0][1] : '?'; ?>
		</div>
	</div>
	</div>
        <script type="text/javascript" src="<?php echo base_url('/admin/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/admin/js/index.js'); ?>"></script>
  </body>
</html>
