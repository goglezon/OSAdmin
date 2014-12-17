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
				<input type="text" name="module_name" value="<{$module.module_name}>" class="input-xlarge" required="true" autofocus="true">
				<label>模块链接</label>
				<input type="text" name="module_url" value="<{$module.module_url}>" class="input-xlarge" required="true">
				<label>模块图标</label>
				<div style="width:20px;padding-bottom:5px">
					<a class="icon" style="width:20px;line-height:2em;">
					<i id="icon_preview" class="<{$module.module_icon}>"></i></a>
				</div>
				<input type="text" readonly value="<{$module.module_icon}>" name="module_icon" id="icon_id" style="width:180px" >
				<a id="icon_select" class="btn btn-info" style="vertical-align:top" >更改图标</a>
				<!--- 选择图标层--->			
				<{include file="panel/icon_select.tpl" }>
				<!--- 选择图标层 结束--->
				
				<label>模块排序数字(数字越小越靠前)</label>
				<input type="text" name="module_sort" value="<{$module.module_sort}>" class="input-xlarge" >
				<label>是否有效</label>
				<{if $module.module_id ==1 }>
				<{html_options name=online id="DropDownTimezone" class="input-xlarge" options=$module_online_optioins disabled="true" selected=$module.online}>
				<{else }>
				<{html_options name=online id="DropDownTimezone" class="input-xlarge" options=$module_online_optioins selected=$module.online}>
				<{/if}>
				<label>描述</label>
				<textarea name="module_desc" rows="3" class="input-xlarge"><{$module.module_desc}></textarea>
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
				</div>
			</form>
        </div>
    </div>
</div>
<script>
$('#icon_select').click(function(){			
	$('#myModal').modal({
		backdrop:true,
		keyboard:true,
		show:true
    });	
});

$('.icon').click(function(){
		var obj=$(this);
		$('#icon_preview').removeClass().addClass(obj.text());
		$('#icon_id').val(obj.text());
		$('#myModal').modal('toggle');
});
</script>
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>