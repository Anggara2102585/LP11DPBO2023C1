<?php


include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class TampilPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampilTabel()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= '<tr>
				<td>' . $no . '</td>
				<td>' . $this->prosespasien->getNik($i) . '</td>
				<td class="main-value">' . $this->prosespasien->getNama($i) . '</td>
				<td>' . $this->prosespasien->getTempat($i) . '</td>
				<td>' . $this->prosespasien->getTl($i) . '</td>
				<td>' . $this->prosespasien->getGender($i) . '</td>
				<td>' . $this->prosespasien->getEmail($i) . '</td>
				<td>' . $this->prosespasien->getTelp($i) . '</td>
				<td>
					<a href="index.php?edit='.$this->prosespasien->getId($i).'" class="btn btn-sm btn-primary edit-btn">Edit</a>
					<a href="index.php?delete='.$this->prosespasien->getId($i).'" class="btn btn-sm btn-danger delete-btn">Delete</a>
				</td>
			<tr>';
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	function tampilAdd()
	{
		$formTitle = "Tambah Pasien";
		
		$formContent = '<form action="index.php" method="POST">
			<label class="form-label">NIK</label>
			<input type="number" class="form-control mb-3" name="nik" required>
			<label class="form-label">Nama</label>
			<input type="text" class="form-control mb-3" name="nama" required>
			<label class="form-label">Tempat</label>
			<input type="text" class="form-control mb-3" name="tempat" required>
			<label class="form-label">Tanggal lahir</label>
			<input type="date" class="form-control mb-3" name="tl" required>
			<label class="form-label">Jenis Kelamin</label>
			<select class="form-control mb-3" name="gender" required>
				<option value="Perempuan" selected>Perempuan</option>
				<option value="Laki-laki">Laki-laki</option>
			</select>
			<label class="form-label">Email</label>
			<input type="email" class="form-control mb-3" name="email" required>
			<label class="form-label">Telp</label>
			<input type="number" class="form-control mb-3" name="telp" required>
			<div class="d-flex justify-content-end">
				<button type="submit" class="btn btn-primary" name="add_pasien">Add Pasien</button>
			</div>
		</form>';
		
		$this->tpl = new Template("templates/skinFormPasien.html");

		$this->tpl->replace("DATA_FORM_TITLE", $formTitle);
		$this->tpl->replace("DATA_FORM_CONTENT", $formContent);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	function tampilEdit($id)
	{
		$this->prosespasien->getDataPasienById($id);
		
		if ($this->prosespasien->getId(0) != null) {
			$formTitle = "Edit Pasien";
		
			$formContent = '<form action="index.php" method="POST">
				<input type="hidden" class="form-control" name="id" value="'.$this->prosespasien->getId(0).'" required>
				<label class="form-label">NIK</label>
				<input type="number" class="form-control mb-3" name="nik" value="'.$this->prosespasien->getNik(0).'" required>
				<label class="form-label">Nama</label>
				<input type="text" class="form-control mb-3" name="nama" value="'.$this->prosespasien->getNama(0).'" required>
				<label class="form-label">Tempat</label>
				<input type="text" class="form-control mb-3" name="tempat" value="'.$this->prosespasien->getTempat(0).'" required>
				<label class="form-label">Tanggal lahir</label>
				<input type="date" class="form-control mb-3" name="tl" value="'.$this->prosespasien->getTl(0).'" required>
				<label class="form-label">Jenis Kelamin</label>
				<select class="form-control mb-3" name="gender" required>
					<option value="Perempuan" '.($this->prosespasien->getGender(0)=="Perempuan"?"selected":"").'>Perempuan</option>
					<option value="Laki-laki" '.($this->prosespasien->getGender(0)=="Laki-laki"?"selected":"").'>Laki-laki</option>
				</select>
				<label class="form-label">Email</label>
				<input type="email" class="form-control mb-3" name="email" value="'.$this->prosespasien->getEmail(0).'" required>
				<label class="form-label">Telp</label>
				<input type="number" class="form-control mb-3" name="telp" value="'.$this->prosespasien->getTelp(0).'" required>
				<div class="d-flex justify-content-end">
					<button type="submit" class="btn btn-primary" name="edit_pasien">Edit Pasien</button>
				</div>
			</form>';
			
			$this->tpl = new Template("templates/skinFormPasien.html");

			$this->tpl->replace("DATA_FORM_TITLE", $formTitle);
			$this->tpl->replace("DATA_FORM_CONTENT", $formContent);

			// Menampilkan ke layar
			$this->tpl->write();
		}
		else {
			echo "<script>
				alert('Data tidak ditemukan.');
				document.location.href = 'index.php';
			</script>";
		}
	}

	function add($data)
	{
		$this->prosespasien->add($data);
	}

	function edit($data)
	{
		$this->prosespasien->edit($data);
	}

	function delete($id)
	{
		$this->prosespasien->delete($id);
	}
}
