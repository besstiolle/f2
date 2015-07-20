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
				<label for='{$forge_id}package_name' >Package</label><input type='text' name='{$forge_id}package_name' value='{$packageName}' readonly="readonly" />
 			</div>
 		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for='{$forge_id}name' >Release's Name</label><input type='text' name='{$forge_id}name' value='{$release.name}' placeholder="v1.0.0, 1.0.0, Version #1" />
 			</div>
 		</div>
 		<div class="row">
			<div class="large-6 columns">
				<label>Changelog</label>
				 <textarea name='{$forge_id}changelog' placeholder="Write here the new features.">{$release.changelog}</textarea>
	     	</div>
			<div class="large-6 columns">
				<label>Release Notes</label>
				 <textarea name='{$forge_id}release_notes' placeholder="Write here information about 'how should you do upgrade'.">{$release.release_notes}</textarea>
	     	</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<label>Should it be active ?</label>
				<input type="radio" name="{$forge_id}is_active" value="1" id="is_active_1" {if $release.is_active == 1}checked{/if}><label for="is_active_1">Active</label>
	     		<input type="radio" name="{$forge_id}is_active" value="0" id="is_active_0" {if $release.is_active == 0}checked{/if}><label for="is_active_0">Disable</label>
	     	</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<input class='button tiny' type='submit' value='send' />
				<a class='button tiny' href='{$link_back}'>cancel</a>
			</div>
		</div>

		<h3>Files of the Release {$release.name}</h3>
		<div class='panel'>
			<h4>Uploaded Files for the Release</h4>
			{if !empty($files)}
				<ul>
					{foreach $files as $file}
						<li><a class='' href="{$file['url']}"></a></li>
					{/foreach}
				</ul>
			{else}
				<p>You don't have uploaded any file</p>
			{/if}
			{if !empty($filesWaiting)}
				<p>Are already on transfert : </p>
				<ul>
					{foreach $filesWaiting as $file}
						<li><a class='' href="{$file['url']}"></a></li>
					{/foreach}
				</li>
			{/if}

			{if $max_files > 0}
				<h4>Upload a new file for your module</h4>
				<p>Max {$max_files} files, are accepted : tar, xml and zip files.</p>
				<div class='avatar_zone'>
					{JQueryFU number=$max_files accept_file_types='/\.(tar|xml|zip)$/i' dir_url=$baseurl_file dir_path=$baseurl_file clean_name="true"}
				</div>
			{/if}
		</div>

		</form>
	
	{/if}

{/block}