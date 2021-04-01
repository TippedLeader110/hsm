<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Daftar Pegawai Tetap</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tablePegawai">
					<thead>
						<th>#</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Status</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($daftarPegawai as $key => $value): ?>
							<tr>
								<td><?php echo $count; $count++; ?></td>
								<td><?php echo $value->nama; ?></td>
								<td>
									<?php if ($value->jenis_kelamin==1): ?>
										Pria
									<?php endif ?>
									<?php if ($value->jenis_kelamin!=1): ?>
										Wanita
									<?php endif ?>
								</td>
								<td>
									<?php if ($value->status==1): ?>
										Aktif
									<?php endif ?>
									<?php if ($value->status!=1): ?>
										Tidak Aktif
									<?php endif ?>
								</td>
								<td>
									<input type="text" id="status<?php echo $value->id ?>" hidden value="<?php echo $value->status ?>">
									<button class="btn btn-primary" id="kelola" onclick="kelola(<?php echo $value->id ?>, <?php echo $value->status ?>)">Kelola</button>		
								</td>
							</tr>
						<?php endforeach ?>
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
	$(document).ready(function () {
		$('#tablePegawai').DataTable();
		$('.dataTables_length').addClass('bs-modal');
	});

	function kelola(id,status){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPegawai?id=') ?>' + id + '&status='+status);
		$('#modalKelola').modal('show');
	}

</script>