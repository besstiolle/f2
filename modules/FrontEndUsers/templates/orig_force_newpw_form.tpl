{* system default force new password form template *}
<div class="alert alert-info">{$mod->Lang('msg_force_newpw')}</div>

{if isset($error)}
<div class="alert alert-danger">{$error}</div>
{/if}

{$formstart}
<div class="row">
  <div class="col-xs-3 text-right">* {$mod->Lang('password')}:</div>
  <div class="col-xs-9">
    <input type="password" name="{$actionid}feu_password" value="" required/>
  </div>
</div>
<div class="row">
  <div class="col-xs-3 text-right">* {$mod->Lang('repeatpassword')}:</div>
  <div class="col-xs-9">
    <input type="password" name="{$actionid}feu_repeatpassword" value="" required/>
  </div>
</div>
<div class="row">
  <div class="col-xs-3">&nbsp;</div>
  <div class="col-xs-9">
    <input type="submit" name="{$actionid}feu_submit" value="{$mod->Lang('submit')}"/>
  </div>
</div>
{$formend}