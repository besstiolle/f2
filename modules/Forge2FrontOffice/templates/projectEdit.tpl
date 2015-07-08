{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}
		{if isset($warn)}{$warn}{/if}
		{$form}

			<label for='{$actionid}name' >Name</label><input type='text' id='{$actionid}name' name='{$actionid}name' value='{$project.name}'/>
			<label for='{$actionid}unix_name' >Unix Name</label><input type='text' id='{$actionid}unix_name' name='{$actionid}unix_name' value='{$project.unix_name}' disabled="disabled" />
			<label for='{$actionid}description' >Description</label><textarea id='{$actionid}description' name='{$actionid}description'>{$project.description}</textarea>

			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>
		</form>

		<h3>Change the visuals of the modules</h3>

		<h4>The logo of your module</h4>
		<p>Max 1 picture, 1024*1024 max and 32*32 min, prefer a cubic picture.</p>
		<div class='avatar_zone'>
			{JQueryFU number=1 accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_avatar dir_path=$baseurl_avatar max_width='1024' max_height='1024' min_width='32' min_height='32'}
		</div>

		<h4>The pictures for the slideshow of your module</h4>
		<p>Max 10 pictures, 1900*1280 max and 150*150 min.</p>
		<div class='show_zone'>
			{JQueryFU number=10 accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_show dir_path=$baseurl_show max_width='1900' max_height='1280' min_width='150' min_height='150'}
		</div>
	{/if}

{/block}