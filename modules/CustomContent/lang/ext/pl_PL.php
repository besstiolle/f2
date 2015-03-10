<?php
$lang['error_nofeusers'] = 'Błąd: nie można odnaleźć modułu Użytkownik&oacute;w FEU (FrontEndUsers)';
$lang['friendlyname'] = 'Moduł Custom Content';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'Moduł został odinstalowany.';
$lang['installed'] = 'Moduł w wersji %s został zainstalowany.';
$lang['accessdenied'] = 'Dostęp zabroniony. Sprawdź swoje uprawnienia.';
$lang['error'] = 'Błąd!';
$lang['upgraded'] = 'Moduł został zaktualizowany do wersji %s.';
$lang['moddescription'] = 'Ten moduł pozwala spersonalizować treści na stronach w zależności od grupy lub nazwy użytkownika.';
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
<li>Version 1.4.4 - Dec, 2006.
<p>Added TemplatePrecompile callback</p>
<li>Version 1.4.5 - Mar, 2007.
<p>Removed the SearchItemAdded callback...</p>
<li>Version 1.4.6 - Apr, 2007.
<p>Added the ccuser object for easier expressions.</p>
<li>Version 1.4.7 - Sep, 2007.
<p>Adjusted the help, the comment syntax is now deprecated</p>
<p>Added a property method to the ccuser object</p>
</li>
<li>Version 1.4.8 - Sep, 2007.
<p>Added the module_exists method to the ccuser object</p>
</li>
<li>Version 1.4.9 - Oct. 2007.
<p>Some minor fixes that seem to fix problems where FEU would get instantiated twice</p>
<p>Fixes an issue in the memberof() method of ccuser when not logged in</p>
</li>
<li>Version 1.4.10 - Nov. 2007.
<p>Minimum CMS Version is now 1.2</p>
<p>Adds new functions to the ccuser object: get_parent_alias(), get_root_alias(), get_page_title(), has_children()</p>
</li>
<li>Version 1.4.11 - Dec. 2007.
<p>Adds the ability to assign the output of some functions in the ccuser object to smarty variables without having to use the capture smarty tag.</p>
<li>Version 1.5 - Feb, 2008.
<p>Removes the comment style syntax once and for all... and sets all of the variables ion the object constructor.</p>
<p>Adds the {$ccuser->setup()} method to ensure that the smarty variables are setup</p>
<p>Removes the redundant functions from ccuser that are now in CGSimpleSmarty</p>
</li>
<li>Version 1.5.1 - August, 2008
<p>Minor optimizations and add the username function to $ccuser</p>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module, in conjunction with the FrontEndUsers module allows you to create a page that will look different depending upon the person that looks at it.  You can specify different content for certain users, or members of a certain group.</p>
<p><b>Note 1:</b> When putting custom smarty logic into any page, you should ensure that that page will not be cached.  This is accomplished by ensuring that the &amp;quote;cachable&amp;quote; tag is cleared on the page before submitting or applying</p>
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
$lang['utma'] = '156861353.2359145497878676500.1213200278.1218666934.1218748697.81';
$lang['utmz'] = '156861353.1218748697.81.13.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/|utmcmd=referral';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>