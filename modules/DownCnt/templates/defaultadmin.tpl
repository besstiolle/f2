{$tabs_start}
	{$hardlinkTpl}
		{if $itemcountHardlink > 0}
		{$formstartHardlink}
		<table id='myTable_{counter start=0}' class="pagetable">
		  <thead>
			<tr>
			  <th class='sortable'>{$nametext}<span></span></th>
			  <th class='sortable'>{$linktext}<span></span></th>
			  <th>{$usageText}</th>

			  <th class="pageicon">&nbsp;</th>
			  <th class="pageicon">&nbsp;</th>
			</tr>
		  </thead>
		  <tbody>
			{foreach from=$itemsHardlink item=entry}
			  <tr>
				<td>{$entry->name}</td>
				<td>{$entry->file}</td>
				<td>{$entry->usage}</td>

				<td>{$entry->deletelink}</td>
				<td>{$entry->massdeletebox}</td>
			  </tr>
			{/foreach}
		  </tbody>
		</table>
		<div style="text-align:right; padding-right: 37px;">{$massdelbuttonhard}</div>
		{$formend}
		{else}
		<br />{$messageHardlink}<br />
		{/if}
		
		{$formstartHardlinkAdd}
		  <h3>{$addText}</h3> 
		  <div><label for="{$id}name">{$newName}* :</label> {$addFormName}<br/>
		  <label for="{$id}file">{$newFile}* :</label> {$addFormFile}<br/>
		  {$submitbutton}</div>
		{$formend}
	
	
	{$tab_end}	

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
	
	{* ################################################# *}
	
	
	{$statsTpl}
	{if $itemcount > 0}
	<div id='statsWrapper'>
		<div id='statsOptionsBox'>
		
			{*<div class="radio">
				<span class='label'>{$title_0}</span>
				<input type="radio" id="radio1" name="radio0" value="1" checked="checked" /><label for="radio1">Stats for Counters Name</label>
				<input type="radio" id="radio2" name="radio0" value="2" /><label for="radio2">Stats for UserAgent</label>
			</div> *}

			<div class="radio">
				<span class='label'>{$title_1}</span>
				<input type="radio" id="radio21" name="radio2" value="1" checked="checked"/><label for="radio21">{$chart_line}</label>
				<input type="radio" id="radio22" name="radio2" value="2"/><label for="radio22">{$chart_area}</label>
				<input type="radio" id="radio23" name="radio2" value="3"/><label for="radio23">{$chart_pie}</label>
			</div>
			
			<div class='radio'>
				<span class='label'>{$title_2}</span>
				<input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
				<div id="slider-range"></div>
			</div>
			
			
			<div class='radio'>
				<span class='label'>{$title_3}</span>
				<input type="checkbox" id="noEnd" value='1'/><label for="noEnd">{$chart_noEnd}</label>
				<input type="checkbox" id="bot" value='1' disabled='disabled'/><label for="bot">{$chart_bot}</label>

			</div>

			<div class="radio by">
				<span class='label'>{$title_4}</span>
				<input type="radio" id="radio12" name="radio1" value="2" checked="checked"/><label for="radio12">{$chart_day}</label>
				<input type="radio" id="radio13" name="radio1" value="3" /><label for="radio13">{$chart_week}</label>
				<input type="radio" id="radio14" name="radio1" value="4" /><label for="radio14">{$chart_month}</label>
				<input type="radio" id="radio15" name="radio1" value="5" /><label for="radio15">{$chart_year}</label>
			
				<br/>
			
				<input type="radio" id="radio11" name="radio1" value="1"/><label for="radio11">{$chart_24}</label>
				<input type="radio" id="radio16" name="radio1" value="6"/><label for="radio16">{$chart_7}</label>
			</div>
			
			
			
			
			<div class="radio master_counter">
				<span class='label'>{$title_5}</span>
				<input type="radio" id="radio31" name="radio3" value="1" checked="checked"/><label for="radio31">{$chart_bytag}</label>
				<input type="radio" id="radio32" name="radio3" value="2"/><label for="radio32">{$chart_bytagD}</label>
				<input type="radio" id="radio33" name="radio3" value="3"/><label for="radio33">{$chart_bycounter}</label>
			</div>
			
			<div class="radio2">	
				<ul id='tag'>
					{foreach from=$ul_masters item=master}
					<li class="checkbox">
						<input type="checkbox" id="tag{$master.master}" value="{$master.master}"/><label for="tag{$master.master}">{$master.master}</label>
					</li>
					{/foreach}
				</ul>
				
				<ul id='counter' style='display:none;'>
					{foreach from=$ul_counters item=counter}
					<li class="checkbox">
						<input type="checkbox" id="counter{$counter.id}" value="{$counter.id}"/><label for="counter{$counter.id}">{$counter.name}</label>
					</li>
					{/foreach}
				</ul>
				
				<div class='clear'></div>
			</div>
			
			<a class="generate" href="#">{$generate}</a>
			
		</div>
		<div id='statsCodeBox'></div>
		<div id='statsRenderBox'></div>
	</div>
	<div class='clear'></div>
		
	{else}
		{$noCounter}
	{/if}
	
	{$tab_end}
{$tabs_end}
<div class="DCversion">20120820</div>
