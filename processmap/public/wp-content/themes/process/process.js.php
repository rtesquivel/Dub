<script type="text/javascript">

require(["jquery"], function($){

	function autoHighlight(keywords, color, index){
		if(keywords.length)
		$.each(keywords, function(e,i){
			$('p').each(function(){
				// debugger;
				$(this).highlight(i, 1, color);
			});
			$(".auto-highlight:contains('"+ i +"')").each(function(){
				$(this).find('.bubble').css({backgroundColor: color});				
			});			
		});

		// highlight timeline
		//console.log(".timeline tr:nth-child("+ index +") td.active");
		$(".timeline tbody tr:nth-child("+ index +") td.active div").each(function(){ 
			$(this).css({borderColor: color});
		});
		
	}

	$.fn.highlight = function(search, insensitive, hls_class) {
      var regex = new RegExp("(<[^>]*>)|(\\b"+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +")", insensitive ? "ig" : "g");
      return this.html(this.html().replace(regex, function(a, b, c){
        return (a.charAt(0) == "<") ? a : "<span class='highlight'>" + c + "</span>";
      }));
	};


	<?php
		for($i=1; $i <= 8; $i++){
			$color = get_option('process-colors-'. $i);
			$keywords = get_option('process-keywords-'. $i); 

				if($keywords != '' && $color != ''){
				$keywords = explode(',', $keywords);
				$keywords = array_map(function($a){
					return "\"". str_replace("'","\\'", trim($a)) ."\"";
				}, $keywords);
				$keywords = "[". implode(',', $keywords) ."]";

				echo "autoHighlight($keywords, \"$color\", $i);\n";
			}
		}
	?>

	$(document).on('click', '.timeline td', function(){
		if($(this).data('href'))
			window.location = $(this).data('href');
		// alert($(this).data('href'));
	});


	// $('.gallery img').jloupe({		
	// 		cursorOffsetX:-210,
	// 		cursorOffsetY:0,
	// 		radiusLT:100,
	// 		radiusLB:100,
	// 		radiusRT:0,
	// 		radiusRB:100				
	// });


})
</script>