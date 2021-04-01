<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Kelola Akun Admin</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah Akun Admin</h5>
				    <p class="card-text">Menambah akun Admin baru untuk mengatur dan memonitor kerja sistem ini.</p>
				    <a href="#" class="btn btn-success" id="tambahAdm"><i class="fas fa-plus"></i>&nbsp;Tambah</a>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 30px;">
		<div class="col-12 col-md-12">
		<div class="table-responsive-sm">
					<table id="adminTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead class="bg-custom text-white">
						<th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th></th>
						</thead>
						<tbody>
							<?php $count=0; ?>
							<?php foreach ($admin as $key => $ADvalue): ?>
								<?php $count++; ?>
								<tr>
									<td>
										<?php echo $count ?>
									</td>
									<td>
										<?php echo $ADvalue->nama ?>
									</td>
									<td>
										<?php echo $ADvalue->email ?>
									</td>
									<td><button class="btn btn-danger" id="hapusAdm" value="<?php echo $ADvalue->id ?>">Hapus</button></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#adminTable').DataTable();
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

    $('#tambahAdm').click(function(event) {
        event.preventDefault();
        loadPage('tambahAdmin');
    });

    $('#gantiPass').click(function(event) {
    	event.preventDefault();
    	loadPage('editPassword?id='+$(this).val());
    });

    function gantiPass(id)
    {
    	loadPage('editPassword?id='+id);
    }
</script>