<?php foreach ($dataPegawai as $key => $value): ?>
	
<?php endforeach ?>
<div class="container-fluid" id="contentModal">
	<div class="row">
		<div class="col-12 col-md-12">
			
			<div class="card text-left" style="margin-bottom: 10px;height: 240px;">
				<div class="card-body">
					<h5 class="card-title text-center">Profile Pegawai</h5>
				    <table>
						<tr>
							<td rowspan="4"><img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" style="max-width: 100px;"></td><td>&nbsp;&nbsp;&nbsp;Nama : <?php echo $value->nama ?></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;Jenis Kelamin : 
								<?php if ($value->jenis_kelamin==1): ?>
									Pria
								<?php endif ?>
								<?php if ($value->jenis_kelamin!=1): ?>
									Wanita
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;No HP : <?php echo $value->nohp ?></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;Status : 
								<?php if ($value->status==1): ?>
									Aktif
								<?php endif ?>
								<?php if ($value->status!=1): ?>
									Tidak Aktif
								<?php endif ?>
							</td>
						</tr>
					</table>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
		<div class="col-12 col-md-12">

			<div class="accordion" id="accordionExample">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h2 class="mb-0">
			        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          Edit Pegawai
			        </button>
			      </h2>
			    </div>

			    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
			      <div class="card-body">
			        <p class="card-text">Mengganti informasi pribadi pegawai yang bersangkutan.</p>
				    <a href="#" class="btn btn-warning" id="modal_editPegawai">Edit</a>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h2 class="mb-0">
			        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          Status Pegawai
			        </button>
			      </h2>
			    </div>
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			      <div class="card-body">
				        <p class="card-text">Mengganti status keanggotaan pegawai.</p>
					    <?php if ($status==1): ?>
					    	<a href="#" class="btn btn-danger" id="modal_statusPegawai">Nonaktifkan</a>
					    <?php endif ?>
					    <?php if ($status!=1): ?>
					    	<a href="#" class="btn btn-success" id="modal_statusPegawai">Aktifkan</a>
					    <?php endif ?>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h2 class="mb-0">
			        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Hapus Pegawai
			        </button>
			      </h2>
			    </div>
			    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
			      <div class="card-body">
			        <p class="card-text">Menghapus pegawai dari perusahaan.</p>
				    <a href="#" class="btn btn-danger text-light" id="modal_hapusPegawai">Hapus</a>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">

	function loadTime(){
        $('#loading').show();
        $('#contentModal').addClass('lodtime',function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
            
        });   
    }

    function loadPage(page){
        loadTime();
        $('#contentModal').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
        });
    }

	$('#modal_editPegawai').click(function(event) {
        event.preventDefault();
        loadPage('modal_editPegawai?id=<?php echo $id ?>');
    });

    $('#modal_statusPegawai').click(function(event) {
        event.preventDefault();
        $.ajax({
        	url: '<?php echo base_url('admin/modal_statusPegawai') ?>',
        	type: 'POST',
        	data: {id: '<?php echo $id ?>'},
        	success: function(event){
        		if (event==1) {
        			Swal.fire('Berhasil', "Status pegawai berhasil diganti !!!", 'success');
        			$('#modalKelola').modal('hide');
					$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
        			$('#loading').show();
				    $('#contentPage').addClass('lodtime',function() {
			            // $('#loading').hide();
			            // $('#contentPage').removeClass('lodtime');
			        });   
			  		$('#contentPage').load('<?php echo base_url('Admin/')?>daftarPegawai',function() {
			            $('#loading').hide();
			            $('#contentPage').removeClass('lodtime');
			            
			        }); 
        		}
        		else{
        			Swal.fire('Kesalahan', "Status pegawai gagal diganti !!!", 'error');
        		}
        	},
        	error: function(err){
        		Swal.fire('Error', "Mengembalikan error : " + err + " , tolong hubungi administrator untuk info lebih lanjut", 'error');
        	}
        })
        
    });

    $('#modal_hapusPegawai').click(function(event) {
        event.preventDefault();
        Swal.fire({
		title: 'Apakah anda ingin menghapus pegawai ini?',
		text: "Perubahan tidak dapat diundurkan!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('admin/modal_hapusPegawai') ?>',
			    	type: 'post',
			    	data:{id  :  '<?php echo $id ?>'},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Terkirim !',
						      text : 'Pegawai berhasil dihapus!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
						        });   
						  		$('#contentPage').load('<?php echo base_url('Admin/')?>daftarPegawai',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
						            $('#modalKelola').modal('hide');
									$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
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
			}
			else{
			}
		})
    });
</script>