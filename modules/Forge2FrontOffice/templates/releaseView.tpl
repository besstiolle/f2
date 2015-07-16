{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}



		{if isset($avatar)}<img src='{$root_url}{$baseurl_avatar}{$avatar}' />{/if}

		{foreach $releases as $release}

		<div class='callout panel clearfix {if isset($release.current)}current{/if}'>
			
			{if $is_admin || $is_member}
				<ul class="button-group radius right">
					<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/delete' class="tiny button alert">Delete</a></li>
					<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/edit' class="tiny button">Edit</a></li>
				</ul>
			{/if}

			<h3 {*data-magellan-destination="r_{$release.id}"*}>Release {$release.name}</h3>

			<p class='small'>Last Update : {$release.updated_at|cms_date_format}</p>
			
			<div class='expendable'>
				{if !empty($release.changelog)}
					<p><b> Changelog : </b>{$release.changelog|markdown}</p>
				{/if}
			</div>
			<div class='expendable'>
				{if !empty($release.release_notes)}
					<p><b> Release Notes : </b>{$release.release_notes|markdown}</p>
				{/if}
			</div>

			<ul>
			{foreach $release.files as $file}
				<li>
					{$file.filename}
					<span class="counters">{$file.downloads} Hits</span>
					<span class="size">{if $file.size < 1048576}{round($file.size/1024)}Ko{else}{round($file.size/1048576)}Mo{/if}
				</li>
			{/foreach}
			</ul>
			
			<span class='small right'><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/release/{$release.id}'>[PERMALINK]</a></span>
		</div>
		{/foreach}
		<ul class="button-group radius">
			{if $is_admin || $is_member}
				<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/new' class="tiny button">Add new Release</a></li>
			{/if}

			{if count($releases) == 1}
				<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/release/{$release.id}/all' class="tiny button">See Older</a></li>
			{/if}
		</ul>

	{/if}

{/block}