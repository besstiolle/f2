{* forgot password verification template *}
<h4>{$mod->Lang('verify_identity')}</h4>
{if !empty($message)}
  {if !empty($error) }
    <div class="alert alert-danger">{$message}</div>
  {else}
    <div class="alert alert-info">{$message}</div>
  {/if}
{/if}

{if isset($startform)}
  {$startform}
  <div class="row">
    <div class="col-sm-3 text-right">{$mod->Lang('prompt_username')}:</div>
    <div class="col-sm-9">
      <input type="{if $username_is_email}email{else}text{/if}" name="{$actionid}feu_username" size="{$unfldlen}" maxlength="{$max_unfldlen}" value="{$username}" disabled="disabled"/>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 text-right">{$mod->Lang('prompt_code')}:</div>
    <div class="col-sm-9">
      <input type="text" name="{$actionid}feu_code" value="{$code}" size="40" maxlength="40" required /> *
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 text-right">{$mod->Lang('prompt_password')}:</div>
    <div class="col-sm-9">
      <input type="password" name="{$actionid}feu_password1" value="{$password1}" size="{$pwfldlen}" maxlength="{$max_pwfldlen}" required/> *
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 text-right">{$mod->Lang('repeatpassword')}:</div>
    <div class="col-sm-9">
      <input type="password" name="{$actionid}feu_password2" value="{$password2}" size="{$pwfldlen}" maxlength="{$max_pwfldlen}" required/> *
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 text-right">&nbsp;</div>
    <div class="col-sm-9">
      <input type="submit" name="{$actionid}feu_submit" value="{$mod->Lang('submit')}"/>
    </div>
  </div>
{$endform}
{/if}
