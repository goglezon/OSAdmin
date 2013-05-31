<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">资料</a></li>
      <li ><a href="#profile" data-toggle="tab">密码</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
			<form id="tab" method="post" action="" autocomplete="off">
				<label>登录名</label>
				<input type="text" name="user_name" value="<{$user_info.user_name}>" class="input-xlarge" readonly="true">
				<label>姓名</label>
				<input type="text" name="real_name" value="<{$user_info.real_name}>" class="input-xlarge">
				<label>手机</label>
				<input type="text" name="mobile" value="<{$user_info.mobile}>" class="input-xlarge">
				<label>邮件</label>
				<input type="text" name="email" value="<{$user_info.email}>" class="input-xlarge">
				<label>描述</label>
				<textarea name="user_desc" value="Smith" rows="3" class="input-xlarge"><{$user_info.user_desc}></textarea>
				<hr />
				<label>显示QuickNote</label>	
				<{html_options name=show_quicknote id="DropDownTimezone" class="input-xlarge" options=$quicknoteOptions selected=$user_info.show_quicknote}>
				
				<div class="btn-toolbar">
				<button type="submit" class="btn btn-primary"><i class="icon-save"></i> 保存</button>
				<div class="btn-group"></div>
			</div>
			</form>
		  </div>
		<div class="tab-pane fade" id="profile">
			<form id="tab2" method="post" action="" autocomplete="off">
				<input type="hidden" name="change_password" value="yes" >
				<label>原密码</label>
				<input type="password" name="old" class="input-xlarge">
				<label>新密码</label>
				<input type="password" name="new" class="input-xlarge">
				<div>
					<button class="btn btn-primary">更新</button>
				</div>
			</form>
		</div>
  </div>
</div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>
</div>
<{ include file="footer.tpl" }>