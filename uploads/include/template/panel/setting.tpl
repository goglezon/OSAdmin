<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">时区设置</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
			<form id="tab" method="post" action="" autocomplete="off">
				 
				<label>选择时区</label>	
				<{html_options name=new_timezone id="DropDownTimezone" class="input-xlarge" options=$timezone_options selected=$timezone }>
				
				<div class="btn-toolbar">
				<button type="submit" class="btn btn-primary"><i class="icon-save"></i> 保存</button>
				<div class="btn-group"></div>
			</div>
			</form>
		  </div>
  </div>
</div>
</div>
<{include file="footer.tpl" }>