{fg_is_project_admin project=$project user_id=ccUser::loggedin() assign=is_admin}
{fg_is_project_member project=$project user_id=ccUser::loggedin() assign=is_member}

{* [{$is_admin}-{$is_member}] *}
{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}

	<p>{$project.description|nl2br}</p>

	{if $is_admin}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
	{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}
	<a class='button tiny' href='{$root_url}/project/list'>Return</a>
{/if}
