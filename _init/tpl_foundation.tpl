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
  
  {$content}
  
  </body>
</html>