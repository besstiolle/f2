{if isset($error)}
	{$error}
{else}
	{if isset($warn)}{$warn}{/if}
	{$form}

		<input type='hidden' name='{$actionid}routing' value='{$routing}'/>
		<input type='hidden' name='{$actionid}method' value='{$method}'/>
		<input type='hidden' name='{$actionid}link_next_success' value='{$link_next_success}'/>
		<input type='hidden' name='{$actionid}link_next_failed' value='{$link_next_failed}'/>

		<label for='{$actionid}name' >Name</label><input type='text' name='{$actionid}name' value='{$project.name}'/>
		<label for='{$actionid}unix_name' >Unix Name</label><input type='text' name='{$actionid}unix_name' value='{$project.unix_name}' disabled="disabled" />
		<label for='{$actionid}description' >Description</label><textarea name='{$actionid}description'>{$project.description}</textarea>

		<input type='submit' value='send' />
		<a href='{$link_back}'>cancel</a>


	</form>

{/if}