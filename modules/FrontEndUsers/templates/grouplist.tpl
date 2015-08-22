
{if $nprops == 0}
  <div class="red center">{$mod->Lang('error_noproperties')}</div>
{else}
  {if !isset($itemcount) || $itemcount == 0}
    <div class="information">0&nbsp;{$groupsfound}</div>
  {/if}
  <div class="c_full">
    <div class="grid_8" style="margin-left: 0;">
      {if $propcount > 0}{$addgrouplink|default:''}&nbsp;{/if}
      {if isset($itemcount) && $itemcount > 0 && isset($exportlink)}{$exportlink}&nbsp;{/if}
      {$importlink|default:''}
    </div>
    {if isset($itemcount) && $itemcount > 0}
    <div class="grid_4 text-right">{$itemcount}&nbsp;{$groupsfound}</div>
    {/if}
    <div class="clearb"></div>
  </div>

  {if isset($items)}
  <table class="pagetable cms_sortable tablesorter">
	<thead>
		<tr>
			<th width="5%">{$idtext}</th>
			<th>{$nametext}</th>
			<th>{$desctext}</th>
			<th>{$mod->Lang('members')}</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}">
			<td>{$entry->id}</td>
			<td>{$entry->name}</td>
			<td>{$entry->desc}</td>
	                <td>{$entry->nusers|default:$mod->Lang('not_available')}</td>
			<td>{$entry->exportlink|default:''}</td>
			<td>{$entry->editlink|default:''}</td>
			<td>{$entry->deletelink|default:''}</td>
		</tr>
		{/foreach}
	</tbody>
  </table>
  {/if}
{/if}
