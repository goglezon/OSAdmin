<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar">
    <a href="user_add.php"><button class="btn btn-primary"><i class="icon-plus"></i> 账号</button></a>
</div>
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">账号列表</a>
        <div id="page-stats" class="block-body collapse in">

               <table class="table">
              <thead>
                <tr>
					<th style="width:20px">#</th>
					<th style="width:80px">登录名</th>
					<th style="width:100px">姓名</th>
					<th style="width:100px">手机</th>
					<th style="width:80px">邮箱</th>
					<th style="width:80px">登录时间</th>
					<th style="width:80px">登录IP</th>
					<th style="width:80px">Group#</th>
					<th style="width:80px">描述</th>
					<th style="width:80px">操作</th>
                </tr>
              </thead>
              <tbody>							  
                <{foreach name=user from=$user_infos item=user_info}>
					<{if $smarty.foreach.user.index % 2  == 0}>
					<tr>
					<{else}>
					<tr class="odd">
					<{/if}>
					<td><{$user_info.user_id}></td>
					<td><{$user_info.user_name}></td>
					<td><{$user_info.real_name}></td>
					<td><{$user_info.mobile}></td>
					<td><{$user_info.email}></td>
					<td><{$user_info.login_time}></td>
					<td><{$user_info.login_ip}></td>
					<td><{$user_info.group_name}></td>
					<td><{$user_info.user_desc}></td>
					<td>
					<a href="user_modify.php?user_id=<{$user_info.user_id}>" title= "修改" ><i class="icon-pencil"></i></a>
					&nbsp;
					<{if $user_info.status == 1}>
					<a data-toggle="modal" href="#myModal"  title= "封停账号" ><i class="icon-pause" href="users.php?page_no=<{$page_no}>&method=pause&user_id=<{$user_info.user_id}>"></i></a>
					<{ /if }>
					<{if $user_info.status == 0}>
					<a data-toggle="modal" href="#myModal" title= "解封账号" ><i class="icon-play" href="users.php?page_no=<{$page_no}>&method=play&user_id=<{$user_info.user_id}>"></i></a>
					<{ /if }>
					&nbsp;
					<a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="users.php?page_no=<{$page_no}>&method=del&user_id=<{$user_info.user_id}>" ></i></a>
					</td>
					</tr>
				<{/foreach}>
              </tbody>
            </table> 
				<!--- START 分页模板 --->
				
               <{$page_html}>
					
			   <!--- END --->
        </div>
    </div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>


<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<{ include file="footer.tpl" }>