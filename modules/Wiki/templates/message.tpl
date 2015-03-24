<div class='panel'>
	{if !empty($errors)}
	{foreach $errors as $error}{if !empty($error)}
	<div data-alert class="alert-box warning radius">
	  {if !is_array($error)}{$mod->Lang($error)}{/if}
	  {if is_array($error)}{$mod->Lang($error[0],$error[1])}{/if}
	  <a href="#" class="close">&times;</a>
	</div>{/if}{/foreach}
	{/if}


	{if !empty($messages)}
	{foreach $messages as $message}{if !empty($message)}
	<div data-alert class="alert-box success radius">
	  {$mod->Lang($message)}
	  <a href="#" class="close">&times;</a>
	</div>{/if}{/foreach}
	{/if}

	{if !empty($url)}<p><a href='{$url}'>Continue</a></p>{/if}
</div>