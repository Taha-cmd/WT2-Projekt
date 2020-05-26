var pic; // define pic as global variable, since we have 2 options for upload
//drag, and manuel. each event sets this variable, upload function can send it

function createDescriptionField() {
	var div = "";
	div += '<div class="form-group d-flex flex-row">';
	div += '<i class="far fa-keyboard"></i>';
	div +=
		'<input name="description" type="text" class="form-control" placeholder="description"></div>';

	return div;
}

function createInputField() {
	var div = "";
	div += '<div class="form-group d-flex flex-row">';
	div += '<i class="fas fa-tag tag"></i>';
	div += '<input name="tag[]" type="text" class="form-control"> </div>';

	return div;
}

$("#plus-sign > i").click(function (e) {
	var div = createInputField();
	$(div).insertBefore($(this).parent());
});

$(window).on("dragover drop", function (event) {
	event.preventDefault();
	event.stopPropagation();
});

$("#upload [type='file']").change(function (event) {
	pic = event.target.files[0];
	$("#upload-preview").addClass("d-flex");
	previewPic(pic, "#upload-preview-img > img");
});

$("#dropbox").on("drop", function (event) {
	pic = event.originalEvent.dataTransfer.files[0];
	$("#upload-preview").addClass("d-flex");
	previewPic(pic, "#upload-preview-img > img");
	console.log(pic);
});

$("#upload-preview form").submit(function (e) {
	e.preventDefault();
	var tags = [];
	var description = null;

	$.each(this, function (key, value) {
		tags.push($(value).val());
	});
	tags.pop(); // pop last element (submit button)
	description = tags.shift();
	$("#upload-preview").removeClass("d-flex");
	$("#upload-preview form .form-group").remove(); // remove all input fields for next upload
	$(createDescriptionField()).insertBefore("#plus-sign"); // insert one field
	$(createInputField()).insertBefore("#plus-sign"); // insert one field

	uploadPerAjax(tags, description);
});

function uploadPerAjax(tags, description) {
	tags = JSON.stringify(tags); // need to make a json array
	var formData = new FormData();
	formData.append("file", pic);
	formData.append("tags", tags);
	formData.append("description", description);

	$.ajax({
		type: "POST",
		url: "index.php",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function (response) {
			//console.log(response);
			$("#my-gallery").append(response);
		},
	});
}
