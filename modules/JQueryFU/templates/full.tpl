{if !$alreadyCalled}
	<!-- Bootstrap CSS Toolkit styles -->
	<link rel="stylesheet" href="{$path}/css/bootstrap.min.css">
	<!-- Generic page styles -->
	<!-- link rel="stylesheet" href="{$path}/css/style.css" -->
	<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
	<link rel="stylesheet" href="{$path}/css/bootstrap-responsive.min.css">
	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]><link rel="stylesheet" href="{$path}/css/bootstrap-ie6.min.css"><![endif]-->
	<!-- Bootstrap Image Gallery styles -->
	<link rel="stylesheet" href="{$path}/css/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="{$path}/css/jquery.fileupload-ui.css">
	<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
{else}<!-- Librairies was already included -->{/if}

<div class='jqfu_block'>
	<!-- The file upload form used as target for the file upload widget -->
		<form class="fileupload" action="{$path}/server/php/index.php?name={$name}&amp;hash={$hash}" method="POST" enctype="multipart/form-data"
		data-upload-template-id="template-upload_{$unique_id}"
	    data-download-template-id="template-download_{$unique_id}">
		<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		<div class="row fileupload-buttonbar">
			<div class="span7">
				<!-- The fileinput-button span is used to style the file input field as button -->
				<span class="btn btn-success fileinput-button">
					<i class="icon-plus icon-white"></i>
					<span>Add files...</span>
					<input type="file" name="files[]" multiple>
				</span>
				<button type="submit" class="btn btn-primary start">
					<i class="icon-upload icon-white"></i>
					<span>Start upload</span>
				</button>
				<button type="reset" class="btn btn-warning cancel">
					<i class="icon-ban-circle icon-white"></i>
					<span>Cancel upload</span>
				</button>
				<button type="button" class="btn btn-danger delete">
					<i class="icon-trash icon-white"></i>
					<span>Delete</span>
				</button>
				<input type="checkbox" class="toggle">
			</div>
			<!-- The global progress information -->
			<div class="span5 fileupload-progress fade">
				<!-- The global progress bar -->
				<div class="progress progress-success progress-striped active">
					<div class="bar" style="width:0%;"></div>
				</div>
				<!-- The extended global progress information -->
				<div class="progress-extended">&nbsp;</div>
			</div>
		</div>
		<!-- The loading indicator is shown during file processing -->
		<div class="fileupload-loading"></div>
		<br>
		<!-- The table listing the files available for upload/download -->
		<table class="table table-striped"><tbody class="files" data-toggle="modal-gallery_{$unique_id}" data-target="#modal-gallery_{$unique_id}"></tbody></table>
	</form>


	<!-- modal-gallery is the modal dialog used for the image gallery -->
	<div id="modal-gallery_{$unique_id}" class="modal modal-gallery hide fade" data-filter=":odd">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3 class="modal-title"></h3>
		</div>
		<div class="modal-body"><div class="modal-image"></div></div>
		<div class="modal-footer">
			<a class="btn modal-download" target="_blank">
				<i class="icon-download"></i>
				<span>Download</span>
			</a>
			<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
				<i class="icon-play icon-white"></i>
				<span>Slideshow</span>
			</a>
			<a class="btn btn-info modal-prev">
				<i class="icon-arrow-left icon-white"></i>
				<span>Previous</span>
			</a>
			<a class="btn btn-primary modal-next">
				<span>Next</span>
				<i class="icon-arrow-right icon-white"></i>
			</a>
		</div>
	</div>
</div>
{literal}
<!-- The template to display files available for upload -->
<script id="template-upload_{/literal}{$unique_id}{literal}" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download_{/literal}{$unique_id}{literal}" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}{/literal}&amp;name={$name}&amp;hash={$hash}{literal}">
                <i class="icon-trash icon-white"></i>
                <span>{%=locale.fileupload.destroy%}</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>{/literal}

{if !$alreadyCalled}
	<script src="{$path}/js/jquery.min.js"></script> 
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="{$path}/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="{$path}/js/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="{$path}/js/load-image.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="{$path}/js/canvas-to-blob.min.js"></script>
	<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
	<script src="{$path}/js/bootstrap.min.js"></script>
	<script src="{$path}/js/bootstrap-image-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="{$path}/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="{$path}/js/jquery.fileupload.js"></script>
	<!-- The File Upload file processing plugin -->
	<script src="{$path}/js/jquery.fileupload-fp.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="{$path}/js/jquery.fileupload-ui.js"></script>
	<!-- The localization script -->
	<script src="{$path}/js/locale.js"></script>
	<!-- The main application script -->
	<script src="{$path}/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
	<!--[if gte IE 8]><script src="{$path}/js/cors/jquery.xdr-transport.js"></script><![endif]-->
{else}<!-- Librairies was already included -->{/if}