{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}

		<div class='clearfix'>
			<div class='avatar left'>
				{if empty($avatars)}<img src='{CGSmartImage src='uploads/forge/design/cmsms_400.png' notag=true filter_resizetofit='150,150,#000000,127'}' width='150px' height='150px'/>{/if}
				{if !empty($avatars)}<img src='{CGSmartImage src=$avatars[0]['url'] notag=true filter_resizetofit='150,150,#000000,127'}' width='150px' height='150px'/>{/if}
			</div>
			
			<p>{$project.description|markdown}</p>
		</div>

		{if !empty($shows)}
			<div class='show clearfix'>
				<ul class="clearing-thumbs" data-clearing>
	  			{foreach $shows as $img}
					<li><a class='th radius' href="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='900,600,#000000,127'}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='75,75,#000000,127'}"></a></li>
				{/foreach}
				</ul>
			</div>
		{/if}

		{foreach $packages as $package}
		<div class='callout panel{if !$package.is_active} disabled{/if}'>
			{if $is_admin || $is_member}
				<ul class="button-group radius right">
					<li><a {if !isset($package.releases.0)}href='{$package.delete_link}'{/if} class="tiny button{if isset($package.releases.0)} secondary disabled{else} alert{/if}">Delete</a></li>
					<li><a href='{$package.edit_link}' class="tiny button">Edit</a></li>
				</ul>
			{/if}
			<h3><a href='{if isset($package.releases.0)}{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$package.id}/release/{$package.releases.0.id}{else}{$root_url}/project/{$project.id}/{$project.unix_name}/package/{$package.id}/release/new{/if}'>{$package.name} {if isset($package.releases.0)}| {$package.releases.0.name}{/if}</a></h3>
			{if isset($package.releases.0)}
				 <p class='small'>Last Update : {$package.releases.0.updated_at|cms_date_format}</p>
				
				<div class='expendable'>
					{if !empty($package.releases.0.changelog)}
						<p><b> Changelog : </b>{$package.releases.0.changelog|markdown}</p>
					{/if}
				</div>
				<div class='expendable'>
					{if !empty($package.releases.0.release_notes)}
						<p><b> Release Notes : </b>{$package.releases.0.release_notes|markdown}</p>
					{/if}
				</div>
			{/if}
		</div>


		{/foreach}

		{if $is_admin}<a class='button tiny alert' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
		{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}
		{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/package/new'>Create new Package</a>{/if}

	{/if}

{/block}
