<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');

	}

	public function index()
	{
		$this->loginProtocol();
		// $data['page'] = 'admin/page/welcome';
		$data['sidebar'] = 'admin/sidebarAdmin';
		$this->load->view('admin/index', $data);
		
	}

	public function mainDashboard()
	{
		$this->loginProtocol();
		$data['admin'] = $this->Admin_model->getDBSearch('a_users', 'level', '1');
		$this->load->view('admin/page/main', $data);	
	}

	public function kelolaAkun()
	{
		$this->loginProtocol();
		$data['admin'] = $this->Admin_model->getDBSearch('a_users', 'level', '1');
		$this->load->view('admin/page/kelolaAkun', $data);	
	}

	public function kelolaBonus()
	{
		$this->loginProtocol();
		$data['jkaryawan'] = $this->Admin_model->hitungDB('karyawan');
		$data['daftarBonus'] = $this->Admin_model->getDB('sesi_bonus');
		$this->load->view('admin/page/kelolaBonus', $data);	
	}

	public function tambahBonus()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahBonus');	
	}

	public function editBonus()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$dataDB = $this->Admin_model->getDBSearch('sesi_bonus', 'id', $id);
		$data['edit'] = 1;
		$data['dataDB'] = $dataDB;
		$this->load->view('admin/page/tambahBonus', $data);	
	}


	public function tambahKaryawan()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahKaryawan');	
	}

	public function tambahKriteria()
	{
		$data['idBonus'] = $this->Admin_model->AktifBonus();
		// echo $data['idBonus'];
		$data["edit"] = false;
		$this->loginProtocol();
		$this->load->view('admin/page/tambahKriteria', $data);	
	}

	public function daftarKriteria()
	{
		$this->loginProtocol();
		if ($this->Admin_model->cekSBonus()) {
			$idbonus = $this->Admin_model->AktifBonus();
			$data['daftarKriteria'] = $this->Admin_model->getDBSearch('kriteria', 'id_sesi', $idbonus);
			$this->load->view('admin/page/daftarKriteria', $data);
		}else{
			$this->load->view('admin/page/bonusNAktif');
		}
	}

	public function modal_kelolaKriteria()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['edit'] = true;

		$data['dataArray'] = $this->Admin_model->getDBSearch('kriteria','id',$id);

		$this->load->view('admin/page/tambahKriteria', $data);
	}	


	public function modal_kelolaKaryawan()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['status'] = $this->input->get('status');

		$data['dataKaryawan'] = $this->Admin_model->getDBSearch('karyawan','id',$id);

		$this->load->view('admin/page/subpage/modal_kelolaKaryawan', $data);
	}


	public function modal_hapusKaryawan()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('karyawan','id',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function hapusKriteria()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('kriteria','id',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function hapusBonus()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->dbDelete('sesi_bonus','id',$id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function modal_statusKaryawan()
	{
		$this->loginProtocol();
		$id = $this->input->post('id');
		if ($this->Admin_model->gantiStatuskaryawan($id)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function modal_editKaryawan()
	{
		$this->loginProtocol();
		$id = $this->input->get('id');
		$data['dataKaryawan'] = $this->Admin_model->getDBSearch('karyawan','id',$id);
		$this->load->view('admin/page/subpage/modal_editKaryawan', $data);	
	}
	public function daftarKaryawan()
	{
		$this->loginProtocol();
		$data ['daftarKaryawan'] = $this->Admin_model->getDB('karyawan');
		$this->load->view('admin/page/daftarKaryawan', $data);
	}


	public function loginProtocol()
	{
		if(($this->session->userdata('login') == "true")){
			
		}
		else{
			redirect(base_url("admin/login"));
		}
	}

	public function log_admin()
	{
		$this->loginProtocol();
		$data['log'] = $this->Admin_model->getDB('log_admin_u');
		$this->load->view('admin/page/logUser', $data);
	}


	public function tambahAdmin()
	{
		$this->load->view('admin/page/tambahAdmin');
	}

	public function tambahAkunKaryawan()
	{
		$this->loginProtocol();
		$this->load->view('admin/page/tambahAkunKaryawan');
	}

	public function editNilai(){
		$dataJSON = $this->input->post('data');
		
		$id = $this->input->post('id_u');
		$idb = $this->input->post('idb');
		$dataBaru = json_decode(utf8_encode($dataJSON));

		// var_dump($dataBaru);

		if ($this->Admin_model->procNilai($dataBaru, $id, $idb)) {
			echo "1";
		}else{
			echo "0";
		}

		// var_dump($dataJSON[0]);
	}

	public function nilaiBonus(){
		$this->loginProtocol();
		if ($this->Admin_model->cekSBonus()) {

			$idBonus = $this->Admin_model->AktifBonus();
			$rowNilai = $this->Admin_model->getDBSearch('kriteria', 'id_sesi', $idBonus);
			$data['rowNilai'] = json_encode($rowNilai);
			$data['namaSesi'] = $this->db->where('status', '1')->get('sesi_bonus')->row()->nama;

			$data['DKaryawan'] = json_encode($this->Admin_model->getDBSearch('bonus_karyawan', 'id_bonus', $idBonus));
			$data['NKaryawan'] = json_encode($this->Admin_model->getDB('karyawan'));
			$data['idB'] = $idBonus;


			$this->load->view('admin/page/bonusNilai', $data);
		}else{
			$this->load->view('admin/page/bonusNAktif');
		}
	}

	public function nilaiMoora(){
		$this->loginProtocol();
		if ($this->Admin_model->cekSBonus()) {

			$idBonus = $this->Admin_model->AktifBonus();
			$rowNilai = $this->Admin_model->getDBSearch('kriteria', 'id_sesi', $idBonus);
			$data['rowNilai'] = json_encode($rowNilai);
			$data['namaSesi'] = $this->db->where('status', '1')->get('sesi_bonus')->row()->nama;

			$data['DKaryawan'] = json_encode($this->Admin_model->getDBSearch('bonus_karyawan', 'id_bonus', $idBonus));
			$data['NKaryawan'] = json_encode($this->Admin_model->getDB('karyawan'));
			$data['idB'] = $idBonus;


			$this->load->view('admin/page/nilaiMoora', $data);
		}else{
			$this->load->view('admin/page/bonusNAktif');
		}
	}

	public function nilaiTotal()
	{
		$this->loginProtocol();
		if ($this->Admin_model->cekSBonus()) {

			$idBonus = $this->Admin_model->AktifBonus();
			$rowNilai = $this->Admin_model->getDBSearch('kriteria', 'id_sesi', $idBonus);
			$data['rowNilai'] = json_encode($rowNilai);
			$data['namaSesi'] = $this->db->where('status', '1')->get('sesi_bonus')->row()->nama;

			$data['DKaryawan'] = json_encode($this->Admin_model->getDBSearch('bonus_karyawan', 'id_bonus', $idBonus));
			$data['NKaryawan'] = json_encode($this->Admin_model->getDB('karyawan'));
			$data['idB'] = $idBonus;


			$this->load->view('admin/page/nilaiTotal', $data);
		} else {
			$this->load->view('admin/page/bonusNAktif');
		}
	}

	// public function nilaiBonus(){
	// 	$this->loginProtocol();
	// 	if ($this->Admin_model->cekSBonus()) {

	// 		$idbonus = $this->db->where('status', '1')->get('sesi_bonus')->row();
	// 		$data ['daftarKaryawan'] = $this->db->query('call daftarNilai('.$idbonus->id.')')->result();
	// 		$data['row'] = $idbonus;
	// 		$this->load->view('admin/page/bonusNilai', $data);
	// 	}else{
	// 		$this->load->view('admin/page/bonusNAktif');
	// 	}
	// }

	public function bonusStatus(){
		$id = $this->input->post('id');
		$sts = $this->input->post('sts');

		if ($sts==1) {
			if ($this->Admin_model->disBonus()) {
				if ($this->Admin_model->statusBonus($id, $sts)) {
					echo "1";
				}else{
					echo "ganti status gagal";
				}
			}else{
				echo "disBonus error";
			}
		}else{
			if ($this->Admin_model->statusBonus($id, $sts)) {
				echo "1";
			}else{
				echo "ganti status gagal";
			}
		}

		// echo "ID : ".$id." \n STS : ".$sts;
	}

	public function cekUsername()
	{
		$this->loginProtocol();
		$ur = $this->input->post('ur');
		$this->db->where('username', $ur);
		$result = $this->db->get('a_users')->num_rows();
		if ($result!=0) {
			echo "0";
		}
		else{
			echo "1";
		}
	}

	public function prosestambahBonus()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$mulai = $this->input->post('mulai');
		$akhir = $this->input->post('akhir');

		$data = array(
			'nama' => $nama,
			'mulai' => $mulai,
			'akhir' => $akhir
		);


        if ($this->Admin_model->tambahData($data, 'sesi_bonus')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function proseseditBonus()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$mulai = $this->input->post('mulai');
		$akhir = $this->input->post('akhir');
		$id = $this->input->post('id');

		$data = array(
			'nama' => $nama,
			'mulai' => $mulai,
			'akhir' => $akhir
		);

        if ($this->Admin_model->editData($data, 'sesi_bonus', $id,'id')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function prosestambahKriteria()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$jenis = $this->input->post('jenis');
		$minmax = $this->input->post('minmax');
		$idB = $this->input->post('idBonus');

		$data['edit'] = false;

        $data = array(
			'nama' => $nama,
			'bobot' => $bobot,
			'jenis' => $jenis,
			'minmax' => $minmax,
			'id_sesi' => $idB
		);


        if ($this->Admin_model->tambahData($data, 'kriteria')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function proseseditKriteria()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$jenis = $this->input->post('jenis');
		$minmax = $this->input->post('minmax');
		$idB = $this->input->post('idBonus');

		$id = $this->input->post('id');

        $data = array(
			'nama' => $nama,
			'bobot' => $bobot,
			'jenis' => $jenis,
			'minmax' => $minmax
		);


        if ($this->Admin_model->editData($data, 'kriteria', $id,'id')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function prosestambahKaryawan()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');

        $data = array(
			'nama' => $nama,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' => $alamat,
			'nohp' => $nohp
		);


        if ($this->Admin_model->tambahData($data, 'karyawan')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function proseseditKaryawan()
	{
		$this->loginProtocol();
		$id_p = $this->input->post('id_p');
		$nama = $this->input->post('nama');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$alamat = $this->input->post('alamat');
		$nohp = $this->input->post('nohp');


        $dataKirim = array(
			'nama' => $nama,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' => $alamat,
			'nohp' => $nohp
		);

        if ($this->Admin_model->editKaryawan($dataKirim, $id_p)==TRUE)
        {
				echo "1";
		}
		else{
				echo "0";
		}
	}

	public function proseseditPassword()
	{
		$this->loginProtocol();
		$id_u = $this->input->post('id_u');
		$passBaru = $this->input->post('passBaru');
		$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);
		$this->db->where('id', $id_u);
		if ($this->db->set('password', $passBaru)->update('a_users')) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function prosestambahAdminDirekturKaryawan()
	{
		$this->loginProtocol();
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$passwordA = $this->input->post('password');	
		$nohp = $this->input->post('nohp');	
		$level = 1;

		$password = password_hash($passwordA, PASSWORD_DEFAULT);
		$dataBaru = array('level' => $level, 'nama' => $nama, 'username' => $username, 'email' => $email, 'password' => $password,
			'nohp' => $nohp
	);
		if ($this->Admin_model->tambahData($dataBaru, 'a_users')==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function login()
	{
		$this->session->sess_destroy();
		$this->load->view('admin/login');
	}

	public function prosesLogin()
	{
		// $this->loginProtocol();
		$username = $this->input->post('user');
		$password = $this->input->post('pwd');
		if ($this->Admin_model->doLogin($username,$password)==TRUE) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function test(){
		$a = 'admin';
		$p = password_hash("admin", PASSWORD_DEFAULT);
		$data = ['username'=>$a, 'password' => $p];
		$this->db->insert('a_users', $data);
		echo "Done with username = ".$a."and password = ".$a." with hash = ".$p;
	}
}
