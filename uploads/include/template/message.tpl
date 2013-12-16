<{include file="simple_header.tpl"}>
  <body class="simple_body">

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
				
				<{if $type =="success" }>
				<h1>Yep!</h1>
				<{elseif $type=="error" }>
				<h1>Oops!</h1>
				<{else }>
				<h1>O~!</h1>
				<{/if }>
				<p class="info"><{$message_detail}></p>
				<h2>返回 <a href="<{$smarty.const.ADMIN_URL}><{$forward_url}>"><{$forward_title}></a></h2>
			</div>
	<div>	
<{include file="footer.tpl"}>


