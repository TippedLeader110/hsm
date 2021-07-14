<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Proses Moora</h6>
			<!-- <h6 id="titleTest">Penilaian bonus [<?php echo $namaSesi ?>]</h6> -->
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tableKaryawan">
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
				<h4 class="modal-title">Kelola Detail Karyawan</h4>
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
		$('#theadNilai tr').append('<th class="rowName' + rowNilai[i].id + '">' + rowNilai[i].nama + '</th>');
		cCount++;
	}

	$('#theadNilai tr').append('<th>Hasil</th>');

	var DKaryawan = <?php echo $DKaryawan ?>;
	var NKaryawan = <?php echo $NKaryawan ?>;
	var FKaryawan = [];

	for (var i = 0; i < NKaryawan.length; i++) {

		var json = '{"nama" : "' + NKaryawan[i].nama + '", "id" : ' + NKaryawan[i].id + '';

		for (var j = 0; j < rowNilai.length; j++) {
			var ada = false;
			for (var DP = 0; DP < DKaryawan.length; DP++) {

				if (DKaryawan[DP].id_kriteria == rowNilai[j].id && DKaryawan[DP].id_karyawan == NKaryawan[i].id) {

					json = json + ', "' + DKaryawan[DP].id_kriteria + '"';
					json = json + ': "' + DKaryawan[DP].nilai + '"';
					ada = true;

				}

			}
			if (!ada) {
				json = json + ', "' + rowNilai[j].id + '"';
				json = json + ': ""';
			}
		}


		json = json + '}'
		console.log(json);
		FKaryawan.push(json);

	}

	console.log("THEAD : " + $("#theadNilai tr th").length);




	var FPCount = 1;

	for (var i = 0; i < FKaryawan.length; i++) {

		var pgw = JSON.parse(FKaryawan[i]);
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
					st = st + '<td><input style="border-style:none;width:70px" class="row' + i + ' chosen-disabled  nb' + pgw.id + '" type="number" id="' + pgwkey[iii] + '" disabled value="' + pgw[pgwkey[iii]] + '"></td>';
					// console.log("BUAT");
				}
				// console.log("TDK");
				// $('#tbodyNilai tr').append('<td></td>')	
			}
		}

		st = st + '<td></td>';

		st = st + '</tr>';

		$('#tbodyNilai').append(st);

		FPCount++;

		if (i + 1 == FKaryawan.length) {
			$('#tableKaryawan').DataTable();
			table = $('#tableKaryawan').DataTable();
			if (phpPage) {
				table.page(pageD - 1).draw('page');
			}
			$('.dataTables_length').addClass('bs-modal');
		}

	}

	$('#titleTest').click(function(event) {
		alert(table.page() + 1);
	});

	var nilaiId = [];
	var nilaiVal = [];

	var hitungMatriks = () => {
		var nilai = 0;
		for (let index = 0; index < rowNilai.length; index++) {

			nilai = 0;

			var col = table.columns('.rowName' + rowNilai[index].id).data()[0];

			// console.log('.rowName'+rowNilai[index].id+').data()')

			// console.log("COL ID : " + rowNilai[index].id + " COL" + col[0]);

			for (let index = 0; index < col.length; index++) {

				// console.log(col[index]);

				var valCol = $(col[index]).val();

				// console.log(valCol + ', Nilai Sekarang[' + index + '] = ' + nilai);

				if (valCol >= 0) {
					valCol = valCol * valCol;
					nilai = nilai + valCol;
				} else {
					nilai = nilai + 0;
				}
			}

			// console.log("Nilai s sqrrt = " + nilai);

			nilai = Math.sqrt(nilai);

			console.log("Nilai ss sqrrt[" + rowNilai[index].id + "] = " + nilai);

			nilaiVal.push(nilai);
			nilaiId.push(rowNilai[index].id);

		}

	}

	var hitungNormalisasi = () => {
		var nilai = 0;
		for (let index = 0; index < rowNilai.length; index++) {

			nilai = 0;

			var sekarang = index;
			var idRow = rowNilai[index].id;

			var col = table.columns('.rowName' + rowNilai[index].id).data()[0];


			for (let index = 0; index < col.length; index++) {

				// console.log(col[index]);

				var valCol = $(col[index]).val();

				// <input style="border-style:none;width:70px" class="row0 chosen-disabled  nb1" type="number" id="1" disabled="" value="5">

				// console.log(valCol + ', Nilai Sekarang[' + index + '] = ' + nilai);

				if (valCol >= 0) {
					nilai = valCol / nilaiVal[sekarang];
				} else {
					nilai = nilai + 0;
				}


				// console.log("Nilai ss normalisasi[" + idRow + "] = " + nilai);

				var newData = '<input style="border-style:none;width:70px" class="row' + index + ' chosen-disabled  nb' + idRow + '" type="number" id="' + idRow + '" disabled="" value="' + nilai.toFixed(5) + '">';

				table.cell(index, sekarang + 3).data(newData);
			}

		}

	}

	var hitungNilaiTotal = () => {
		var nilai = 0;

		var tb = table.rows();

		for (let index = 0; index < tb.count(); index++) {

			var hasil = 0;
			var hMax = 0;
			var nMax = [];
			var hMin = 0;
			var nMin = [];

			for (let index1 = 0; index1 < nilaiId.length; index1++) {
				var posisi = 3 + index1;
				var indTable = table.rows(index).data()[0][posisi];
				var nilaiKriteria = $(indTable).val();
				var total = nilaiKriteria / nilaiVal[index1];
				// console.log("Rorw = " + index + " | " + hMax + " + " + nilaiVal[index] + " = " + total);
				var bobot = rowNilai[index1].bobot;
				bobot = bobot/100
				total = total * bobot;
				// console.log("Rorw = " + index + " | total = " + total);
				if (rowNilai[index1].minmax == "0") {
					nMin.push(total);
				} else {
					nMax.push(total);
				}
			}

			for (let index = 0; index < nMax.length; index++) {
				hMax = hMax + nMax[index];
			}

			for (let index = 0; index < nMin.length; index++) {
				hMin = hMin + nMin[index];
			}

			hasil = hMax - hMin;

			console.log("Rorw = " + index + " | " + hMax + " + " + hMin + " = " + hasil);

			var pj = table.rows(index).data()[0].length - 1;

			hasil = hasil.toFixed(5);

			console.log(isNaN(parseFloat(pj)));

			if (isNaN(pj)) {
				pj = "Nilai Belum Lengkap"
			}

			table.cell(index, pj).data(hasil);

		}

	}

	hitungMatriks();
	hitungNormalisasi();
	hitungNilaiTotal();

	// $('#tbodyNilai tr').append('<td>'+FPCount+'</td><td>'+FKaryawan[i].id_karyawan+'</td><td>'+FKaryawan[i].nama+'</td><td></td>');


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

			var count = 0;

			$(cls).each(function(index, el) {
				if (count != 0) {
					jsonSend = jsonSend + ',';
				}
				var idnilai = $(this).attr('id');
				var value = $(this).val();
				console.log('ID USER : ' + id + '\n ID NILAI : ' +
					idnilai);
				console.log("NILAI = " + value);

				jsonSend = jsonSend + '{"id_u" : ' + id + ', "id_k" : ' + idnilai + ', "nilai" : ' + value + '}';

				count++;

			});

			jsonSend = jsonSend + "]"

			console.log(jsonSend);


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
			$(cls).attr('disabled', false);
			$(cls).removeClass('chosen-disabled');
			$(btn).html('Simpan');
		}
	}

	function kelola(id, status) {
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaKaryawan?id=') ?>' + id + '&status=' + status);
		$('#modalKelola').modal('show');
	}
</script>