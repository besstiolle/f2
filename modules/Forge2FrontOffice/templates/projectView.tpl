{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}



		{if isset($avatar)}<img src='{$root_url}{$baseurl_avatar}{$avatar}' />{/if}

		<div data-magellan-expedition="fixed">
		  <dl class="sub-nav">
		  	<dd data-magellan-arrival="summary"><a href="#summary">Summary</a></dd>
		  {foreach $packages as $package}
		    <dd data-magellan-arrival="p_{$package.id}"><a href="#p_{$package.id}">{$package.name}</a></dd>
		  {/foreach}
		  </dl>
		</div>


		<a name="summary"></a><p data-magellan-destination="summary">{$project.description|markdown}</p>



		{foreach $packages as $package}
		<div class='callout panel'>
			<h3 data-magellan-destination="p_{$package.id}"><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/release/{$package.releases.0.id}'>{$package.name} | {$package.releases.0.name}</a></h3><a name="p_{$package.id}"></a>
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
		</div>


		{/foreach}

		{if $is_admin}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/delete'>Delete</a>{/if}
		{if $is_admin || $is_member}<a class='button tiny' href='{$root_url}/project/{$project.id}/{$project.unix_name}/edit'>Edit</a>{/if}

	{/if}

{/block}