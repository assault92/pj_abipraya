<style>
	#chooser{
		
	}
		#chooser .item{
			width:200px;
			display:inline-block;
			margin: 3px 5px;
			padding:9px 11px;
			border:1px solid #ccc;
			cursor:pointer;
			text-align:center;
		}
		#chooser .item:hover{
			border:1px solid #aaa;
			text-decoration:none;
			
		}
			#chooser .item .color-item{
				width:40px;
				height:40px;
				display:inline-block;
				margin:-3px;
				padding:0;
				border:0;
				border-collapse:collapse;
			}
			#chooser .item .name{
				font-family:"verdana";
				font-size:9pt;
				font-weight:700;
				display:block;
				width:100%;
				text-align:center;
				margin-top:10px;
			}
</style>

<form action="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/theme_roller/choose'); ?>" method="post">
	<input type="hidden" name="theme" />
</form>
	
<label>Please Choose theme:</label>
<br/>
<br/>
<div id="chooser">
	<a class="item" theme-data="default">
		<div class="color">
			<div class="color-item" style="background:#2F3540"></div>
			<div class="color-item" style="background:#666a73"></div>
			<div class="color-item" style="background:#999"></div>
			<div class="color-item" style="background:#f2f2f2"></div>
			<div class="color-item" style="background:#f8f8f8"></div>
		</div>
		
		<span class="name">default (grey)</span>
	</a>
	<?php foreach($this->themes as $theme): ?>
	<a class="item" theme-data="<?php echo $theme[0]; ?>">
		<div class="color">
			<div class="color-item" style="background:<?php echo $theme[1]; ?>"></div>
			<div class="color-item" style="background:<?php echo $theme[2]; ?>"></div>
			<div class="color-item" style="background:<?php echo $theme[3]; ?>"></div>
			<div class="color-item" style="background:<?php echo $theme[4]; ?>"></div>
			<div class="color-item" style="background:<?php echo $theme[5]; ?>"></div>
		</div>
		
		<span class="name"><?php echo ucwords(str_replace('theme ', '', str_replace('-', ' ', $theme[0]))); ?></span>
	</a>
	<?php endforeach; ?>
</div>


<script type="text/javascript">
	
	$(function(){
		var e = $('#chooser .item');
		
		e.mouseover(function(){
			$('body').attr('class', $(this).attr('theme-data'));
		});
		
		e.click(function(){
			$('#content input[name="theme"]').val($(this).attr('theme-data'));
			$('#content form').submit();
		});
	});
	
</script>