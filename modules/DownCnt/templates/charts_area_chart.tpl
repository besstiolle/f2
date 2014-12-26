{if isset($noData)}
 <span class='error'>{$noData}</span>
{else}
	{strip}{literal}
	<script>
	function drawVisualization() {
	  var data = google.visualization.arrayToDataTable([   {/literal}
		['Month',   {foreach from=$ord item=anOrd name='lOrd'}
						{if !$smarty.foreach.lOrd.first},{/if}
						'{$anOrd}' 
					{/foreach}
		],

	 {foreach from=$abs item=anAbs name='lAbs'}
	   [{if $day_month == 6}
			'{$week_days.$anAbs}'
		{elseif $day_month==1}
			'{$anAbs}h' 
		{else}
			'{$anAbs}' 
		{/if}, 
	   {foreach from=$ord item=anOrd name='lOrd'}
		 {if !$smarty.foreach.lOrd.first},{/if}{$matrix.$anAbs.$anOrd}
	   {/foreach}
	   ]{if !$smarty.foreach.lAbs.last},{/if}
	 {/foreach}
		
		{literal}
	  ]);

	  // Create and draw the visualization.
	  var ac = new google.visualization.AreaChart(document.getElementById('visualization'));
	  ac.draw(data, {
		title : '{/literal}{$chart_title}{literal}',
		isStacked: true,
		width: 600,
		height: 400,
		vAxis: {title: "{/literal}{$chart_y}{literal}"},
		hAxis: {title: "{/literal}{$chart_x}{literal}"}
	  });
	}</script>

	{/literal}
	<div id="visualization" style="width: 900px; height: 500px;"></div>{/strip}
{/if}