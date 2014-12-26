<?php
$lang['modulename'] = 'Download Counter';
$lang['help'] = "
<h3>What does this do?</h3>
<p>The Download Counter module is a very simple tag module. It's used to add download counters or click counters to files or links you present on your page.
This module does not depend on Uploads, nor any other module. You can use it for any file you want, no matter which way it has been uploaded to the server. Even better: you can use it for <b>any link</b> to your site pointing to your site or at another site to count how many times it has been clicked!
</p>

<h3>How to use it?</h3>
<p>Download counter is just a tag module. It's inserted into your page or template by using the cms_module tag. Example syntax would be:<br />


<p>
	<b>To generate the url into 'counter_temp_id' var : </b>
	<code>{DownCnt name='counter_name' link='www.mywebsite.com' assign='counter_temp_id'}</code>
</p>
<p>
	<b>To displaying the url in your page : </b>
	<code>{&#36;counter_temp_id}</code>
</p>
<p>
	<b>To generate a HTML link : </b>
	<code>&lt;a href='{&#36;counter_temp_id}'&gt;lot of text&lt;/a&gt;</code>
</p>
<p>
	<b>for displaying the counter value. : </b>
	<code>(DownCnt name='counter_name' action='display'}</code>
</p>

<p>Make sure to set the 'Manage Download Counters' permission on users who will be administrating the counters.</p>


<h3>Parameters</h3>
<ul>
<li><i>action</i> - action to be taken in the current tag. The possible values are:
  <ul>
    <li><i>default</i> - this tag will perform counting; to make it working it should be placed instead of the target address of the &lt;a&gt; html tag (for example: &lt;a href='{DownCnt ...)'; <i>name</i> and <i>link</i> parameters are required for this action; <i>protocol</i> is requiered if you want external link</li>
    <li><i>display</i> - this tag will only display the counter for given name; <i>name</i> parameter is required for this action;</li>
  </ul>
<li><i>name</i> - name of the counter to be used; the name may be anything you want (the file name for example), but it should be unique across the CMS installation; the name is an identifier by which the module distinguishes separate counters; the name cannot be longer than 255 characters!</li>
<li><i>link</i> - required only if <i>action</i>='default'; put here the link to the target resource - the link that otherwise would be used as href of the &lt;a&gt; html tag; the path is relative to the CMS MS installation directory. For external links you musn't include <b>http://</b> but you must add the <b>param protocol</b>.</li>
</ul>
<br/>
<p>To display the counter of a link after the actual link the tag must be used twice - first with default <i>action</i> (the <i>action</i> parameter may be omitted in this case), and second with <i>action</i>='display', and the same <i>name</i> must be set in both tags.</p>

<h3>Examples</h3>
<h4>Creating link to a site or downloadable file that will count clicks:</h4>
<p>If your link looks like<br />
<br />
<code>
&lt;a href='downloads/the_file.zip'&gt;download this file&lt;/a&gt;<br />
&lt;a href='http://somesite.com'&gt;go to the site&lt;/a&gt;<br />
&lt;a href='www.somesite.com/sub/contact.html'&gt;go to the site&lt;/a&gt;<br />
&lt;a href='ftp://sub.somesite.com'&gt;see my ftp file&lt;/a&gt;</code><br />

<p>to make the link counting clicks, you will have to write :</p>

<code>
	{DownCnt name='the_file' link='/downloads/the_file.zip' assign='smarty_var1'}<br />
	{DownCnt name='site_1' link='http://somesite.com' assign='smarty_var2'}<br />
	{DownCnt name='site_2' link='www.somesite.com/sub/contact.html' assign='smarty_var3'}<br />
	{DownCnt name='site_3' link='ftp://sub.somesite.com' assign='smarty_var4'}<br />

	&lt;a href='{&#36;smarty_var1}'&gt;download this file&lt;/a&gt;<br />
	&lt;a href='{&#36;smarty_var2}'&gt;go to the site&lt;/a&gt;<br />
	&lt;a href='{&#36;smarty_var3}'&gt;go to the site&lt;/a&gt;<br />
	&lt;a href='{&#36;smarty_var4}'&gt;see my ftp file&lt;/a&gt;
</code>

<p>Note that you can easily use your WYSIWYG for make a link, simply write {&#36;var4} into the url<br/>
Other &lt;A&gt; tag parameters, like target or class or id, can be used freely.</p>

<p>Since the version 2.3.0 you can create your counters in the back-office (it's harcoded links) and use them in your website like this : </p>

<code>
	{DownCnt sid='the_unique_name' assign='another_smarty_var'}<br />
	
	&lt;a href='{&#36;another_smarty_var}'&gt;download this file&lt;/a&gt;
</code>

<h4>Displaying the clicks counter:</h4>
<p>Regardless whether the link leads to a site or a file, there is only one method to display its counter. This is:<br />
<br />
<code>
	{DownCnt action='display' name='the_file'}<br />
	{DownCnt action='display' name='the_unique_name'}

</code><br />
<br />
In the <i>name</i> parameter you must specify the name used for the appropriate tag in the link.<br />
This tag will dislpay a plain integer value of the counter. You can enclose it with any tags you want to alter its appearance.<br />
If the link has never been clicked (its counter does not exist yet) the tag will display zero.</p>

<h4>Regroup your counters under Tags</h4>

<p>Since the version 2.2.0 you can create Tags. After that operation you will be allowed to regroup your counters under one or many Tags</p>
<p>The Tags system is used for the statistics</p>

<h4>Enjoy the statistics</h4>
<p>Since the version 2.3.0 you can generate statistics, just enjoy it. If you have question about it : send an email to bess : contact at furie.be</p>

<h3>The admin part</h3>
<p>You can manage already existing counters from the admin area of the CMSMS. Go to Content menu and choose Download Counter.</p>
<p>If you want to reset a counter to zero, simply delete it. It will be recreated automatically the next time the link is clicked.</p>
<p>The <i>Active</i> tells if the counter should be incremented or not. If a counter is disabled (not active) the link will still work and its value can be displayed, it just won't increase the counter value when clicked.</p>
";
$lang['changeLog'] = '
<ul>
	<li>
		2.3.x 
		<ul>
			<li>ADD : You can create unique link in the backoffice and use them on the front-office like this : {DownCnt sid="mylink"}</li>
			<li>ADD : You can see your statistics in the back-office</li>
			<li>FIX : bug with a fresh install 2.2.0</li>
		</ul>
	</li>
	<li>
		2.2.x 
		<ul>
			<li>ADD : You can group the counter with differents tags</li>
		</ul>
	</li>
	<li>
		2.1.x 
		<ul>
			<li>ADD : New inner security system</li>
			<li>ADD : All the click are now saved in database for futures stats</li>
		</ul>
	</li>
	<li>
		2.0.0: new big version, CmsMadeSimple 1.6.7 to 1.10.x approved!
		<ul>
			<li>REMOVE : param protocol</li>
			<li></li>
			<li>ADD : adding the parameter "assign" which allows you to set the url into a smarty var</li>
			<li>ADD : greater security</li>
			<li></li>
			<li>UPDATE : Update documentation</li>
		</ul>
	</li>
</ul>

';
$lang['description'] = 'The Download Counter module allows you to count downloads of files you make available for downloading from your site.';
$lang['postinstall'] = "Don't forget to make sure to set the <b>'Manage Download Counters' permission</b> on users who will be administering the counters.<br />
See the help for usage information.";
$lang['pre_uninstall'] = 'All couters will be deleted. Do you want to uninstall this module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module version %s updated.';
$lang['nameunspec'] = 'The required name parameter is unspecified!';
$lang['error_insufficientparams'] = 'Required parameter is not specified: %s';
$lang['nocountersfound'] = 'There are no counters yet.<br />
To create a counter put the module tag into a page (see the module help for information on how to do it) - a new counter will be created automatically when someone clicks the link for the first time.';
$lang['noresult'] = 'No result';
$lang['delete'] = 'Delete';
$lang['areyousure'] = 'Delete the counter?';
$lang['areyousure2'] = 'Delete the counters?';
$lang['name'] = 'Counter name';
$lang['link'] = 'Link : url, file, other';
$lang['newName'] = 'Name (must be unique)';
$lang['newFile'] = 'Link : url, file, other';
$lang['lastdate'] = 'Last click date';
$lang['active'] = 'Active';
$lang['value'] = 'Value';
$lang['tag'] = 'Tag';
$lang['withouttag'] = 'Without tag';
$lang['addText'] = 'Add a new hardcoded link';
$lang['usageText'] = 'How use it?';
$lang['submit'] = 'Submit';
$lang['listtagtext'] = 'List of tags';
$lang['confirm_del_tag'] = 'Are you sure you want to remove this tag?';
$lang['title_hardlink'] = 'Hardcoded links';
$lang['title_all'] = 'General';
$lang['title_master'] = 'By Tags';
$lang['title_stats'] = 'Statistics';
$lang['delselected'] = 'Delete selected counters';
$lang['needpermission'] = "You need the '%s' permission to perform that function.";
$lang['message_success'] = "Operation finished with success";
$lang['error_no_id'] = 'Internal error: id is not specified';
$lang['error_mustBeUnique'] = 'The name must be unique';
$lang['error_isrequired'] = 'The both fieds are required';
$lang['param_action'] = "action to be performed in the current tag. '<i>default</i>': count clicks, '<i>display</i>': show the counter value.";
$lang['param_name'] = 'name of the counter, by which separate counters are distinguished.';
$lang['param_link'] = 'link to the target resource.';

$lang['chart_title'] = 'Chart from %s to %s';
$lang['chart_x'] = 'Period';
$lang['chart_y'] = 'Number of Clicks';


$lang['title_1'] = 'Choose the type of the Chart';
$lang['title_2'] = 'Select the min and max date';
$lang['title_3'] = 'You can also choose the last date available or exclude robot\'s statistiques';
$lang['title_4'] = 'Regroup on differents period';
$lang['title_5'] = 'Regroup the differents counters, or not';
$lang['chart_x'] = 'Period';
$lang['generate'] = 'Generate Stats';
$lang['chart_line'] = 'Line';
$lang['chart_area'] = 'Area';
$lang['chart_pie'] = 'Pie';
$lang['chart_from'] = 'from';
$lang['chart_to'] = 'to';
$lang['chart_noEnd'] = 'Not End Date';
$lang['chart_bot'] = 'Exclude Bots';
$lang['chart_day'] = 'Day';
$lang['chart_week'] = 'Week';
$lang['chart_month'] = 'Month';
$lang['chart_year'] = 'Year';
$lang['chart_24'] = '24-Hours rolling';
$lang['chart_7'] = '7-days rolling';
$lang['chart_bytag'] = 'By Tags';
$lang['chart_bytagD'] = 'By Tags + Details';
$lang['chart_bycounter'] = 'All Counters';
$lang['princess'] = 'Sorry mario but the princess is in another castle (and by the way i didn\'t find any result for you)';

?>
