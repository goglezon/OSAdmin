<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
<select name="group_id" onchange="javascript:location.replace('group_role.php?group_id='+this.options[this.selectedIndex].value)" style="margin:5px 0px 0px">
	<{html_options options=$group_option_list selected=$group_id}>
</select>
<form method="post" action="">
<{foreach from=$role_list item=role}>
	<{if count($role.menu_info) >0 }>
		<div class="block">
			<a href="#page-stats_<{$role.module_id}>" class="block-heading" data-toggle="collapse"><{$role.module_name}></a>
			<div id="page-stats_<{$role.module_id}>" class="block-body collapse in">
			<{html_checkboxes name="menu_ids"  options=$role.menu_info checked=$group_role separator="&nbsp;&nbsp;" labels="1"  }>						
			</div>
		</div>
	<{/if }>
<{/foreach}>											
	<div>
		<button class="btn btn-primary">更新</button>
	</div>
</form>

<{include file="footer.tpl" }>