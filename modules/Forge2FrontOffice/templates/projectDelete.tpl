{fg_is_project_admin project=$project user_id=ccUser::loggedin() assign=is_admin}


{if !$is_admin}
	Sorry dave i can't let you do that
{else if isset($error)}
	{$error}
	<a href='{$root_url}/project/list'>Return</a>
{else}
	{$form}
		<p>Are you sure ?</p>
		<input class='button tiny' type='submit' value='delete' />
		<a class='button tiny' href='{$link_back}'>cancel</a>
	</form>
{/if}