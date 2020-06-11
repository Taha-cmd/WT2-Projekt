/* validate password on register submit */

function previewPic(pic, previewBox) {
	const reader = new FileReader();
	reader.readAsDataURL(pic);
	reader.addEventListener("load", function () {
		$(previewBox).attr("src", this.result); // this refers to the reader object
		$(previewBox).show();
	});
}

$("#register-form").submit(function (event) {
	if ($("[name=password]").val() !== $("[name=confirm-password]").val()) {
		event.preventDefault();
		alert("password did not match");
	}
});

$(".profile-picture-input").change(function () {
	// preview image upon upload before submitting form
	const file = this.files[0]; // this refers to the input tag, first uploaded file
	const target = $(this).prev();
	previewPic(file, target);
});

$("#edit-button").click(function (e) {
	e.preventDefault(); // prevent form from submitting, this validation takes place with ajax
});

$("#confirm-password-button").click(function () {
	// confirm password for editing profile
	event.preventDefault();
	$("#modal").slideUp();
	$("#password-prompt-content").fadeOut(500);

	const password = $("#password-prompt-content [type=password]").val();
	$.ajax({
		type: "POST",
		url: "index.php",
		data: { verify: password },
		success: (response) => {
			response = JSON.parse(response);
			if (response["response"]) {
				$.each($("#edit-form input"), (key, value) => {
					$(value).removeAttr("disabled");
					$("#edit-form [type='submit']").removeClass("d-none");
					$("#edit-form #edit-button").hide();
				});
			} else {
				alert("wrong password");
				$("#password-prompt-content [type=password]").val("");
			}
		},
	});
});

// delete stuff by admin

$(".user-delete").click(function (e) {
	var username = $(this).prev().children().first().children().first().html(); // look at dom
	username = username.replace("username: ", "");
	username = username.replace(" ", ""); // cut off spaces
	deleteRequest({ delete_user: username });

	$($(this).parent()).fadeOut(function () {
		$(this)
			.next()
			.fadeOut(function () {
				$(this)
					.next()
					.fadeOut(function () {
						$(this)
							.next()
							.fadeOut(function () {
								$(this).remove();
							});
						$(this).remove();
					});
				$(this).remove();
			});
		$(this).remove();
	});
});

$(".picture-delete").click(function (e) {
	var path = $(this)
		.parent()
		.prev()
		.children()
		.first()
		.children()
		.first()
		.attr("src");
	console.log(path);
	deleteRequest({ delete_picture: path });
	$($(this).parent().parent()).fadeOut(function () {
		$(this).remove(); // fadeout then remove
	});
});

function deleteRequest(request) {
	$.ajax({
		type: "POST",
		url: "index.php",
		data: request,
		success: function (response) {},
	});
}
