<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Tambah Bonus baru</h5>
				<hr>
			</div>
		</div>
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="namaP">Nama Bonus</label>
							<input type="text" class="form-control" id="nama" name="nama">
								<div class="invalid-feedback">Tolong isi nama Karyawan</div>
						</div>
					</div>
					<input type="text" value="1" name="level" hidden>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="mulai">Tanggal Mulai</label>
							<input class="form-control" type="date"  id="mulai" name="mulai">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="akhir">Tanggal Akhir</label>
							<input class="form-control" type="date"  id="akhir" name="akhir">
						</div>
					</div>
					
				</div>
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button class="btn btn-outline-primary">Tambah</button>&nbsp;<button class="btn btn-outline-warning" id="return">Kembali</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	var go = true;

	$('#form').submit(function(event) {
		event.preventDefault(); 
		if (go==true) {
			$.ajax({
				url: '<?php echo base_url('admin/prosestambahBonus') ?>',
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
	            	Swal.fire('Berhasil !!', 'Masa sesi bonus baru berhasil ditambahkan !!', 'success')
	            	var delay = 1500; 
					setTimeout(function(){ 
						$('#loading').show();
						$('#contentPage').addClass('lodtime');
						$('#contentPage').load('<?php echo base_url('admin/kelolaBonus') ?>', function(){
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
			Swal.fire('Kesalahan!!', 'Username telah digunakan !!', 'error');
		}
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolaBonus') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>