<?php foreach($group->result() as $item): ?>
<a class="btn btn-tab <?php echo $this->group->id == $item->id ? 'active' : ''; ?>" href="<?php echo base_url('index.php/' . $this->sys_user->user_data()->group_name . '/menu_management/index/' . $item->name); ?>"><?php echo $item->name; ?></a>
<?php endforeach; ?>

<?php //var_dump($this->group); ?>
<hr/>

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
			text-transform:capitalize;
		}
		#menu_editor .item > a.menu:hover, #menu_editor .item > a.menu.active{
			background:#999;
		}
			#menu_editor .item > a.menu > span{
				margin-left:15px;
			}
		#menu_editor .item ul{
			margin: 13px 33px;
		}
			#menu_editor .item ul li{
				margin: 3px 0;
			}
				#menu_editor .item ul li a{
					font-family:"verdana";
					font-size:9pt;
					font-weight:200;
					text-decoration:none;
					color:#585555;
				}
				#menu_editor .item ul li a:hover{
					text-decoration:underline;
				}

				#menu_editor .item ul{
					/* display:none; */
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
	<a href="<?php echo base_url('index.php/developer/menu_management/add/' . $this->group->name); ?>" class="btn" onclick="javascript:popup('<?php echo base_url('index.php/developer/menu_management/add/' . $this->group->name); ?>', 'add new', 550, 200);return false;">add new</a>
	<br/>
	<br/>

	<form action="<?php echo base_url('index.php/developer/menu_management/reorder/' . $this->group->name); ?>" method="post">
		<ul class="sorter">
		<?php foreach($q->result() as $parent): ?>
			<li class="item">
				<a class="menu <?php echo false ? 'active' : ''; ?>" href="<?php echo base_url('index.php/developer/menu_management/edit/' . $this->group->name . '/' . $parent->id); ?>" onClick="javascript:_edit(<?php echo $parent->id; ?>, '<?php echo $parent->alias; ?>');return false;"><span><?php echo $parent->alias; ?></span></a>
				<a href="" class="btn" onclick="javascript:_delete(<?php echo $parent->id; ?>, '<?php echo $parent->alias; ?>');return false;">delete</a>
				
				<?php $childs = json_decode($parent->method, true); if(count($childs) > 0): ?>
				<ul class="hav-list">
					<?php foreach($childs as $child): ?>
					<li><?php echo $child[1]; ?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				
				<input type="hidden" name="order[<?php echo $parent->id; ?>]" />
			</li>
		<?php endforeach; ?>
		</ul>
		
		<br/>
		<input type="submit" value="reorder!" class="btn" />
	</form>
<br/>
<span>*click for edit menu / drag for reorder menu</span>
</div>

<div id="menu_editor_form">
	
</div>

<br/>

<script type="text/javascript">
	$(function(){
		$(".sorter").sortable();
		$(".sorter").disableSelection();
	});
	
	function _edit(id, title){
		var url = '<?php echo base_url('index.php/developer/menu_management/edit/' . $this->group->name); ?>/' + id;
		$.get(url, function(d){
			$('#menu_editor_form').html(d);
		});
		
		return false;
	}
	
	function _delete(id, title){
		var url = '<?php echo base_url('index.php/developer/menu_management/del/' . $this->group->name); ?>/' + id;
		if(confirm('Are you sure want to delete "' + title + '"?')){
			window.location = url;
		}
		
		return false;
	}
</script>