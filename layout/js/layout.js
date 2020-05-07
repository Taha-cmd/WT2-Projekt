/* drop down menu -> header*/
$("#burger-icon").click(function () {
	$("#navbar").slideToggle();
});

$(window).on("resize", function () {
	if ($(window).width() > 768) {
		$("#navbar").show();
	} else if ($(window).width() <= 768) {
		$("#navbar").hide();
	}
});

/* login modal -> login*/
$("#login-link").click(function () {
	$("#modal").slideDown();
	$("#modal-content").fadeIn(500);
});

$("#modal").click(function (event) {
	if (event.target == this) {
		$(this).slideUp();
		$("#modal-content").fadeOut(500);
	}
});
