{if isset($module_message)}<h2>{$module_message|escape}</h2>{/if}
<p>
{foreach from=$items item=item}
    <a title="Rechercher {$item.word} sur ce site | {$item.count} élements" style="font-size:{$item.size}px; color:{$item.color};" 
          href="tag/{$item.word|urlencode}/{$returnid}">{$item.word}</a>&nbsp;

          {**
              If you want to use this template, please don't forget configure your cmsmadesimple to allow pretty url ! 
              After doing it, simply add this line into your .htaccess 

              # TagCloud rewrite 
              RewriteRule ^tag/(.*)\/([0-9]*)$ index.php?&mact=Search,m99,dosearch,0&m99returnid=$2&m99searchinput=$1 [NC,L]
          **}

{/foreach}
</p> 