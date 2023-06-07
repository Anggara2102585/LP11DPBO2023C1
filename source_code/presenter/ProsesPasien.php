<?php

include_once("kontrak/KontrakPasien.php");

class ProsesPasien implements KontrakPasienPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_01"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "DbP error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				// $pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				// $pasien->setId($row['id']); //mengisi id
				// $pasien->setNik($row['nik']); //mengisi nik
				// $pasien->setNama($row['nama']); //mengisi nama
				// $pasien->setTempat($row['tempat']); //mengisi tempat
				// $pasien->setTl($row['tl']); //mengisi tl
				// $pasien->setGender($row['gender']); //mengisi gender

				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "DbP error part 2" . $e->getMessage();
		}
	}
	function getDataPasienById($id)
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasienById($id);
			$this->data[] = $this->tabelpasien->getResult();
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "DbP error part 2" . $e->getMessage();
		}
	}

	function add($data)
	{
		try {
			//mengisi data ke tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->addPasien($data);
			
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "DbP error part 3" . $e->getMessage();
		}
	}

	function edit($data)
	{
		try {
			//mengisi data ke tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->editPasien($data);
			
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "DbP error part 4" . $e->getMessage();
		}
	}

	function delete($id)
	{
		try {
			//mengisi data ke tabel pasien
			$this->tabelpasien->open();
			if ($this->tabelpasien->deletePasien($id)) {
				echo "<script>
					alert('Hapus berhasil.');
					document.location.href = 'index.php';
				</script>";
			} else {
				echo "<script>
					alert('Hapus gagal.');
					document.location.href = 'index.php';
				</script>";
			}
			
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "DbP error part 5" . $e->getMessage();
		}
	}
	
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
