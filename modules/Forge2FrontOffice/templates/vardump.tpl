{extends file="_glob_1col.tpl"}

{block name=main_content}

  {foreach $dump as $rest}

    <h2>&rarr;Rest Request&larr;</h2>
    <h3 class="subheader">Summary</h3>
    <div>
      {if isset($rest.GET)}<p>Route : <span class='method'>GET</span> <span class='tiny'>{$rest.GET}</span></p>{/if}
      {if isset($rest.POST)}<p>Route : <span class='method'>POST</span> <span class='tiny'>{$rest.POST}</span></p>{/if}
      {if isset($rest.PUT)}<p>Route : <span class='method'>PUT</span> <span class='tiny'>{$rest.PUT}</span></p>{/if}
      {if isset($rest.DELETE)}<p>Route : <span class='method'>DELETE</span> <span class='tiny'>{$rest.DELETE}</span></p>{/if}
      <p>Code : <span class="{if $rest.http_code == 200}success{else}alert{/if} label">{$rest.http_code}</span></p>
      <p>Time : <span class="{if $rest.time_exec < 0.04}success{elseif $rest.time_exec < 0.1}warning{else}alert{/if} label">{$rest.time_exec}</span></p>
    </div>
    <table>
    <thead><tr><th>Key</th><th>Value</th></tr></thead>
    <tbody>
    <tr><td class='key'>base</td><td>{$rest.route_exploded.base}</td></tr>
    {foreach $rest.route_exploded.key as $key => $value}
      <tr><td class='key'>{$key}</td><td>{$value}</td></tr>
    {/foreach}
    </tbody>
    </table>

    <h3 class="subheader">&rarr;Request</h3>
    <table>
    <thead><tr><th>Key</th><th>Value</th></tr></thead>
    <tbody>
    <tr><td class='key'>request.curloptions</td><td><pre>{$rest.request->getCurlOptions()|var_dump}</pre></td></tr>
    <tr><td class='key'>request.status</td><td>{$rest.request->getStatus()}</td></tr>
    <tr><td class='key'>request.header</td><td><pre>{$rest.request->getHeader()}</pre></td></tr>
    </tbody>
    </table>
    <h3 class="subheader">&larr;Response</h3>
    <table>
    <thead><tr><th>Key</th><th>Value</th></tr></thead>
    <tbody>
    <tr><td class='key'>response.code</td><td>{$rest.json_object.server.code}</td></tr>
    <tr><td class='key'>response.message</td><td>{$rest.json_object.server.message}</td></tr>
    <tr><td class='key'>response.microtime</td><td>{$rest.json_object.server.microtime}</td></tr>
    <tr><td class='key'>token</td><td>{if isset($rest['json_object']['server'][token])}{$rest.json_object.server.token.token}{/if}</td></tr>
    <tr><td class='key'>tocken expire on</td><td>{if isset($rest['json_object']['server'][token])}{$rest.json_object.server.token.expireOn}{/if}</td></tr>
    <tr><td class='key'>token unique</td><td>{if isset($rest['json_object']['server'][token])}{$rest.json_object.server.token.isUnique}{/if}</td></tr>

    <thead><tr><th>Key</th><th>Value</th></tr></thead>
    <tr><td class='key'>raw response</td><td><pre>{$rest.request->getResponse()}</pre></td></tr>
    <tr><td class='key'>higlight response</td><td><pre>{$rest.json_exploded}</pre></td></tr>

    </tbody>
    </table>


  {/foreach}
  
{/block}