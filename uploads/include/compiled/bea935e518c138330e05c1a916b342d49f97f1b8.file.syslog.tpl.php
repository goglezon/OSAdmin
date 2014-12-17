<?php /* Smarty version Smarty-3.1.15, created on 2014-07-04 10:27:05
         compiled from "D:\wamp\www\osadmin\uploads\include\template\panel\syslog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2412453b610f9ac8b47-22729849%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bea935e518c138330e05c1a916b342d49f97f1b8' => 
    array (
      0 => 'D:\\wamp\\www\\osadmin\\uploads\\include\\template\\panel\\syslog.tpl',
      1 => 1382249386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2412453b610f9ac8b47-22729849',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'class_options' => 0,
    '_GET' => 0,
    'sys_logs' => 0,
    'sys_log' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53b610f9bd6801_22767259',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b610f9bd6801_22767259')) {function content_53b610f9bd6801_22767259($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'D:\\wamp\\www\\osadmin\\uploads\\include\\config/../../include/lib/Smarty/plugins\\function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>


<div style="border:0px;padding-bottom:5px;height:auto">
	<form action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>请选择操作记录类型</label>
		<?php echo smarty_function_html_options(array('name'=>'class_name','id'=>"DropDownTimezone",'options'=>$_smarty_tpl->tpl_vars['class_options']->value,'selected'=>$_smarty_tpl->tpl_vars['_GET']->value['class_name']),$_smarty_tpl);?>
 
	</div>
	<div style="float:left;margin-right:5px">
		<label> 选择起始时间 </label>
		<input type="text" id="start_date" name="start_date" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['start_date'];?>
" placeholder="起始时间" >
	</div>
	<div style="float:left;margin-right:5px">
		<label>选择结束时间</label>	
		<input type="text" id="end_date" name="end_date" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['end_date'];?>
" placeholder="结束时间" > 
	</div>
	<div style="float:left;margin-right:5px">
		<label>用户名，查询所有用户请留空</label>
		<input type="text" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['_GET']->value['user_name'];?>
" placeholder="输入用户名" > 
	</div>
		<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary"><strong>检索</strong></button>
	</div>
	<div style="clear:both;"></div>
	</form>
</div>
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">操作记录</a>
        <div id="page-stats" class="block-body collapse in">
               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:30px">#</th>
					<th style="width:50px">操作员</th>
					<th style="width:35px">行为</th>
					<th style="width:35px">类型</th>
					<th style="width:35px">对象</th>
					<th style="width:250px">操作结果</th>
					<th style="width:100px">操作时间</th>
                </tr>
              </thead>
              <tbody>							  
                <?php  $_smarty_tpl->tpl_vars['sys_log'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sys_log']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sys_logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sys_log']->key => $_smarty_tpl->tpl_vars['sys_log']->value) {
$_smarty_tpl->tpl_vars['sys_log']->_loop = true;
?>
					<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['op_id'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['user_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['action'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['class_name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['class_obj'];?>
</td>
					<td style = "word-break: break-all; word-wrap:break-word;"><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['result'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sys_log']->value['op_time'];?>
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

<script>
$(function() {
	var date=$( "#start_date" );
	date.datepicker({ dateFormat: "yy-mm-dd" });
	date.datepicker( "option", "firstDay", 1 );
});
$(function() {
	var date=$( "#end_date" );
	date.datepicker({ dateFormat: "yy-mm-dd" });
	date.datepicker( "option", "firstDay", 1 );
});
</script>
	
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
