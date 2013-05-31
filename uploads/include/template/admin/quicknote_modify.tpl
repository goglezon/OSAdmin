<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<{$osadmin_action_alert}>
<{$osadmin_quick_note}>
    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写quick note</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="">
				<label><span class="label label-info">可输入HTML代码</span></label>
				<textarea name="note_content" rows="3" class="input-xlarge"><{$quicknote.note_content}></textarea>
				
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