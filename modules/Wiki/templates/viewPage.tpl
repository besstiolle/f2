
{if !empty($breadcrumbs)}<ul class="breadcrumbs">
{foreach $breadcrumbs as $bread}
	 <li {if $bread@last}class='current'{/if}><a href="{$bread.url}" {if !empty($bread.class)}class='{$bread.class}'{/if} {if !empty($bread.title)}title='{$bread.title}'{/if}>{$bread.name}</a></li>
{/foreach}</ul>
{/if}

<div class="off-canvas-wrap" data-offcanvas>
<div class="inner-wrap">

<nav class="tab-bar">

	<section class="left-small">
		<a class="left-off-canvas-toggle menu-icon" ><span></span></a>
	</section> 

	<section class="middle tab-bar-section"> 
		
		

	<ul class="button-group in-off-bar right">
		{if $version.status!=1}
			<li><input class='tiny button in-off-bar goLast' type='button' value='See the last version of this page'></li>
		{elseif !$isUpToDate}
			<li><input class='tiny button in-off-bar goLastDefaultLang' type='button' value='The page is a translation and may be outdated. See the original here'></li>
		{elseif !$isDefaultLang}
			<li><input class='tiny button in-off-bar goLastDefaultLang' type='button' value='The page is a translation. See the original here.'></li>
		{/if}
	</ul>

	<ul class="button-group in-off-bar">
		<li><input class='tiny button in-off-bar raw' type='button' value='Show Raw Code'></li>
		<li><input class='tiny button in-off-bar edit' type='button' value='Edit'{if $version.status!=1} disabled='disabled' title='you can not edit an old version'{/if}></li>
		<li><input class='tiny button in-off-bar deletePre' type='button' value='Delete'{if $version.status!=1} disabled='disabled' title='you can not delete an old version'{elseif $isDefaultPage} disabled='disabled' title='you can not delete the default page'{/if}></li>
		<li><input class='tiny button in-off-bar deletePost alert' type='button' value='Delete (Are You Sure?)'></li>

	</ul>	

	</section>


	
	<section class="right-small">
		<a class="right-off-canvas-toggle menu-icon" ><span></span></a>
	</section>
</nav>
<aside class="left-off-canvas-menu">
	<ul class="off-canvas-list">
		<li><label>Menu</label></li>
	
		{foreach $wiki_menu as $elt}
			<li><a href="{$elt.viewUrl}" {if !empty($elt.class)}class='{$elt.class}'{/if}>{$elt.label|capitalize}</a></li>
		{/foreach}
		{*
		<li><label>Options</label></li>
		<li><a href="#">Some options</a></li>
		<li><a href="#">Other options</a></li>
		*}
	</ul>
</aside>
<aside class="right-off-canvas-menu">
	<ul class="off-canvas-list">
		<li><label>Lang</label></li>
		
		{foreach $other_langs as $elt}
			<li><a href="{$elt.viewUrl}" {if !empty($elt.class)}class='{$elt.class}'{/if}>{$elt.label|capitalize}</a></li>
		{/foreach}
		
		<li><label>Revisions</label></li>
		
		{foreach $oldRevisions as $elt}
			<li class='small'><a href="{$elt.viewUrl}">{if $elt.version_id==$version.version_id}&raquo; {/if}The <b>{$elt.dt_creation|cms_date_format|utf8_encode}</b> by <b>{$elt.author_name}</b> </a></li>
		{/foreach} 
		
	</ul>
</aside> 


<section class="main-section">

<div class='panel no-margin h500'>
	{if !empty($sub_entries)}
	<dl class="sub-nav">
		<dt>Sub page:</dt>
		
		{foreach $sub_entries as $elt}
			<dd><a href="{$elt.viewUrl}" {if !empty($elt.class)}class='{$elt.class}'{/if}>{$elt.label|capitalize}</a></dd>
		{/foreach}
	</dl>
	{/if}

	{if !empty($errors)}
	{foreach $errors as $error}{if !empty($error)}
	<div data-alert class="alert-box warning radius">
	  {$mod->Lang($error)}
	  <a href="#" class="close">&times;</a>
	</div>{/if}{/foreach}
	{/if}

	<div class='fancybox' id='raw_result'></div>
	<div class='wikiContent'>{$version.text}</div>

</div>




 </section> <a class="exit-off-canvas"></a> </div> </div>
