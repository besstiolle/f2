{extends file="_glob_2col.tpl"}

{block name=main_content}

	<style>
	.avatar{
		padding: 10px;
	}
	.show{
	 	border-top: 1px dotted;
	 	border-bottom: 1px dotted;
	    margin: 15px 0;
	    padding: 15px 0;
	}

	</style>

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
			{*<div data-magellan-expedition="fixed">
			  <dl class="sub-nav">
			  	<dd data-magellan-arrival="summary"><a href="#summary">Summary</a></dd>
			  {foreach $packages as $package}
			    <dd data-magellan-arrival="p_{$package.id}"><a href="#p_{$package.id}">{$package.name}</a></dd>
			  {/foreach}
			  </dl>
			</div>*}


			{*<a name="summary"></a>*}<p {*data-magellan-destination="summary"*}>{$project.description|markdown}</p>
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
		<div class='callout panel'>
			<h3 {*data-magellan-destination="p_{$package.id}"*}><a href='{$root_url}/project/{$project.id}/{$project.unix_name}/release/{$package.releases.0.id}'>{$package.name} | {$package.releases.0.name}</a></h3>{*<a name="p_{$package.id}"></a>*}
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
