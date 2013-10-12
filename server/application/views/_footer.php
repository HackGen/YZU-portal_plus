
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url("/statics/js/vendor/jquery.ui.widget.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/tmpl.min.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/load-image.min.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/canvas-to-blob.min.js"); ?>"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("/statics/js/jquery.blueimp-gallery.min.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.iframe-transport.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-process.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-image.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-audio.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-video.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-validate.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.fileupload-ui.js"); ?>"></script>
<script src="<?php echo base_url("/statics/jquery.fancybox.pack.js"); ?>"></script>
<script src="<?php echo base_url("/statics/js/jquery.autocomplete.js"); ?>"></script>

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