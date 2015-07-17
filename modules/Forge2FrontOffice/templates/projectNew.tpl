{extends file="_glob_2col.tpl"}

{block name=main_content}
	{* No navigation because no specific project *}

	<style>
		textarea{
			min-height: 200px;
		}
	</style>

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
					<label for='{$forge_id}description' >Description</label>
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
							<label for='{$forge_id}repository_type' >Project Repository</label>
							<select name='{$forge_id}repository_type'>
								{foreach $enumProjectRepository key value}<option value='{$key}'>{$value}</option>{/foreach}
							</select>
						</div>
					</div>
					<div class="row collapse">
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
			</div>

			<input class='button tiny' type='submit' value='send' />
			<a class='button tiny' href='{$link_back}'>cancel</a>

		</form>
	
	{/if}

	<script>
		
	</script>

{/block}