{* Navigation bar*}
<a class='button tiny' href='{$root_url}/project/list'>Project List</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a>
<a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a>
<a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a>
<a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a>

<table>
	<thead>
		<tr>
			<th width="400px">Summary</th>
			<th>Severity</th>
			<th>Resolution</th>
			<th title='Assigned To'></th>
		</tr>
	</thead>
	{if empty($tracker_items)}<tr><td colspan="4">There is no item into this tracker</td></tr>{/if}
	{foreach $tracker_items as $tracker_item}
		{assign tr_color 'transparent'}
		{if $tracker_item.severity == '0'}
			{assign tr_color '#FEBFBC'}
		{else if $tracker_item.severity == '1'}
			{assign tr_color '#FEDBBC'}
		{else if $tracker_item.severity == '2'}
			{assign tr_color '#FBFD93'}
		{else if $tracker_item.severity == '3'}
			{assign tr_color '#FCFEBC'}
		{else if $tracker_item.severity == '4'}
			{assign tr_color '#F5FFE8'}
		{else if $tracker_item.severity == '12'}
			{assign tr_color 'transparent'}
		{/if}

		<tr>
			<td>
				{if $tracker_item.state == 1}<img src='{root_url}/uploads/forge/design/locked.png' alt='This bug is already closed.' width='16px' height='16px'/>{/if}<b><a href='{root_url}/project/{$project.id}/{$project.unix_name}/bug/{$tracker_item.id}'>{$tracker_item.summary}</a></b>
				<br/>
				#{$tracker_item.id} opened on {$tracker_item.created_at|cms_date_format} by {$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}
			</td>
			<td style='background-color:{$tr_color};'>{$enumTrackerItemSeverity[$tracker_item.severity]}</td>
			<td>{$enumTrackerItemResolution[$tracker_item.resolution]}</td>
			<td title='Assign to {$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}'>{if isset($avatar)}<img src='{$avatar}' alt='Assign to {$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}' width='32px' height='32px'/>{/if}</td>
		</tr>
	{/foreach}
</table>
<br/>
<br/>

