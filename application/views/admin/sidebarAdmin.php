<div class="sidebar-header">
            <h3 style="padding-top: 25px"><center>
                <img width="200px" src="<?=base_url()?>assets/img/logo.png" alt="Yayasan Sekolah Namira">
                <br>
            	<h5 style="padding-top: 10px">Dashboard Admin</h5>
            </center></h3>
        </div>

        <ul class="list-unstyled">
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-home"></i>
                    Laporan
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li id="reportSingkatSide" class="bawah">
                        <a href="#" id="homeMain">Home</a>
                    </li>
                    <li>
                		<a href="#" id="kelolaAkun">Akun</a>
                	</li>
                    <li>
                		<a href="#" id="logAdmin">Log Admin</a>
                	</li>
                </ul>
            </li>
            <li>
                <a href="#postSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user"></i>
                    &nbsp;Karyawan
                </a>
                <ul class="collapse list-unstyled" id="postSubmenu">
                    <li id="reportSingkatSide" class="bawah">
                        <a href="#" id="daftarKaryawan">Data Karyawan</a>
                    </li>
                    <li>
                        <a href="#" id="tambahKaryawan">Tambah Karyawan</a>
                    </li>
                    <!-- <li>
                        <a href="#" id="reportTeam">Team</a>
                    </li>
                    <li>
                        <a href="#" id="reportKasus">Seminar</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="#pageNilai" data-toggle='collapse' aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-edit"></i>
                    &nbsp;Penilaian
                </a>
                <ul class="collapse list-unstyled" id="pageNilai">
                	<li>
                     <a href="#" id="kelolaBonus">Sesi Penilaian</a>
                    </li>
                    <li>
                        <a href="#" id="daftarKriteria">Kriteria</a>
                    </li>
                    <li>
                     <a href="#" id="nilaiBonus">Nilai Sesi Kriteria</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pageLaporan" data-toggle='collapse' aria-expanded="false" class="dropdown-toggle">
                    <i class="far fa-file-alt"></i>
                    &nbsp;Laporan
                </a>
                <ul class="collapse list-unstyled" id="pageLaporan">
                    <li>
                     <a href="#" id="nilaiMoora">Laporan Moora</a>
                    </li>
                    <li>
                        <a href="#" id="keputusan">Laporan Keputusan</a>
                    </li>
                </ul>
            </li>
        </ul>