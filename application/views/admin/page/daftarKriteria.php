<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin</h5>
			<hr>
			<h6>Daftar Kriteria pada Sistem</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="">
		<div class="col-12 col-md-12">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah kriteria baru</h5>
					<p class="card-text">Menambah kriteria beserta bobotnya untuk penilaian karyawan</p>
					<a href="#" class="btn btn-success" id="tambahKriteria"><i class="fas fa-plus"></i>&nbsp;Tambah</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tableKaryawan">
					<thead>
						<th>#</th>
						<th>ID</th>
						<th>Nama Kriteria</th>
						<th>Bobot</th>
						<th>MinMax</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($daftarKriteria as $key => $value) : ?>
							<tr>
								<td><?php echo $count;
									?></td>
								<td>C<?php echo $count; $count++;  ?></td>
								<td><?php echo $value->nama; ?></td>
								<td>
									<?php echo $value->bobot ?>
									<?php if ($value->jenis == 1) : ?>
										(Benefit)
									<?php endif ?>
									<?php if ($value->jenis != 1) : ?>
										(Cost)
									<?php endif ?>
								</td>
								<td>
									<?php if ($value->minmax != 1) : ?>
										Min
									<?php endif ?>
									<?php if ($value->minmax == 1) : ?>
										Max
									<?php endif ?>
								</td>
								<td>

									<button class="btn btn-primary" id="kelola" onclick="kelola(<?php echo $value->id ?>)">Ubah&Hapus</button>
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
				<h4 class="modal-title">Kelola Detail Karyawan</h4>
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
	$(document).ready(function() {
		$('#tableKaryawan').DataTable();
		$('.dataTables_length').addClass('bs-modal');
	});

	function kelola(id) {
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaKriteria?id=') ?>' + id);
		$('#modalKelola').modal('show');
	}

	function loadTime() {
		$('#loading').show();
		$('#contentPage').addClass('lodtime', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	}

	function loadPage(page) {
		loadTime();
		$('#contentPage').load('<?php echo base_url('Admin/') ?>' + page, function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	}

	$('#tambahKriteria').click(function(event) {
		event.preventDefault();

		loadPage("tambahKriteria");
	});
</script>