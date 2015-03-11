{if isset($error)}
	{$error}
{else}
	{if isset($warn)}{$warn}{/if}
	{$form}
		<label for='{$actionid}name' >Name</label><input type='text' name='{$actionid}name' value=''/>
		<label for='{$actionid}unix_name' >Unix Name</label><input type='text' name='{$actionid}unix_name' value=''/>
		<label for='{$actionid}description' >Description</label><textarea name='{$actionid}description'></textarea>
		<select name='{$actionid}project_type'>
		{foreach $enumProjectType key value}<option value='{$key}'>{$value}</option>{/foreach}
		</select>

		<input class='button tiny' type='submit' value='send' />
		<a class='button tiny' href='{$link_back}'>cancel</a>

	</form>
{/if}