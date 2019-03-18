<html>
	<head>
		<title><?php echo $site_title; ?></title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
		
		<link rel="stylesheet" href="<?php echo base_url('shared/css/html5doctor.css'); ?>" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('admin/css/style.css'); ?>" media="screen" />
		
		<script type="text/javascript" src="<?php echo base_url('shared/js/jquery-1.11.0.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('admin/js/functions.js'); ?>"></script>
		<script type="text/javascript">
			
		</script>
		
<?php foreach($css_link as $item): ?>
	<link rel="stylesheet" href="<?php echo $item; ?>" media="screen"/>
<?php endforeach; ?>
<?php foreach($css_script as $item): ?>
	<style>
		<?php echo $item; ?>
	</style>
<?php endforeach; ?>
<?php foreach($js_link as $item): ?>
	<script type="text/javascript" src="<?php echo $item; ?>"></script>
<?php endforeach; ?>
<?php foreach($js_script as $item): ?>
	<script type="text/javascript">
		<?php echo $item; ?>
	</script>
<?php endforeach; ?>
	
	</head>
	
	<body class="<?php echo get_instance()->sys_setting->val('admin-theme'); ?>">
		
		<div id="header" class="login">
			<div class="main">
				<div class="wrapper">
					<a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="logo"/></a>
				</div>
			</div>
		</div>
		
		<div id="content" class="login">
			<div class="wrapper">
				<div class="breadcrumb">
					<ul>
						<li><?php echo count($content) > 0 ? $content[0][0] : '-'; ?></li>
					</ul>
				</div>
				
				<div class="content">
					<?php echo count($content) > 0 ? $content[0][1] : '?'; ?>
				</div>
			</div>
			
			<div id="footer">
				<span><?php echo get_instance()->sys_setting->value('site name'); ?> @ <?php echo get_instance()->sys_setting->value('year'); ?></span>
			</div>
		</div>
	</body>
</html>