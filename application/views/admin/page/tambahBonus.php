<?php 
	if(isset($edit)){
		$edit = true;
		$title = "Edit Sesi Bonus";
		foreach ($dataDB as $key => $value) {
		}
	}else{
		$edit = false;
		$title = "Tambah Sesi Bonus baru";
	}
?>

<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5><?php echo $title ?></h5>
				<hr>
			</div>
		</div>
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-12">
						<?php if ($edit): ?>
							<input type="text" hidden name="id" value="<?php echo $value->id ?>">
						<?php endif ?>
						<div class="form-group">
							<label class="form-control-label" for="namaP">Nama Bonus</label>
							<input type="text" class="form-control" id="nama" name="nama" 
								<?php if($edit) : ?>
									value="<?php echo $value->nama ?>"
								<?php endif; ?>
							>
								<div class="invalid-feedback">Tolong isi nama Karyawan</div>
						</div>
					</div>
					<input type="text" value="1" name="level" hidden>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="mulai">Tanggal Mulai</label>
							<input class="form-control" type="date" id="mulai" name="mulai"
								<?php if($edit) : ?>
									value=<?php echo $value->mulai ?>
								<?php endif; ?>
							>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="akhir">Tanggal Akhir</label>
							<input class="form-control" type="date"  id="akhir" name="akhir"
								<?php if($edit) : ?>
									value=<?php echo $value->akhir ?>
								<?php endif; ?>
							>
						</div>
					</div>
					
				</div>
				<?php if($edit) : ?>
					<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
						<button class="btn btn-outline-primary" type="submit">Simpan</button>&nbsp;
						<button class="btn btn-outline-danger" type="button" id="hapus">Hapus</button>&nbsp;
						<button class="btn btn-outline-warning" type="button" id="kembaliKelola">Kembali</button>
					</div>
				<?php endif; ?>
				<?php if(!$edit) : ?>
					<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
						<button class="btn btn-outline-primary" type="submit">Tambah</button>&nbsp;
						<button class="btn btn-outline-warning" type="button" id="kembaliKelola">Kembali</button>
					</div>
				<?php endif; ?>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	var go = true;

	<?php if($edit) : ?>
		var edit = true;
		var idData = <?php echo $value->id ?>
	<?php endif; ?>

	<?php if(!$edit) : ?>
		var edit = false;
	<?php endif; ?>

	
	$('#kembaliKelola').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolaBonus') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});

	$('#form').submit(function(event) {
		event.preventDefault(); 
		if (go && !edit) {
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
		else if(go && edit){
			$.ajax({
				url: '<?php echo base_url('admin/proseseditBonus') ?>',
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
	            	Swal.fire('Berhasil !!', 'Masa sesi bonus baru berhasil diubah !!', 'success')
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
			Swal.fire('Kesalahan!!', 'Kesalahan dengan sistem !!', 'error');
		}
	});

	$('#returnEdit').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolaBonus') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});

	$('#hapus').click(function(event) {
        event.preventDefault();
        Swal.fire({
		title: 'Apakah anda ingin menghapus sesi bonus ini?',
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
			url: '<?php echo base_url('admin/hapusBonus') ?>',
			type: 'post',
			data:{id  :  id},
			success: function(er){
				if (er==1) {
					console.log(er);
					Swal.fire({
				      title : 'Terkirim !',
				      text : 'Sesi Bonus berhasil dihapus!!.',
				      icon : 'success',
				      timer: 2000,
  					  timerProgressBar: true
				    }).then((result) => {
				    	// $('#modalKelola').modal('hide');
							$('#loading').show();
						    $('#contentPage').addClass('lodtime');   
					  		$('#contentPage').load('<?php echo base_url('Admin/')?>kelolaBonus',function() {
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