{$startform}
<div class="information">{$mod->Lang('info_force_newpw_template')}</div>
<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('lbl_template')}:</p>
  <p class="pageinput">
    {cge_textarea prefix=$actionid name=force_newpw_template value=$force_newpw_template syntax=1}
  </p>
</div>
<div class="pageoverflow">
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
    <input type="submit" name="{$actionid}defaults" value="{$mod->Lang('defaults')}"/>
  </p>
</div>
{$endform}
