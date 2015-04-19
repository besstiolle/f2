{Wiki action='doesPageExists' pprefix="project/{$project.id}/{$project.unix_name}/wiki"}

{* Navigation bar*}
<ul class="button-group">
<li><a class='button tiny' href='{$root_url}/project/list'>Project List</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a></li>
<li><a class='button success tiny {if !$doesPageExists}disabled{/if}' {if $doesPageExists}href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'{/if} {if !$doesPageExists}onclick="javascript: return false;"{/if}>Wiki</a></li>
<li><a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a></li>
</ul>


{*fg_is_project_admin project=$project user_id=ccUser::loggedin() assign=is_admin}
{fg_is_project_m project=1 user_id=ccUser::loggedin() assign=is_member*}

{* [{$is_admin}-{$is_member}] *}
{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}



	{if isset($avatar)}<img src='{$root_url}{$baseurl_avatar}{$avatar}' />{/if}
	<p>{$project.description|nl2br}</p>

	{if $is_admin}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
	{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}

{/if}
