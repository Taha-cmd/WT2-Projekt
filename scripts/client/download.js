$(".custom-control-label").click(function (e) {
	var path = $(this)
		.parent()
		.parent()
		.parent()
		.children()
		.first()
		.children()
		.first()
		.attr("href");

	var input =
		'<input name="path[]" class="hidden" type="text" value="' + path + '">';
	$("#download-form").append(input);
});

$("#download-button").click(function (e) {
	enableDownload();
});

$("#download-form").submit(function (e) {
	disableDownload();
});

$("#close-download").click(function (e) {
	e.preventDefault();
	disableDownload();
});

function disableDownload() {
	$(".img-container form").fadeOut();
	$("#download-form").fadeOut();
	$("#download-button").show();
	$(":checkbox").prop("checked", false);
	setTimeout(() => {
		$("#download-form input[type=text]").remove();
	}, 1000);
}

function enableDownload() {
	$(".img-container form").fadeIn();
	$("#download-form").fadeIn();
	$("#download-button").hide();
}
