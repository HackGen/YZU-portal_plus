<!doctype html>
<html>
<head>
	<title>Yzu Market</title>
	<meta charset="utf-8">
	<!--<link rel="stylesheet" href="<?php echo base_url("/statics/css/bootstrap.css"); ?>">-->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="<?php echo base_url("/statics/css/jquery.fileupload-ui.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("/statics/css/page.css"); ?>">
</head>

<body>

<div class="container">	
	<ul class="nav nav-pills nav-justified pos">
		<li class="active"><a href="#all" data-toggle="tab"><span class="glyphicon glyphicon-eye-open"></span> 全部商品</a></li>
		<li><a href="#mine" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> 我的商品</a></li>
		<li><a href="#post" data-toggle="tab"><span class="glyphicon glyphicon-send"></span> 刊登商品</a></li>
		<li><a href="#about" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> 關於市場</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="all">
			<?php include('_all.php'); ?>
		</div>
		<div class="tab-pane" id="mine">
			<?php include('_mine.php'); ?>
		</div>
		<div class="tab-pane" id="post">
			<?php include('_post.php'); ?>
		</div>
		<div class="tab-pane" id="about">
			你好，我好，大家好。
		</div>


	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../statics/js/vendor/jquery.ui.widget.js"></script>
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="../../statics/js/jquery.iframe-transport.js"></script>
<script src="../../statics/js/jquery.fileupload.js"></script>
<script src="../../statics/js/jquery.fileupload-process.js"></script>
<script src="../../statics/js/jquery.fileupload-image.js"></script>
<script src="../../statics/js/jquery.fileupload-audio.js"></script>
<script src="../../statics/js/jquery.fileupload-video.js"></script>
<script src="../../statics/js/jquery.fileupload-validate.js"></script>
<script src="../../statics/js/jquery.fileupload-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url("/statics/js/masonry.pkgd.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/statics/js/script.js"); ?>"></script>

<script>
//this is the application.js file from the example code//
$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();

    // Load existing files:
    $.getJSON($('#fileupload form').prop('action'), function (files) {
        var fu = $('#fileupload').data('fileupload');
        fu._adjustMaxNumberOfFiles(-files.length);
        fu._renderDownload(files)
            .appendTo($('#fileupload .files'))
            .fadeIn(function () {
                // Fix for IE7 and lower:
                $(this).show();
            });
    });

    // Open download dialogs via iframes,
    // to prevent aborting current uploads:
    $('#fileupload .files a:not([target^=_blank])').on('click', function (e) {
        e.preventDefault();
        $('<iframe style="display:none;"></iframe>')
            .prop('src', this.href)
            .appendTo('body');
    });

});
</script>

</body>

</html>