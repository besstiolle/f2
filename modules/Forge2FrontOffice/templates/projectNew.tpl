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
					<label for='{$forge_id}name' >Name</label>
					<input type='text' id='{$forge_id}name' name='{$forge_id}name' value='' placeholder='Avoid anything with "made simple" or "-ms inside. Thank you :)'/>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label for='{$forge_id}unix_name' >Unix Name</label>
					<input type='text' id='{$forge_id}unix_name' name='{$forge_id}unix_name' value='' placeholder='must be unique with only-letters in lowercase.'/>
				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
					<label for='{$forge_id}description' >Description <span class="markdown radius label right">Markdown Ready</span></label>
					<textarea id='{$forge_id}description' name='{$forge_id}description' placeholder='Will allow people understand why your module is the best module ever.'></textarea>
				</div>

				<div class="large-6 columns">
					<div class="row">
						<div class="large-12 columns">
							<label for='{$forge_id}project_type' >Project Type</label>
							<select name='{$forge_id}project_type'>
								{foreach $enumProjectType key value}<option value='{$key}'>{$value}</option>{/foreach}
							</select>
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<label for='{$forge_id}license_id' >License</label>
							<select name='{$forge_id}license_id'>
								{foreach $licenses license}<option value='{$license.id}' {if $license.id == $defaultLicense}selected{/if}>{$license.name}</option>{/foreach}
							</select>
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<label for='{$forge_id}repository_type' >Project Repository</label>
							<select name='{$forge_id}repository_type' id='{$forge_id}repository_type'>
								{foreach $enumProjectRepository key value}<option value='{$key}'>{$value}</option>{/foreach}
							</select>
						</div>
					</div>
					<div class="row collapse hide" id='github_repo'>
						<div class="large-5 columns">
							<span class="prefix">https://github.com/</span>
						</div>
						<div class="large-7 columns">
							<input type="text" name='{$forge_id}github_repo' placeholder="Enter your URL...">
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<label for='{$forge_id}show_join_request' >Show Join Request Button</label>

							<input type="radio" name="{$forge_id}show_join_request" value="1" id="show_join_request_1" checked><label for="show_join_request_1">Show it</label>
				     		<input type="radio" name="{$forge_id}show_join_request" value="0" id="show_join_request_0"><label for="show_join_request_0">Hide it</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<label for='{$forge_id}registration_reason' >Registration Reason <span class="markdown radius label right">Markdown Ready</span></label>


					<textarea id='{$forge_id}registration_reason' name='{$forge_id}registration_reason' placeholder='Let us know what you want to do with this new Project. It will help us deciding to validate your project (or not).'></textarea>
				</div>
			</div>


			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>

		</form>
	
	{/if}

{/block}

{block name=js}
	{$smarty.block.parent}
	<script>
		$( document ).ready(function() {
		  $("#{$forge_id}repository_type").change(function() {
			  if($(this).val() == 3{* GITHUB *}){
			  	$("#github_repo").show();
			  } else {
			  	$("#github_repo").hide();
			  }
			});
		});
	</script>
{/block}