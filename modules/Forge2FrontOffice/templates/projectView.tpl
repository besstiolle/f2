{* Navigation bar*}
<a class='button tiny' href='{$root_url}/project/list'>Project List</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a>
<a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a>
<a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a>

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
