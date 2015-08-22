{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}



		{if isset($avatar)}<img src='{$root_url}{$baseurl_avatar}{$avatar}' />{/if}

		{include file='inc_paginator.tpl'}

		{foreach $releases as $release}

		<div class='callout panel clearfix {if !$release.is_active}disabled{/if}'>
			
			{if $is_admin || $is_member}
				<ul class="button-group radius right">
					<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/{$release.id}/delete' class="tiny button alert">Delete</a></li>
					<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/{$release.id}/edit' class="tiny button">Edit</a></li>
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
					<span class="size">{$file.size_human_readable}</span>
				</li>
			{/foreach}
			</ul>
			
			<span class='small right'><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/{$release.id}'>[PERMALINK]</a></span>
		</div>
		{/foreach}

		{include file='inc_paginator.tpl'}

		{if $is_admin || $is_member}
			<ul class="button-group radius">
				<li><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$release.package_id.id}/release/new' class="tiny button">Add new Release</a></li>
			</ul>
		{/if}

	{/if}

{/block}