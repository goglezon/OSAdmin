function listenShortCut(clazz){
	$('.'+clazz).click(function(){
		elem=$(this);
		url = $(this).attr("url");
		method= $(this).attr("method");
		$.getJSON(url+"&method="+method, function(json){
			
			if(json.result){
				$(".bb-alert").find("span").html(json.msg);
				$(".bb-alert").fadeIn();
				
				setTimeout(function(){
					$(".bb-alert").fadeOut();
				},3000);
				setTimeout(function(){
					if(method=="add"){
						elem.attr("method","del")
						elem.attr("class","icon-minus");
					}else if (method=="del"){
						elem.attr("method","add")
						elem.attr("class","icon-plus");
					}
				},3000);
				
			}
		});
	});
}

function alertDismiss(clazz,sec){
	setTimeout(function(){
		$('.'+clazz).fadeOut();
	},sec*1000);
}

function doSidebar(){
	$('.doSidebarClz').click(function(){
		elem=$(this);
		clz =elem.find("a").find("i").attr("class");
		var cookie=$.cookie('sidebarStatus');
		cookie=cookie==null?"yes":cookie;
		//当前侧栏打开，要关闭侧栏
		if(cookie=="yes"){
			$('#sidebar-nav').attr("class","sidebar-nav-hide");
			$('#content').attr("class","content-fullscreen");
			$('#body').attr("class","body-fullscreen");
			elem.find("a").html("打开侧栏<i class=\"icon-step-forward\"></i>");
			$.cookie('sidebarStatus','no');
		}else{
		//当前侧栏关闭，要打开侧栏
			$('#sidebar-nav').attr("class","sidebar-nav");
			$('#content').attr("class","content");
			$('#body').attr("class","body");
			elem.find("a").html("关闭侧栏<i class=\"icon-step-backward\"></i>");
			$.cookie('sidebarStatus','yes');
		}
	});
}