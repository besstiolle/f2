{strip}
{*get_template_vars*}

{if isset($project)}
	{capture assign='doesPageExists'}{Wiki action='doesPageExists' pprefix="project/{$project.id}/{$project.unix_name}/wiki"}{/capture}
{else}
	{assign 'doesPageExists' 'false'}
{/if}

{* Navigation bar*}
<ul class="button-group">
	<li><a class='button tiny' href='{$root_url}/project/list'>Project List</a></li>

	{if isset($project)}
		<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a></li>
		{if !$doesPageExists && ($is_admin || $is_member)}
			<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a></li>
		{else if $doesPageExists}
			<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a></li>
		{/if}
	{*	<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a></li> *}
		<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a></li>
		<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a></li>

	{/if}
	{if feu_smarty::get_current_userid()}
	<li><a class='button tiny' href='{$root_url}/account'>My Account</a></li>
	<li><a class='button tiny' href='{$root_url}/account'>Logout</a></li>
	{else}
	<li><a class='button tiny' href='{$root_url}/account'>Login</a></li>
	<li><a class='button tiny' href='{$root_url}/account'>Sign Up</a></li>
	{/if}

</ul>
{/strip}{* END Navigation bar*}
