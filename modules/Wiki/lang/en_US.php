<?php
$lang['friendlyname'] = 'Simple Wiki';
$lang['postinstall'] = '';
$lang['postuninstall'] = 'Module Wiki uninstalled, bye !"';
$lang['really_uninstall'] = 'Really? Are you sure you want to uninstall this fine module?';
$lang['uninstalled'] = 'Module Wiki Uninstalled.';
$lang['installed'] = 'Module Wiki version %s installed.';
$lang['reseted'] = 'Module Wiki version %s reseted with success ';
$lang['moddescription'] = 'This module is a simple implementation of a WIKI into CmsMadeSimple';
$lang['changelog'] = 'see changelog : <a href="https://github.com/besstiolle/wiki-ms" target="_blank">https://github.com/besstiolle/wiki-ms</a>';

$lang['lang_id_mandatory'] = 'the lang_id parameter is missing';
$lang['lang_mandatory'] = 'The lang is missing or unknown';
$lang['title_mandatory'] = 'The title is mandatory';
$lang['text_mandatory'] = 'The text is mandatory';
$lang['default_page_with_new_title'] = 'You can\'t change the title of the default page';
$lang['default_version_undeletable'] = 'You can\'t delete the default page';
$lang['title_format'] = 'Title is required and must be an alphanumerique string (symbols "-_:" are accepted too).';
$lang['version_unknow'] = 'The current page is not know. Maybe it\'s already deleted ?';
$lang['revision_unknow'] = 'The version %s of the page is not known.';


$lang['save_success'] = 'Page saved with success.';
$lang['delete_success'] = 'Page deleted with success.';
$lang['dupplicate_code'] = 'Another Lang already exists with this code';
$lang['code_is_mandatory'] = 'The code is mandatory';
$lang['label_is_mandatory'] = 'The label is mandatory';


$lang['wiki_not_readable'] = 'You cannot read this wiki';
$lang['wiki_not_writable'] = 'You cannot modify the pages of this wiki';
$lang['wiki_not_deletable'] = 'You cannot delete the pages of this wiki';
$lang['wiki_page_not_exists'] = 'This page doesn\'t exists and you don\'t have the right to create it.';

$lang['help_is_readable'] = 'Set to TRUE if you want that the wiki  can be readable';
$lang['help_is_writable'] = 'Set to TRUE if you want that the pages of the wiki can be writable (creating new page, editing existing page)';
$lang['help_is_deletable'] = 'Set to TRUE if you want that the pages of the wiki can be readable';
$lang['help_author_name'] = 'Set to the name (username, login, whatever) of the current user. Will be stored into the database for every modifications';
$lang['help_author_id'] = 'Set to the ID (integer) of the current user. Will be stored into the database for every modifications';


$lang['help'] = '<h3>What Does This Do?</h3>
<p>more informations on : <a href="https://github.com/besstiolle/wiki-ms" target="_blank">https://github.com/besstiolle/wiki-ms</a></p>
<h3>How use it</h3>
<h4>{Wiki}</h4>
<p>add the tag {Wiki} in your template to implement the wiki. It won\'t be readable by default</p>
<h4>{Wiki action="setAccess"}</h4>
<p>add the tag {Wiki action="setAccess"} in your template before the tag {Wiki} to set the authorization. There is some options : </p>
<ul>
<li>is_readable (FALSE by default)</li>
<li>is_writable (FALSE by default)</li>
<li>is_deletable (empty by default)</li>
<li>author_name (empty by default)</li>
<li>author_id (empty by default)</li>
</ul>

<p>For example : </p>
<pre>
{Wiki action="setAccess" is_readable="TRUE" is_writable="TRUE" is_deletable="FALSE"}
[...]
{Wiki}
</pre>

<p>You can easily test the current FEU user/group to allow or deny access to the wiki</p>
<pre>
{if $ccuser->loggedin()}
  {Wiki action="setAccess" is_readable="TRUE" is_writable="TRUE" is_deletable="FALSE" author_name=$ccuser->username() author_id=$ccuser->loggedin() }<br/>
{else}
  {Wiki action="setAccess" is_readable="TRUE"}
{/if}
[...]
{Wiki}
</pre>

<p>finally you can customize your own test with a custom UDT.</p>
<p style="color:#F00;">! Remember, you must always define the access <b>BEFORE</b> your tag {Wiki} and before the tag {content} or the settings won\'t be actives ! </p>
';
$lang['xxx'] = 'xxx';


?>
