<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	{foreach $projects as $project}
		<tr>
			<td>
				<a href='{root_url}/project/{$project.id}/{$project.unix_name}'>{$project.id}</a>
			</td>
			<td>{$project.name}</td>
			<td>
				<a href='{root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>
				<a href='{root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>
			</td>
		</tr>
	{/foreach}
</table>
<br/>
<br/>
{*<a href='{$link_create}' class='button tiny'>Create new project</a>*}