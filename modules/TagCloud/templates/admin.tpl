<style type="text/css">
label{
    display: block;
    max-width: 400px;
}
textarea{
    height: 150px;
    width: 400px;
	font-family:monospace;
    word-wrap: normal;
}
input[type="text"]{
	width:30px;
}
</style>
{$tabs_start}
   {$start_general_tab}
      {$start_form}
      	<div class="line">
			<h3>{$mod->Lang('title_allowed')}</h3>
      		<label for="{$actionid}allowed">{$mod->Lang('text_allowed')}</label>
      		<textarea id="{$actionid}allowed" name="{$actionid}allowed">{foreach $prefs.allowed as $pattern}{$pattern}
{/foreach}</textarea>
      	</div>
		<div class="line">
			<h3>{$mod->Lang('title_denied')}</h3>
      		<label for="{$actionid}denied">{$mod->Lang('text_denied')}</label>
      		<textarea id="{$actionid}denied" name="{$actionid}denied">{foreach $prefs.denied as $pattern}{$pattern}
{/foreach}</textarea>
      	</div>
		<div class="line">
			<h3>{$mod->Lang('title_colors')}</h3>
      		<label for="{$actionid}colors">{$mod->Lang('text_colors')}</label>
      		<textarea id="{$actionid}colors" name="{$actionid}colors">{foreach $prefs.colors as $pattern}{$pattern}
{/foreach}</textarea>
      	</div>
		<div class="line">
			<h3>{$mod->Lang('title_min_px')}</h3>
      		<label for="{$actionid}min_px">{$mod->Lang('text_min_px')}</label>
      		<input type='text' id="{$actionid}min_px" name="{$actionid}min_px" value='{$prefs.min_px}'/>
      	</div>
		<div class="line">
			<h3>{$mod->Lang('title_max_px')}</h3>
      		<label for="{$actionid}max_px">{$mod->Lang('text_max_px')}</label>
      		<input type='text' id="{$actionid}max_px" name="{$actionid}max_px" value='{$prefs.max_px}'/>
      	</div>
		<div class="line">
			<h3>{$mod->Lang('title_number')}</h3>
      		<label for="{$actionid}number">{$mod->Lang('text_number')}</label>
      		<input type='text' id="{$actionid}number" name="{$actionid}number" value='{$prefs.number}'/>
      	</div>
		
      	<div class="line">
      		<p class="pagetext">&nbsp;</p>
      		<p class="pageinput">{$submit}</p>
      	</div>
      </form>
	  
   {$tab_end}
   
   {$start_template_tab}
		<h3>{$heading_display}</h3>
		{$list_display_templates}
   {$tab_end}
{$tabs_end}