<{include file = "simple_header.tpl"}>
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="<{$smarty.const.ADMIN_URL}>/index.php"><span class="first"></span> <span class="second"><{$smarty.const.COMPANY_NAME}></span></a>
        </div>
    </div>
    
    <div class="row-fluid">	
	
    <div class="dialog">
		<{$osadmin_action_alert}>	
        <div class="block">
            <p class="block-heading">重置数据库？</p>
            <div class="block-body">
                <form name="loginForm" method="post" action="">
                    
                     <label>验证码</label>
					<input type="text" name="verify_code" class="span4" placeholder="输入验证码" autocomplete="off">
					<a href="#"><img title="验证码" id="verify_code" src="<{$smarty.const.ADMIN_URL}>/verify_code_cn.php" style="vertical-align:top"></a>
 
					<input type="submit" class="btn btn-primary pull-right" name="loginSubmit" value="恢复式初始状态"/></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="http://osadmin.org" target="blank"></a></p>
        
    </div>
<script type="text/javascript">
$("#verify_code").click(function(){
	var d = new Date()
	var hour = d.getHours(); 
	var minute = d.getMinutes();
	var sec = d.getSeconds();
    $(this).attr("src","/verify_code_cn.php?"+hour+minute+sec);
});
</script>

<{include file = "footer.tpl"}>


