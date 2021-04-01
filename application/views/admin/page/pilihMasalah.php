<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Masalah / Kasus dari pemohon</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Kasus Baru</h5>
			    <p class="card-text">Melihat daftar aduan kasus baru dari pemohon.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary" id="masalahBaru">Lihat</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Kasus Berjalan</h5>
			    <p class="card-text">Melihat daftar kasus yang sedang berjalan atau belum terselesaikan.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary" id="masalahBerjalan">Lihat</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Riwayat Kasus</h5>
			    <p class="card-text">Melihat daftar riwayat kasus yang dibatalkan/ditolak maupun selesai.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary text-light" id="riwayatMasalah">Lihat</a>
			 </div>
		</div>
	</div>
</div>

<script type="text/javascript">
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

	$('#masalahBaru').click(function(event) {
        event.preventDefault();
        loadPage('daftarMasalah?tipe=1');
    });

    $('#masalahBerjalan').click(function(event) {
        event.preventDefault();
        loadPage('daftarMasalah?tipe=2');
    });

    $('#riwayatMasalah').click(function(event) {
        event.preventDefault();
        loadPage('daftarMasalah?tipe=4');
    });

    $('#hapuseditPengacara').click(function(event) {
        event.preventDefault();
        loadPage('daftarPengacara');
    });
</script>