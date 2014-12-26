<?php
$lang['friendlyname'] = 'TagCloud';
$lang['postinstall'] = 'Be sure to set "Use TagCloud" permissions to use this module!';
$lang['postuninstall'] = 'Ok, i\'m gone';
$lang['really_uninstall'] = 'Do you really want to uninstall this module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['prefsupdated'] = 'Module preferences updated.';
$lang['submit'] = 'Save';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';

$lang['title_general'] = 'General';

$lang['title_allowed'] = 'List of pattern allowed';
$lang['title_denied'] = 'List of pattern denied';
$lang['title_colors'] = 'List of colors';
$lang['title_min_px'] = 'Min size of the tag';
$lang['title_max_px'] = 'Max size of the tag';
$lang['title_number'] = 'Number of words';

$lang['title_template'] = 'Templates';
$lang['heading_display'] = 'Edit the templates';
$lang['title_display'] = 'Main Template';
$lang['text_display_edit'] = 'Edit the template';

$lang['text_allowed'] = 'It will override the patterns denied. You can add RegEx pattern by surrounding your pattern with the symbol `xx` 
and you can also adding a single word. One word by line. The empty lines are ignored.';
$lang['text_denied'] = 'You can add RegEx pattern by surrounding your pattern with the symbols `xx` 
and you can also adding a single word. One word by line. The empty are ignored. 
For a matter of performance, you should consider to add the word (not the regex pattern) in the excluded words of the module "Search"';
$lang['text_colors'] = 'The list of colors used for the differents word. One color by line. Can be #FFF of rvb(255,0,0) or rvba(255,0,0,13), no matter. 
the first color is used for the smaller size of the tags. the last color is used for the highest size of the tags. The empty lines are ignored';
$lang['text_min_px'] = 'Can be px relative or em relative, no matter. Only the positive numbers are allowed';
$lang['text_max_px'] = 'Can be px relative or em relative, no matter. Only the positive numbers are allowed';
$lang['text_number'] = 'The number of words used to generate the tag cloud. Only the positive numbers are allowed';

$lang['min_px_number'] = 'The field "min size of the tagcan only accept positive number';
$lang['max_px_number'] = 'The field "max size of the tag" can only accept positive number';
$lang['number_number'] = 'The field "number of words" can only accept positive number';

$lang['moddescription'] = 'This module will add a tag cloud on your website.';


$lang['help_module_template'] = 'Will override the template used for the renderer';
$lang['help_module_number'] = 'Will override the number of tag displayed';
$lang['help_module_resultpage'] = 'Allow you to specify the alias of the page where displayed the results when user clicks on a tag. Can be either the alias or the Id of the page';
$lang['help_module_algo'] = 'Let you choose the algorithm of displaying
<ul><li>
 "log" : used by default, it\'s a natural logarithm function.
</li><li> 
 "linear" : the size of a tag will be really proportional to its counter.
</li></ul>
 ';


$lang['changelog'] = '<ul>
<li>Version 1.0.0, Nov 2013 First release</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module will generate a tag cloud with all the words indexed on your website.</p>
<h3>How Do I Use It</h3>
<p>The first step is to add &#123;TagCloud} into your page or your template</p>
<p>You should see a new tag cloud appear on your website. You can play with parameters in the back-office to filtering the results</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/tagcloud/">TagCloud Page</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2013, Kevin Danezis <a href="http://furie.be">&lt;http://furie.be&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
';
?>
