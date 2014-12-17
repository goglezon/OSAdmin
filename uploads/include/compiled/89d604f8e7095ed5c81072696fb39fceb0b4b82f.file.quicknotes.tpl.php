<?php /* Smarty version Smarty-3.1.15, created on 2014-07-04 10:18:52
         compiled from "D:\wamp\www\osadmin\uploads\include\template\panel\quicknotes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1124553b60f0c7bc802-96117624%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89d604f8e7095ed5c81072696fb39fceb0b4b82f' => 
    array (
      0 => 'D:\\wamp\\www\\osadmin\\uploads\\include\\template\\panel\\quicknotes.tpl',
      1 => 1382249386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1124553b60f0c7bc802-96117624',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'quicknotes' => 0,
    'note' => 0,
    'user_group' => 0,
    'current_user_id' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53b60f0c8b4299_98732621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b60f0c8b4299_98732621')) {function content_53b60f0c8b4299_98732621($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<div class="btn-toolbar">
	<a href="quicknote_add.php"  class="btn btn-primary"><i class="icon-plus"></i> Quick Note</a>
</div>
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">Quick Note列表</a>
	<div id="page-stats" class="block-body collapse in">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>#</th>
				<th>所有者</th>
				<th>内容</th>
				<th width="80px">操作</th>
			</tr>
			</thead>
			<tbody>							  
			<?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quicknotes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
				 
				<tr>
				 
				<td><?php echo $_smarty_tpl->tpl_vars['note']->value['note_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['note']->value['owner_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['note']->value['note_content'];?>
</td>
				<td>
				<?php if ($_smarty_tpl->tpl_vars['user_group']->value==1||$_smarty_tpl->tpl_vars['note']->value['owner_id']==$_smarty_tpl->tpl_vars['current_user_id']->value) {?>
				<a href="quicknote_modify.php?note_id=<?php echo $_smarty_tpl->tpl_vars['note']->value['note_id'];?>
" title= "修改" ><i class="icon-pencil"></i></a>
				&nbsp;
				<a data-toggle="modal" href="#myModal"  title= "删除" ><i class="icon-remove" href="quicknotes.php?method=del&note_id=<?php echo $_smarty_tpl->tpl_vars['note']->value['note_id'];?>
#myModal" data-toggle="modal" ></i></a>
				<?php }?>
				</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
			<!--- START 分页模板 --->
				
               <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

					
			 <!--- END --->
	</div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>

	
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
