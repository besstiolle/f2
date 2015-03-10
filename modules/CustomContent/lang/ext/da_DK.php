<?php
$lang['error_nofeusers'] = 'Fejl: Kunne ikke finde FrontEndUsers modules';
$lang['friendlyname'] = 'Specielt Indhold modules';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'Modul afinstalleret.';
$lang['installed'] = 'Modul version %s installeret.';
$lang['accessdenied'] = 'Adgang n&aelig;gtet! Tjek dine rettigheder.';
$lang['error'] = 'Fejl!';
$lang['upgraded'] = 'Modul upgraderet til version %s.';
$lang['moddescription'] = 'Dette module giver mulighed for at angive specielt indhold for grupper eller brugernavne';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module, in conjunction with the FrontEndUsers module allows you to create a page that will look different depending upon the person that looks at it.  You can specify different content for certain users, or members of a certain group.</p>
<p><b>Note 1:</b> Creating logic in a page that could potentially result in different output for each request, you should ensure that that page will not be cached.  This is accomplished by ensuring that the &amp;quote;cachable&amp;quote; tag is cleared on the page before submitting or applying</p>
<p><b>Note 2:</b> If the smarty logic is in your template, you need to ensure that each page that uses that template is not cachable</p>
<h3>How Do I Use It</h3>
<pre>
{if $customcontent_loggedin > 0}
  Welcome &amp;lt;b&amp;gt;{$customcontent_loginname}&amp;lt;/b&amp;gt;&amp;lt;br/&amp;gt;
{else}
  &amp;lt;h1&amp;gt;You are not authorized to view this data&amp;lt;/h1&amp;gt;
{/if}
</pre>
<br/>
<p>Or you can use the $ccuser variable for more advanced, and easier to read testing</p>
<pre>
{if $ccuser->memberof(&#039;members&#039;) &amp;&amp; $ccuser->ipmatches(&#039;192.168.0.0/24&#039;)}
Welcome logged in local member
{elseif $ccuser->memberof(&#039;members&#039;)}
Welcome logged in member
{elseif $ccuser->loggedin()}
Welcome user from some other group
{else}
Anonymous user
{/if}
</pre>
<br/>
<h4>Available variables:</h4>
<ul>
<li><p><em>ccuser</em> - An object with convenience functions for testing.</p>
<p>This object contains some convenience methods for performing more advanced customcontent logic, or for making your template look a little bit better. The available methods are:</p>
  <ul>
<li><em>$ccuser->groups()</em> - outputs a list of the users member groups</li>
<li><em>$ccuser->memberof(&#039;group&#039;)</em> - outputs a boolean if the user is indeed a member of this group.  This function will also accept a comma separated list of group names.</li>
<li><em>$ccuser->loggedin()</em> - outputs a boolean if the user is loggedin</li>
<li><em>$ccuser->username()</em> - outputs the username of the currently logged in user.</li>
<li><em>$ccuser->property(&#039;propertyname&#039;)</em> - outputs the value of the property for the currently logged in user.</li>
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
</ul>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2009, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>
<li><p><em>customcontent_timezone</em> - Timezone setting of this machine</p></li>
<li><p><em>customcontent_date</em> - RFC 2822 formatted date</p></li>
<li><p><em>customcontent_epochseconds</em> - Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)</p></li>
</ul>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2005, Robert Campbell <a href="mailto:rob@techcom.dyndns.org">&amp;lt;rob@techcom.dyndns.org&amp;gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['utma'] = '156861353.2039886585.1231713618.1268089242.1268131470.106';
$lang['utmz'] = '156861353.1268131470.106.19.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/index.php/board,9.0.html';
$lang['qca'] = '1229601790-85243197-43260713';
$lang['utmb'] = '156861353.1.10.1268131470';
$lang['utmc'] = '156861353';
?>