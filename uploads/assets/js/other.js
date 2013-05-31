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