
<input id="fileupload" type="file" name="files[]" data-url="{$path}/server/php/index.php?name={$name}&amp;hash={$hash}" multiple>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="{$path}/js/vendor/jquery.ui.widget.js"></script>
<script src="{$path}/js/jquery.iframe-transport.js"></script>
<script src="{$path}/js/jquery.fileupload.js"></script>
<script>{literal}
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});
</script>{/literal}
