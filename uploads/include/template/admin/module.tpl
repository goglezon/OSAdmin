<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">菜单模块链接列表</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="">
				 <table class="table table-striped">
              <thead>
                <tr>
					<th><input type="checkbox" id="checkAll" >全选</th>
					<th>#</th>
					<th>名称</th>
					<th>URL</th>
					<th>#Module</th>
					<th >菜单</th>
					<th >是否在线</th>
					<th >快捷菜单</th>
					<th>描述</th>
                </tr>
              </thead>
              <tbody>							  
                <{foreach name=menu from=$menus item=menu}>
					 
					<tr>
					 
					<td>
					<{if $menu.menu_id <=100 }>
					<input type="checkbox" name="menu_ids[]" value="<{$menu.menu_id}>" disabled>
					<{else }>
					<input type="checkbox" name="menu_ids[]" value="<{$menu.menu_id}>" >
					<{/if }>
					</td>
					<td><{$menu.menu_id}></td>
					<td><{$menu.menu_name}></td>
					<td><{$menu.menu_url}></td>
					<td><{$menu.module_id}></td>
					<td>
					<{if $menu.is_show}>
						是
					<{else}>
						否
					<{/if}>
					</td>
					<td>
					<{if $menu.online}>
						在线
					<{else}>
						已下线
					<{/if}></td>
					<td>
					<{if $menu.shortcut_allowed}>
						允许
					<{else}>
						不允许
					<{/if}>
					</td>
					<td><{$menu.menu_desc}></td>
					</tr>
				<{/foreach}>
              </tbody>
            </table> 
			<{if $module_id > 1 }>
			<label>选择菜单模块</label>
				<{html_options name=module id="DropDownTimezone" class="input-xlarge" options=$module_options_list selected=0 }>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>修改菜单模块</strong></button>
				</div>
			<{/if }>
			</form>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#checkAll").click(function(){
     if($(this).attr("checked")){
		$("input[name='menu_ids[]']").attr("checked",$(this).attr("checked"));
	 }else{
		$("input[name='menu_ids[]']").attr("checked",false);
	 }
});
</script>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>