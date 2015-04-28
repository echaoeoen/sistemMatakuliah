<?php 
/**
* 
*/
class administrator extends ci_controller
{
	var $me = false;
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->load->model("dosen");
		$this->load->model("jadwal");
		$this->load->model("kelas");
		$this->load->model("matakuliah");
		$this->load->model("ruangan");
		$this->load->model("sks");
		$this->load->model("user");
		$this->load->model("database","mengajar",true);
		$this->mengajar->set_table("mengajar");
		$this->mengajar->set_order("matakuliahId asc");
		$this->me=$this->session->all_userdata();	
	}
	function dashboard(){
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->jadwal();	
	}

	function kelas(){
		$this->kelas->activeJoin("dosen","kelas.dosenWali = dosen.dosenId");
		$this->data["kelas"] = $this->kelas->tampil();
		$this->data["dosen"] = $this->dosen->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/kelas";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function ruangan(){
		$this->data["ruangan"] = $this->ruangan->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/ruangan";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function dosen(){
		$this->data["matakuliah"]=$this->matakuliah->tampil();
		$this->data["dosen"] = $this->dosen->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/dosen";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function getMengajar(){
		$dosenId = $_GET["dosenId"];
		$this->matakuliah->set_where("mataKuliahId in (select matakuliahId from mengajar where dosenId ='".$dosenId."' )");
		echo json_encode($this->matakuliah->tampil());
	}
	function sks(){
		$this->data["sks"] = $this->sks->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/sks";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function submitSks($action="simpan",$sksId=null){
		if($action=="simpan"){
			$val["jmlSks"] = $this->input->post("jmlSks");
			$val["jmlJam"] = $this->input->post("jmlJam");
			$val["jenisSks"] = $this->input->post("jenisSks");
			$this->sks->set_values($val);
			$this->sks->simpan();
			redirect("administrator/sks");
		}
		else if($action=="edit"){
			if(!$sksId)
				redirect("administrator/sks");
			$where["sksId"] = $sksId;
			$val["jmlSks"] = $this->input->post("jmlSks");
			$val["jmlJam"] = $this->input->post("jmlJam");
			$val["jenisSks"] = $this->input->post("jenisSks");
			$this->sks->set_where($where);
			$this->sks->set_values($val);
			$this->sks->update();
			redirect("administrator/sks");
		}
		else if($action=="delete"){
			if(!$sksId)
				redirect("administrator/sks");
			$where["sksId"] = $sksId;
			$this->sks->set_where($where);
			$this->sks->hapus();
			redirect("administrator/sks");
		}
	}
	function submitDosen($action="simpan",$dosenId=null){
		if($action=="simpan"){
			$val["nama"] = $this->input->post("nama");
			$val["kodeDosen"] = $this->input->post("kodeDosen");
			$val["NIDN"] = $this->input->post("NIDN");
			$this->dosen->set_values($val);
			$this->dosen->simpan();
			redirect("administrator/dosen");
		}
		else if($action=="edit"){
			if(!$dosenId)
				redirect("administrator/dosen");
			$where["dosenId"] = $dosenId;
			$val["nama"] = $this->input->post("nama");
			$val["kodeDosen"] = $this->input->post("kodeDosen");
			$val["NIDN"] = $this->input->post("NIDN");
			$this->dosen->set_where($where);
			$this->dosen->set_values($val);
			$this->dosen->update();
			redirect("administrator/dosen");
		}
		else if($action=="delete"){
			if(!$dosenId)
				redirect("administrator/dosen");
			$where["dosenId"] = $dosenId;
			$this->dosen->set_where($where);
			$this->dosen->hapus();
			redirect("administrator/dosen");
		}
		else if($action=="inputMengajar"){
			if(!$dosenId)
				redirect("administrator/dosen");
			$idMatkul = $this->input->post("mataKuliahId");
			$where["dosenId"] = $dosenId;
			$this->mengajar->set_where($where);
			$this->mengajar->hapus();
			foreach ($idMatkul as $key => $value) {
				$val["mataKuliahId"] = $value;
				$val["dosenId"] = $dosenId;
				$this->mengajar->set_values($val);
				$this->mengajar->simpan();
			}
			redirect("administrator/dosen");
		}
	}
	function submitKelas($action="simpan",$kelasId=null){
		if($action=="simpan"){
			$val["namaKelas"] = $this->input->post("namaKelas");
			$val["dosenWali"] = $this->input->post("dosenWali");
			$this->kelas->set_values($val);
			$this->kelas->simpan();
			redirect("administrator/kelas");
		}
		else if($action=="edit"){
			if(!$kelasId)
				redirect("administrator/kelas");
			$where["kelasId"] = $kelasId;
			$val["namaKelas"] = $this->input->post("namaKelas");
			$val["dosenWali"] = $this->input->post("dosenWali");
			$this->kelas->set_values($val);
			$this->kelas->set_where($where);
			$this->kelas->update();
			redirect("administrator/kelas");
		}
		else if($action=="delete"){
			if(!$kelasId)
				redirect("administrator/kelas");
			$where["kelasId"] = $kelasId;
			$this->kelas->set_where($where);
			$this->kelas->hapus();
			redirect("administrator/kelas");
		}
	}
	function submitjadwal($action="simpan",$jadwalId=null){
		if($action=="simpan"){
			$val["dosenId"] = $this->input->post("dosenId");
				$jam = $this->input->post("jam");
				$jam = str_replace(".", ":", $jam ).":00";
			$val["jam"] = $jam;
			$val["hari"] = $this->input->post("hari");
			$val["kelasId"] = $this->input->post("kelasId");
			$val["ruanganId"] = $this->input->post("ruanganId");
			$val["mataKuliahId"] = $this->input->post("mataKuliahId");

			$this->jadwal->set_values($val);
			$this->jadwal->simpan();
			redirect("administrator/jadwal");
		}
		else if($action=="edit"){
			if(!$jadwalId)
				redirect("administrator/jadwal");
			$where["jadwalId"] = $jadwalId;
				$val["dosenId"] = $this->input->post("dosenId");
				$jam = $this->input->post("jam");
				$jam = str_replace(".", ":", $jam ).":00";
			$val["jam"] = $jam;
			$val["hari"] = $this->input->post("hari");
			$val["kelasId"] = $this->input->post("kelasId");
			$val["ruanganId"] = $this->input->post("ruanganId");
			$val["mataKuliahId"] = $this->input->post("mataKuliahId");

		$this->jadwal->set_values($val);
			$this->jadwal->set_where($where);
			$this->jadwal->update();
			redirect("administrator/jadwal");
		}
		else if($action=="delete"){
			echo "tes";
			if(!$jadwalId)
				redirect("administrator/jadwal");
			$where["jadwalId"] = $jadwalId;
			$this->jadwal->set_where($where);
			$this->jadwal->hapus();
			redirect("administrator/jadwal");
		}
	}
	function submitMataKuliah($action="simpan",$mataKuliahId=null){
		if($action=="simpan"){
			$val["namaMataKuliah"] = $this->input->post("namaMataKuliah");
			$val["sks"] = $this->input->post("sks");
			$this->matakuliah->set_values($val);
			$this->matakuliah->simpan();
			redirect("administrator/matakuliah");
		}
		else if($action=="edit"){
			if(!$mataKuliahId)
				redirect("administrator/matakuliah");
			$where["matakuliahId"] = $mataKuliahId;
			$val["namaMataKuliah"] = $this->input->post("namaMataKuliah");
			$val["sks"] = $this->input->post("sks");
			$this->matakuliah->set_values($val);
			$this->matakuliah->set_where($where);
			$this->matakuliah->update();
			redirect("administrator/matakuliah");
		}
		else if($action=="delete"){
			if(!$mataKuliahId)
				redirect("administrator/matakuliah");
			$where["matakuliahId"] = $mataKuliahId;
			$this->matakuliah->set_where($where);
			$this->matakuliah->hapus();
			redirect("administrator/matakuliah");
		}
	}
	function submitRuangan($action="simpan",$ruanganId=null){
		if($action=="simpan"){
			$val["namaRuangan"] = $this->input->post("namaRuangan");
			$this->ruangan->set_values($val);
			$this->ruangan->simpan();
			redirect("administrator/ruangan");
		}
		else if($action=="edit"){
			if(!$ruanganId)
				redirect("administrator/ruangan");
			$where["ruanganId"] = $ruanganId;
			$val["namaRuangan"] = $this->input->post("namaRuangan");
			$this->ruangan->set_values($val);
			$this->ruangan->set_where($where);
			$this->ruangan->update();
			redirect("administrator/ruangan");
		}
		else if($action=="delete"){
			if(!$ruanganId)
				redirect("administrator/dosen");
			$where["ruanganId"] = $ruanganId;
			$this->ruangan->set_where($where);
			$this->ruangan->hapus();
			redirect("administrator/ruangan");
		}
	}
	function cekKodeDosen(){
		$where["dosenId !="] = $_GET["dosenId"];
		$where["kodeDosen"] = $_GET["kodeDosen"];
		$this->dosen->set_where($where);
		if($this->dosen->count()>0)
			echo "false";
		else
			echo "true";
	}
	function cekNIDNDosen(){
		$where["dosenId !="] = $_GET["dosenId"];
		$where["NIDN"] = $_GET["NIDN"];
		$this->dosen->set_where($where);
		if($this->dosen->count()>0)
			echo "false";
		else
			echo "true";
	}
	function jadwal(){
		$res = $this->jadwal->query("select j.`jadwalId`, j.`hari`, j.`matakuliahId`, j.`dosenId`, j.`ruanganId`, j.`kelasId`, j.`jam` 
 , d.`kodeDosen`, d.`NIDN`, d.`nama`, k.`namaKelas`, k.`dosenWali`, r.`namaRuangan`, m.`namaMataKuliah`, m.`sks` from jadwal j, matakuliah m, ruangan r,dosen d, kelas k
 where j.dosenId = d.dosenId and r.ruanganId = j.ruanganId and j.mataKuliahId = m.matakuliahId and j.kelasId = k.kelasId

			");
		$this->data["jadwal"] = $res;
		$this->data["matakuliah"] = $this->matakuliah->tampil();
		$this->data["dosen"] = $this->dosen->tampil();
		$this->data["ruangan"] = $this->ruangan->tampil();
		$this->data["kelas"] = $this->kelas->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/jadwal";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function cekAdaRuangan(){

	}
	function mataKuliah(){
		$this->data["sks"] = $this->sks->tampil();
		$this->matakuliah->activeJoin("sks","matakuliah.sks = sks.sksId");
		$this->data["mataKuliah"]=$this->matakuliah->tampil();
		if(!isset($this->me["userId"]))
			redirect("administrator/login");
		$this->data["page"] = "admin/matakuliah";
		$this->load->view("admin/templateAdmin",$this->data);
	}
	function index(){
		$this->dashboard();
	}
	function login(){
		if(isset($this->me["userId"]))
			redirect("administrator/dashboard");
		$this->data["page"] = "admin/formLogin";
		$this->load->view("template",$this->data);
	}
	function process(){
		$val["username"] = $this->input->post("username");
		$val["password"] = sha1($this->input->post("password"));
		$this->user->set_where($val);
		$us = $this->user->tampil();
		if(count($us)>0){
			$us=$us[0];
			$sess["userId"] = $us->username;
			$this->session->set_userdata("userId");
			redirect("administrator/");
		}
		$this->data["pesan"] = "Username atau password salah";
		$this->data["page"] = "admin/formLogin";
		$this->load->view("template",$this->data);
	}
	function logout(){
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect("administrator/");
	}
}