{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}
	{if isset($warn)}{$warn}{/if}
	{$form}

		<label for='{$actionid}name' >Name</label><input type='text' name='{$actionid}name' value='{$project.name}'/>
		<label for='{$actionid}unix_name' >Unix Name</label><input type='text' name='{$actionid}unix_name' value='{$project.unix_name}' disabled="disabled" />
		<label for='{$actionid}description' >Description</label><textarea name='{$actionid}description'>{$project.description}</textarea>

		<input class='button tiny' type='submit' value='send' />
		<a class='button tiny' href='{$link_back}'>cancel</a>


	</form>

{/if}