{Wiki action='doesPageExists' pprefix="project/{$project.id}/{$project.unix_name}/wiki"}

{* Navigation bar*}
<ul class="button-group">
<li><a class='button tiny' href='{$root_url}/project/list'>Project List</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a></li>
<li><a class='button success tiny {if !$doesPageExists}disabled{/if}' {if $doesPageExists}href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'{/if} {if !$doesPageExists}onclick="javascript: return false;"{/if}>Wiki</a></li>
<li><a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a></li>
</ul>

<p><b>{$tracker_item.summary}</b></p>
<p>#{$tracker_item.id} opened on {$tracker_item.created_at|cms_date_format} by {$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}</p>
<ul>
	<li><b>State : </b>{$enumTrackerItemState[$tracker_item.state]}</li>
	{if $tracker_type == 0}<li><b>Severity : </b>{if !empty($tracker_item.severity)}{$enumTrackerItemSeverity[$tracker_item.severity]}{/if}</li>{/if}
	<li><b>Resolution : </b>{if !empty($tracker_item.resolution)}{$enumTrackerItemResolution[$tracker_item.resolution]}{/if}</li>
	<li><b>Assign to : </b>{$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}</li>
</ul>

<div class='panel callout radius'>
	<div><span class="radius secondary label">{$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}, posted on {$tracker_item.created_at|cms_date_format}</span></div>
	{$tracker_item.description|htmlspecialchars|nl2br}
</div>

{assign cpt 0}
{foreach $elements as $key => $element}

	{if $element._type == 'comment'}
		{assign cpt $cpt+1}
		<div class='panel {if $cpt % 2 == 0 }callout{/if} radius'>
			<div><span class="radius {if $cpt % 2 == 0 }secondary{/if} label">
				{if !empty($element.user_id)}{$feu_smarty->get_user_properties($element.user_id,'userprops')}{$userprops.pseudo}{/if}, posted on {$element.created_at|cms_date_format}
			</span></div>
			{$element.comment|htmlspecialchars|nl2br}
		</div>
	{/if}

	{if $element._type == 'history'}
		<div style='width: 55%;margin-left: 45%;margin-bottom: 1.25rem;'>
			<div style='margin-left: 7px; padding-left:8px;padding-bottom: 1px;border-left:2px dotted #000;'>
				{$element.created_at|cms_date_format}
				
				{foreach $element.lines line}
					{if $line.field_name == 'resolution_id'}
						<p>"Resolution" changed from '{if !empty($line.field_value_was)}{$enumTrackerItemResolution[$line.field_value_was]}{/if}' to '{if !empty($line.field_value_actual)}{$enumTrackerItemResolution[$line.field_value_actual]}{/if}'</p>
					{elseif $line.field_name == 'assigned_to_id'}
						<p>"Assigned to" changed from '{if !empty($line.field_value_was)}{$feu_smarty->get_user_properties($line.field_value_was,'userprops')}{$userprops.pseudo}{/if}' to '{if !empty($line.field_value_actual)}{$feu_smarty->get_user_properties($line.field_value_actual,'userprops')}{$userprops.pseudo}{/if}'</p>
					{else}
						"{$line.field_name}" changed from '{$line.field_value_was}' to '{$line.field_value_actual}'
					{/if}
				{/foreach}
				
			</div>
			<div style='background-image:url({$root_url}/uploads/forge/design/arrow-down-16.png);background-repeat: no-repeat;height: 16px;'></div>
		</div>
	{/if} 
{/foreach}

<br/>
<br/>

