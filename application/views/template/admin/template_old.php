<html>
	<head>
		<title><?php echo $site_title; ?></title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('shared/css/html5doctor.css'); ?>" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('shared/css/hartija.css'); ?>" media="print" />
		
		<link rel="stylesheet" href="<?php echo base_url('admin/assets/data-tables/css/jquery.dataTables.min.css'); ?>" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('admin/assets/jquery-timepicker/jquery.timepicker.min.css'); ?>" media="screen" />
		
		<link rel="stylesheet" href="<?php echo base_url('admin/css/jquery-ui.min.css'); ?>" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('admin/css/style.css'); ?>" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('admin/css/style-print.css'); ?>" media="print" />
		<link rel="stylesheet" href="<?php echo base_url('admin/assets/select2/css/select2.css'); ?>" />

		<script type="text/javascript" src="<?php echo base_url('/admin/js/jquery-2.2.3.min.js'); ?>"></script>
		
		<script type="text/javascript" src="<?php echo base_url('admin/assets/data-tables/js/jquery.dataTables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('admin/assets/jquery-timepicker/jquery.timepicker.min.js'); ?>"></script>
		
		<script type="text/javascript">
			var base_url = '<?php echo base_url(); ?>';

		</script>
		<script type="text/javascript" src="<?php echo base_url('admin/assets/select2/js/select2.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/jquery-ui.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/functions.js'); ?>"></script>
		
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
		
		<div id="header">
			<div class="main">
				<div class="wrapper">
					<a href="" onClick="javascript:menuSlide(); return false;" class="nav-menu"></a>
					<a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url('admin/images/logo.png'); ?>" alt="logo"/></a>
				</div>
			</div>
			
			<div class="info no-print">
				<div class="wrapper">
					<?php $inbox = get_instance()->sys_message->count_unread_inbox(get_instance()->sys_user->user_data()->id); ?>
					<a href="<?php echo base_url('index.php/' . get_instance()->sys_user->user_data()->group_name . '/message'); ?>">inbox (<?php echo $inbox > 0 ? '<strong>' . $inbox .'</strong>' : 0; ?>)</a>
					<a href="<?php echo base_url('index.php/' . get_instance()->sys_user->user_data()->group_name . '/security'); ?>">security</a>
					<a href="<?php echo base_url('index.php/router/logout'); ?>" onClick="javascript:return logout();" class="btn">logout</a>
				</div>
			</div>
		</div>
		
		<div id="sidebar" class="no-print">
			
			<div class="profile">
				<div class="info">
					<span class="username"><?php echo ucwords(get_instance()->sys_user->user_data()->name); ?></span><br/>
					<span class="group">as <?php echo get_instance()->sys_user->user_data()->group_name; ?></span>
					<span class="">as <?php echo get_instance()->sys_user->user_data()->id_ledging; ?></span>
				</div>
				
				<a href="<?php echo base_url('index.php/' . get_instance()->sys_user->user_data()->group_name . '/profile'); ?>" class="btn">profile</a>
			</div>
			
		<?php if($enable_menu): ?>
			<?php foreach($menu as $parent):  ?>
			<div class="nav">
				<a class="<?php echo strpos(current_url(), $parent->link) !== false ? 'active' : ''; ?>" href="<?php echo $parent->link; ?>"><span><?php echo $parent->alias; ?></span></a>
				
				<?php if(count($parent->child) > 0): ?>
				<ul class="hav-list">
					<?php foreach($parent->child as $child): ?>
					<li><a href="<?php echo $child->link; ?>"><?php echo $child->alias; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
		
		<div id="content">
			
			<?php if(strlen(strval($this->input->get('notif'))) > 0): ?>
			<div class="notif"><?php echo $this->input->get('notif'); ?></div>
			<?php endif; ?>
				
			<?php foreach($notif as $item): ?>
			<div class="notif"><?php echo $item; ?></div>
			<?php endforeach; ?>
			
			<div class="wrapper">
				<div class="breadcrumb no-print">
					<ul>
						<?php $first = true; foreach($breadcrumb as $item): ?>
							<?php if(!$first): ?><li>&gt;</li><?php endif; ?>
							
							<li><a href="<?php echo $item[1]; ?>"><?php echo ucwords($item[0]); ?></a></li>
						<?php $first = false; endforeach; ?>
					</ul>
				</div>
				
				<div class="content">
					<?php echo count($content) > 0 ? $content[0][1] : '-'; ?>
				</div>
			</div>
			
			<?php if($enable_footer): ?>
			<div id="footer" class="no-print">
				<span><?php echo get_instance()->sys_setting->value('site name'); ?> @ <?php echo get_instance()->sys_setting->value('year'); ?></span>
			</div>
			<?php endif; ?>
		</div>
		
		
		<div id="dialog"></div>
	</body>
</html>