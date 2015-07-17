{process_pagedata}{content assign='content'}<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{if isset($title)}{$title}{else}{title}{/if} | {Sitename}</title>
    {cms_stylesheet}

    <link rel='stylesheet' type='text/css' href='{root_url}/modules/Wiki/scripts/fancybox/jquery.fancybox.css?v=2.1.5' media='screen' />

    <script src="{root_url}/uploads/foundation/js/vendor/modernizr.js"></script>
  </head>
  <body>
  
  <div class="row">
	<div class="large-12 columns">
		<h1>{if isset($title)}{$title}{else}{title}{/if}</h1>
	</div>
</div>

<div class="row">
	<div class="large-8 columns">
		<div class="">
                        {Forge2FrontOffice action='navigation'}
			{$content}
		</div>
	</div>

	<div class="large-4 columns">

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

		

	</div>

</div>


	<script>window.jQuery || document.write('<script src="{root_url}/uploads/foundation/js/vendor/jquery.js"><\/script>')</script>
	<script src="{root_url}/uploads/foundation/js/foundation.min.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.abide.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.topbar.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.equalizer.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.offcanvas.js"></script>
	<script src="{root_url}/uploads/foundation/js/foundation/foundation.magellan.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type='text/javascript' src='{root_url}/modules/Wiki/scripts/jquery/jquery.mousewheel-3.0.6.pack.js'></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type='text/javascript' src='{root_url}/modules/Wiki/scripts/fancybox/jquery.fancybox.js?v=2.1.5'></script>

	<script>
	  $(document).foundation();
	</script>
	{if isset($wiki_js)}{$wiki_js}{/if}
  
  </body>
</html> 
