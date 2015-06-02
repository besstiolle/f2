<?php

if (!function_exists("cmsms")) exit;

$ops = ModuleOperations::get_instance();
$wiki = $ops->get_module_instance('wiki','',TRUE);
if( !is_object($wiki) ) {
  $this->SetError($this->Lang('error_getmodulewiki'));
  $this->RedirectToAdminTab();
}

$secu = <<<'php'
{if isset($gatewayParams) && isset($gatewayParams.pprefix)}
{Forge2FrontOffice action='wikigateway' wiki_prefix=$gatewayParams.pprefix}
{else}
{Forge2FrontOffice action='wikigateway'}
{/if}

{if $ccuser->loggedin()}
  {Wiki action="setAccess" is_readable=$is_readable is_writable=$is_writable is_deletable=$is_deletable author_name=ccUser::property('pseudo') author_id=$ccuser->loggedin() }
{else}
  {Wiki action="setAccess" is_readable=$is_readable}
{/if}

php;

$wiki->SetTemplate('access',$secu);

$this->redirect($id, 'defaultadmin', $returnid, array('message'=>'admin_wiki_initiated'));

?>