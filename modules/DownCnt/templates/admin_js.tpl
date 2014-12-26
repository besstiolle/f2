<script type="text/javascript" src="{root_url}/modules/DownCnt/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<link href="{root_url}/lib/jquery/css/smoothness/jquery-ui-1.8.12.custom.css" type="text/css" rel="stylesheet">
{literal}

<script type="text/javascript">

		function makeAction(){
			// dissocie un tag et un compteur
			$(".tag").click(function(){ 
					tag = $.trim($(this).attr('rel'));
					if(!tag)
					{
						return false;
					}
					sid = $.trim($(this).attr('id')); //"tag_999"
					sid = sid.substring(4);
					url = "{/literal}{$urlDel}{literal}&amp;{/literal}{$id}{literal}tag=" + tag + "&amp;{/literal}{$id}{literal}sid=" + sid;
					masterAjax(url);
				}
			);
			//Supprime un tag
			$(".tag2").click(function(){ 
					if(!confirm('{/literal}{$confirm_del_tag}{literal}'))
					{
						return false;
					}
					tag = $.trim($(this).attr('id')); //"tag2_999"
					tag = tag.substring(5);
					if(!tag)
					{
						return false;
					}
					
					url = '{/literal}{$urlDel}{literal}&amp;{/literal}{$id}{literal}tag=' + tag;
					masterAjax(url);
				}
			);
			//Ajout un tag vide
			$("#newtag").click(function(){ 
					tag = $.trim($(this).prev('input').val());
					if(!tag)
					{
						return false;
					}
					
					url = "{/literal}{$urlAdd}{literal}&amp;{/literal}{$id}{literal}tag=" + tag;
					masterAjax(url);
				}
			);
			//Ajoute un compteur à un tag selon le Select
			$(".addtag").click(function(){ 
					tag = $.trim($(this).prev('select').val());
					if(!tag)
					{
						return false;
					}
					
					sid = $.trim($(this).attr('id'));
					sid = sid.substring(4);
					url = "{/literal}{$urlAdd}{literal}&amp;{/literal}{$id}{literal}tag=" + tag + "&amp;{/literal}{$id}{literal}sid=" + sid;
					masterAjax(url);
				}
			);
			
			
			
			$(".pagetable").tablesorter(); 
			$(".section").click(function(){ 
					$(this).next('table').toggle();
				}
			);
			
		}
		
		function masterAjax($url){
			url = url.replace(new RegExp('&amp;',"g"),'&');
			$.get(url, function(data) {
			  $('#master_c').html(data);
			  makeAction();
			});
		}


		$(document).ready(function() 
		{ 
			makeAction();
		}); 

		google.load('visualization', '1.0', {'packages':['corechart']});
		
		$(function() {
			/* JQuery UI */
			$( "div.radio" ).buttonset();
			$( "#bot" ).button();
			$( "#noEnd" ).button();

			/* START Gestion Slider */
			var milliStart = {/literal}{$date_min}{literal}000;
			var milliEnd = {/literal}{$date_max}{literal}000;
			var date_format = 'dd/mm/yy';
		
			$( "#slider-range" ).slider({
				range: true,
				min: milliStart,
				max: milliEnd,
				values: [ milliStart, milliEnd ],
				slide: function( event, ui ) {
					$( "#amount" ).val( "{/literal}{$chart_from}{literal} " + $.datepicker.formatDate(date_format, new Date(ui.values[ 0 ])) 
						+ " {/literal}{$chart_to}{literal} " + $.datepicker.formatDate(date_format, new Date(ui.values[ 1 ])) );
				}
			});
			
			$( "#amount" ).attr('disabled', 'disabled');
			$( "#amount" ).val( "from " + $.datepicker.formatDate(date_format, new Date($( "#slider-range" ).slider( "values", 0 ))) +
				" to " + $.datepicker.formatDate(date_format, new Date($( "#slider-range" ).slider( "values", 1 ))) );
			
			/* END Gestion Slider */	
			
			/* START Gestion type de stat */			
			/*	$( 'input[name="radio0"]' ).click(function() {
				if( $( 'input[name="radio0"]:checked' ).val() == 1){
					if( $( 'input[name="radio3"]:checked' ).val() == 1 || $( 'input[name="radio3"]:checked' ).val() == 2){
						$( "ul#tag" ).show();
					} else {
						$( "ul#counter" ).show();
					}
					$( "div.master_counter" ).show();
				} else {
					$( "ul#tag" ).hide();
					$( "ul#counter" ).hide();
					$( "div.master_counter" ).hide();
				}
			}); */
			/* END Gestion type de stat */		

			/* START Gestion clic sur boutons */	
			$( 'input[name="radio2"]' ).click(function() {
				if( $( 'input[name="radio2"]:checked' ).val() == 1 || $( 'input[name="radio2"]:checked' ).val() == 2){
					$( "div.by" ).show();
				} else {
					$( "div.by" ).hide();
				}
			});
		
			$( 'input[name="radio3"]' ).click(function() {
				if( $( 'input[name="radio3"]:checked' ).val() == 1 || $( 'input[name="radio3"]:checked' ).val() == 2){
					$( "ul#tag" ).show();
					$( "ul#counter" ).hide();
				} else {
					$( "ul#tag" ).hide();
					$( "ul#counter" ).show();
				}
			});
			
			$( "a.generate" ).button().click(function() {send(); return false; });
			
			/* END Gestion clic sur boutons */	
			
			
		});
		
		/**
		 * Return the url with all the parameters
		 **/
		function getUrl(){
		
			var allVals = [];
			if( $( 'input[name="radio3"]:checked' ).val() == 1 || $( 'input[name="radio3"]:checked' ).val() == 2){
				
				 $('#tag :checked').each(function() {
				   allVals.push($(this).val());
				 });
				
			} else {
				$('#counter :checked').each(function() {
				   allVals.push($(this).val());
				 });
			}		
			
			param = '?';
		//	param += 'clic_useragent=' + $( 'input[name="radio0"]:checked' ).val();
			param += '&datemin=' + $.datepicker.formatDate('yy-mm-dd', new Date($( "#slider-range" ).slider( "values", 0 )));
			param += '&datemax=' + $.datepicker.formatDate('yy-mm-dd', new Date($( "#slider-range" ).slider( "values", 1 )));
			param += '&day_month=' + $( 'input[name="radio1"]:checked' ).val();
			param += '&chart=' + $( 'input[name="radio2"]:checked' ).val();
			param += '&by=' + $( 'input[name="radio3"]:checked' ).val();
			param += '&noEnd=' + $( '#noEnd' ).is(':checked');
			param += '&bot=' + $( '#bot' ).is(':checked');
			param += '&value=' + allVals;		
			myUrl = "{/literal}{$root_url}{literal}/modules/DownCnt/ajax.charts.php";
			return myUrl + param;
		}
	
		/**
		 * do the Ajax call
		 **/
		function send(){
			
			var_url = getUrl();
			
			$.ajax({
			  url: var_url,
			  cache: false,
			  success: function(html){
				$("#statsRenderBox").html(html);

				drawVisualization();
			  },
			  statusCode: {
				404: function() {
				  alert("page not found");
				}
			  }
			});
			
			$("#statsCodeBox").html(getCode());
		}
		
		/**
		 * Show the JS code
		 **/
		function getCode(){
			return '	\
				&lt;script type="text/javascript" src="{/literal}{$root_url}{literal}/lib/jquery/js/jquery-1.7.2.min.js"&gt;&lt;/script&gt;	\
				&lt;script type="text/javascript" src="https://www.google.com/jsapi"&gt;&lt;/script&gt;	\
				&lt;script type="text/javascript"&gt; \
					google.load("visualization", "1.0", {"packages":["corechart"]}); \
					var_url = "'+ getUrl() +'"; \
					$.ajax({ \
					  url: var_url, \
					  cache: false, \
					  success: function(html){ \
						$("#statsRenderBox").html(html); \
						drawVisualization(); \
					  }, \
					  statusCode: { \
						404: function() { \
						  alert("page not found"); \
						} \
					  } \
					}); \
				&lt;/script&gt; \
				&lt;div id="statsRenderBox"&gt;&lt;/div&gt; \
			'; 
		}
	
	</script>{/literal}