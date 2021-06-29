<?php
define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	 public function __construct() { 
        parent::__construct(); 
    }


	public function doLogin($user_real, $password)
	{
		$cari = $this->db->where('username',$user_real)->get('a_users');
		// var_dump($user_real);
		$match = password_verify($password , $cari->row()->password);
		// echo $cari->num_rows();
		if ($match) {
			// echo "1";
			if ($cari->num_rows()!=0) {
				$sesi = array(
				'email' => $cari->row()->email,
				'login' => 'true',
				'full_name' => $cari->row()->nama,
				'id_u' => $cari->row()->id,
				'level' => $cari->row()->level
			);
			// echo "2";
			$this->session->set_userdata($sesi);
			$this->logLoginAdmin($user_real);
			// echo "3";
			return true;
			}
		}
		else{
			return false;
		}
	}

	public function getDB($db)
	{
		return $this->db->get($db)->result();
	}

	public function getDBSearch($db, $kolom, $cari)
	{
		$this->db->where($kolom, $cari);
		return $this->db->get($db)->result();
	}

	public function procNilai($data, $id, $idb){
		// echo "DD".$idb;
		foreach ($data as $key => $value) {
			$this->db->where('id_bonus', $idb);
			$this->db->where('id_pegawai', $value->id_u);
			$this->db->where('id_kriteria', $value->id_k);
			$row = $this->db->get('bonus_pegawai')->num_rows();

			// var_dump($row);

			$dataINS = array('id_pegawai' => $value->id_u,
					'id_bonus' => $idb,
					'id_kriteria' => $value->id_k,
					'nilai' => $value->nilai
				 );

			if ($row==0) {	
				$this->db->insert('bonus_pegawai', $dataINS);
			}else{
				$this->db->where('id_bonus', $idb);
				$this->db->where('id_pegawai', $id);
				$this->db->where('id_kriteria', $value->id_k);
				$this->db->update('bonus_pegawai', $dataINS);
			}
		}
		return true;
	}

	public function dbDelete($db, $kolom, $cari)
	{
		$this->db->where($kolom, $cari);
		if ($this->db->delete($db)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	public function gantiStatusPegawai($id)
	{
		$stat = $this->db->where('id', $id)->get('pegawai')->row()->status;
		if ($stat==1) {
			$this->db->set('status', 0);
		}
		else{
			$this->db->set('status', 1);	
		}
		if ($this->db->where('id', $id)->update('pegawai')) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	public function tambahData($data, $table){
		if ($this->db->insert($table, $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}	
	}

	public function logLoginAdmin($u){
		$ip = $this->getIP();
		$user = $u;
		$query = $this->db
			->where('username', $user)
			->get('a_users');
		$idU = $query->row()->id;
		if ($this->session->userdata('level')==1) {
			$ket = 'Admin';
		}
		else{
			$ket = 'Direktur';
		}
		$data = array('ip' => $ip,
			'status' => 'Login '.$ket ,
			'waktu' => date("Y-m-d H:i:s"),
			'id_admin' => $idU
		 );
		$this->db->insert('log_admin', $data);
	}

	public function getIP(){
		$ip = getenv('HTTP_CLIENT_IP')?:
		getenv('HTTP_X_FORWARDED_FOR')?:
		getenv('HTTP_X_FORWARDED')?:
		getenv('HTTP_FORWARDED_FOR')?:
		getenv('HTTP_FORWARDED')?:
		getenv('REMOTE_ADDR');
		return $ip;
	}

	public function AktifBonus(){
		$this->db->where('status','1');
		$d = $this->db->get('sesi_bonus')->row()->id;

		return $d;
	}

	public function cekSBonus(){
		$this->db->where('status','1');
		$d = $this->db->get('sesi_bonus')->num_rows();

		if ($d!=0) {
			return true;
		}else{
			return false;
		}
	}

	public function disBonus(){
		if ($this->db->set('status', 0)->update('sesi_bonus')) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function statusBonus($id, $sts){
		if ($this->db->set('status', $sts)->where('id', $id)->update('sesi_bonus')) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function hitungDBSearch($db, $kolom, $cari){
		$this->db->where($kolom, $cari);
		return $this->db->get($db)->num_rows();
	}

	public function hitungDB($db){
		return $this->db->get($db)->num_rows();
	}

	public function editPegawai($data, $id_p)
	{
		$this->db->where('id', $id_p);
		if ($this->db->update('pegawai', $data)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}

// create or replace view log_admin_u as select b.id_log, b.ip, b.id_admin, b.waktu, b.status, a.nama, a.username, a.password, a.email, a.level from a_users as a inner join log_admin as b on b.id_admin = a.id

//create or replace view daftar_nilai as select * from nilai_pegawai as b  where id_bonus <> 2 or id_bonus is null and not exists(select * from bonus_pegawai as c where c.id_pegawai = b.id_pegawai)

// DELIMITER $$
// CREATE OR REPLACE PROCEDURE daftarNilai(ID int(10))
// BEGIN

//     select * from nilai_pegawai as b  
//     where id_bonus = ID
//     or id_bonus is null 
//     and not exists(select * from bonus_pegawai as c where c.id_pegawai = b.id_pegawai);

// END$$

// DELIMITER ;


// DELIMITER $$
// CREATE OR REPLACE PROCEDURE daftarNilai(ID int(10))
// BEGIN

// select * from nilai_pegawai as b  where id_bonus = ID or id_bonus is null and not exists(select * from bonus_pegawai as c where c.id_bonus = ID and c.id_pegawai = b.id_pegawai);

// END$$

// DELIMITER ;


// DELIMITER $$
// CREATE OR REPLACE PROCEDURE daftarNilaiH(ID int(10))
// BEGIN

// select COUNT(*) as count from nilai_pegawai as b  where id_bonus = ID or id_bonus is null and not exists(select * from bonus_pegawai as c where c.id_bonus = ID and c.id_pegawai = b.id_pegawai);

// END$$

// DELIMITER ;


?>