<?php /* Smarty version Smarty-3.1.15, created on 2014-05-22 16:21:35
         compiled from "D:\wamp\www\osadmin\uploads\include\template\panel\menus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24233537db38f443563-89047588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4176103a66d807f7a71878a9eb141ce6913e9723' => 
    array (
      0 => 'D:\\wamp\\www\\osadmin\\uploads\\include\\template\\panel\\menus.tpl',
      1 => 1382249386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24233537db38f443563-89047588',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    '_GET' => 0,
    'module_options_list' => 0,
    'menus' => 0,
    'menu' => 0,
    'page_no' => 0,
    'page_html' => 0,
    'osadmin_action_confirm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_537db38f622624_69401430',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537db38f622624_69401430')) {function content_537db38f622624_69401430($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\osadmin\\uploads\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>


<div class="btn-toolbar"  style="margin-bottom:2px;">
    <a href="menu_add.php"  class="btn btn-primary"><i class="icon-plus"></i> 功能</a>
	<a data-toggle="collapse" data-target="#search"  href="#" title= "检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>
<?php if ($_smarty_tpl->tpl_vars['_GET']->value['search']) {?>
<div id="search" class="collapse in">
<?php } else { ?>
<div id="search" class="collapse out" >
<?php }?>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>选择菜单模块</label>
		<?php echo smarty_function_html_options(array('name'=>'module_id','id'=>"DropDownTimezone",'class'=>"input-xlarge",'options'=>$_smarty_tpl->tpl_vars['module_options_list']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['module_id']),$_smarty_tpl);?>

	</div>
	<div style="float:left;margin-right:5px">
		<label>查询所有请留空</label>
		<input type="text" name="menu_name" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['menu_name'];?>
" placeholder="输入菜单名称" > 
		<input type="hidden" name="search" value="1" >
	</div>
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">功能列表</a>
        <div id="page-stats" class="block-body collapse in">

               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:30px">#</th>
					<th style="width:90px">名称</th>
					<th style="width:180px">URL</th>
					<th style="width:80px">所属模块</th>
					<th style="width:80px">菜单</th>
					<th style="width:80px">所属菜单</th>
					<th style="width:80px">是否在线</th>
					<th style="width:80px">快捷菜单</th>
					<th style="width:180px">描述</th>
					<th style="width:80px">操作</th>
                </tr>
              </thead>
              <tbody>							  
                <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
					 
					<tr>
					 
					<td><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_id'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_url'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['module_options_list']->value[$_smarty_tpl->tpl_vars['menu']->value['module_id']];?>
</td>
					<td>
					<?php if ($_smarty_tpl->tpl_vars['menu']->value['is_show']) {?>
						是
					<?php } else { ?>
						否
					<?php }?>
					</td>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value['father_menu']>0) {?><?php echo $_smarty_tpl->tpl_vars['menu']->value['father_menu_name'];?>
<?php }?></td>
					
					<td>
					<?php if ($_smarty_tpl->tpl_vars['menu']->value['online']) {?>
						在线
					<?php } else { ?>
						已下线
					<?php }?></td>
					<td>
					<?php if ($_smarty_tpl->tpl_vars['menu']->value['shortcut_allowed']) {?>
						允许
					<?php } else { ?>
						不允许
					<?php }?>
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_desc'];?>
</td>
				
					<td>
					<a href="menu_modify.php?menu_id=<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_id'];?>
" title= "修改" ><i class="icon-pencil"></i></a>
					
					<?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_id']>100) {?>
					&nbsp;
					<a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="menus.php?page_no=<?php echo $_smarty_tpl->tpl_vars['page_no']->value;?>
&method=del&menu_id=<?php echo $_smarty_tpl->tpl_vars['menu']->value['menu_id'];?>
" ></i></a>
					<?php }?>
					</td>
					</tr>
				<?php } ?>
              </tbody>
            </table> 
<!--- START 分页模板 --->
               <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

<!--- END 分页--->			   
        </div>
    </div>
	
<!---操作的确认层，相当于javascript:confirm函数--->
<?php echo $_smarty_tpl->tpl_vars['osadmin_action_confirm']->value;?>

	
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
