{* forgot password template *}
{if !isset($forgotpwdone)}
<script type="text/javascript">
{* uses jquery to set the form to novalidate if cancel is clicked *}
$(document).ready(function(){
  $('#feu_cancel').click(function(ev){
     $(this).closest('form').attr('novalidate','novalidate');
  });
})
</script>
{/if}

<h4>{$mod->Lang('title_forgotpw')}</h4>
{if !empty($message) }
  {if !empty($error) }
    <div class="alert alert-danger">{$message}</div>
  {else}
    <div class="alert alert-info">{$message}</div>
  {/if}
{else}
  <div class="alert alert-info">{$mod->Lang('lostpw_message')}</div>
{/if}

{if !isset($forgotpwdone)}
  {if isset($startform)}
    {$startform}
    <div class="row">
      <div class="col-sm-2 text-right">
        {if $username_is_email}
          {$mod->Lang('prompt_email')}:
        {else}
          {$mod->Lang('prompt_username')}:
        {/if}
      </div>
      <div class="col-sm-10">
        <input name="{$actionid}feu_username" type="{if $username_is_email}email{else}text{/if}" size="{$unfldlen}" maxlength="{$max_unfldlen}" value="{$username}" required/> *
      </p>
    </div>
    {if isset($captcha)}
    <div class="row">
      <div class="col-sm-2 text-right">{$captcha_title}:</div>
      <div class="col-sm-10">{$captcha}
        {if isset($input_captcha)}<div class="row">{$input_captcha}</p>{/if}
      </div>
    </div>
    {/if}
    <div class="row">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" name="{$actionid}feu_submit" value="{$mod->Lang('submit')}"/>
        <input id="feu_cancel" type="submit" name="{$actionid}feu_cancel" value="{$mod->Lang('cancel')}"/>
      </div>
    </div>
    {$endform}
  {/if}
{/if}
