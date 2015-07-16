{extends file="_glob_2col.tpl"}

{block name=main_content}
	{* No navigation because no specific project *}

	{if isset($error)}
		{$error}
	{else}
		{if isset($warn)}{$warn}{/if}
		{$form}
			<label for='{$forge_id}name' >Name</label><input type='text' name='{$forge_id}name' value=''/>
			<label for='{$forge_id}unix_name' >Unix Name</label><input type='text' name='{$forge_id}unix_name' value=''/>
			<label for='{$forge_id}description' >Description</label><textarea name='{$forge_id}description'></textarea>
			<select name='{$forge_id}project_type'>
			{foreach $enumProjectType key value}<option value='{$key}'>{$value}</option>{/foreach}
			</select>

			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>

		</form>
	
	{/if}

{/block}