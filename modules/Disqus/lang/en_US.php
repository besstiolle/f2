<?php
$lang['friendlyname'] = 'Disqus. Elevating the discussion';
$lang['postinstall'] = 'Post Install Message, e.g., Be sure to set "Use Disqus" permissions to use this module!';
$lang['postuninstall'] = 'Post Uninstall Message, e.g., "Curses! Foiled Again!"';
$lang['really_uninstall'] = 'Really? You\'re sure you want to uninstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['prefsupdated'] = 'Module preferences updated.';
$lang['submit'] = 'Save';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['shortname_null'] = 'the parameter shortname cannot be null';
$lang['success'] = 'Save with success.';

$lang['moddescription'] = 'This module is a simple wrapper to include Disqus system : http://disqus.com';
$lang['changelog'] = '<ul>
<li>Version 2.0, April 2013, Bess : first release</li>
</ul>';
$lang['help'] = '<h3>How use it?</h3>
<h5>1 - take time to create your own account on Disqus</h5>
<p>It\'s very simple : <a href=\'http://disqus.com\'>http://disqus.com</a></p>
<h5>2 - Add your shortname into the settings of the module Disqus</h5>
<p>you should see a quick presentation of Disqus in action after saving your shortname</p>
<h5>3 - Insert this Tag at the end of the template of CmsMadeSimple</h5>
<p>juste before the html tag &lt;/body&gt;</p>
<pre>{Disqus action=\'counter\'}</pre>
<h5>4 - Insert this Tag where you want add the comments</h5>
<p>The most common use of the plugin is the add of comments into News/CgBlog articles, Simply add this code into the detail\'s template</p>
<pre>{Disqus disqus_identifier=$entry->id}</pre>
<p>you can also try them : </p>
<pre>{$entry->title|cms_escape:htmlall assign=\'title\'}<br/>
{Disqus disqus_identifier=$entry->id disqus_title=$title}</pre>
<pre>{capture name=xxx assign=sid}news_{$entry->id}{/capture}<br/>
{$entry->title|cms_escape:htmlall assign=\'title\'}<br/>
{Disqus disqus_identifier=$sid disqus_title=$title}</pre>
<p>depending on what you want to achieve.</p>
<h5>5 - [optional] Insert this tag where you want adding the counter of comments</h5>
into the summary template, add/change the code bellow : 
<pre>&lt;p class="links"&gt;[{$entry->morelink}]&lt;/p&gt;</pre>
<p> for this one : </p>
<pre>&lt;p class="links"&gt;[{$entry->morelink}] [&lt;a href="{$entry->moreurl}#disqus_thread" title=\'see the comments\' 
 data-disqus-identifier="{$entry->id}"&gt;&nbsp;&lt;/a&gt;]&lt;/p&gt;</pre>
<p>depending on what you have already use for the value of disqus-identifier before, you would use also this code : .</p>
<pre>&lt;p class="links"&gt;[{$entry->morelink}] [&lt;a href="{$entry->moreurl}#disqus_thread" title=\'see the comments\' 
 data-disqus-identifier="news_{$entry->id}"&gt;&nbsp;&lt;/a&gt;]&lt;/p&gt;</pre>
';

$lang['title_d_Shortname_help'] = 'Disqus\'s Shortname';
$lang['title_isPreviewBlocked_help'] = 'enable disqus even in the preview mode (not recommended)';
$lang['title_test'] = 'See the result in the box below';


$lang['help_action'] = '[optional] to display the comments. Can also take another value : "counter" if you want displaying the counters.';

$lang['help_disqus_identifier'] = 'Won\'t work with action=\'counter\'. Will define each identifier for each discussion. Ex for News in the template of detail : 
	<pre>{Disqus disqus_identifier=$entry->id}</pre>
	NB : it could be a good idea to prefixe this number by something like "news_" or "content_" if you want using Disqus with more than a single type of content
	<a href="http://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables#disqus_identifier">See more informations on the Disqus documentation</a>';
$lang['help_disqus_url'] = 'Won\'t work with action=\'counter\'. Will override the default url detected by the script : the url of the page where the comments are displayed. Obiviously it must be a valid url.
	<a href="http://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables#disqus_url">See more informations on the Disqus documentation</a>';
$lang['help_disqus_title'] = 'Won\'t work with action=\'counter\'. Will override the default title detected by the script : the title of the page where the comments are displayed. 
	<a href="http://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables#disqus_title">See more informations on the Disqus documentation</a>';
$lang['help_disqus_category_id'] = 'Won\'t work with action=\'counter\'. Will define the id of the category for Disqus.
	<a href="http://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables#disqus_category_id">See more informations on the Disqus documentation</a>';


?>
