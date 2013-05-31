<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写菜单模块资料</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="">
				<label>模块名称</label>
				<input type="text" name="module_name" value="<{$_POST.module_name}>" class="input-xlarge" >
				<label>模块链接</label>
				<input type="text" name="module_url" value="<{if $_POST.module_url=="" }>/index.php<{else}><{$_POST.module_url}><{/if}>" class="input-xlarge" >
				<label>模块排序数字(数字越小越靠前)</label>
				<input type="text" name="module_sort" value="<{$_POST.module_sort}>" class="input-xlarge" >
				<label>描述</label>
				<textarea name="module_desc" rows="3" class="input-xlarge"><{$_POST.module_desc}></textarea>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
				</div>
			</form>
        </div>
    </div>

<!---操作的确认层，相当于javascript:confirm函数--->
<{$osadmin_action_confirm}>

</div>	

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{ include file="footer.tpl" }>