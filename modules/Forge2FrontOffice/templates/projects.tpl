
{include file='filter.tpl'}

{include file='paginator.tpl'}



{foreach $projects as $aproject name='cpt'}
	{if $smarty.foreach.cpt.index % 2 == 0}
		<ul class="small-block-grid-2"  data-equalizer>
	{/if}
		<li>
			<div class="panel callout radius" data-equalizer-watch>
				<h4>{$aproject.name}</h4>
			  	<div>{$aproject.description|strip_tags|summarize:50}</div>
			  	<span class='cta-button'>
			  		<a class='button success tiny' href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}'>Let's take a look</a>
			  		<a class='button success tiny disabled' href='{root_url}/project/{$aproject.id}/{$aproject.unix_name}/file/list'>Download</a>
			  	</span>
			</div>
		</li>

	{if $smarty.foreach.cpt.index % 2 == 1}
		</ul>
	{/if}

{/foreach}



{include file='paginator.tpl'}