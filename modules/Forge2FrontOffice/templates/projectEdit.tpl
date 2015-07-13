{extends file="_glob_2col.tpl"}

{block name=main_content}

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}
		{if isset($warn)}{$warn}{/if}

		{$form}

			<label for='{$forge_id}name' >Name</label><input type='text' id='{$forge_id}name' name='{$forge_id}name' value='{$project.name}'/>
			<label for='{$forge_id}unix_name' >Unix Name</label><input type='text' id='{$forge_id}unix_name' name='{$forge_id}unix_name' value='{$project.unix_name}' disabled="disabled" />
			<label for='{$forge_id}description' >Description</label><textarea id='{$forge_id}description' name='{$forge_id}description'>{$project.description}</textarea>

			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>
		</form>

		<h3>Change the visuals of the modules</h3>

		<h4>The logo for your module</h4>
		{if !empty($avatars)}
			{foreach $avatars as $img}
				<img src='{$img.url}' width='250px' height='250px' />
			{/foreach}
		{else}
			<p>You don't have uploaded any picture</p>
		{/if}
		
		<h4>Upload a new logo for your module</h4>
		{if !empty($avatarsWaiting)}
			<p>Are already on transfert : </p>
			{foreach $avatarsWaiting as $img}
			<img src='{$img.url}' width='100px' height='100px' />
			{/foreach}
		{/if}
		{if $max_avatars > 0}
			<p>Max {$max_avatars} picture, 1024*1024 max and 32*32 min, prefer a cubic picture.</p>
			<div class='avatar_zone'>
				{JQueryFU number=$max_avatars accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_avatar dir_path=$baseurl_avatar max_width='1024' max_height='1024' min_width='32' min_height='32'}
			</div>
		{/if}


		<h4>The pictures for the slideshow of your module</h4>
		{if !empty($shows)}
			{foreach $shows as $img}
				<img src='{$img.url}' width='250px' height='250px' />
			{/foreach}
		{else}
			<p>You don't have uploaded any picture</p>
		{/if}
		
		<h4>Upload more pictures for your slideshow</h4>
		{if !empty($showsWaiting)}
			<p>Are already on transfert : </p>
			{foreach $showsWaiting as $img}
			<img src='{$img.url}' width='100px' height='100px' />
			{/foreach}
		{/if}
		{if $max_shows > 0}
			<p>Max {$max_shows} pictures, 1900*1280 max and 150*150 min.</p>
			<div class='show_zone'>
				{JQueryFU number=$max_shows accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_show dir_path=$baseurl_show max_width='1900' max_height='1280' min_width='150' min_height='150'}
			</div>
		{/if}
	{/if}

{/block}