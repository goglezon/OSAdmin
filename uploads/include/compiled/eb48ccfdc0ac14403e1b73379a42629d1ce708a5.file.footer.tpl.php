<?php /* Smarty version Smarty-3.1.15, created on 2014-07-04 10:18:34
         compiled from "D:\wamp\www\osadmin\uploads\include\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8752537db38de93020-11067130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb48ccfdc0ac14403e1b73379a42629d1ce708a5' => 
    array (
      0 => 'D:\\wamp\\www\\osadmin\\uploads\\include\\template\\footer.tpl',
      1 => 1402405901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8752537db38de93020-11067130',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_537db38dea78c7_39362322',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537db38dea78c7_39362322')) {function content_537db38dea78c7_39362322($_smarty_tpl) {?>                    
	
					<footer>
                        <hr>
                        <p class="pull-right">A <a href="http://osadmin.org/" target="_blank">Basic Backstage Management System for China Only.</a> by <a href="http://weibo.com/osadmin" target="_blank">SomewhereYu</a>. 安卓应用【<a href="http://app.herobig.com" target="_blank">短信卫士</a>】</p>

                        <p>&copy; 2013 <a href="http://osadmin.org" target="_blank">OSAdmin</a></p>
                    </footer>
				</div>
			</div>
		</div>
    <script src="<?php echo @constant('ADMIN_URL');?>
/assets/lib/bootstrap/js/bootstrap.js"></script>
	
<!--- + -快捷方式的提示 --->
	
<script type="text/javascript">	
	
alertDismiss("alert-success",3);
alertDismiss("alert-info",10);
	
listenShortCut("icon-plus");
listenShortCut("icon-minus");
doSidebar();
</script>
  </body>
</html><?php }} ?>
