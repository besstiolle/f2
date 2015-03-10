<p style='color:red;'><b style='color:red;'>Oups... There is something wrong</b><br/>{$error}</p>

<p>
	<a href="#" class='xlarge' data-reveal-id="modal_dump">Show Rest Dump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_request_vardump">Show Request vardump</a>
	-
	<a href="#" class='xlarge' data-reveal-id="modal_request_printr">Show Request print_r</a>
<p>


<div id="modal_request_vardump" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$request|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_request_printr" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$request|print_r}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>
<div id="modal_dump" class="reveal-modal" data-reveal>
  <pre style='height: 800px;font-size: 0.6em;'>{$dump|var_dump}</pre>
  <a class="close-reveal-modal">&#215;</a>
</div>