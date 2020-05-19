/* validate password on register submit */

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
	console.log(target);
	if (file) {
		const reader = new FileReader();
		reader.readAsDataURL(file);
		reader.addEventListener("load", function () {
			target.attr("src", this.result); // this refers to the reader
			target.show();
		});
	}
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
