<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>游戏结束</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	b {
	background-image: url(/2013warmingup/image/background.jpg);} 
	
	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin-left: auto;
		margin-right: auto;
		padding: 14px 15px 10px 15px;
	}
	
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin-left: auto;
		margin-right: auto;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin-left: auto;
		margin-right: auto;
	}
	
	#footer{
		margin-left: auto;
		margin-right: auto;
		width: 950px;
	}
	
	#container{
		margin-left: auto;
		margin-right: auto;
		font-size: 15px;
		border: 1px solid #D0D0D0;
		width:  720px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	#header{
		margin-left: auto;
		margin-right: auto;
		width: 950px;
	}
	.fontsize{
		font-size:20px;
		font-family:"Microsoft YaHei", Times, serif;
	}
	#menu li { 
		float:left; /* 往左浮动 */
	}
	</style>
</head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/2013warmingup/js/bootstrap.min.js"></script>

	<br/>
	<br/>
	<br/>
<div id="header">
		
	<div id="logo">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	<img src="/2013warmingup/image/logo.png" /></div>
</div>	
	
<body style="background-image:url(/2013warmingup/image/background2.jpg);filter:‘progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
-moz-background-size:100% 100%;
	background-size:100% 100%;">
	
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
		  <ul class="nav" id="menu">
                      <li><a href="#"><font color="white">已登录：<?php echo $cpno ?></font></a></li>
					  <li><a href="#"><font color="white">产品：<?php switch($cptype){
																	case 1: echo "A"; break;
																	case 2: echo "B"; break;
																	case 3: echo "C"; break;
																	default: echo "error!"; break;
																}?></font></a></li>
					  <li><a href="#"><font color="white">游戏进度：已结束</font></a></li>
                    </ul>
        </div>
      </div>
    </div>
	
<div id="container" class="fontsize">	
	<?php echo form_open('home/index/gold'); ?>
		<?php echo $cpno ?>小组,感谢参与游戏，你们最终的资产状况如下：<br/>
		
		
		总资产：<?php echo $total ?>万元 <br/>
		（贷款已强制归还，所有投资已经强制撤回）
		<br />
		<hr />

		资源状况： <br/>
		A：&nbsp<?php echo $anum ?>吨&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		B：&nbsp<?php echo $bnum ?>吨&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		C：&nbsp<?php echo $cnum ?>吨 <br/>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>

<div id="footer"> 
		<img src="/2013warmingup/image/footer.png">
		<p style="text-align:right;"> Honor-produced by ITP &nbsp &nbsp 		浙江大学创新与创业管理强化班 © 2013
		</p>
</div>
</html>