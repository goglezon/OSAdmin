<{if $sidebarStatus=='yes' }> 
  <body id="body" class="body">
  <{else}>
  <body id="body" class="body-fullscreen">
  <{/if}>
  <!--<![endif]-->
<div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
					<{if $sidebarStatus=='yes' }>
						<li class="doSidebarClz"><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">
						关闭侧栏<i class="icon-step-backward"></i>
						</a></li>
					<{else}>
						<li class="doSidebarClz"><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">
						打开侧栏<i class="icon-step-forward"></i>
						</a></li>
					<{/if}>
					 
					<{if $user_info.setting}>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i>设置<i class="icon-caret-down"></i>
						</a>
                        <ul class="dropdown-menu">
                            <li><a href="<{$smarty.const.ADMIN_URL}>/panel/setting.php">系统设置</a></li>
                        </ul>
                    </li>
					<{/if}>
					
					<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
							
                            选择模板
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
							<{foreach from=$osa_templates key=key item=name}>
                            <li><a href="<{$smarty.const.ADMIN_URL}>/panel/set.php?t=<{$key}>"><{$name}></a></li>
							<{/foreach}>
                        </ul>
                    </li>
					
					<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <{$user_info.user_name}>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<{$smarty.const.ADMIN_URL}>/panel/profile.php">我的账号</a></li>
                            <li><a tabindex="-1" href="<{$smarty.const.ADMIN_URL}>/panel/logout.php">登出</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="<{$smarty.const.ADMIN_URL}>/panel/index.php"><span class="first"></span> <span class="second"><{$smarty.const.COMPANY_NAME}></span></a>
        </div>
</div>