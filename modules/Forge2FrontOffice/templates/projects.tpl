{extends file="_glob_2col.tpl"}

{block name=main_content}
	
	{include file='inc_navigation.tpl'}

	{include file='inc_filter.tpl'}

	{include file='inc_paginator.tpl'}



	{foreach $projects as $aproject name='cpt'}
		{if $smarty.foreach.cpt.index % 2 == 0}
			{assign close 0}
			<ul class="small-block-grid-2"  data-equalizer>
		{/if}
			<li>
				<div class="panel callout radius" style='position: relative;' data-equalizer-watch>
					<h4>{$aproject.name}</h4>
				  	<div style='max-width:100%;word-wrap: break-word;'>
				  		<span class='right'>
				  			<a class="th" href="{root_url}/project/{$aproject.id}/{$aproject.unix_name}">
							  <img width='32' height='32' src="{$root_url}/uploads/forge/design/cmsms_400.png">
							</a>
				  		</span>
				  		{$aproject.description|strip_tags|summarize:50}
				  	</div>
				  	<div style='margin-bottom: 57px;'>

				  	{if $smarty.now - $aproject.last_file_date < 2592000 * 5}
				  		<span data-tooltip aria-haspopup="true" class="has-tip" title="A new release has been published recently">
				  			<span class="label">Recently updated</span>
				  		</span>
				  	{/if}

				  	{if $aproject.project_type == 5}	
				  		<span data-tooltip aria-haspopup="true" class="has-tip" title="This is a offical project maintened by the dev-core">
				  			<span class="label warning">Offical Project</span>
				  		</span>
				  	{/if}

				  	{if $smarty.now - $aproject.last_file_date > 2592000 * 12}
				  		<span data-tooltip aria-haspopup="true" class="has-tip" title="Be carefull, this project hasn't be updated since more than a year">
				  			<span class="label alert">Stale</span>
				  		</span>
				  	{/if}

				  	{if $aproject.downloads > 100000}
				  		<span data-tooltip aria-haspopup="true" class="has-tip" title="This is one of the most downloaded module (+100 000 since the beginning)">
				  			<span class="label success">Must Have !</span>
				  		</span>
				  	{/if}
				  	</div>
				  	<div class='' style='position: absolute;bottom: 0px;'>
				  		<a class='button success' href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}'>Let's take a look</a>
				  	</div>
				</div>
			</li>

		{if $smarty.foreach.cpt.index % 2 == 1}
			{assign close 1}
			</ul>
		{/if}

	{/foreach}

	{if !$close}</ul>{/if}



	{include file='inc_paginator.tpl'}

{/block}

{block name=js}{$smarty.block.parent}{/block}