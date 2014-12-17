<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- TPLSTART 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="block">
	<a href="#page-stats" class="block-heading" data-toggle="collapse">系统信息</a>
	<div id="page-stats" class="block-body collapse in">
	
	 <table class="table table-striped">
              <tbody>							  
					<tr><td>服务器时间</td><td><{$sys_info.gmt_time}> (格林威治标准时间)</td></tr>
					<tr><td>服务器时间</td><td><{$sys_info.bj_time}> (北京时间)</td></tr>
					<tr><td>服务器ip地址</td><td><{$sys_info.server_ip}></td></tr>
					<tr><td>服务器解译引擎</td><td><{$sys_info.software}></td></tr>
					<tr><td>web服务端口</td><td><{$sys_info.port}></td></tr>
					<tr><td>Mysql 版本</td><td><{$sys_info.mysql_version}></td></tr>
					<tr><td>服务器管理员</td><td><{$sys_info.admin}></td></tr>
					<tr><td>服务端剩余空间</td><td><{$sys_info.diskfree}></td></tr>
					<tr><td>系统当前用户名</td><td><{$sys_info.current_user}></td></tr>
					<tr><td>系统时区</td><td><{$sys_info.timezone}></td></tr>
              </tbody>
     </table>  																		
								 
	</div>
</div>
<!-- TPLEND 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>