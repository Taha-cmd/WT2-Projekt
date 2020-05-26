$(".img-container").on("dragstart", function (e) {
	var image = $(this).find("img").attr("src");
	var price = $(this).find(".price").html();

	// when the dragstart event kicks off, you can write data into the event datatransfer property
	// when the drag event ends (drop), the data will be transfered and caught by the element dropped on
	e.originalEvent.dataTransfer.setData("image", image);
	e.originalEvent.dataTransfer.setData("price", price);
});

$("#cart div").on("dragover", function (e) {
	$(this).addClass("carthover");
});

$("#cart div").on("dragleave drop", function (e) {
	$(this).removeClass("carthover");
});

$(".buy-image > button").click(function (e) {
	var price = $(this).prev().children().first().html();
	var image = $(this).parent().parent().parent().find("img").attr("src");
	buy(image, price);
});

$("#cart").on("drop", function (e) {
	var image = e.originalEvent.dataTransfer.getData("image");
	var price = e.originalEvent.dataTransfer.getData("price");
	buy(image, price);
});

function buy(image, price) {
	var obj = { image: image, price: price };
	obj = JSON.stringify(obj);
	$.ajax({
		type: "POST",
		url: "index.php",
		data: { buy: obj },
		success: function (response) {
			updateCart(JSON.parse(response));
			animateCart();
		},
	});
}

$(".remove-product").click(function (e) {
	var image = $(this).parent().parent().parent().find("img").attr("src");
	var divToRemove = $(this).parent().parent().parent();

	$.ajax({
		type: "POST",
		url: "index.php",
		data: { remove_product: image },
		success: function (response) {
			updateCart(JSON.parse(response));
			$(divToRemove).removeClass("d-flex").remove();
			animateCart();
		},
	});
});

function updateCart(response) {
	$("#price").html(response.price);
	$("#count").html(response.count);
	$("#sum").html(response.price);
	if (response.price == 0) {
		$("#pay").removeClass("d-flex").remove();
	}
}

function animateCart() {
	$("#cart div").addClass("carthover");
	setTimeout(() => {
		$("#cart div").removeClass("carthover");
	}, 250);
}
