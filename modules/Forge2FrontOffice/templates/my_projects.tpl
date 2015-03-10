{if empty($projects)}
	<p>It seems you don't have any projects right now.</p>
{else}
	<ul>
		{foreach $projects as $project}
			<li><a href='{root_url}/project/{$project.id}/{$project.unix_name}'>{$project.name}</a>
				{*	<a href='{root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>
					<a href='{root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a> *}
			</li>
		{/foreach}
	</ul>
{/if}
<a href='{$link_create}' class='button tiny'>Create new project</a>