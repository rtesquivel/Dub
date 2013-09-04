
// List Finder Widget
function listFinderSearchByTerm(term) {
	$('.list-finder-clear').show();

	var items = $('.search-list > li'), ticker = 0;
	$(items).each(function(){
		if( $("*", this).text().toLowerCase().indexOf(term) != -1) {
			$(this).show();
			ticker++;
		}
		else {
			$(this).hide();
		}
	});

	if (ticker == 0) {
		$("#noResults").show();
	} else {
		$("#noResults").hide();
	}
}

function listFinderClear(e){				
	e.preventDefault();
	$('.list-finder input').val('');
	listFinderSearchByTerm('');
	$(this).hide();
	window.location.hash = '';
}