<?php
$lang['error_nofeusers'] = 'Hiba: nem tal&aacute;lom a FrontEndUsers modult';
$lang['friendlyname'] = 'Egy&eacute;ni tartalom modul';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'A modult elt&aacute;vol&iacute;tottuk.';
$lang['installed'] = 'A(z) %s verzi&oacute;j&uacute; modul van install&aacute;lva.';
$lang['accessdenied'] = 'A hozz&aacute;f&eacute;r&eacute;s megtagadva. K&eacute;rem, ellenőrizze a jogosults&aacute;gokat.';
$lang['error'] = 'Hiba!';
$lang['upgraded'] = 'A modult friss&iacute;tett&uuml;k a(z) %s verzi&oacute;ra.';
$lang['moddescription'] = 'Ez a modul lehetőv&eacute; teszi, hogy k&uuml;l&ouml;nb&ouml;ző tartalmakat jelen&iacute;ts&uuml;nk meg k&uuml;l&ouml;nb&ouml;ző csoportoknak vagy felhaszn&aacute;l&oacute;knak';
$lang['changelog'] = '<ul><li>Version 1.0. 14 September 2005. Initial Release.</li></ul>
<ul>
<li>Version 1.1.  - September 2005. Added startif/else/endif, and search through multiple groups and users.</li>
<li>Version 1.2.  - September 2005. Added loggedin optional parameter</li>
<li>Version 1.3   - October   2005. Changed to use FrontEndUsers instead of UserID</li>
<li>Version 1.3.1 - November 2005. Very minor bugfix to the parameter parsing</li>
<li>Version 1.4.0 - January, 2006.
<p>Added smarty compatible variables</p></li>
<li>Version 1.4.1 - May, 2006.
<p>Smarty variables now work in 0.13b2</p>
<p>Now require CMS 0.13b2 as a minimum</p>
<p>Updated the help</p>
</li>
<li>Version 1.4.3 - June, 2006.
<p>Added search module compatibility</p>
<p>Added date and time smarty variables</p>
</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module, in conjunction with the UserID module allows you to create a page that will look different depending upon the person that looks at it.  You can specify different content for certain users, or members of a certain group.</p>
<h3>How Do I Use It (method 1: comment tags)</h3>
<p>To use it you place the tag {cms_module module=CustomContent} into your page or template, and then below that you place the content you want isolated to specific users in groups in one of two ways, either using specially formatted comment tags, or using smarty syntax.</p>
<h4>Method 1: comment tags</h4>
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
<p><b>Available parameters</b></p> 
<ul>
<li><p><em>ip</em> - test if remote ip matches a network or supplied ip address.  Valid formats are xxx.xxx.xxx.xxx (exact), xxx.xxx.xxx.[yyy-zzz] (range) and xxx.xxx.xxx/nn (nn = # bits, i.e.  192.168.1.0/24)</p></li>
<li><p><em>group</em> - test if the currently logged in user is a member of any of the supplied groups</p></li>
<li><p><em>user<em> - test if the currently logged in username matches any of the supplied ones</p></li>
<li><p><em>loggedin<em> - test if the current user is logged in or not./p></li>
</ul>
<p>Tests are evaluated in a logical OR fashion in order as follows ip address, group, and user.  The first successfull test will result in the expression evaluationg to true</p>
<h3>How Do I Use It (method 2 : smarty)</h3>
<pre>
{cms_module module=CustomContent}
{if $customcontent_loggedin}
  Welcome <b>{$customcontent_loginname}</b><br/>
{/else}
  <h1>You are not authorized to view this data</h1>
{/if}
</pre>
<p>Any smarty compatible expressions or logic can be used with the available variables.  Using this syntax, expressions may be nested, or complex logic used.</p>
<h4>Available variables:</h4>
<ul>
<li><p><em>customcontent_ip</em> - The remote IP address</p></li>
<li><p><em>customcontent_loggedin</em> - A boolean indicating wether the user is logged in or not</p></li>
<li><p><em>customcontent_loginname</em> - The name of the currently logged in user</p></li>
<li><p><em>customcontent_groupcount</em> - A count of the number of groups this user is a member of</p></li>
<li><p><em>customcontent_groups</em> - A string containing the group names of all member groups</p></li>
<li><p><em>customcontent_memberof_*</em> - A series of boolean variables indicating group membership.  i.e.: customcontent_memberof_staff, customcontent_memberof_users, etc.  No variables are defined for groups that this user is not a member of.</p></li>
<li><p><em>customcontent_dayzeros</em> - Day of the month, 2 digits with leading zeros</p></li> 
<li><p><em>customcontent_day3text</em> - A textual representation of a day, three letters</p></li>
<li><p><em>customcontent_day</em> - Day of the month without leading zeros</p></li> 
<li><p><em>customcontent_weekday</em> - A full textual representation of the day of the week</p></li> 
<li><p><em>customcontent_dayordsuffix</em> - English ordinal suffix for the day of the month, 2 characters</p></li> 
<li><p><em>customcontent_dayofweek</em> - Numeric representation of the week</p></li> 
<li><p><em>customcontent_dayofyear</em> - The day of the year (starting from 0)</p></li> 
<li><p><em>customcontent_weeknum</em> - ISO-8601 week number of year, weeks starting on Monday</p></li> 
<li><p><em>customcontent_monthfulltext</em> - A full textual representation of a month, such as January or March</p></li> 
<li><p><em>customcontent_monthnumzeros</em> - Numeric representation of a month, with leading zeros</p></li> 
<li><p><em>customcontent_monthshorttext</em> - A short textual representation of a month, three letters</p></li> 
<li><p><em>customcontent_monthnum</em> - Numeric representation of a month, without leading zeros</p></li> 
<li><p><em>customcontent_monthnumdays</em> - Number of days in the current month</p></li> 
<li><p><em>customcontent_leapyear</em> - Wether it&#039;s a leap year</p></li> 
<li><p><em>customcontent_4digityear</em> - A full numeric representation of a year, 4 digits</p></li> 
<li><p><em>customcontent_2digityear</em> - A two digit representation of a year</p></li> 
<li><p><em>customcontent_lowerampm</em> - Lowercase Ante meridiem and Post meridiem</p></li> 
<li><p><em>customcontent_upperampm</em> - Uppercase Ante meridiem and Post meridiem</p></li>
<li><p><em>customcontent_inettime</em> - Swatch Internet time</p></li>
<li><p><em>customcontent_12hour</em> - 12-hour format of an hour without leading zeros</p></li>
<li><p><em>customcontent_24hour</em> - 24-hour format of an hour without leading zeros</p></li>
<li><p><em>customcontent_12hourzeros</em> - 12-hour format of an hour with leading zeros</p></li>
<li><p><em>customcontent_24hourzeros</em> - 24-hour format of an hour with leading zeros</p></li>
<li><p><em>customcontent_minutes</em> - Minutes with leading zeros</p></li>
<li><p><em>customcontent_seconds</em> - Seconds, with leading zeros</p></li>
<li><p><em>customcontent_timezone</em> - Timezone setting of this machine</p></li>
<li><p><em>customcontent_date</em> - RFC 2822 formatted date</p></li>
<li><p><em>customcontent_epochseconds</em> - Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)</p></li>
</ul>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2005, Robert Campbell <a href=&quot;mailto:rob@techcom.dyndns.org&quot;><rob@techcom.dyndns.org></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href=&quot;http://www.gnu.org/licenses/licenses.html#GPL&quot;>GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['utma'] = '156861353.1745742775.1167462096.1181363092.1181753758.26';
$lang['utmz'] = '156861353.1176323191.18.2.utmccn=(referral)|utmcsr=forum.cmsmadesimple.org|utmcct=/index.php/topic,7004.0.html|utmcmd=referral';
$lang['utmc'] = '156861353';
?>