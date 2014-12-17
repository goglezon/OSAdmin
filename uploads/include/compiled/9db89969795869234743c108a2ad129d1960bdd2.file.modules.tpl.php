<?php /* Smarty version Smarty-3.1.15, created on 2014-07-04 10:21:09
         compiled from "D:\wamp\www\osadmin\uploads\include\template\panel\modules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1684753b60f953000b9-22064126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9db89969795869234743c108a2ad129d1960bdd2' => 
    array (
      0 => 'D:\\wamp\\www\\osadmin\\uploads\\include\\template\\panel\\modules.tpl',
      1 => 1382249386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1684753b60f953000b9-22064126',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'modules' => 0,
    'module' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53b60f9540a952_48195735',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b60f9540a952_48195735')) {function content_53b60f9540a952_48195735($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<div class="btn-toolbar">
	<a href="module_add.php" class="btn btn-primary"><i class="icon-plus"></i> 模块</a>
</div>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">模块列表</a>
	<div id="page-stats" class="block-body collapse in">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>#</th>
				<th>模块名</th>
				<th>模块链接</th>
				<th>排序</th>
				<th>是否在线</th>
				<th>描述</th>
				<th>图标</th>
				<th width="80px">操作</th>
			</tr>
			</thead>
			<tbody>							  
			<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
				 
				<tr>
				 
				<td><?php echo $_smarty_tpl->tpl_vars['module']->value['module_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['module']->value['module_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['module']->value['module_url'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['module']->value['module_sort'];?>
</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['module']->value['online']) {?>
						在线
					<?php } else { ?>
						已下线
					<?php }?>
				</td>
				<td><?php echo $_smarty_tpl->tpl_vars['module']->value['module_desc'];?>
</td>
				<td><i class="<?php echo $_smarty_tpl->tpl_vars['module']->value['module_icon'];?>
"></i></td>
				<td>
				<a href="module.php?module_id=<?php echo $_smarty_tpl->tpl_vars['module']->value['module_id'];?>
" title= "菜单链接列表" ><i class="icon-list-alt"></i></a>
				&nbsp;
				<a href="module_modify.php?module_id=<?php echo $_smarty_tpl->tpl_vars['module']->value['module_id'];?>
" title= "修改" ><i class="icon-pencil"></i></a>
				&nbsp;
				<?php if ($_smarty_tpl->tpl_vars['module']->value['module_id']!=1) {?>
				<a data-toggle="modal" href="#myModal"  title= "删除" ><i class="icon-remove" href="modules.php?method=del&module_id=<?php echo $_smarty_tpl->tpl_vars['module']->value['module_id'];?>
"></i></a>
				<?php }?>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>  
	</div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>

	
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
