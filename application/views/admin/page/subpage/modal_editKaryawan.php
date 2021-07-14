<div class="page">
	<div class="container">
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-6 col-md-12">
						<?php foreach ($dataKaryawan as $key => $value): ?>
						<?php endforeach ?>
						<div class="form-group">
							<input type="text" hidden name="id_p" value="<?php echo $value->id ?>">
							<label class="form-control-label" for="nama">Nama Lengkap</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $value->nama ?>">
								<div class="invalid-feedback">Tolong isi Nama Lengkap</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Nomor Handphone/Telepon</label>
							<input type="number" class="form-control" id="nohp" name="nohp" value="<?php echo $value->nohp ?>">
								<div class="invalid-feedback">Tolong isi no hp</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="jenis_kelamin">Jenis Kelamin <?php echo $value->jenis_kelamin ?></label>
							<select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">

								<?php if ($value->jenis_kelamin==1): ?>
							    	<option value="1">Pria</option>	
									<option value="0">Wanita</option>
								<?php endif ?>

							    <?php if ($value->jenis_kelamin!=1): ?>
									<option value="0">Wanita</option>
							    	<option value="1">Pria</option>	
								<?php endif ?>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="alamat">Alamat</label>
							<textarea class="form-control" id="alamat" name="alamat"> <?php echo $value->alamat ?> </textarea>
								<div class="invalid-feedback">Tolong isi alamat</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button class="btn btn-outline-primary">Simpan</button>&nbsp;<button class="btn btn-outline-warning" id="return">Kembali</button>
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
			url: '<?php echo base_url('admin/proseseditKaryawan') ?>',
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
            	Swal.fire('Berhasil !!', 'Perubahan berhasil disimpan !!', 'success')
            	var delay = 1500; 
				setTimeout(function(){ 
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
					$('#contentPage').load('<?php echo base_url('admin/daftarKaryawan') ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
						$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
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
		$('#contentModal').addClass('lodtime');
		$('#contentModal').load('<?php echo base_url('admin/modal_kelolaKaryawan?id='); echo $value->id; ?>&status=<?php echo $value->status ?>', function(){
			$('#loading').hide();
			$('#contentModal').removeClass('lodtime');
		});
	});
</script>