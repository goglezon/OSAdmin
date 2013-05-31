<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar">
    <a href="menu_add.php"><button class="btn btn-primary"><i class="icon-plus"></i> 功能</button></a>
</div>
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">功能列表</a>
        <div id="page-stats" class="block-body collapse in">

               <table class="table">
              <thead>
                <tr>
					<th style="width:20px">#</th>
					<th style="width:90px">名称</th>
					<th style="width:180px">URL</th>
					<th style="width:80px">所属模块</th>
					<th style="width:80px">菜单</th>
					<th style="width:80px">所属菜单</th>
					<th style="width:80px">是否在线</th>
					<th style="width:80px">快捷菜单</th>
					<th style="width:180px">描述</th>
					<th style="width:80px">操作</th>
                </tr>
              </thead>
              <tbody>							  
                <{foreach name=menu from=$menus item=menu}>
					<{if $smarty.foreach.menu.index % 2  == 0}>
					<tr>
					<{else}>
					<tr class="odd">
					<{/if}>
					<td><{$menu.menu_id}></td>
					<td><{$menu.menu_name}></td>
					<td><{$menu.menu_url}></td>
					<td><{$module_options_list[$menu.module_id]}></td>
					<td>
					<{ if $menu.is_show}>
						是
					<{else}>
						否
					<{ /if}>
					</td>
					<td><{if $menu.father_menu>0}><{$menu.father_menu_name}><{/if}></td>
					
					<td>
					<{ if $menu.online}>
						在线
					<{else}>
						已下线
					<{ /if}></td>
					<td>
					<{ if $menu.shortcut_allowed}>
						允许
					<{else}>
						不允许
					<{ /if}>
					</td>
					<td><{$menu.menu_desc}></td>
				
					<td>
					<a href="menu_modify.php?menu_id=<{$menu.menu_id}>" title= "修改" ><i class="icon-pencil"></i></a>
					&nbsp;
					<a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="menus.php?page_no=<{$page_no}>&method=del&menu_id=<{$menu.menu_id}>" ></i></a>
					</td>
					</tr>
				<{/foreach}>
              </tbody>
            </table> 
<!--- START 分页模板 --->
               <{$page_html}>
<!--- END 分页--->			   
        </div>
    </div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>
	
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<{ include file="footer.tpl" }>