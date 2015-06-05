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
	<p>{$project.description|nl2br}</p>

	{foreach $packages as $package}
	<div>
		<h3>{$package.name} | {$package.releases.0.name}</h3>
		<p>Last Update : {$package.updated_at}</p>
		<h4> Changelog : </h4>
		<p>{$package.releases.0.changelog}</p>
		<h4> Release Notes : </h4>
		<p>{$package.releases.0.release_notes}</p>
	</div>

{$package.releases|var_dump}

	{/foreach}

	{if $is_admin}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
	{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}

{/if}
