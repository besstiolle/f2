<p><b>My modules</b></p>
{if empty($assignments)}
	<p>It seems you don't have any projects right now.</p>
{else}
	<ul style='font-size:0.8em;'>
		{foreach $assignments as $assignment}
			<li>
			
				<a href='{root_url}/project/{$assignment.project_id.id}/{$assignment.project_id.unix_name}'>{$assignment.project_id.name}</a>
					{*	<a href='{root_url}/project/{$assignment.project_id.id}/{$assignment.project_id.unix_name}/delete'>Delete</a>
						<a href='{root_url}/project/{$assignment.project_id.id}/{$assignment.project_id.unix_name}/edit'>Edit</a> *}

				{if $assignment.role == $enumAssignmentRole.Administrator}
					<span class="label success">admin</span>
				{else if $assignment.role == $enumAssignmentRole.Member}
					<span class="label info">dev</span>
				{/if}

				{if $assignment.project_id.state == $enumProjectState.hidden}
					<span class="label success">closed</span>
				{else if $assignment.project_id.state == $enumProjectState.pending}
					<span class="label info">pending</span>
				{/if}
			</li>
		{/foreach}
	</ul>
{/if}
<a href='{$link_create}' class='button tiny'>Create new project</a>
