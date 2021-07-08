<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6 id="titleTest">Penilaian bonus [<?php echo $namaSesi ?>]</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tablePegawai">
					<thead id="theadNilai">
						<th>#</th>
						<th>ID</th>
						<th>Nama</th>
					</thead>
					<tbody id="tbodyNilai">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalKelola">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Kelola Detail Pegawai</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var table;


	phpPage = false;

	<?php if (isset($_GET['page'])) : ?>
		phpPage = true;
		pageD = <?php echo $_GET['page'] ?>;
	<?php endif ?>

	// console.log(<?php echo $rowNilai ?>);

	var rowNilai = <?php echo $rowNilai ?>;
	console.log(rowNilai);

	var cCount = 1;

	for (var i = 0; i < rowNilai.length; i++) {
		rowNilai[i]
		$('#theadNilai tr').append('<th class="rowName' + rowNilai[i].id + '">C' + cCount + '</th>');
		cCount++;
	}

	$('#theadNilai tr').append('<th>Aksi</th>');

	var DPegawai = <?php echo $DPegawai ?>;
	var NPegawai = <?php echo $NPegawai ?>;
	var FPegawai = [];

	for (var i = 0; i < NPegawai.length; i++) {

		var json = '{"nama" : "' + NPegawai[i].nama + '", "id" : ' + NPegawai[i].id + '';

		for (var j = 0; j < rowNilai.length; j++) {
			var ada = false;
			for (var DP = 0; DP < DPegawai.length; DP++) {

				if (DPegawai[DP].id_kriteria == rowNilai[j].id && DPegawai[DP].id_pegawai == NPegawai[i].id) {

					json = json + ', "' + DPegawai[DP].id_kriteria + '"';
					json = json + ': "' + DPegawai[DP].nilai + '"';
					ada = true;

				}

			}
			if (!ada) {
				json = json + ', "' + rowNilai[j].id + '"';
				json = json + ': "0"';
			}
		}


		json = json + '}'
		console.log(json);
		FPegawai.push(json);

	}

	console.log("THEAD : " + $("#theadNilai tr th").length);




	var FPCount = 1;

	var mnormal = "{";

	for (var i = 0; i < FPegawai.length; i++) {

		var pgw = JSON.parse(FPegawai[i]);
		console.log(pgw);
		var pgwkey = Object.keys(pgw);

		// console.log(pgw['nama']);

		var st = '<tr><td>' + FPCount + '</td><td>A' + pgw.id + '</td><td>' + pgw.nama + '</td>';

		for (var ii = 0; ii < rowNilai.length; ii++) {
			// console.log("ii :" + ii);
			for (var iii = 0; iii < pgwkey.length; iii++) {
				// console.log("iii :" + iii);
				if (rowNilai[ii].id == pgwkey[iii]) {
					// console.log(pgwkey[iii]);
					// st = st+ '<td><input style="border-style:none;width:70px" class="chosen-disabled  nb'+pgw.id+'" type="number" id="'+pgwkey[iii]+'" disabled value="'+pgw[pgwkey[iii]]+'"></td>';
					if (pgw[pgwkey[iii]] == 5) {
						mnormal += ""
						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "2" > Cukup [2]</option>' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'</select>' +
							'</td>';
					} else if (pgw[pgwkey[iii]] == 4) {

						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "2" > Cukup [2]</option>' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'</select>' +
							'</td>';

					} else if (pgw[pgwkey[iii]] == 3) {

						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "2" > Cukup [2]</option>' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'</select>' +
							'</td>';

					} else if (pgw[pgwkey[iii]] == 2) {

						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "2" > Cukup [2]</option>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'</select>' +
							'</td>';

					} else if (pgw[pgwkey[iii]] == 1) {

						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "2" > Cukup [2]</option>' +
							'</select>' +
							'</td>';

					} else {

						st = st + '<td>' +
							'<input name="vl" value="' + pgw[pgwkey[iii]] + '"  hidden>' +
							'<select class="chosen-disabled nb' + pgw.id + '" id ="' + pgwkey[iii] + '" disabled>' +
							'<option value = "0" > BELUM DINILAI </option>' +
							'<option value = "5" > Sangat Baik [5]</option> ' +
							'<option value = "1" > Sangat Cukup [1]</option>' +
							'<option value = "4" > Baik [4]</option>' +
							'<option value = "3" > Kurang Baik [3]</option>' +
							'<option value = "2" > Cukup [2]</option>' +
							'</select>' +
							'</td>';

					}
					// console.log("BUAT");
				}
				// console.log("TDK");
				// $('#tbodyNilai tr').append('<td></td>')	
			}
		}

		st = st + '<td><button id="btn' + pgw.id + '" onclick="switchEdit(' + pgw.id + ')" class="btn btn-success">Edit</button></td>';

		st = st + '</tr>';

		$('#tbodyNilai').append(st);

		FPCount++;

		if (i + 1 == FPegawai.length) {
			$('#tablePegawai').DataTable();
			table = $('#tablePegawai').DataTable();
			if (phpPage) {
				table.page(pageD - 1).draw('page');
			}
			$('.dataTables_length').addClass('bs-modal');
		}

	}

	mnormal += "}";

	$('#titleTest').click(function(event) {
		alert(table.page() + 1);
	});



	// $('#tbodyNilai tr').append('<td>'+FPCount+'</td><td>'+FPegawai[i].id_pegawai+'</td><td>'+FPegawai[i].nama+'</td><td></td>');


	$(document).ready(function() {});

	function switchEdit(id) {
		console.log(id);
		var btn = '#btn' + id;
		var cls = '.nb' + id;
		if ($(btn).html() == "Simpan") {
			$(btn).html('Edit');
			$(cls).addClass('chosen-disabled');
			$(cls).attr('disabled', true);
			var jsonSend = "[";
			var sendArr = [];
			var send = true;

			var count = 0;

			$(cls).each(function(index, el) {
				if (count != 0) {
					jsonSend = jsonSend + ',';
				}
				var idnilai = $(this).attr('id');
				var value = $(this).val();
				if (value == 0) {
					send = false;
				}
				console.log('ID USER : ' + id + '\n ID NILAI : ' +
					idnilai);
				console.log("NILAI = " + value);

				jsonSend = jsonSend + '{"id_u" : ' + id + ', "id_k" : ' + idnilai + ', "nilai" : ' + value + '}';

				count++;

			});

			jsonSend = jsonSend + "]"

			console.log(jsonSend);


			if (send) {

				Swal.fire({
					title: 'Apakah nilai sudah benar ?',
					text: "Perubahan akan disimpan ke server!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya!!',
					cancelButtonText: 'Tidak!!'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: '<?php echo base_url('admin/editNilai') ?>',
							type: 'POST',
							data: {
								data: jsonSend,
								id_u: id,
								idb: <?php echo $idB ?>
							},
							error: function(data) {
								Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
							},
							success: function(data) {
								if (data == 1) {
									Swal.fire('Berhasil !!', 'Nilai berhasil disimpan !!', 'success')
									var delay = 1500;
									setTimeout(function() {
										var curPage = table.page();
										curPage++;
										$('#loading').show();
										$('#contentPage').addClass('lodtime');
										$('#contentPage').load('<?php echo base_url('admin/nilaiBonus') ?>?page=' + curPage, function() {
											$('#loading').hide();
											$('#contentPage').removeClass('lodtime');
										})
									}, delay);
								} else
									Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
							}
						})
					} else {}
				})

			} else {
				Swal.fire('Info !!', 'Nilai belum diterapkan !!', 'info');
			}

		} else {
			$(cls).attr('disabled', false);
			$(cls).removeClass('chosen-disabled');
			$(btn).html('Simpan');
		}
	}

	console.log(FPegawai);

	function kelola(id, status) {
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPegawai?id=') ?>' + id + '&status=' + status);
		$('#modalKelola').modal('show');
	}
</script>