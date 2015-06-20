<style>

.json_line{

}

.json_space{
  display: inline-block;
  width: 20px;
}

.json_key{
  color:#911C42;
}

.json_val{
  color:#301C91;
}

.json_valnum{
  color:#7C911C;
}

.json_null{
  color:#1C916C;
}

.key{
  font-weight: bold;
}

</style>

{foreach $dump as $rest}

  <h2>&rarr;Rest Request&larr;</h2>
  <h3 class="subheader">Summary</h3>
  <div>
    <p>Route : <span class='tiny'>{$rest.GET}</span></p>
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
  <tr><td class='key'>token</td><td>{$rest.json_object.server.token.token}</td></tr>
  <tr><td class='key'>tocken expire on</td><td>{$rest.json_object.server.token.expireOn}</td></tr>
  <tr><td class='key'>token unique</td><td>{$rest.json_object.server.token.isUnique}</td></tr>

  <thead><tr><th>Key</th><th>Value</th></tr></thead>
  <tr><td class='key'>raw response</td><td><pre>{$rest.request->getResponse()}</pre></td></tr>
  <tr><td class='key'>higlight response</td><td><pre>{$rest.json_exploded}</pre></td></tr>

  </tbody>
  </table>


{/foreach}