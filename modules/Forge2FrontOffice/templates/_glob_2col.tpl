<div class="row">
	<div class="large-12 columns">
		<h1>{block name=title}{if isset($title)}{$title}{else}{title}{/if}{/block}</h1>
	</div>
</div>

<div class="row">
	<div class="large-8 columns">
		<div class="">
			{block name=main_content}:){/block}
		</div>
	</div>

	<div class="large-4 columns">
		{block name=sidebar}

			<div class="panel">
				{if ccUser::loggedin()}
					<p><b>Hello {ccUser::property('pseudo')}</b></p><a href={cms_selflink page='account' urlonly=true}>see my account</a>
				{else}
					<p><b>Not already with us ?</b></p><a href={cms_selflink page='account'  urlonly=true}>signin</a> - signup
				{/if}
			</div>

			{if ccUser::loggedin()}
				<div class="panel">
					{Forge2FrontOffice action='my_modules' user_id=ccUser::loggedin()}
				</div>
			{/if}

		{/block}

	</div>

</div>

{block name=js}
	<script>window.jQuery || document.write('<script src="{root_url}/uploads/foundation/js/vendor/jquery.js"><\/script>')</script>
	<script src="{root_url}/uploads/foundation/js/foundation.min.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.abide.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.topbar.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.equalizer.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.offcanvas.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.magellan.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.clearing.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type='text/javascript' src='{root_url}/modules/Wiki/scripts/jquery/jquery.mousewheel-3.0.6.pack.js'></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type='text/javascript' src='{root_url}/modules/Wiki/scripts/fancybox/jquery.fancybox.js?v=2.1.5'></script>

	<script>
	  $(document).foundation();
	</script>
	{if isset($wiki_js)}{$wiki_js}{/if}
{/block}