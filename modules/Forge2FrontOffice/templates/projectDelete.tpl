{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}
	{$form}
		<p>Are you sure ?</p>
		<input class='button tiny' type='submit' value='delete' />
		<a class='button tiny' href='{$link_back}'>cancel</a>
	</form>
{/if}