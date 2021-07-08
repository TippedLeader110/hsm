<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin-Pengacara</title>
    <?php $this->load->view('template/headerAdmin') ?>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <?php $this->load->view($sidebar) ?>
        </nav>

        <div id="content">
            <?php $this->load->view('template/navAdmin') ?>



            <div id="loading" style="display: none;z-index: 4;position: absolute; top: 50%; left: 5%; height: 100%; width: 100%;">
                <!-- <center><img src='<?php echo base_url('assets/file/load.gif') ?>'/></center> -->
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>
            <div id="contentPage" class="shadow-sm p-3 mb-5 bg-white rounded ">

            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="<?php echo base_url('/assets/js/popper.min.js') ?>"></script>
<!-- Bootstrap core JavaScript -->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('/assets/js/mdb.min.js') ?>"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript" src="<?php echo base_url('/assets/js/addons/datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/admin.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/mmouse.js') ?>"></script>

<script type="text/javascript">
    function loadTimeIndex() {
        $('#loading').show();
        $('#contentPage').addClass('lodtime', function() {});
    }

    function LoadPageIndex(page) {
        loadTimeIndex();
        $('#contentPage').load('<?php echo base_url('Admin/') ?>' + page, function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });
    }

    LoadPageIndex('mainDashboard');

    $('#tambahPegawai').click(function(event) {
        event.preventDefault();
        LoadPageIndex('tambahPegawai');
    });

    $('#homeMain').click(function(event) {
        event.preventDefault();
        LoadPageIndex('mainDashboard');
    });

    $('#kelolaAkun').click(function(event) {
        event.preventDefault();
        LoadPageIndex('kelolaAkun');
    });

    $('#daftarPegawai').click(function(event) {
        event.preventDefault();
        LoadPageIndex('daftarPegawai');
    });

    $('#kelolaBonus').click(function(event) {
        event.preventDefault();
        LoadPageIndex('kelolaBonus');
    });

    $('#nilaiBonus').click(function(event) {
        event.preventDefault();
        LoadPageIndex('nilaiBonus');
    });

    $('#daftarKriteria').click(function(event) {
        event.preventDefault();
        LoadPageIndex('daftarKriteria');
    });

    $('#nilaiMoora').click(function(event) {
        event.preventDefault();
        LoadPageIndex('nilaiMoora');
    });

    $('#keputusan').click(function(event) {
        event.preventDefault();
        LoadPageIndex('nilaiTotal');
    });
</script>

</html>