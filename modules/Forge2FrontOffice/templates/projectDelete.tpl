{if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}
	{$form}
		<p>Are you sure ?</p>
		<input type='submit' value='delete' />
		<a href='{$link_back}'>cancel</a>
	</form>
{/if}