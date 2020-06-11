$(".tag:not(.fa)").click(function (e) {
	var term = $(this).html();
	term = term.substring(1); // cut off first char '#'
	$("#filter").val(term); // put clicked value in filter
	$("#filter").trigger("keyup"); // trigger search event
});

$(".tag:not(.fa)").on("dragstart", function (e) {
	var term = $(this).html();
	term = term.substring(1);

	e.originalEvent.dataTransfer.setData("term", term);
});

$("#clear-icon").click(function (e) {
	$("#filter").val("");
	$("#filter").trigger("keyup");
});

$("#filter").on("drop", function (e) {
	$(this).val(e.originalEvent.dataTransfer.getData("term"));
	$(this).trigger("keyup");
});

$("#filter").keyup(function (event) {
	var divs = $("#gallery .img-container");
	var term = event.target.value;
	if (term == "") {
		// if no search term, show everything and return
		$.each(divs, function (key, div) {
			$(div).addClass("d-flex");
			$(div).fadeIn();
		});
		return;
	}

	$.ajax({
		type: "POST",
		url: "index.php",
		data: { search: term },
		success: function (response) {
			pics = JSON.parse(response);
			var hide = true;

			$.each(divs, function (key, div) {
				var src = $(div).children().first().children().first()[0]; // get source
				src = $(src).attr("href"); // then compare it to return values
				hide = true;

				$.each(pics, function (index, pic) {
					// compare each string in pics
					if (src.includes(pic)) {
						hide = false;
					}
				});

				if (hide) {
					$(div).removeClass("d-flex");
					$(div).fadeOut();
				} else {
					$(div).addClass("d-flex");
					$(div).fadeIn();
				}
			});
		},
	});
});
