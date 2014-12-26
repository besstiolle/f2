{if isset($noData)}
 <span class='error'>{$noData}</span>
{else}
	{strip}{literal}
	<script>
	function drawVisualization() {

	// Some raw data (not necessarily accurate)
	  var data = google.visualization.arrayToDataTable([   {/literal}
		['Month', 'blabla'],

	 {foreach from=$matrix key=anKey item=anItem name='lItem'}
	   ['{$anKey}', {$anItem}]{if !$smarty.foreach.lAbs.last},{/if}
	 {/foreach}
		
		{literal}
	  ]);

	  // Create and draw the visualization.
	  var ac = new google.visualization.PieChart(document.getElementById('visualization')).
		 draw(data, {
		title : '{/literal}{$chart_title}{literal}',
		width: 800,
		height: 400,
	  });
	}</script>

	{/literal}
	<div id="visualization" style="width: 900px; height: 500px;"></div>
	{/strip}
{/if}