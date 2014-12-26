<?php

$lang['title_template'] = 'Templates';
$lang['heading_display'] = 'Edit the templates';
$lang['title_display'] = 'Main Template';
$lang['text_display_edit'] = 'Edit the template';

$lang['help'] = <<<EOT
		<h3>What does this do?</h3>
		<p>This module provides an integration of the great plugin JQuery File Upload into the great Cms Made Simple</p>
		<p>See more on http://blueimp.github.com/jQuery-File-Upload/</p>
		<h3>How do I use it?</h3>
		<p>Write into your content : {JQueryFU} </p>
		<h3>How do I use it ? (Advance usage)</h3>
		<p>You can easily associate this module with FEU and create a different upload platform for each of your user</p>
		<p> Example of code </p>
		<pre style="margin: 5px; background-color: rgb(71, 68, 68); color: rgb(2, 187, 0); padding: 5px;">
			{if \$ccuser->memberof("Admin")}
				{JQueryFU template="full" number=100 accept_file_types='/\.(txt|gif|jpe?g|png|psd|pdf)$/i'}
			{else}
				{JQueryFU template="basic" number=10 accept_file_types='/\.(gif|jpe?g|png)$/i'}
			{/if}
		</pre>
		<h3>How can i activate the client's side resizing ? (Advance usage)</h3>
		<p>JQuery File Upload can resize the big pictures BEFORE starting the uploads. To activate this function, you must modify the file ./modules/JQueryFU/jqfu/js/jquery.fileupload-fp.js and uncomment the code line 42 : </p>
		<pre style="margin: 5px; background-color: rgb(71, 68, 68); color: rgb(2, 187, 0); padding: 5px;">
              process: [
            /*
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1920,
                    maxHeight: 1200,
                    minWidth: 800,
                    minHeight: 600
                },
                {
                    action: 'save'
                }
            */
            ],
		</pre>
		
		<p>to</p>
		
		<pre style="margin: 5px; background-color: rgb(71, 68, 68); color: rgb(2, 187, 0); padding: 5px;">
              process: [
            
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1920,
                    maxHeight: 1200,
                    minWidth: 800,
                    minHeight: 600
                },
                {
                    action: 'save'
                }
            
            ],
		</pre>
		<p> It's very simple but <span style="color:#F00">you must be aware that theses changes will be lost on the next upgrade of my module</span>. I don't have other solution. Sorry for that. BTW If you have a solution, don't hesite to contact me !</p>
EOT;
$lang['help_accept_file_types'] = 'Regex of the files extensions that are allowed. By Default : \'/\.(txt|gif|jpe?g|png)$/i\'';
$lang['help_number'] = 'Number of files that can be in the uploads directory at the same time';
$lang['help_max_width'] = 'The max width for the images uploaded. Exemple : max_width=150';
$lang['help_max_height'] = 'The max_height for the images uploaded. Exemple : max_height=150';
$lang['help_min_width'] = 'The min width for the images uploaded. Exemple : min_width=150. By Default : min_width=0';
$lang['help_min_height'] = 'The min height for the images uploaded. Exemple : min_height=150. By Default : min_height=0';
$lang['help_clean_name'] = 'if true, will replace accents, spaces and other spacials caracters by some more clean';
$lang['help_dir_path'] = 'the directory used to upload files. Be carefull, use "/" or "\" into Unix or Windows system';
$lang['help_dir_url'] = 'the url used to display uploaded files';
$lang['help_template'] = 'The name of the template. Are allowed : "full", "basic" and all the templates into the "/modules/JQueryFU/templates" directory';
$lang['moddescription'] = 'You can easily associate this module with FEU and create a different upload platform for each of your user. You can also simply use it as an open upload platform for your visitors with lot of parameters.';
$lang['postinstall'] = 'Installed with success';
$lang['really_uninstall'] = 'Are you sure ?';
?>