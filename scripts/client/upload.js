$(window).on("dragover drop", function (event) {
	event.preventDefault();
	event.stopPropagation();
});

$("#upload [type='file']").change(function (event) {
	uploadPerAjax(event.target.files[0]);
});

$("#dropbox").on("drop", function (event) {
	uploadPerAjax(event.originalEvent.dataTransfer.files[0]);
});

function uploadPerAjax(file) {
	var formData = new FormData();
	formData.append("file", file);

	$.ajax({
		type: "POST",
		url: "index.php",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function (response) {
			console.log(response);
		},
	});
}
