<div class="sidebar-header">
            <h3><center><img width="100px" src="<?=base_url()?>assets/images/logo.png" alt=""><br>
            	<h4>Dashboard Admin</h4>
            </center></h3>
            <!-- <strong>
            	<img width="40px" src="<?=base_url()?>assets/images/logo.png" alt="ITFest 4.0">
            </strong> -->
        </div>

        <ul class="list-unstyled">
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-home"></i>
                    Laporan
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li id="reportSingkatSide" class="bawah">
                        <a href="#" id="laporanSingkat">Rangkuman</a>
                    </li>
                    <li>
                		<a href="#" id="akunPage">Akun</a>
                	</li>
                    <li>
                		<a href="#" id="logAdmin">Log Admin</a>
                	</li>
                </ul>
            </li>
            <li>
                <a href="#postSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user"></i>
                    &nbsp;Pegawai
                </a>
                <ul class="collapse list-unstyled" id="postSubmenu">
                    <li id="reportSingkatSide" class="bawah">
                        <a href="#" id="daftarPegawai">Daftar Pegawai</a>
                    </li>
                    <li>
                        <a href="#" id="kelolaPegawai">Tambah Pegawai</a>
                    </li>
                    <!-- <li>
                		<a href="#" id="katPage">Kategori</a>
                	</li> -->
                    <!-- <li>
                        <a href="#" id="reportTeam">Team</a>
                    </li>
                    <li>
                        <a href="#" id="reportKasus">Seminar</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="#pagePesertamenu" data-toggle='collapse' aria-expanded="false" class="dropdown-toggle">
                    <i class="far fa-file-alt"></i>
                    &nbsp;Bonus Pegawai
                </a>
                <ul class="collapse list-unstyled" id="pagePesertamenu">
                	<li>
                     <a href="#" id="daftarKasusADM">Sesi Bonus</a>
                    </li>
                    <li>
                     <a href="#" id="daftarKasusADM">Nilai Sesi Bonus</a>
                    </li>
                </ul>
            </li>
        </ul>