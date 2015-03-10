<?php
$lang['error_nofeusers'] = 'Fel: FrontEndUsers modulen hittades inte';
$lang['friendlyname'] = 'Custom Content Modul';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'Modulen &auml;r avinstallerad.';
$lang['installed'] = 'Modulversion %s &auml;r installerad.';
$lang['accessdenied'] = '&Aring;tkomst nekad. Kontrollera din beh&ouml;righet.';
$lang['error'] = 'Fel!';
$lang['upgraded'] = 'Modulen &auml;r nu uppgraderad till version %s.';
$lang['moddescription'] = 'Denna modul ger en m&ouml;jlighet att ange olika inneh&aring;ll av en grupp eller anv&auml;ndarnamn';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module, in conjunction with the FrontEndUsers module allows you to create a page that will look different depending upon the person that looks at it.  You can specify different content for certain users, or members of a certain group.</p>
<p><b>Note 1:</b> When putting custom smarty logic into any page, you should ensure that that page will not be cached.  This is accomplished by ensuring that the &quot;e;cachable&quot;e; tag is cleared on the page before submitting or applying</p>
<p><b>Note 2:</b> If the smarty logic is in your template, you need to ensure that each page that uses that template is not cachable</p>
<h3>How Do I Use It</h3>
<pre>
{if $customcontent_loggedin > 0}
  Welcome <b>{$customcontent_loginname}</b><br/>
{else}
  <h1>You are not authorized to view this data</h1>
{/if}
</pre>
<p>Or you can use the $ccuser variable for more advanced, and easier to read testing</p>
<pre>
{if $ccuser->loggedin() &amp;&amp; $ccuser->memberof(&#039;members&#039;) &amp;&amp; $ccuser->ipmatches(&#039;192.168.0.0/24&#039;)}
Welcome logged in local member
{elseif $ccuser->loggedin() &amp;&amp; $ccuser->memberof(&#039;members&#039;)}
Welcome logged in member
{elseif $ccuser->loggedin()}
Welcome user from some other group
{else}
Anonymous user
{/if}
</pre>
<p>Another example: (getting the root page alias)</p>
<pre>
{capture assign=&#039;rootalias&#039;}{$ccuser->get_root_alias()}{/capture}
</pre>
<p>Alternatively:</p>
{$ccuser->get_root_alias(&#039;&#039;,&#039;assign&#039;)}
<p>Any smarty compatible expressions or logic can be used with the available variables.  Using this syntax, expressions may be nested, or complex logic used.</p>
<h4>Available variables:</h4>
<ul>
<li><p><em>ccuser</em> - An object with convenience functions for testing.</p>
<p>This object contains some convenience methods for performing more advanced customcontent logic, or for making your template look a little bit better. The available methods are:</p>
  <ul>
<li><em>$ccuser->get_parent_alias($alias,$assign)</em> - outputs the page alias of the parent page, or empty if the specified page does not have a parent (is at the top).  This function will accept a page alias as an argument, if no page alias is specified or it is empty, the current page is assumed. If the assign parameter is not empty the results will be assigned to a smarty variable matching the supplied name.</li>
<li><em>$ccuser->get_root_alias($alias,$assign)</em> - outputs the page alias of the topmost parent page, or empty if the specified page does not have a parent (is at the top).  This function will accept a page alias as an argument, if no page alias is specified or is empty, the current page is assumed. If the assign parameter is not empty the results will be assigned to a smarty variable matching the supplied name.</li>
<li><em>$ccuser->get_page_title($alias,$assign)</em> - outputs the title of the page matching the supplied alias.  This function will accept a page alias as an argument, if no page alias is specified or it is empty, the current page is assumed. If the assign parameter is not empty the results will be assigned to a smarty variable matching the supplied name.</li>
<li><em>$ccuser->has_children($alias,$assign)</em> - outputs a boolean indicating if the specified page has child pages or not.  This function will accept a page alias as an argument, if no page alias is specified or it is empty, the current page is assumed. If the assign parameter is not empty the results will be assigned to a smarty variable matching the supplied name.</li>
<li><em>$ccuser->groups()</em> - outputs a list of the users member groups</li>
<li><em>$ccuser->memberof(&#039;group&#039;)</em> - outputs a boolean if the user is indeed a member of this group.  This function will also accept a comma separated list of group names.</li>
<li><em>$ccuser->loggedin()</em> - outputs a boolean if the user is loggedin</li>
<li><em>$ccuser->username()</em> - outputs the username of the currently logged in user.</li>
<li><em>$ccuser->property(&#039;propertyname&#039;)</em> - outputs the value of the property for the currently logged in user.</li>
<li><em>$ccuser->module_installed(&#039;modulename&#039;)</em> - outputs a boolean if the specified module is installed and available.</li>
<li><em>$ccuser->ipmatches($ranges)</em> - outputs a boolean if the users ip address matches one of the comma separated ip ranges.  Accepts ranges like ###.###.###.###/## i.e: 192.168.0.0/24</li>
  </ul>
<br/>
</li>
<li><p><em>customcontent_ip</em> - The remote IP address</p></li>
<li><p><em>customcontent_loggedin</em> - An integer indicating the userid if the current logged in user.  This variable may exist, but have no value if the user is not logged in.</p></li>
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
<p>Copyright &copy; 2005, Robert Campbell <a href="mailto:rob@techcom.dyndns.org"><rob@techcom.dyndns.org></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1242652654';
$lang['utmz'] = '156861353.1242652654.79.43.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/index.php';
$lang['utma'] = '156861353.385153522109207000.1214818446.1240900026.1242652654.79';
?>