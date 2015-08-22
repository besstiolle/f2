{* logout form template *}
{if isset($alt_logoutform)}{$alt_logoutform}{/if}
{if isset($message)}<div class="alert alert-info">{$message}</div>{/if}
<p>{$prompt_loggedin}&nbsp;{$username}</p>
<p><a href="{$url_changesettings}" title="{$mod->Lang('info_changesettings')}">{$mod->Lang('prompt_changesettings')}</p>
{if isset($url_logout)}
<p><a href="{$url_logout}" title="{$mod->Lang('info_logout')}">{$mod->Lang('logout')}</a></p>
{/if}
