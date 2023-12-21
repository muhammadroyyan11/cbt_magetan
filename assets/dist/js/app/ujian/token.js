$(document).ready(function () {
	ajaxcsrf();

	$("#btncek").on("click", function () {
		var token = $("#token").val();
		var idUjian = $(this).data("id");

		var key = $("#id_ujian").data("key");
		// success: function (result) {
		Swal({
			type: "success",
			// title: result.status ? "Berhasil" : "Gagal",
			text: "Selamat mengerjakan",
		}).then((data) => {
			// if (result.status) {
			location.href = base_url + "Loker/garap/?key=" + key;
			// }
		});
	});

	var time = $(".countdown");
	if (time.length) {
		countdown(time.data("time"));
	}
});
