{if $ccuser->loggedin()}
  {Wiki action="setAccess" is_readable="TRUE" is_writable="TRUE" is_deletable="FALSE" author_name=ccUser::property('pseudo') author_id=$ccuser->loggedin() }
{else}
  {Wiki action="setAccess" is_readable="TRUE"}
{/if}