{if isset($error)}
	{$error}
{else}
	{if isset($warn)}{$warn}{/if}
	{$form}
		
		<input type='hidden' name='{$actionid}routing' value='{$routing}'/>
		<input type='hidden' name='{$actionid}method' value='{$method}'/>
		<input type='hidden' name='{$actionid}link_next_success' value='{$link_next_success}'/>
		<input type='hidden' name='{$actionid}link_next_failed' value='{$link_next_failed}'/>

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

		<input type='submit' value='send' />
		<a href='{$link_back}'>cancel</a>


	</form>
{/if}