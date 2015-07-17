{extends file="_glob_2col.tpl"}

{block name=main_content}

	<style>
		.img_wrapper{
			display:inline-block;
			position: relative;
			margin-bottom: 10px;
			margin-right: 10px;
		}
		.delete_action, .delete_action:hover, .delete_action:focus {
		    color: #cf2a0e;
		    cursor: pointer;
		    font-size: 2.22222rem;
		    font-weight: bold;
		    line-height: 1;
		    position: absolute;
		    right: 0.2rem;
		    top: 0.2rem;
		}
		textarea{
			min-height: 200px;
		}
	</style>

	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
		<a href='{$root_url}/project/list'>Return</a>
	{else}
		{if isset($warn)}{$warn}{/if}

		{$form}

			<div class="row">
				<div class="large-12 columns">
					<label for='{$forge_id}name' >Name</label>
					<input type='text' id='{$forge_id}name' name='{$forge_id}name' value='{$project.name}' placeholder='Avoid anything with "made simple" or "-ms inside. Thank you :)'/>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label for='{$forge_id}unix_name' >Unix Name</label>
					<input type='text' {*id='{$forge_id}unix_name' name='{$forge_id}unix_name' value='{$project.unix_name}'*} disabled="disabled" />
				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
					<label for='{$forge_id}description' >Description</label>
					<textarea id='{$forge_id}description' name='{$forge_id}description' placeholder='Will allow people understand why your module is the best module ever.'>{$project.description}</textarea>
				</div>
				{if $is_admin}
				<div class="large-6 columns">
					<div class="row">
						<div class="large-12 columns">
							<label {*for='{$forge_id}project_type'*} >Project Type</label>
							<input type='text' {*id='{$forge_id}project_type' name='{$forge_id}project_type'*} value='TODO : project type' disabled="disabled" />
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label for='{$forge_id}show_join_request' >Show Join Request Button</label>

							<input type="radio" name="{$forge_id}show_join_request" value="1" id="show_join_request_1" {if $project.show_join_request == 1}checked{/if}><label for="show_join_request_1">Show it</label>
				     		<input type="radio" name="{$forge_id}show_join_request" value="0" id="show_join_request_0" {if $project.show_join_request == 0}checked{/if}><label for="show_join_request_0">Hide it</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							
						</div>
					</div>
				</div>
				{/if}
			</div>

			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>
		</form>

		<h3>Change the visuals of the modules</h3>

		<div class='panel'>
			<h4>The logo for your module</h4>
			{if !empty($avatars)}
				{foreach $avatars as $img}
					<div class='img_wrapper'>
						<a class='th radius' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='150,150,#000000,127'}"></a>
						<a class="delete_action" aria-label="Close" data-reveal-id="myModal_{$img.url|md5}">&#215;</a>
					</div>
					<div id="myModal_{$img.url|md5}" class="reveal-modal" data-reveal aria-labelledby="modalTitle_{$img.url|md5}" aria-hidden="true" role="dialog">
					  <h2 id="modalTitle_{$img.url|md5}">Delete the picture</h2>
					  <p><a class='th radius right' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='75,75,#000000,127'}"></a>Are you sure you want deleting this picture ? the operation will be instant and can not be canceled.</p>
					  <a class="close-reveal-modal close" aria-label="Close">&#215;</a>

					  <a href="{$deleteAvatarUrl}?{$forge_id}filename={$img.name|urlencode}" class="button tiny alert">Delete</a>
					</div>
				{/foreach}
			{else}
				<p>You don't have uploaded any picture</p>
			{/if}
			{if !empty($avatarsWaiting)}
				<p>Are already on transfert : </p>
				{foreach $avatarsWaiting as $img}
					<a class='th radius' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='150,150,#000000,127'}"></a>
				{/foreach}
			{/if}

			{if $max_avatars > 0}
				<h4>Upload a new logo for your module</h4>
				<p>Max {$max_avatars} picture, 1024*1024 max and 32*32 min, prefer a cubic picture.</p>
				<div class='avatar_zone'>
					{JQueryFU number=$max_avatars accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_avatar dir_path=$baseurl_avatar max_width='1024' max_height='1024' min_width='32' min_height='32'}
				</div>
			{/if}
		</div>

		<div class='panel'>
			<h4>The pictures for the slideshow of your module</h4>
			{if !empty($shows)}
				{foreach $shows as $img}
					<div class='img_wrapper'>
						<a class='th radius' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='75,75,#000000,127'}"></a>
						<a class="delete_action" aria-label="Close" data-reveal-id="myModal_{$img.url|md5}">&#215;</a>
					</div>
					<div id="myModal_{$img.url|md5}" class="reveal-modal" data-reveal aria-labelledby="modalTitle_{$img.url|md5}" aria-hidden="true" role="dialog">
					  <h2 id="modalTitle_{$img.url|md5}">Delete the picture</h2>
					  <p><a class='th radius right' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='75,75,#000000,127'}"></a>Are you sure you want deleting this picture ? the operation will be instant and can not be canceled.</p>
					  <a class="close-reveal-modal" aria-label="Close">&#215;</a>

					  <a href="{$deleteShowUrl}?{$forge_id}filename={$img.name|urlencode}" class="button tiny alert">Delete</a>
					</div>
				{/foreach}
			{else}
				<p>You don't have uploaded any picture</p>
			{/if}
			
			{if !empty($showsWaiting)}
				<p>Are already on transfert : </p>
				{foreach $showsWaiting as $img}
					<a class='th radius' href="{$img['url']}"><img src="{CGSmartImage src=$img['url'] notag=true filter_resizetofit='75,75,#000000,127'}"></a>
				{/foreach}
			{/if}
			{if $max_shows > 0}
				<h4>Upload more pictures for your slideshow</h4>
				<p>Max {$max_shows} pictures, 1900*1280 max and 150*150 min.</p>
				<div class='show_zone'>
					{JQueryFU number=$max_shows accept_file_types='/\.(gif|jpe?g|png)$/i' dir_url=$baseurl_show dir_path=$baseurl_show max_width='1900' max_height='1280' min_width='150' min_height='150'}
				</div>
			{/if}
		</div>
	{/if}

{/block}