{if isset($paginator)}
	<div class="pagination-centered">
		<ul class="pagination">

			<li class="arrow {$paginator.previous.css}"><a href="{$paginator.previous.query}">&laquo; Previous</a></li>
		{foreach $paginator.pages as $num => $page}
			{if !empty($page.query)}
				<li class="{$page.css}"><a href="{$page.query}">{$num}</a></li>
			{else}
				<li class="unavailable"><a href="">&hellip;</a></li>
			{/if}
		{/foreach}
			<li class="arrow {$paginator.next.css}"><a href="{$paginator.next.query}">Next &raquo;</a></li>

		</ul>
	</div>
{/if}