<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Penilaian bonus [<?php echo $namaSesi ?>]</h6>
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

	// console.log(<?php echo $rowNilai ?>);

	var rowNilai = <?php echo $rowNilai?>;
	console.log(rowNilai);

	var cCount = 1;

	for (var i = rowNilai.length - 1; i >= 0; i--) {
		rowNilai[i]
		$('#theadNilai tr').append('<th>C'+cCount+'</th>');
		cCount++;
	}

	$('#theadNilai tr').append('<th>Aksi</th>');

	var DPegawai = <?php echo $DPegawai ?>;
	var NPegawai = <?php echo $NPegawai ?>;
	var FPegawai = [];

	for (var i = 0 ; i< NPegawai.length; i++) {

		var json = '{"nama" : "'+NPegawai[i].nama+'", "id" : '+NPegawai[i].id+'';

		for (var j = 0; j < rowNilai.length ; j++) {
			var ada = false;
			for (var DP = 0 ; DP< DPegawai.length; DP++) {

				if (DPegawai[DP].id_kriteria == rowNilai[j].id && DPegawai[DP].id_pegawai == NPegawai[i].id) {

					json = json + ', "'+DPegawai[DP].id_kriteria+'"';
					json = json + ': "'+DPegawai[DP].nilai+'"';
					ada = true;

				}

			}	
			if (!ada) {
				json = json + ', "'+rowNilai[j].id+'"';
				json = json + ': "0"';
			}
		}


		json = json + '}'
		console.log(json);
		FPegawai.push(json);
		
	}

	console.log("THEAD : " +$("#theadNilai tr th").length);




	var FPCount = 1;

	for (var i = 0; i < FPegawai.length; i++) {

		var pgw = JSON.parse(FPegawai[i]);
		console.log(pgw);
		var pgwkey = Object.keys(pgw);

		// console.log(pgw['nama']);

		var st = '<tr><td>'+FPCount+'</td><td>A'+pgw.id+'</td><td>'+pgw.nama+'</td>';

		for (var ii = 0; ii < rowNilai.length; ii++) {
			// console.log("ii :" + ii);
			for (var iii = 0; iii < pgwkey.length; iii++) {
				// console.log("iii :" + iii);
				if (rowNilai[ii].id == pgwkey[iii]) {
					// console.log(pgwkey[iii]);
					st = st+ '<td><input class="nb'+pgw.id+'" type="number" id="'+pgwkey[iii]+'" disabled value="'+pgw[pgwkey[iii]]+'"></td>';
					// console.log("BUAT");
				}
				// console.log("TDK");
				// $('#tbodyNilai tr').append('<td></td>')	
			}
		}		

		st = st + '<td><button id="btn'+pgw.id+'" onclick="switchEdit('+pgw.id+')" class="btn btn-success">Edit</button></td>';

		st = st + '</tr>';

		$('#tbodyNilai').append(st);

		FPCount++;

		if (i+1 == FPegawai.length ) {
			$('#tablePegawai').DataTable();
			$('.dataTables_length').addClass('bs-modal');
		}
		
	}

		// $('#tbodyNilai tr').append('<td>'+FPCount+'</td><td>'+FPegawai[i].id_pegawai+'</td><td>'+FPegawai[i].nama+'</td><td></td>');


	$(document).ready(function () {
	});

	function switchEdit(id){
		console.log(id);
		var btn = '#btn' + id;
		var cls = '.nb' + id;
		if ($(btn).html()=="Simpan") {
			$(btn).html('Edit');
			$(cls).attr('disabled', true);
			var jsonSend = "[";
			var sendArr = [];

			var count = 0;

			$(cls).each(function(index, el) {
				if (count!=0) {
					jsonSend = jsonSend + ',';
				}
				var idnilai = $(this).attr('id');
				var value = $(this).val();
				console.log('ID USER : ' +id + '\n ID NILAI : ' + 
					idnilai);
				console.log("NILAI = " + value);

				jsonSend = jsonSend + '{"id_u" : '+id+', "id_k" : '+idnilai+', "nilai" : '+value+'}';

				count++;

			});

			jsonSend = jsonSend+ "]"

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
					data: {data:jsonSend, id_u:id, idb: <?php echo $idB ?>},
		            error: function(data){
		            	Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
		            },
		            success: function(data){
		            	if (data==1) {
		            	Swal.fire('Berhasil !!', 'Nilai berhasil disimpan !!', 'success')
		            	var delay = 1500; 
						setTimeout(function(){ 
							$('#loading').show();
							$('#contentPage').addClass('lodtime');
							$('#contentPage').load('<?php echo base_url('admin/nilaiBonus') ?>', function(){
								$('#loading').hide();
								$('#contentPage').removeClass('lodtime');
							})}, delay);
		            	}
		            	else
		            		Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
		            }
				})
				}
				else{
				}
			})
			
		}else{
			$(cls).attr('disabled', false);
			$(btn).html('Simpan');
		}
	}

	function kelola(id,status){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPegawai?id=') ?>' + id + '&status='+status);
		$('#modalKelola').modal('show');
	}

</script>