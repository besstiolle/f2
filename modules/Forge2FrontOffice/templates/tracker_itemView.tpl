{* Navigation bar*}
<ul class="button-group">
<li><a class='button tiny' href='{$root_url}/project/list'>Project List</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}'>Summary</a></li>
<li><a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/wiki'>Wiki</a></li>
<li><a class='button success tiny disabled' href='{$root_url}/project/{$project.id}/{$project.unix_name}/file/list'>Files</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/bug/list'>Bug Tracker</a></li>
<li><a class='button success tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/request/list'>Features Requests</a></li>
</ul>

<p><b>{$tracker_item.summary}</b></p>
<p>#{$tracker_item.id} opened on {$tracker_item.created_at|cms_date_format} by {$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}</p>
<ul>
	<li><b>State : </b>{$enumTrackerItemState[$tracker_item.state]}</li>
	{if $tracker_type == 0}<li><b>Severity : </b>{$enumTrackerItemSeverity[$tracker_item.severity]}</li>{/if}
	<li><b>Resolution : </b>{$enumTrackerItemResolution[$tracker_item.resolution]}</li>
	<li><b>Assign to : </b>{$feu_smarty->get_user_properties($tracker_item.assigned_to_id,'userprops')}{$userprops.pseudo}</li>
</ul>

<div class='panel callout radius'>
	<span class="radius secondary label">{$feu_smarty->get_user_properties($tracker_item.created_by_id,'userprops')}{$userprops.pseudo}, posted on {$tracker_item.created_at|cms_date_format}</span>
	{$tracker_item.description|htmlspecialchars|nl2br}
</div>

{*foreach $comments comment name=foo}
	<div class='panel {if $smarty.foreach.foo.index % 2 == 1}callout{/if} radius'>
		<span class="radius {if $smarty.foreach.foo.index % 2 == 1}secondary{/if} label">{$feu_smarty->get_user_properties($comment.user_id,'userprops')}{$userprops.pseudo}, posted on {$comment.created_at|cms_date_format}</span>
	{$comment.comment|htmlspecialchars|nl2br}
	</div>
{/foreach*}

{assign cpt 0}
{foreach $elements element}
	
	{if $element.type = 'comment'}
		{assign cpt $cpt+1}
		<div class='panel {if $cpt % 2 == 0 }callout{/if} radius'>
			<span class="radius {if $cpt % 2 == 0 }secondary{/if} label">{$feu_smarty->get_user_properties($element.user_id,'userprops')}{$userprops.pseudo}, posted on {$element.created_at|cms_date_format}</span>
		{$element.comment|htmlspecialchars|nl2br}
		</div>
	{/if}

	{if $element.type = 'history'}
	<div>history</div>
	{/if}
{/foreach}

<br/>
<br/>

