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
				<label for='{$forge_id}name' >Name</label><input type='text' name='{$forge_id}name' value='' placeholder="v1.0.0, 1.0.0, Version #1" />
 			</div>
 		</div>
 		<div class="row">
			<div class="large-6 columns">
				<label>Changelog</label>
				 <textarea placeholder="small-12.columns"></textarea>
	     	</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				<label>Release Notes</label>
	     	</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<label>Should it be active ?</label>
				<input type="radio" name="{$forge_id}is_active" value="1" id="is_active_1" checked><label for="is_active_1">Active</label>
	     		<input type="radio" name="{$forge_id}is_active" value="0" id="is_active_0"><label for="is_active_0">Disable</label>
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