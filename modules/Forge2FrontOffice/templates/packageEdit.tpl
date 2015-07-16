{extends file="_glob_2col.tpl"}

{block name=main_content}
	{include file='inc_navigation.tpl'}

	{if isset($error)}
		{$error}
	{else}
		{if isset($warn)}{$warn}{/if}
		{$form}
		<div class="row">
			<div class="large-12 columns">
				<input type='hidden' name='{$forge_id}projectId' value='{$project.id}' />
				<input type='hidden' name='{$forge_id}packageId' value='{$package.id}' />
				<label for='{$forge_id}name' >Name</label><input type='text' name='{$forge_id}name' value='{$package.name}' placeholder="stable, beta, alpha, ... or module, design package, extended_module, ..." />
 			</div>
 		</div>

		<div class="row">
			<div class="large-6 columns">
				<label>Should it be active ?</label>
				<input type="radio" name="{$forge_id}is_active" value="1" id="is_active_1" {if $package.is_active == 1}checked{/if}><label for="is_active_1">Active</label>
	     		<input type="radio" name="{$forge_id}is_active" value="0" id="is_active_0" {if $package.is_active == 0}checked{/if}><label for="is_active_0">Disable</label>
	     	</div>

			<div class="large-6 columns">
				<label>Should it be indexed ?</label>
				<input type="radio" name="{$forge_id}is_public" value="1" id="is_public_1" {if $package.is_public == 1}checked{/if}><label for="is_public_1">Indexe it</label>
	     		<input type="radio" name="{$forge_id}is_public" value="0" id="is_public_0" {if $package.is_public == 0}checked{/if}><label for="is_public_0">Hide it</label>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<input class='button tiny' type='submit' value='send' />
				<a class='button tiny' href='{$link_back}'>cancel</a>
			</div>
		</div>

		</form>
	
	{/if}

{/block}