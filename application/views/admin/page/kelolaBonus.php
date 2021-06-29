<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Kelola masa bonus</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="">
		<div class="col-12 col-md-12">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah masa bonus baru</h5>
				    <p class="card-text">Menambah masa sesi bonus baru kepada pegawai yang ada</p>
				    <a href="#" class="btn btn-success" id="tambahBonus"><i class="fas fa-plus"></i>&nbsp;Tambah</a>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<div class="col-12 col-md-12">
			<h6>Daftar masa bonus</h6>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tablePegawai">
					<thead>
						<th>#</th>
						<th>Masa Bonus</th>
						<th>Nama</th>
						<th>Penilaian</th>
						<th>Status</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($daftarBonus as $key => $value): ?>
							<tr>
								<td><?php echo $count; $count++; ?></td>
								<td><?php echo $value->mulai ?> s/d <?php echo $value->akhir ?></td>
								<td><?php echo $value->nama; ?></td>
								<td><a href="javascript:void(0)">Lihat hasil</a></td>
								<td>
									<?php if ($value->status==1): ?>
										Aktif
									<?php endif ?>
									<?php if ($value->status!=1): ?>
										Tidak Aktif
									<?php endif ?>
								</td>
								<td>
									<?php if ($value->status==1): ?>
										<button onclick="statusBonus(<?php echo $value->id ?>,0)" class="btn btn-warning">Non-Aktifkan</button>
									<?php endif ?>
									<?php if ($value->status!=1): ?>
										<button onclick="statusBonus(<?php echo $value->id ?>,1)" id="ak" class="btn btn-success">Aktifkan</button>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function () {
		$('#tablePegawai').DataTable();
		$('.dataTables_length').addClass('bs-modal');
	});

	function loadTime(){
        $('#loading').show();
        $('#contentPage').addClass('lodtime',function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });   
    }

	function loadPage(page){
        loadTime();
        $('#contentPage').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });
    }

    $('#tambahBonus').click(function(event) {
        event.preventDefault();
        loadPage('tambahBonus');
    });

    function statusBonus(id, sts){
    	$.post('<?php echo base_url('admin/bonusStatus') ?>', {'id': id, 'sts': sts}, function(data, textStatus, xhr) {

    		if (data==1) {
	           	Swal.fire('Berhasil !!', 'Status bonus berhasil diganti !!', 'success')
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
	            		Swal.fire('Kesalahan!!', 'Terjadi kesalahan dengan pesan error : ['+data+']');
    			
    	});
    }



</script>