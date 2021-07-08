<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Tambah kriteria baru ke sistem</h5>
				<hr>
			</div>
		</div>
		<form id="form">

			<input type="text" name="idBonus" value="<?php echo $idBonus ?>" hidden>

			<div class="row">
				<div class="col-12 col-md-12">
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-control-label" for="nama">Nama Kriteria</label>
								<input type="text" class="form-control" id="nama" name="nama">
								<div class="invalid-feedback">Tolong isi Nama Lengkap</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="bobot">Bobot</label>
								<input type="number" class="form-control" id="bobot" name="bobot"> </textarea>
								<div class="invalid-feedback">Tolong isi no hp</div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="jenis">Jenis</label>
								<select class="custom-select" id="jenis" name="jenis">
									<option selected>Pilih</option>
									<option value="0">Cost</option>
									<option value="1">Benefit</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-control-label" for="minmax">Min-Max</label>
								<select class="custom-select" id="minmax" name="minmax">
									<option selected>Pilih</option>
									<option value="0">Min</option>
									<option value="1">Max</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12" style="margin-top: 20px;">
							<button class="btn btn-outline-success">Tambah Kriteria Baru
						</div>
					</div>
				</div>
		</form>
	</div>
</div>


<script type="text/javascript">
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

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolakriteria') ?>', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>