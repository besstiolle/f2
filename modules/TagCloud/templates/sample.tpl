{if isset($module_message)}<h2>{$module_message|escape}</h2>{/if}
<p>
{foreach from=$items item=item}
    <a title="Rechercher {$item.word} sur ce site | {$item.count} élements" 
          style="font-size:{$item.size}px; color:{$item.color};" 
          href="index.php?&amp;mact=Search%2Cm99%2Cdosearch%2C0&amp;m99returnid={$returnid}&amp;m99searchinput={$item.word|urlencode}">
      {$item.word}
    </a>
{/foreach}
</p>