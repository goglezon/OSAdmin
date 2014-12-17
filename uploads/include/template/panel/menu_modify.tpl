<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写功能资料</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="">
				<label>名称</label>
				<input type="text" name="menu_name" value="<{$menu.menu_name}>" class="input-xlarge" required="true">
				<label>链接 <span class="label label-important">不可重复</span></label>
				<input type="text" name="menu_url" value="<{$menu.menu_url}>" class="input-xlarge" required="true" >
				
				<label>所属模块</label>
				<{if $menu.menu_id >100 }>
				<{html_options name=module_id id="DropDownTimezone" class="input-xlarge" options=$module_options_list selected=$menu.module_id}>
				<{else }>
				<{html_options name=module_id id="DropDownTimezone" class="input-xlarge" options=$module_options_list disabled="true" selected=$menu.module_id}>
				<{/if}>
				<label>是否显示为左侧菜单</label>
				<{html_options name=is_show id="DropDownTimezone" class="input-xlarge" options=$show_options_list selected=$menu.is_show}>
				<label>所属菜单</label>
				<{html_options name=father_menu id="DropDownTimezone" class="input-xlarge" options=$father_menu_options_list selected=$menu.father_menu}>
				<label>是否有效</label>
				<{html_options name=online id="DropDownTimezone" class="input-xlarge" options=$online_options_list selected=$menu.online}>			 
				<label>是否允许快捷菜单 <span class="label label-important">修改/ 删除类链接不允许</span></label>
				<{html_options name=shortcut_allowed id="DropDownTimezone" class="input-xlarge" options=$shortcut_allowed_options_list selected=$menu.shortcut_allowed}>
				<label>描述</label>
				<textarea name="menu_desc" rows="3" class="input-xlarge"><{$menu.menu_desc}></textarea>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
				</div>
			</form>
        </div>
    </div>
</div>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>