<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Tambah karyawan baru ke sistem</h5>
				<hr>
			</div>
		</div>
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="nama">Nama Lengkap</label>
							<input type="text" class="form-control" id="nama" name="nama">
								<div class="invalid-feedback">Tolong isi Nama Lengkap</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Nomor Handphone/Telepon</label>
							<input type="number" class="form-control" id="nohp" name="nohp"> </textarea>
								<div class="invalid-feedback">Tolong isi no hp</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="jenis_kelamin">Jenis Kelamin</label>
							<select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
							    <option selected>Pilih</option>
							    <option value="0">Wanita</option>
							    <option value="1">Pria</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="alamat">Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat"> </textarea>
								<div class="invalid-feedback">Tolong isi alamat</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-12" style="margin-top: 20px;">
					<button class="btn btn-outline-success">Tambah Karyawan Baru
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
			url: '<?php echo base_url('admin/prosestambahKaryawan') ?>',
			type: 'POST',
			data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            error: function(data){
            	Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
            },
            success: function(data){
            	if (data==1) {
            	Swal.fire('Berhasil !!', 'Karyawan berhasil ditambahkan !!', 'success')
            	var delay = 1500; 
				setTimeout(function(){ 
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
					$('#contentPage').load('<?php echo base_url('admin/daftarKaryawan') ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
					})}, delay);
            	}
            	else
            		Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
            }
		})
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolaKaryawan') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>