<?php echo $this->load->view($this->sys_user->user_data()->group_name . '/database/menu', null, true); ?>


<style>
#menu_editor{
	display:inline-block;
	width: 380px;
	margin-bottom:50px;
}
	#menu_editor > ul{
		list-style:none;
	}
	#menu_editor .item{
		margin:0 0 1px 0 !important;
	}
		#menu_editor .item > a.btn{
			display:inline-block;
		}
		#menu_editor .item > a.menu{
			width:236px;
			padding:13px 0;
			display:inline-block;
			vertical-align:middle;
			background:#666a73;
			font-family:"verdana";
			font-size:10pt;
			font-weight:200;
			text-decoration:none;
			color:#fff;
			text-transform:underline;
		}
		#menu_editor .item > a.menu:hover, #menu_editor .item > a.menu.active{
			background:#999;
		}
			#menu_editor .item > a.menu > span{
				margin-left:15px;
			}
		#menu_editor > span{
			font-size:8pt;
		}
		
#menu_editor_form, #menu_editor{
	vertical-align:top;
}
#menu_editor_form{
	display:inline-block;
}
</style>

<div id="menu_editor">
	<label>Database Backup</label>
	<br/>
	<br/>
	
	<ul class="sorter">
	<?php foreach($lists as $file): ?>
		<li class="item">
			<a class="menu" target="_blank" href="<?php echo base_url('uploads/database/' . $file); ?>"><span><?php echo $file; ?></span></a>
			<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/backup_delete?file=' . $file); ?>" class="btn">delete</a>
		</li>
	<?php endforeach; ?>
	</ul>
<br/>
<span>*click for download</span>
</div>


<div id="menu_editor_form">
	<fieldset>
		<legend>create new backup</legend>
		do you want to create new backup now?<br/><br/>
		<a href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/database/?confirm=1'); ?>" class="btn">create new backup</a>
	</fieldset>
</div>