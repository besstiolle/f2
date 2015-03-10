{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}

	<p>{$project.description}</p>

	<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>
	<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>
	<a class='button tiny' href='{$root_url}/project/list'>Return</a>
{/if}
