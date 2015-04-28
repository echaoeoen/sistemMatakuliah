<?php

/**
* 
*/
class pages extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("dosen");
		$this->load->model("jadwal");
		$this->load->model("kelas");
		$this->load->model("matakuliah");
		$this->load->model("ruangan");
		$this->load->model("sks");
	}
	function home(){
	$res = $this->jadwal->query("select j.`jadwalId`, j.`hari`, j.`matakuliahId`, j.`dosenId`, j.`ruanganId`, j.`kelasId`, j.`jam` 
 , d.`kodeDosen`, d.`NIDN`, d.`nama`, k.`namaKelas`, k.`dosenWali`, r.`namaRuangan`, m.`namaMataKuliah`, m.`sks` from jadwal j, matakuliah m, ruangan r,dosen d, kelas k
 where j.dosenId = d.dosenId and r.ruanganId = j.ruanganId and j.mataKuliahId = m.matakuliahId and j.kelasId = k.kelasId

			");
		$this->data["jadwal"] = $res;$this->data["matakuliah"] = $this->matakuliah->tampil();
		$this->data["dosen"] = $this->dosen->tampil();
		$this->data["ruangan"] = $this->ruangan->tampil();
		$this->data["kelas"] = $this->kelas->tampil();
		$this->load->view("home",$this->data);

	}
}