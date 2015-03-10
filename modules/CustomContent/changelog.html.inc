<ul><li>Version 1.0. 14 September 2005. Initial Release.</li></ul>
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
<li>Version 1.5.2 - December, 2008
   <p>Remove erroneous comments from the help, I removed the get_root_alias(), has_children() and other functions long ago and moved them into CGSimpleSmarty.</p>
</li>
<li>Version 1.5.3 - December, 2008
   <p>Remove event handlers.</p>
</li>
<li>Version 1.8.2 
  <p>Remove the last event handler.</li>
  <p>Remove the $customcontent_ variables that were long deprecated.</li>
  <p>Adds a couple of menumanager postfilters.</p>
</li>
<li>Version 1.9 - March, 2013
  <p>Adds {cc_protect} block plugin (why did I not do this a long time ago?)</p>
  <p>Cleans up the main module file.</p>
</li>
</ul>
