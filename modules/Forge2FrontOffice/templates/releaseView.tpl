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

	{foreach $releases as $release}
	<div class='callout panel {if isset($release.current)}current{/if}'>
		<h3 data-magellan-destination="r_{$release.id}">Release {$release.name}</h3>
		<p class='small'><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/release/{$release.id}'>[PERMALINK]</a></p>

		<ul>
		{foreach $release.files as $file}
			<li>
				{$file.filename}
				<span class="counters">{$file.downloads} Hits</span>
				<span class="size">{if $file.size < 1048576}{round($file.size/1024)}Ko{else}{round($file.size/1048576)}Mo{/if}
			</li>
		{/foreach}
		</ul>
		
	</div>
	{/foreach}

{/if}
