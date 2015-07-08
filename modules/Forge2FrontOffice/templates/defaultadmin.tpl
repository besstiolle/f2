	
<h1>Update Forge's Settings</h1>

{$form}
	<label for='{$actionid}user'>User : </label><input name='{$actionid}user' value="{$user}" />
	<label for='{$actionid}pass'>Pass : </label><input name='{$actionid}pass' value="{$pass}" />
	<label for='{$actionid}rest_url'>URL Rest : </label><input name='{$actionid}rest_url' value="{$rest_url}" />
	<input type='submit' value='Save settings' />
</form>

{if isset($token)}
<b style="color:#137007">Connection with Rest Service is okay</b>
{else}
<b style="color:#A61B21">No Connection with Rest Service available</b>
{/if}

<h1>Update Wiki's Settings</h1>

{$forminit}
<input type='submit' value="Initiate Wiki's settings" />
</form>
