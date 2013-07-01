<div class="sidebar-nav">
		<{foreach from=$sidebar item=module}>
			<{if $module.menu_list|@count neq 0}>
			<a href="#sidebar_menu_<{$module.module_id}>" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i><{$module.module_name}> <i class="icon-chevron-up"></i></a>
			<{if $module.module_id == $current_module_id }>
				<ul id="sidebar_menu_<{$module.module_id}>" class="nav nav-list collapse in">
			<{ else }>
				<ul id="sidebar_menu_<{$module.module_id}>" class="nav nav-list collapse">
			<{ /if }>
				
					<{foreach from=$module.menu_list item=menu_list name=menu_url_list}>
					<li><a href="<{$smarty.const.ADMIN_URL}><{$menu_list.menu_url}>"><{$menu_list.menu_name}></a></li>
					<{/foreach}>
			</ul>
			<{/if}>
			
		<{/foreach}>

        <a target="_blank" href="http://osadmin.org/help" class="nav-header" ><i class="icon-question-sign"></i>帮助</a>
</div>
	
	 <!--- 以上为左侧菜单栏 sidebar --->
	 
<div class="content">
        
        <div class="header">
            <div class="stats">
			<p class="stat"><!--span class="number"></span--></p>
			</div>

            <h1 class="page-title"><{$content_header.menu_name}></h1>
        </div>
        
		<ul class="breadcrumb">
            <li><a href="<{$smarty.const.ADMIN_URL}><{$content_header.module_url}>"> <{$content_header.module_name}> </a> <span class="divider">/</span></li>
           
			<{ if $content_header.father_menu }>
			<li><a href="<{$smarty.const.ADMIN_URL}><{$content_header.father_menu_url}>"> <{$content_header.father_menu_name}> </a> <span class="divider">/</span></li>
			<{ /if}>
			
			<li class="active"><{$content_header.menu_name}></li>
			<{ if $content_header.shortcut_allowed}>
				<{ if $content_header.menu_id|in_array:$user_info.shortcuts_arr}>
					<a title= "移除快捷菜单" href="#"><li class="active"><i class="icon-minus" method="del" url="<{$smarty.const.ADMIN_URL}>/ajax/shortcut.php?menu_id=<{$content_header.menu_id}>"></i></li></a>
				<{ else }>
					<a title= "加入快捷菜单" href="#"><li class="active"><i class="icon-plus" method="add" url="<{$smarty.const.ADMIN_URL}>/ajax/shortcut.php?menu_id=<{$content_header.menu_id}>"></i></li></a>
				<{ /if }>
			<{ /if }>
			
        </ul>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="bb-alert alert alert-info" style="display: none;">
			<span>操作成功</span>
		</div>