{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if $tracker_type == 0}
		{assign tracker_type_str 'bug'}
	{else}
		{assign tracker_type_str 'request'}
	{/if}

	{include file='inc_filter.tpl'}

	{include file='inc_paginator.tpl'}

	<table>
		<thead>
			<tr>
				<th style='width:400px;'>Summary</th>
				<th>{if $tracker_type == 0}Severity{/if}</th>
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
				<td {if $tracker_type == 0} style='width:400px;'{/if}>
					{if $tracker_item.state == 1}<img src='{root_url}/uploads/forge/design/locked.png' alt='This {$tracker_type_str} is already closed.' width='16px' height='16px'/>{/if}<b><span style='word-break: break-all;'><a href='{root_url}/project/{$project.id}/{$project.unix_name}/{$tracker_type_str}/{$tracker_item.id}'>{$tracker_item.summary}</a></span></b>
					<br/>
					#{$tracker_item.id} opened on {$tracker_item.created_at|cms_date_format} by {$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}
				</td>
				{if $tracker_type == 0}<td style='background-color:{$tr_color};'>{if isset($tracker_item.severity)}{$enumTrackerItemSeverity[$tracker_item.severity]}{/if}</td>{else}<td></td>{/if}
				<td style='overflow: hidden;max-width: 50px;' >{if isset($tracker_item.resolution)}{$enumTrackerItemResolution[$tracker_item.resolution]}{/if}</td>
				<td title='Assign to {$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}'>{if isset($avatar)}<img src='{$avatar}' alt='Assign to {$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}' width='32px' height='32px'/>{/if}</td>
			</tr>
		{/foreach}
	</table>

	{include file='inc_paginator.tpl'}

{/block}