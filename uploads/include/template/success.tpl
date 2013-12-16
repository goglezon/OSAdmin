<{include file="simple_header.tpl"}>
  <body> 
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                </ul>
                <a class="brand" href="<{$smarty.const.ADMIN_URL}>/index.php"><span class="first"></span> <span class="second"><{$smarty.const.COMPANY_NAME}></span></a>
        </div>
    </div>
<div>
<div class="container-fluid">	
<div class="row-fluid">
    <div class="http-error">
        <h1>Yep!</h1>
        <p class="info"><{$message_detail}></p> 
		<p><i class="icon-home"></i></p>
        
    </div>
<{include file="footer.tpl"}>