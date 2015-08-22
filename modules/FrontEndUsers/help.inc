<h3>What Does This Do?</h3>
<p>This module allows management and administration of front end users <i>(users who have no admin accesss)</i>.  It allows creation of user groups, and user accounts and allows users to login and logout.  it can be used in conjunction with the CustomContent module to display different content to different users once they have logged in</p>
<h3>Features:</h3>
<ul>
<li>Users can be members of multiple groups.</li>
<li>User account expiration.  You can create temporary users</li>
<li>Group Properties.  You can ask for different information from members of different groups.</li>
<li>Lots of field types.</li>
<li>Provides a content type to make protecting content simple, if not trivial.</li>
<li>Capable of handling thousands of users</li>
<li>Extensive flexibility for handling redirection after login, and sends events to extend the workflow process.</li>
<li>Forgotten password, and forgot username functionality... allows users to set a new password, and/or to recover their username if they completely forgot login details.</li>
<li>Extendable to different authentication types (LDAP, Facebook, etc).</li>
<li>Provides extensive import and export capabilities.</li>
<li>Has an extensive API for adding functionality into various other CMSMS addon modules.</li>
<li>The ability to encrypt sensitive user data.</li>
<li>Strong encryption and security.</li>
</ul>

<h3>How do I use it:</h3>
<p>After installation you can the access admin panel to the FrontEndUsers module under the &quot;Users &amp; Groups&quot; menu.</p>
<p>You need to define at least one property.  Properties are essentially field definitions, here you specify the type of information you want to gather, and limits. i.e:  Name, Age, City, State, Country, etc.</p>
<p><b>Note:</b> You do not need to define properties for username (or email address) and password, these will be provided for you.  Though you can provide properties for additional email addresses.</p>
<p><b>Note:</b> New installations of the FEU module specify that the users email address is their username (this option can be changed in the modules admin panel).  So if using this option you will not need to create an email address property.</p>
<p>Next you must create one or more user groups.  When you create a group, you are asked for a group name, a description and to associate one or more properties with that group, specify the properties sort order, and whether it is an optional, required, or hidden field.  At least one property must be associated with a group.</p>
<p><b>Note:</b> Before proceeding, you should ensure that the preferences are set correctly.  Take some time here, there are numerous options.</p>
<p>Thirdly you should create some users.  Adding users is a two step process.  When creating a user you are asked for the username/email and password, and an expiry date for that user.  You then must select the groups that that user is a member of, and click &quot;Next&quot;</p>
<p><em>Note: </em>This is a labour intensive and boring process, it is easier to let users register themselves <em>(See the SelfRegistration Module)</em>, and then you can edit their group information.  but for testing purposes, please create at least one user</p>
<p>Lastly, after the system has determined all of the information fields to be presented for that user, you are presented with a form asking for all of the required user information.  Complete this form to complete the user addition</p>
<p>You are now ready to add the front end functionality to your site.  This is as simple as adding the {FrontEndUsers} tag to your page or template.  You must ensure that this page is set to &quot;not cache&quot; when editing the content page(s) where the login form is displayed.  If you call the {FrontEndUsers} tag from within a page template, you must disable caching on all pages that use that template.</p>
<p>Adding protected content to your CMSMS site is as simple as creating new pages of type &quot;Protected Content&quot; and selecting which user groups (or all) that are allowed to view the page.</p>

<h3>Strong Passwords:</h3>
<p>This module, when freshly installed (not an upgrade) enables strong passwords.  At a minimum one upper case character and one digit are required to be in every password.  The site administrator can also specify other optional characters, one of which must be present in all passwords.</p>

<h3>Smarty Functions:</h3>
<h4>{feu_protect}</h4>
<p>The <strong>feu_protect</strong> block plugin provides a convenient method to hide some content from users on what is normally a public page.</p>
<p><strong style="color: red;">Warning:</strong> This plugin cannot be considered 100% secure, and should not at any time be used in the page template to protect the default {content} tag.  There are ways to access the default content property of a page, or to call a module action without processing the page template.  If you need to protect the content and ensure that no unauthorized users access the page, use the protected page content type provided by this module.</p>
<h5>Usage:</h5>
<pre><code>{feu_protect groups="group1,group2,grop3"}
  &lt;p&gt;Smarty content that should only be visible to members of those groups.&lt;/p&gt;
{/feu_protect}</code></pre>
<p><strong>Note:</strong> The user must be a member of at least one of the specified groups.  The group names are case sensitive.</p>

<h4>The feu_smarty class</h4>
<p>The <strong>feu_smarty</strong> class provides some functions to interact with the database and pull and test for user information.</p>
<p>Some interaction with the FrontEndUsers module database is possible with smarty and the feu_smarty class.</p>
<div class="information">
  <p><strong>Note:</strong> Behavior of the feu_smarty class changed significantly at version 1.29 resulting in compatibility problems.</p>
  <p>This is now a registered class with Smarty (for CMSMS 2.0 compatibility).  And all methods must be accessed statically.  Additionally, there is no assign param.  You must capture the output of the function into a smarty variable.</p>
</div>
<h5>Functions:</h5>
<ul>
<li><strong><code>{feu_smarty::get_current_userid()}</code></strong>
<p>This function returns the integer user id if the currently logged in user (if any).</p>
<p>Example:</p>
<pre><code>{$uid=feu_smarty::get_get_current_userid()}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_current_username()}</code></strong>
<p>This function returns the user name if the currently logged in user (if any).</p>
<p>Example:</p>
<pre><code>{$username=feu_smarty::get_get_current_username()}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_userid($username)}</code></strong>
<p>This function can be used to return the integer user id given a username.</p>
<p>Example:</p>
<pre><code>{$uid=feu_smarty::get_userid($username)}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_username([$uid])}</code></strong>
<p>This function can be used to return the string username given an integer uid.  If no uid is specified, the current logged in uid is assumed.</p>
<p>Example:</p>
<pre><code>{feu_smarty::get_username($the_uid)}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_email([$uid])}</code></strong>
<p>This function can be used to return an email adderess associated with the given integer uid.  If no uid is specified, the current logged in uid is assumed.</p>
<p>Example:</p>
<pre><code>{feu_smarty::get_email($the_uid)}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_userinfo([$uid])}</code></strong>
<p>This function can be used to return the user information for a single user.  If no uid is specified, the current logged in uid is assumed.</p>
<p>Example:</p>
<pre><code>{$uinfo=feu_smarty::get_userinfo($something.userid)}<br/>{$uinfo|@print_r}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_users_by_groupname($groupname[,$for_list])}</code></strong>
<p>This function can be used to extract an array of usernames and userids for all users that belong to the specified group.</p>
<p>The groupname parameter must be a single string groupname.</p>
<p>The for_list parameter is a boolean that indicates that the output should be suitable for use in a select list.</p>
<p>Example:</p>
<pre><code>{$mymembers=feu_smarty::get_users_by_groupname('members')}<br/>{$mymembers|@print_r}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_group_memberlist($gid)}</code></strong>
  <p>This function returns an array of uid and usernames for all users that are members of the specified group (by group id).</p>
  <p>Example:</p>
  <pre><code>{html_options options=feu_smarty::get_group_memberlist($gid) selected=$uid}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_user_expiry([$uid])}</code></strong>
<p>This function returns the unix timestamp that the specified uid account expires.  The function will return false if the uid cannot be found or some other error occurred.</p>
<p>Example:</p>
<pre><code>{$expiry=feu_smarty::get_user_expiry(25)}<br/>{$expiry|cms_date_format}</code></pre>
</li>

<li><strong><code>{feu_smarty::user_expired($uid)}</code></strong>
<p>This function returns a boolean indicating wether the specified user account has expired.  The method will also return false if the uid cannot be found or some other error occurred.</p>
<p>Example:</p>
<pre><code>{$expired=feu_smarty::user_expired(25)}<br/>{if $expired}UID 25 can no longer login to the system{/if}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_user_properties($uid)}</code></strong>
<p>This function can be used to extract a list of properties for the specified user.  If the uid is not specified the current logged in uid is used.</p>
<p>Example:</p>
<pre><code>{$userprops=feu_smarty::get_user_properties(5)}<br/>{$userprops|@print_r}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_user_property($property,[$uid])}</code></strong>
  <p>This function returns the value of a single property for the specified uid.  If the uid parameter is not specified, the current logged in uid is used.</p>
  <p>Example:</p>
  <pre><code>{feu_smarty::get_user_property('fullname',5)}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_dropdown_text($propname,$propvalue)}</code></strong>
  <p>This function returns the text specified for a particular option value for a specified dropdown property.</p>
  <p>Example:</p>
  <pre><code>{feu_smarty::get_dropdown_text('age_range',$onepropvalue)}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_multiselect_text($propname,$propvalue)}</code></strong>
  <p>This function returns an array of option texts corresponding to a comma separated list of option values.</p>
  <p>Example:</p>
  <pre><code>{$favorite_foods=feu_smarty::get_multiselect_text('favorite_foods',$onepropvalue)}<br/>{$favorite_foods|@print_r}</code></pre>
</li>

<li><strong><code>{feu_smarty::get_group_list()}</code></strong>
  <p>This function returns an array of FEU groups that is suitable for use in a dropdown.</p>
  <p>Example:</p>
<pre><code>&lt;select id="group"&gt;{html_options options=feu_smarty::get_group_list()}&lt;/select&gt;</code></pre>
</li>

<li><strong><code>{feu_smarty::get_user_groups([$uid])}</code></strong>
  <p>This function returns an array of FEU groups that this user belongs to (if any).  The output is an array suitable for use in a select list (the key is the groupid, value is the group name).</p>
  <p>Example:</p>
<pre><code>{$mygroups=feu_smarty::get_user_groups()}
{$mygroups|@print_r}</code></pre>
</li>

<li><strong><code>{feu_smarty::is_user_memberof($groups[,$uid])}</code></strong>
  <p>This function returns a boolean if the user is a member of one the specified groups.</p>
  <p>The groups parameter can be a comma delimited string of group names, or an array of group names.</p>
  <p>If the uid parameter is not specified, the currently logged in userid is used.</p>
  <p>Example:</p>
<pre><code>{if feu_smarty::memberof('Staff,Managers')}Hello Customer{/if}</code></pre>
</ul>


<h3>Privacy Related Items:</h3>
<p>This module does track the IP address of users.  And does store that information in its history.  Additionally, the administrator has the ability to configure the module so that cookies are used.  However no personal information is stored in the cookies (if enabled).  Only a system assigned unique user identifer, and a session identifier.</p>
<h3>See Also:</h3>
<ul>
  <li>CustomContent - <em>(deprecated)</em> Provides smarty tags and utilities for more flexible control of protected pages.</li>
  <li>SelfRegistration - Provides the ability to allow users to register themselves, including paid registration options.</li>
  <li>CGUserDirectory - Provides the ability to browse and search through the profile information of known users.</li>
</ul>
<h3>Encrypted Data:</h3>
<p>The Encrypted field functionality is intended to store (in a secure way) personal and private data that even the site administrator should not have access to.  i.e: items such as Credit Card information.  The only person that should be able to view and edit this data is the user himself.   This data should not be exported to plain text either.  The data could however be read and used by other modules.</p>
<p><strong>Note:</strong>  There may be a need for an additional module to display the unencrypted form of encrytped user information, however the FEU module does not need it.</p>
<h3>FAQ</h3>
<ul>
  <li><strong>Q:</strong> Why can't I create a group
    <p><strong>A:</strong> Groups can't be created untill at least one property is created.</p>
  </li>
  <li><strong>Q:</strong> Why can't I delete a property
    <p><strong>A:</strong> A property can only be deleted if it is not associated with any groups as required or hidden.  Additionally, properties created by other modules cannot be deleted.</p>
  </li>
  <li><strong>Q:</strong> Setting property order doesn't seem to work
  <p><strong>A:</strong> The percieved property order will change each time the group is edited.  The properties that are marked as &quot;off&quot; will always be displayed at the bottom, but the sort order of other properties will be retained.</p>
  </li>
</ul>

<h3>Support</h3>
<p>The module author is in no way obligated to provide support for this code in any fashion.  However, there are a number of resources available to help you with it:</p>
<ul>
<li>A bug tracking and feature request system has been created for this module <a href="http://dev.cmsmadesimple.org/projects/frontendusers">here</a>.  Please be verbose and descriptive when submitting bug reports and feature requests, and for bug reports ensure that you have provided sufficient information to reliably reproduce the issue.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.  When describing an issue please make an effort to provide all relavant information, a thorough description of your issue, and steps to reproduce it or your discussion may be ignored.</li>
<li>The author, calguy1000, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.  However, please use this as a last resort, and ensure that you have followed all applicable instructions on the forge, in the forums, etc.</li>
</ul>

<h3>Parameters</h3>
<ul>
<li><em>(optional)</em> action="default"
  <p>Actions:</p>
  <ul>
    <li><em>default</em> - The default action.  If the user is logged in, the logoutform action will be displayed.  If the user is not logged in the login action will be called.
    <li><em>login</em> - Display the login form.</li>
    <li><em>logoutform</em> - Display output about your current username, and actions to change your settings, or logout.  If the user is not logged in, this action does nothing.</li>
    <li><em>changesettings</em> - Display the change settings form for logged in users.  If the user is not logged in, this action does nothing.</li>
    <li><em>forgotpw</em> - Display the forgot password form.</li>
    <li><em>silent</em> - Creates and assigns some smarty variables containing info about the currently logged in user.</li>
    <li><em>lostusername</em> - Display the lostusername form (if the system is properly setup to handle lost username requests, and the user is not currently logged in.</li>
    <li><em>reset_session</em> - Provide a javascript controlled template to allow the manual, or automatic pinging of the user session.  This template can be used to remind the user that his login session is about to expire, and to trigger its reset.  Normally this method is not required as any page that displays the FrontEndUser controls would handle this, just requiring the user to view a page on a regular basis.  However, if there are pages with alot of content requiring extensive reading, this may be a useful solution.</li>
    <li><em>viewuser</em> - Display a report for a single user, requires use of the uid parameter.</li>
  </ul>
</li>

<li><em>(optional)</em> form="name"
<p>Forms:</p>
<div class="warning">Note: The form parameter is deprecated.  Please us the standard action parameter for accessing different FEU forms directly.</div>
<ul>
 <li><em>login</em> - Display the login form <em>(see action=login)</em></li>
 <li><em>logout</em> - Display the logout form <em>(see action=logoutform)</em></li>
 <li><em>changesettings</em> - Display the change settings form <em>(see action=changesettings)</em></li>
 <li><em>forgotpw</em> - Display the forgot password form <em>(see action=forgotpw)</em></li>
 <li><em>lostusername</em> - Display the lost username form. <em>(see action=lostusername)</em></li>
<li><em>silent</em> =  <em>(see action=silent)</em> Display nothing, but export properties and other smarty variables for the currently logged in user.  If no user is logged in, then no variables are exported.</li>
</ul>
</li>

<li><em>(optional)</em> returnto="page"
  <p>Used with the login, logout, and changesettings forms, this parameter contains the page id or alias of a page to redirect to, when the form has been successfully completed</p>
</LI>
<li><em>(optional)</em> only_groups="group1, group2, group3"
   <p>Used with the login forms.  Basically only allows users to login if they belong to that particular group(s).</p>
</li>
<li><em>(optional)</em> lostun_group="group"
   <p>Used with the lostusername form, this feature specifies the frontend user group to assume tht users are members of.</p>
</li>
<li><em>(optional)</em> nocaptcha="1"
  <p>Used with the login forms. This will disable captcha on the form. By default, if the Captcha module is installed, validation of a captcha image will be required for login.  This is a security measure intented to prevent brute force attacks.</p>
</li>
<li><em>(optional)</em> uid=null
  <p>Used with the viewuser action.  This parameter is required to specify which user to view the details of.</p>
</li>
<li><em>(optional)</em> inline=true
  <p>Used with the login action, this parameter indicates that the result of the form submission should replace the original input tag.</p>
</li>
<li><em>(optional)</em> logintemplate=string
  <p>This parameter allows overriding the default login form template with the name of a different one.</p>
</li>
<li><em>(optional)</em> logouttemplate=string
  <p>This parameter allows overriding the default logout template with the name of a different one.</p>
</li>
<li><em>(optional)</em> changesettingstemplate=string
  <p>This parameter allows overriding the default changesettings form template with the name of a different one.</p>
</li>
<li><em>(optional)</em> forgotpwtemplate=string
  <p>This parameter allows overriding the default forgot password form template with the name of a different one.</p>
</li>
<li><em>(optional)</em> lostuntemplate=string
  <p>This parameter allows overriding the lost username form template with the name of a different one.</p>
</li>
</ul>
<p><strong>Tip:</strong> You can use the {cge_module_hint} plugin from CGExtensions, or the {cms_module_hint} plugin in CMSMS 2.0 to set these parameters on a global, per-page-template, or per-page basis without having to adjust every call, and while still maintaining pretty URL's.</p>

<h3>Overriding Templates.</h3>
<p>As of FEU 1.30 it is possible to specify different templates for many of the FEU module templates.  It is also flexible.  You can use global content blocks, or file based templates or
 any other smarty resource as a template.</p>
<ul>
  <li>Template names ending with .tpl
    <p>If the specified template name is not a smarty resource, but ends with the extension <code>.tpl</code>, then FEU (actually CGExtensions) will assume that you want a file template from the module directory, or from the module_custom directory <em>(see <a href="http://docs.cmsmadesimple.org">http://docs.cmsmadesimple.org</a> for a description of the module_custom stuff)</em>.
  </li>
  <li>globalcontent:gcb_name
    <p>Specifying a template in this syntax allows you to use a global content block as as replacement template.</p>
  </li>
  <li>template:gcb_name
    <p>Specifying a template in this syntax allows you to use a page template as as replacement template.</p>
  </li>
  <li>cms_template:name <em>(CMSMS 2.0 only)</em>
    <p>Specifying a template in this syntax allows you to use a template from within Design Manager as as replacement template.</p>
  </li>
  <li>file:filename.tpl
    <p>Using this syntax allows you to use a file based template from within the smarty templates dir <em>(usually tmp/templates)</em>.
  </li>
</ul>

<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h3>Requirements</h3>
<p>In order to implement the forgotten password functionality, this module requires the CMSMailer module to be previously installed and properly configured.</p>
<p>For encrypted fields the mcrypt functionality is required.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&lt;calguy1000@cmsmadesimple.org&gt;</a>. All Rights Are Reserved.</p>
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
