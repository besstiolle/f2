<style>

.box{
	border:1px solid #000;
	background-color: #CCC;
	padding: 10px;
	border-radius: 5px;
	margin-bottom: 5px; 
}

.boxW{
	padding: 10px;
	margin-bottom: 5px; 
}

.box h2{
	margin-top: 0;
}

.box p{
	margin: 10px 0;
}

.choice{
	color: #666;
	margin-left: 20px;
}
.choice:before{

}

</style>

{$form_save}
<div class='box'>
	<div class='choice'>
		<h2>Mono-Instance VS Multi-Instances</h2>
		<p>This wiki will be called each time the url <b>starts</b> with the prefix (eg : /wiki/xxx). If you need more instances of the wiki with different urls (eg : /foo/wiki/xxx &amp; /bar/wiki/xxx) you should activate the multi-instances. The prefix will be commun for each instance but the module will be called each time the url <b>contains</b> the prefix.</p>
		<label for='{$actionid}multiInstances0'>Mono Instance</label>
		<input type='radio' name='{$actionid}multiInstances' id='{$actionid}multiInstances0' value='0' {if !$multiInstances}checked{/if}>
		<label for='{$actionid}multiInstances1'>Multi-instances</label>
		<input type='radio' name='{$actionid}multiInstances' id='{$actionid}multiInstances1' value='1' {if $multiInstances}checked{/if}>
	</div>
</div>
<div class='box'>
	<div class='choice'>
		<h2>Prefix of the wiki</h2>
		<p>You can personalize the prefix of your WIKI.</p>
		<label for='{$actionid}prefix'>
			Prefix for URLs : 
			<input type='text' name='{$actionid}prefix' value='{$prefix}' />
		</label>
	</div>
</div>
<div class='box'>
	<div class='choice'>
		<h2>Lang Code in the URL</h2>
		<p>Unless you manage differents langs, you can ask to remove the lang information from the URL (eg : /wiki/FR_fr/home => /wiki/home) .</p>
		<label for='{$actionid}show_code_iso1'>Show langs in URL</label>
		<input type='radio' name='{$actionid}show_code_iso' id='{$actionid}show_code_iso1' value='1' {if $show_code_iso}checked{/if}>
		<label for='{$actionid}show_code_iso0'>Nope</label>
		<input type='radio' name='{$actionid}show_code_iso' id='{$actionid}show_code_iso0' value='0' {if !$show_code_iso}checked{/if}>
	</div>
</div>
<div class='box'>
	<div class='choice'>
		<h2>Default Alias for Home Page</h2>
		<p>You can personalize the alias of the default page.</p>
		<label for='{$actionid}default_alias'>
			Default Alias : 
			<input type='text' name='{$actionid}default_alias' value='{$default_alias}' />
		</label>
	</div>
</div>

	<div>
		<input type='submit' value='save' />
	</div>
</form>

<table class="pagetable">
	<thead>
		<tr>
			<th>Code</th>
			<th>Label</th>
			<th>Actives Pages</th>
			<th>&nbsp;</th>
			<th><a href='{$addLang}'>[+] Add new Lang</a></th>
		</tr>
	</thead>
	<tbody>
		{foreach $langs lang}
			<tr>
				<td>
					{if $lang.isdefault}<b>{/if}{$lang.code}{if $lang.isdefault}</b>{/if}
				</td>
				<td>
					{if $lang.isdefault}<b>{/if}{$lang.label}{if $lang.isdefault}</b>{/if}
				</td>
				<td>
					{if $lang.isdefault}<b>{/if}{$lang.count}{if $lang.isdefault}</b>{/if}
				</td>
				<td>
					{if $lang.isdefault}
						{$imgs.true}
					{else}
						<a href='{$lang.default}'>{$imgs.false}</a>
					{/if}
				</td>
				<td>
					<a href='{$lang.edit}'>{$imgs.edit}</a>{if !$lang.isdefault}&nbsp;&nbsp;<a href='{$lang.delete}'>{$imgs.delete}</a>{/if}
				</td>
			</tr>
		{foreachelse}
			<tr><td>There is no Lang, it's a problem...</td></tr>
		{/foreach}
	</tbody>
</table>

<div><p>Clic <span onclick='$("#resetme").show();' style='color:#F00;cursor: no-drop;'>here</span> if you really <b>really</b> want to reset the wiki</p>
	<p id='resetme' style='display:none;'><a href='{$reset}' >Reset the entire Wiki (trust me, you certainly don't want to clic on this link...)</a></p>
</div>