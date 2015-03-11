<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	{foreach $projects as $aproject}
		<tr>
			<td>
				<a href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}'>{$aproject.id}</a>
			</td>
			<td>{$aproject.name}</td>
			<td>
				<a href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}/delete'>Delete</a>
				<a href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}/edit'>Edit</a>
			</td>
		</tr>
	{/foreach}
</table>
<br/>
<br/>
{*<a href='{$link_create}' class='button tiny'>Create new project</a>*}