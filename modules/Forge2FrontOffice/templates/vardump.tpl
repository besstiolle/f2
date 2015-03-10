
<p>
	<a href="#" class='xlarge' data-reveal-id="modal_dump">Show Rest Dump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_response">Show Response Dump</a>
<p>


<div id="modal_response" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$response|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_dump" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$dump|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>