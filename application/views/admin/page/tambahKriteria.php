<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Tambah kriteria baru ke sistem</h5>
				<hr>
			</div>
		</div>
		<form id="form">

			<?php if ($edit): ?>
				<?php foreach ($dataArray as $key => $value): ?>
					
				<?php endforeach ?>

				<input type="text" name="id" value="<?php echo $value->id ?>" hidden>

			<?php endif ?>

			<?php if (!$edit): ?>
				<input type="text" name="idBonus" value="<?php echo $idBonus ?>" hidden>
			<?php endif ?>

			<div class="row">
				<div class="col-12 col-md-12">
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-control-label" for="nama">Nama Kriteria</label>
								<input type="text" class="form-control" id="nama" name="nama"
									<?php if ($edit): ?>
										value="<?php echo $value->nama ?>"
									<?php endif ?>
								>
								<div class="invalid-feedback">Tolong isi Nama Lengkap</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="bobot">Bobot</label>
								<input type="number" class="form-control" id="bobot" name="bobot"
									<?php if ($edit): ?>
										value="<?php echo $value->bobot ?>"
									<?php endif ?>
								>
								<div class="invalid-feedback">Tolong isi no hp</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="jenis">Jenis</label>
								<select class="custom-select" id="jenis" name="jenis">
									<?php if (!$edit): ?>
										<option selected>Pilih</option>
										<option value="0">Cost</option>
										<option value="1">Benefit</option>
									<?php endif ?>
									<?php if ($edit): ?>
										<?php if ($value->jenis==1): ?>
											<option value="1">Benefit</option>
											<option value="0">Cost</option>
										<?php endif ?>
										<?php if ($value->jenis==0): ?>
											<option value="0">Cost</option>
											<option value="1">Benefit</option>
										<?php endif ?>
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="minmax">Min-Max</label>
								<select class="custom-select" id="minmax" name="minmax">
									<?php if (!$edit): ?>
										<option selected>Pilih</option>
										<option value="0">Min</option>
										<option value="1">Max</option>
									<?php endif ?>
									<?php if ($edit): ?>
										<?php if ($value->minmax==0): ?>
											<option value="0">Min</option>
											<option value="1">Max</option>
										<?php endif ?>
										<?php if ($value->minmax==1): ?>
											<option value="1">Max</option>
											<option value="0">Min</option>
										<?php endif ?>
									<?php endif ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12" style="margin-top: 20px;">
							<?php if ($edit): ?>
								<button class="btn btn-outline-success">Simpan perubahan</button>
								<button class="btn btn-outline-danger" type="button" id="hapus">Hapus Kriteria</button>
							<?php endif ?>
							<?php if (!$edit): ?>
								<button class="btn btn-outline-success">Tambah Kriteria Baru</button>
							<?php endif ?>
						</div>
					</div>
				</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	<?php if ($edit): ?>
		var idData = <?php echo $value->id ?>

		$('#form').submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?php echo base_url('admin/proseseditKriteria') ?>',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				error: function(data) {
					Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
				},
				success: function(data) {
					if (data == 1) {
						Swal.fire('Berhasil !!', 'Kriteria berhasil diubah !!', 'success')
						var delay = 1500;
						setTimeout(function() {
							$('#modalKelola').modal('hide');
							$('body').removeClass('modal-open');
							$('.modal-backdrop').remove();
							$('#loading').show();
							$('#contentPage').addClass('lodtime');
							$('#contentPage').load('<?php echo base_url('admin/daftarKriteria') ?>', function() {
								$('#loading').hide();
								$('#contentPage').removeClass('lodtime');
							})
						}, delay);
					} else
						Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
				}
			})
		});
	<?php endif ?>

	<?php if (!$edit): ?>

		$('#form').submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?php echo base_url('admin/prosestambahKriteria') ?>',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				error: function(data) {
					Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
				},
				success: function(data) {
					if (data == 1) {
						Swal.fire('Berhasil !!', 'Kriteria berhasil ditambahkan !!', 'success')
						var delay = 1500;
						setTimeout(function() {
							$('#loading').show();
							$('#contentPage').addClass('lodtime');
							$('#contentPage').load('<?php echo base_url('admin/daftarKriteria') ?>', function() {
								$('#loading').hide();
								$('#contentPage').removeClass('lodtime');
							})
						}, delay);
					} else
						Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
				}
			})
		});
		
	<?php endif ?>

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolakriteria') ?>', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});


	$('#hapus').click(function(event) {
        event.preventDefault();
        Swal.fire({
		title: 'Apakah anda ingin menghapus kriteria ini?',
		text: "Perubahan tidak dapat diundurkan!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
				ajaxDelete(idData);
			}
			else{
			}
		})
    });

    var ajaxDelete = (id) => {
    	$.ajax({
			url: '<?php echo base_url('admin/hapusKriteria') ?>',
			type: 'post',
			data:{id  :  id},
			success: function(er){
				if (er==1) {
					console.log(er);
					Swal.fire({
				      title : 'Terkirim !',
				      text : 'Kriteria berhasil dihapus!!.',
				      icon : 'success',
				      timer: 2000,
  					  timerProgressBar: true
				    }).then((result) => {
				    	// $('#modalKelola').modal('hide');
				    		$('#modalKelola').modal('hide');
							$('body').removeClass('modal-open');
							$('.modal-backdrop').remove();
							$('#loading').show();
						    $('#contentPage').addClass('lodtime');   
					  		$('#contentPage').load('<?php echo base_url('Admin/')?>daftarKriteria',function() {
				            $('#loading').hide();
				            $('#contentPage').removeClass('lodtime');
				        }); 
				    });
				}
				else{
				console.log(er);
				if (er==0) {
					er = "Database ERROR: Check Network Log";
				}
				Swal.fire('Gagal','Terjadi kesalahan dengan error : ' + er + ' hubungi administrator untuk info lebih lanjut ', 'error');
			}
	 		},
			 	error: function(er){
			 		Swal.fire('Gagal','Terjadi kesalahan dengan error : ' + er + ' hubungi administrator untuk info lebih lanjut ', 'error');
			  	}
			});
    };
</script>