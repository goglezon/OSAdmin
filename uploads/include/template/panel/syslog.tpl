<{include file ="header.tpl"}>
<{include file ="navibar.tpl"}>
<{include file ="sidebar.tpl"}>
<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<div style="border:0px;padding-bottom:5px;height:auto">
	<form action="" method="GET" style="margin-bottom:0px">
	<div style="float:left;margin-right:5px">
		<label>请选择操作记录类型</label>
		<{html_options name=class_name id="DropDownTimezone"  options=$class_options selected=$_GET.class_name}> 
	</div>
	<div style="float:left;margin-right:5px">
		<label> 选择起始时间 </label>
		<input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
	</div>
	<div style="float:left;margin-right:5px">
		<label>选择结束时间</label>	
		<input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" > 
	</div>
	<div style="float:left;margin-right:5px">
		<label>用户名，查询所有用户请留空</label>
		<input type="text" name="user_name" value="<{$_GET.user_name}>" placeholder="输入用户名" > 
	</div>
		<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary"><strong>检索</strong></button>
	</div>
	<div style="clear:both;"></div>
	</form>
</div>
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">操作记录</a>
        <div id="page-stats" class="block-body collapse in">
               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:30px">#</th>
					<th style="width:50px">操作员</th>
					<th style="width:35px">行为</th>
					<th style="width:35px">类型</th>
					<th style="width:35px">对象</th>
					<th style="width:250px">操作结果</th>
					<th style="width:100px">操作时间</th>
                </tr>
              </thead>
              <tbody>							  
                <{foreach name=sys_log from=$sys_logs item=sys_log}>
					<tr>
					<td><{$sys_log.op_id}></td>
					<td><{$sys_log.user_name}></td>
					<td><{$sys_log.action}></td>
					<td><{$sys_log.class_name}></td>
					<td><{$sys_log.class_obj}></td>
					<td style = "word-break: break-all; word-wrap:break-word;"><{$sys_log.result}></td>
					<td><{$sys_log.op_time}></td>
					
					</tr>
				<{/foreach}>
              </tbody>
            </table>
				<!--- START 分页模板 --->
               <{$page_html}>
			   <!--- END --->
        </div>
    </div>

<script>
$(function() {
	var date=$( "#start_date" );
	date.datepicker({ dateFormat: "yy-mm-dd" });
	date.datepicker( "option", "firstDay", 1 );
});
$(function() {
	var date=$( "#end_date" );
	date.datepicker({ dateFormat: "yy-mm-dd" });
	date.datepicker( "option", "firstDay", 1 );
});
</script>
	
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
<{include file="footer.tpl" }>