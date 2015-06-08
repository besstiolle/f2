{strip}{Wiki action='doesPageExists' pprefix="project/{$project.id}/{$project.unix_name}/wiki"}

{* Navigation bar*}
<ul class="button-group">
	<li><a class='button tiny' href='{$root_url}/project/list'>Project List</a></li>
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a></li>
{if !$doesPageExists && ($is_admin || $is_member)}
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a></li>
{else if $doesPageExists}
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a></li>
{/if}
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a></li>
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a></li>
	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a></li>
</ul>
{/strip}{* END Navigation bar*}

{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}



	{if isset($avatar)}<img src='{$root_url}{$baseurl_avatar}{$avatar}' />{/if}

	<div data-magellan-expedition="fixed">
	  <dl class="sub-nav">
	  	<dd data-magellan-arrival="summary"><a href="#summary">Summary</a></dd>
	  {foreach $packages as $package}
	    <dd data-magellan-arrival="p_{$package.id}"><a href="#p_{$package.id}">{$package.name}</a></dd>
	  {/foreach}
	  </dl>
	</div>


	<a name="summary"></a><p data-magellan-destination="summary">{$project.description|markdown}</p>



	{foreach $packages as $package}
	<div class='callout panel'>
		<h3 data-magellan-destination="p_{$package.id}">{$package.name} | {$package.releases.0.name}</h3><a name="p_{$package.id}"></a>
		<p class='small'>Last Update : {$package.releases.0.updated_at|cms_date_format}</p>
		{if !empty($package.releases.0.changelog)}
			<p><b> Changelog : </b>{$package.releases.0.changelog|markdown}</p>
		{/if}
		{if !empty($package.releases.0.release_notes)}
			<p><b> Release Notes : </b>{$package.releases.0.release_notes|markdown}</p>
		{/if}
	</div>


	{/foreach}

	{if $is_admin}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
	{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}

{/if}
