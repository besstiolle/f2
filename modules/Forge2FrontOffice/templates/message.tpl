{extends file="_glob_2col.tpl"}

{block name=main_content}

{include file='inc_navigation.tpl'}

<div class="panel">
	<div data-alert="" class="alert-box {$css} radius">
	 	{$label}
	  	{if $closable}<a href="#" class="close">×</a>{/if}
	</div>	
	{if isset($next)}<a href="{$next}" class="button {$css} tiny radius right">Continue</a>{/if}

	{if isset($quote)}<blockquote>{$quote}{if isset($quoteBy)}<cite>{$quoteBy}</cite>{/if}</blockquote>{/if}

</div>

{/block}