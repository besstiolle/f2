	{$masterTpl}
		{if $itemcount > 0}
				
			{* List of Tags *}
			<div class='sectionwrapper'>
			<h3 class='section'>{$listtagtext}</h3>
			{foreach from=$masterskey item=el}
				<span class='tag2' id='tag2_{$el}'>{$el}</span>
			{/foreach}
			{$newTag}
			</div>
			
			
			{$formstartMaster}
				{foreach from=$masters key=master item=contents}
					<div class='sectionwrapper'>
					<h3 class='section'>{$master}</h3>
					<table id='myTable_{counter}' class="pagetable">
					  <thead>
						<tr>
						  <th class='sortable w20'>{$nametext}<span></span></th>
						  <th class='sortable w20'>{$valuetext}<span></span></th>
						  <th class='sortable w20'>{$lastdatetext}<span></span></th>
						  <th class='w30'>{$tagtext}<span></span></th>
						  <th class="pagepos">{$activetext}</th>
						  <th class="pageicon">&nbsp;</th>
						  <th class="pageicon">&nbsp;</th>
						</tr>
					  </thead>
					  <tbody>
						  
						{foreach from=$contents item=contentsid} 
							{foreach from=$items item=entry}
								{if $entry->id == $contentsid}
							  <tr>
								<td>{$entry->name}</td>
								<td>{$entry->value}</td>
								<td>{$entry->lastdate}</td>
								<td>{foreach from=$sids.$contentsid item=el}<span class='tag' rel='{$el}' id='tag_{$contentsid}'>{$el}</span>{/foreach} {$selects.$contentsid}</td>
								<td class="pagepos">{$entry->activelink}</td>
								<td>{$entry->deletelink}</td>
								<td>{$entry->massdeletebox}</td>
							  </tr>
								{/if}
							{/foreach}
						{/foreach}
					
					 </tbody>
					</table>
					</div>
				{/foreach}
				
				{* With no Master *}
				<div class='sectionwrapper'>
				<h3 class='section'>{$withouttagtext}</h3>
				<table id='myTable_nomaster' class="pagetable">
					  <thead>
						<tr>
						  <th class='sortable w20'>{$nametext}<span></span></th>
						  <th class='sortable w20'>{$valuetext}<span></span></th>
						  <th class='sortable w20'>{$lastdatetext}<span></span></th>
						  <th class='w30'>{$tagtext}<span></span></th>
						  <th class="pagepos">{$activetext}</th>
						  <th class="pageicon">&nbsp;</th>
						  <th class="pageicon">&nbsp;</th>
						</tr>
					  </thead>
					  <tbody>
							{foreach from=$nomasters key=nomastersid item=xx} 
								{foreach from=$items item=entry}
									{if $entry->id == $nomastersid}
								  <tr>
									<td>{$entry->name}</td>
									<td>{$entry->value}</td>
									<td>{$entry->lastdate}</td>
									<td>{$selects.$nomastersid}</td>
									<td>{$entry->activelink}</td>
									<td>{$entry->deletelink}</td>
									<td>{$entry->massdeletebox}</td>
								  </tr>
									{/if}
								{/foreach}
							{/foreach}
					  
					  </tbody>
					</table>
					</div>
			<div style="text-align:right; padding-right: 37px;">{$massdelbutton}</div>
			{$formend}
		{else}
		<br />{$noCounter}<br />
		{/if}
	{$tab_end}