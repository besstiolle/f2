{if isset($error)}
	{$error}
{else}
	{if isset($warn)}{$warn}{/if}
	{$form}
		<label for='{$actionid}name' >Name</label><input type='text' name='{$actionid}name' value=''/>
		<label for='{$actionid}unix_name' >Unix Name</label><input type='text' name='{$actionid}unix_name' value=''/>
		<label for='{$actionid}description' >Description</label><textarea name='{$actionid}description'></textarea>
		<select name='{$actionid}project_type'>
			<option value='1'>module</option>
			<option value='2'>translation</option>
			<option value='3'>plugin</option>
			<option value='4'>other</option>
			<option value='5'>core</option>
			<option value='7'>documentation</option>
		</select>

		<input class='button tiny' type='submit' value='send' />
		<a class='button tiny' href='{$link_back}'>cancel</a>


	</form>
{/if}