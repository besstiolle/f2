<dl class="sub-nav">
  <dt>Filter:</dt>
  {foreach $filters filter}
  	<dd class="{$filter.css}"><a href="{$filter.url}">{$filter.text}</a></dd>	
  {/foreach}
</dl>