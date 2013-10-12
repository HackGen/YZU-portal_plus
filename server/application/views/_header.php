<!doctype html>
<html>
<head>
	<title>Yzu Market</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url("/statics/css/blueimp-gallery.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("/statics/css/jquery.fileupload-ui.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("/statics/css/page.css"); ?>">
	<link rel="stylesheet" href='<?php echo base_url("/statics/jquery.fancybox.css"); ?>'>
</head>

<body>
<div class="yzu_nav">
	<ul class="nav nav-pills nav-justified">
		<li><a href="<?php echo base_url().'index.php/market/product/all'; ?>"><span class="glyphicon glyphicon-eye-open"></span> 全部商品</a></li>
		<li><a href="<?php echo base_url().'index.php/market/mine/all'; ?>"><span class="glyphicon glyphicon-user"></span> 我的商品</a></li>
		<li><a href="<?php echo base_url().'index.php/market/post'; ?>"><span class="glyphicon glyphicon-send"></span> 刊登商品</a></li>
	</ul>
</div>
<button type="button" class="btn btn-default col-md-12 yzu_nav_controller pos"><span class="glyphicon glyphicon-arrow-down"></span>Menu</button>
