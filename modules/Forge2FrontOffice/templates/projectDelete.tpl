{if isset($error)}
	{$error}
{else}
	{$form}

		<input type='hidden' name='{$actionid}routing' value='{$routing}'/>
		<input type='hidden' name='{$actionid}method' value='{$method}'/>
		<input type='hidden' name='{$actionid}link_next_success' value='{$link_next_success}'/>
		<input type='hidden' name='{$actionid}link_next_failed' value='{$link_next_failed}'/>

		<p>Are you sure ?</p>
		<input type='submit' value='delete' />
		<a href='{$link_back}'>cancel</a>
	</form>
{/if}