<?php
$lang['error_nofeusers'] = 'Chyba: modul FrontEndUsers nebyl nalezen';
$lang['friendlyname'] = 'Custom Content modul';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'Modul odinstalov&aacute;n.';
$lang['installed'] = 'Modul verze %s nainstalov&aacute;n.';
$lang['accessdenied'] = 'Př&iacute;stup zak&aacute;z&aacute;n. Ověřte pros&iacute;m sv&aacute; opr&aacute;vněn&iacute;.';
$lang['error'] = 'Chyba!';
$lang['upgraded'] = 'Modul pov&yacute;&scaron;en na verzi %s.';
$lang['moddescription'] = 'Tento modul umožňuje uv&eacute;st jin&yacute; obsah podle skupiny nebo uživatelsk&eacute;ho jm&eacute;na';
$lang['changelog'] = '<ul><li>Version 1.0. 14 September 2005. Initial Release.</li></ul>
<ul>
<li>Version 1.1.  - September 2005. Added startif/else/endif, and search through multiple groups and users.</li>
<li>Version 1.2.  - September 2005. Added loggedin optional parameter</li>
<li>Version 1.3   - October   2005. Changed to use FrontEndUsers instead of UserID</li>
<li>Version 1.3.1 - November 2005. Very minor bugfix to the parameter parsing</li>
<li>
<p>Version 1.4.0 - January, 2006.</p>
<p>Added smarty compatible variables</p>
</li>
</ul>';
$lang['help'] = '<h3>Co děl&aacute; tento modul?</h3>
<p>Tento modul, ve spolupr&aacute;ci s modulem UserID V&aacute;m umožňuje vytvořit str&aacute;nku, kter&aacute; bude vypdat jinak v z&aacute;vislosti na osobě, kter&aacute; si danou str&aacute;nku prohl&iacute;ž&iacute;.  Můžete uv&eacute;st jin&yacute; obsah pro nekter&eacute; uživatele nebo pro členy určit&eacute; skupiny.</p>
<h3>Jak se použ&iacute;v&aacute;</h3>
<p>Pro použit&iacute; se vkl&aacute;d&aacute; tag {cms_module module=CustomContent} do Va&scaron;&iacute; str&aacute;nky nebo &scaron;ablony a pak pod vložen&yacute; obsah zad&aacute;te uživatele ve skupin&aacute;ch pomoc&iacute; jedn&eacute; ze dvou možnost&iacute;, buď pomoc&iacute; speci&aacute;lně form&aacute;tovan&yacute;ch koment&aacute;řů nebo smarty syntaxe.</p>
<h4>Metoda 1: koment&aacute;ře</h4>
<pre>
{cms_module module=CustomContent}
<!--customContent: startif group=testers,admins -->
<H1>This content is only available to logged in testers and and admins</H1>
<!--customContent: else -->
<H1>This content is available to everybody else</H1>
<!--customContent: endif -->
<!--customContent: startif group=users -->
<H1>This content is only available to logged in users </H1>
<!--customContent: endif -->
</pre>
<p><b>Možn&eacute; parametry</b></p> 
<ul>
<li><p><em>ip</em> - test if remote ip matches a network or supplied ip address.  Valid formats are xxx.xxx.xxx.xxx (exact), xxx.xxx.xxx.[yyy-zzz] (range) and xxx.xxx.xxx/nn (nn = # bits, i.e.  192.168.1.0/24)</p></li>
<li><p><em>group</em> - test if the currently logged in user is a member of any of the supplied groups</p></li>
<li><p><em>user<em> - test if the currently logged in username matches any of the supplied ones</p></li>
<li><p><em>loggedin<em> - test if the current user is logged in or not./p></li>
</ul>
<p>Tests are evaluated in a logical OR fashion in order as follows ip address, group, and user.  The first successfull test will result in the expression evaluationg to true</p>
<h4>Method 2: smarty syntax</h4>
<pre>
{cms_module module=CustomContent}
{if customcontent_loggedin}
  Welcome <b>{customcontent_loginname}</b><br/>
{/if}
</pre>
<p>Any smarty compatible expressions or logic can be used with the available variables.  Using this syntax, expressions may be nested, or complex logic used.</p>
<p><b>Available variables:</b></p>
<ul>
<li><p><em>customcontent_ip</em> - The remote IP address</p></li>
<li><p><em>customcontent_loggedin</em> - A boolean indicating wether the user is logged in or not</p></li>
<li><p><em>customcontent_loginname</em> - The name of the currently logged in user</p></li>
<li><p><em>customcontent_groupcount</em> - A count of the number of groups this user is a member of</p></li>
<li><p><em>customcontent_groups</em> - A string containing the group names of all member groups</p></li>
<li><p><em>customcontent_memberof_*</em> - A series of boolean variables indicating group membership.  i.e.: customcontent_memberof_staff, customcontent_memberof_users, etc.  No variables are defined for groups that this user is not a member of.</p></li>
</ul>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2005, Robert Campbell <a href=\&quot;mailto:rob@techcom.dyndns.org\&quot;><rob@techcom.dyndns.org></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href=\&quot;http://www.gnu.org/licenses/licenses.html#GPL\&quot;>GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['utma'] = '156861353.352505848.1175204572.1178052668.1181924151.5';
$lang['utmz'] = '156861353.1181924151.5.5.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/projects/cmsmadesimple/|utmcmd=referral';
?>