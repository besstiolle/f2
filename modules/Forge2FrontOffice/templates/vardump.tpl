
<p>
	<a href="#" class='xlarge' data-reveal-id="modal_dump">Show Rest Dump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_response_request">Show Response.request Dump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_response_server">Show Response.server Dump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_response_data">Show Response.data Dump</a>
<p>


<div id="modal_response_request" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$response.request|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_response_server" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$response.server|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_response_data" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$response.data|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_dump" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$dump|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>