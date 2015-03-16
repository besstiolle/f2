<table>
	<thead>
		<tr>
			<th>Name</th>
		</tr>
	</thead>
	{foreach $projects as $aproject}
		<tr>
			<td>
				<a href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}'>{$aproject.name}</a></td>
		</tr>
	{/foreach}
</table>
<br/>
<br/>
{*<a href='{$link_create}' class='button tiny'>Create new project</a>*}