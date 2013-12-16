<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="btn-toolbar"  style="margin-bottom:2px;">
    <a href="menu_add.php"  class="btn btn-primary"><i class="icon-plus"></i> 功能</a>
	<a data-toggle="collapse" data-target="#search"  href="#" title= "检索"><button class="btn btn-primary" style="margin-left:5px"><i class="icon-search"></i></button></a>
</div>
<{if $_GET.search }>
<div id="search" class="collapse in">
<{else }>
<div id="search" class="collapse out" >
<{/if }>
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>选择菜单模块</label>
		<{html_options name=module_id id="DropDownTimezone" class="input-xlarge" options=$module_options_list selected=$_GET.module_id}>
	</div>
	<div style="float:left;margin-right:5px">
		<label>查询所有请留空</label>
		<input type="text" name="menu_name" value="<{$_GET.menu_name}>" placeholder="输入菜单名称" > 
		<input type="hidden" name="search" value="1" >
	</div>
	<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary">检索</button>
	</div>
	<div style="clear:both;"></div>
</form>
</div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">功能列表</a>
        <div id="page-stats" class="block-body collapse in">

               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:30px">#</th>
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
					 
					<tr>
					 
					<td><{$menu.menu_id}></td>
					<td><{$menu.menu_name}></td>
					<td><{$menu.menu_url}></td>
					<td><{$module_options_list[$menu.module_id]}></td>
					<td>
					<{if $menu.is_show}>
						是
					<{else}>
						否
					<{/if}>
					</td>
					<td><{if $menu.father_menu>0}><{$menu.father_menu_name}><{/if}></td>
					
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
				
					<td>
					<a href="menu_modify.php?menu_id=<{$menu.menu_id}>" title= "修改" ><i class="icon-pencil"></i></a>
					
					<{if $menu.menu_id > 100}>
					&nbsp;
					<a data-toggle="modal" href="#myModal" title= "删除" ><i class="icon-remove" href="menus.php?page_no=<{$page_no}>&method=del&menu_id=<{$menu.menu_id}>" ></i></a>
					<{/if }>
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
<{include file="footer.tpl" }>