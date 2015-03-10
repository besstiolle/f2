<h3>What Does This Do?</h3>
<p>This module, in conjunction with the FrontEndUsers module allows you to create a page that will look different depending upon the person that looks at it.  You can specify different content for certain users, or members of a certain group.</p>
<p><b>Note 1:</b> Creating logic in a page that could potentially result in different output for each request, you should ensure that that page will not be cached.  This is accomplished by ensuring that the &quot;cachable&quot; tag is cleared on the page before submitting or applying</p>
<p><b>Note 2:</b> If the smarty logic is in your template, you need to ensure that each page that uses that template is not cachable</p>
<h3>How Do I Use It</h3>
<ul>
<li>Example 1 - Simple hiding of private content:<br/>
<pre><code>{cc_protect}This is protected content{/cc_protect}</code></pre>
</li>

<li>Example 2 - Static hiding of private content:<br/>
<pre><code>{if ccUser::loggedin()}
  Welcome &lt;strong&gt;{ccUser::username()}&lt;/strong&gt;
{/if}</code></pre>
</li>

<li>Example 3 - Simple loggedin test:
<p><strong>Note:</strong> - The dynamic methods of accessing custmcontent may be removed at a future date.</p>
<pre><code>{if $ccuser->loggedin()}
  Welcome &lt;b&gt;{$ccuser->username()}&lt;/b&gt;&lt;br/&gt;
{else}
  &lt;h1&gt;You are not authorized to view this data&lt;/h1&gt;
{/if}
</code></pre>
</li>

<li>Example 4 - Showing content to only members of certain groups:
<p>The logged in user must be a member of at least one of the named groups</p>
<pre><code>{cc_protect group='group1,group2'}Only a member of one of those groups can see this{/cc_protect}</code></pre>
</li>

<li>Example 5 - Advanced login testing:<br/>
<pre><code>{if ccUser::memberof('members') && ccUser::ipmatches('192.168.0.0/24')}
Welcome logged in, local member.
{elseif ccUser::memberof('members')}
Welcome logged in member
{elseif ccUser::loggedin()}
Welcome {ccUser::username()}
{else}
You are not authorized to view this content.
{/if}
</code></pre>
</li>

<li>Example 6 - More advanced testing:<br/>
<pre><code>{if $ccuser->memberof('members') && $ccuser->ipmatches('192.168.0.0/24')}
Welcome logged in local member
{elseif $ccuser->memberof('members')}
Welcome logged in member
{elseif $ccuser->loggedin()}
Welcome user from some other group
{else}
Anonymous user
{/if}
</code></pre>
</li>
</ul>

<h4>Available Methods:</h4>
<ul>
<li><p><em>ccuser</em> - An object with convenience functions for testing and retrieving information about the currently logged in visitor.</p>
<p>This object contains some convenience methods for performing more advanced smarty logic based on information about the current visitor.  These methods can be used either statically or dynamically.</p>
  <ul>
<li><strong>{ccUser::groups()}</strong> or <em>{$ccuser->groups()}</em> - outputs a list of the users member groups</li>
<li><strong>{ccUser::memberof('group')}</strong> or <em>$ccuser->memberof('group')</em> - outputs a boolean if the user is indeed a member of this group (by name or id).  This function will also accept a comma separated list or PHP array of group names or ids.</li>
<li><strong>{ccUser::loggedin()}</strong> or <em>$ccuser->loggedin()</em> - outputs the userid of the currently logged in user.<br/>
  <pre><code>{$uid=ccUser::loggedin()}</pre>
</li>
<li><strong>{ccUser::username()}</strong> or <em>$ccuser->username()</em> - outputs the username of the currently logged in user.</li>
<li><strong>{ccUser::email()}</strong> or <em>$ccuser->email()</em> - outputs the email address of the currently logged in user.</li>
<li><strong>{ccUser::property('propertyname')}</strong> or <em>$ccuser->property('propertyname')</em> - outputs the value of the property for the currently logged in user.</li>
<li><strong>{ccUser::ipmatches($ranges}</strong> or <em>$ccuser->ipmatches($ranges)</em> - outputs a boolean if the users ip address matches one of the comma separated ip ranges.  Accepts ranges like ###.###.###.###/## i.e: 192.168.0.0/24</li>
<li><strong>{ccUser::expired(}</strong> or <em>$ccuser->expired()</em> - Returns a boolean indicating wether the user has expired or not.</li>
  </ul>
<br/>
</li>
</ul>

<h4>Other Plugins.</h4>
<p>The <strong>{cc_protect}</strong> Block plugin provides a convenient way of displaying custom content to specific users. Its usage is simple:</p>
<pre><code>{cc_protect [groups=group1,group2]}This is protected text{/cc_protect}</code></pre>
<p>As you can see, you can specify an optional comma separated list of group names <em>(or group ids)</em>.  If specified, the logged in user must be a member of at least one of the groups for the protected content to be displayed.</p>
<h4>MenuManager PostFilters</h4>
<p>This module provides two plugins for use in the MenuManager module of CMSMS to allow filtering the rersults based on loggedin status, or group membership.  These plugins can be used at the start of your menumanager template to provide some postfiltering to the results returned by CMSMS.</p>
<p><strong>Note:</strong> Recent versions of FrontEndUsers include a ProectedContent content type that will work in many simple situations. However these plugins may be useful for more complex situations.</p>
<ul>
<li><p><em>{cc_menufilter_loggedin}</em> - Filter menu manager nodes based strictly on loggedin status.<br/>
<p>The idea here is that you will mark either a content block or a primary field with a special value... this value will be tested, and if the condition fails OR the user is not logged into FEU then the node will be filtered out of the list.</p>
<code>usage: {cc_menufilter_loggedin menunodes=$nodelist assign=nodelist [keyname=fieldname keyvalue=value|contentblock=blockname contentvalue=value]}</code>
<p>Parameters:</p>
<ul>
  <li>menunodes - required - The list of menunodes created by MenuManager</li>
  <li>assign    - required - Smarty variable to assign the output of this function to.</li>
  <li>keyname   - optional - The name of the node member that contains the data indicating that this is a private page.</li>
  <li>keyvalue  - optional - The value of the node member that indicates that the page is a private page.  This parameter is required if keyname is supplied. The special value of ::ANY:: (case sensitive) can be used to indicate that any value in the field indicates that this is a private page.</li>
  <li>contentblock - optional - The name of the content block that indicates wether the current page is private (only accessible to logged in users).</li>
  <li>contentvalue - optional - The value of the content block that indicates that the page is a private page.  This parameter is required if contentblock is supplied.  The special value of ::ANY:: (case sensitive) can be used to indicate that any value in the field indicates this is a private page.</li>
</ul>
  <p>Example: Filter menu nodes that have an extra1 field value of '1' when the user is not logged in:<br/>
  <code>{cc_menufilter_loggedin menunodes=$nodelist assign=$nodelist keyname=extra1 keyvalue=1}</code></p>
</li>
<li><p><em>{cc_menufilter_memberof}</em> - Filter menu manager nodes based on membership in an FEU group.
<p>The idea here is that you will mark either a content block or a primary field with a special value... this value will be tested, and if the condition fails OR the user is not a member of the specified FEU group then the node will be filtered out of the list.</p>
<code>usage: {cc_menufilter_memberof menunodes=$nodelist assign=nodelist [keyname=fieldname keyvalue=value|contentblock=blockname contentvalue=value]}</code>
<p>Parameters:</p>
<ul>
  <li>menunodes - required - The list of menunodes created by MenuManager</li>
  <li>assign    - required - Smarty variable to assign the output of this function to.</li>
  <li>memberof  - required - The FEU group that the user must be a member of.</li>
  <li>keyname   - optional - The name of the node member that contains the data indicating that this is a private page.</li>
  <li>keyvalue  - optional - The value of the node member that indicates that the page is a private page.  This parameter is required if keyname is supplied. The special value of ::ANY:: (case sensitive) can be used to indicate that any value in the field indicates that this is a private page.</li>
  <li>contentblock - optional - The name of the content block that indicates wether the current page is private (only accessible to members of the specified group).</li>
  <li>contentvalue - optional - The value of the content block that indicates that the page is a private page.  This parameter is required if contentblock is supplied.  The special value of ::ANY:: (case sensitive) can be used to indicate that any value in the field indicates this is a private page.</li>
</ul>
  <p>Example: Filter menu nodes that have an extra1 field value of '1' when the user is not logged in:<br/>
  <code>{cc_menufilter_memberof menunodes=$nodelist assign=$nodelist keyname=extra1 keyvalue=customers}</code></p>
</li>

</ul>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2009, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&lt;calguy1000@cmsmadesimple.org&gt;</a>. All Rights Are Reserved.</p>
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
