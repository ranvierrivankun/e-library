<style type="text/css" media="screen">
	.swal2-container {
		z-index: 1000000;
	}
	.edit-body{
		height: 120;
		overflow-y: auto;
	}
</style>

<div class="modal-body">

	<div class="row g-2">
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">Nama Peminjam</label> <span class="badge bg-label-info"><?= $getKelas->kelas_jurusan ?></span> 
			<input type="text" class="form-control" value="<?= $detail->nama ?> / <?= $detail->kode_anggota ?>" readonly>
		</div>
		<div class="col mb-2">
			<label for="dobLarge" class="form-label">Tanggal Kunjungan</label>
			<input type="text" class="form-control" value="<?= $detail->tanggal_kunjungan ?> <?= $detail->jam_kunjungan ?>" readonly>
		</div>
	</div>

	<div class="row g-2">

		<div class="col mb-2">
			<label for="emailLarge" class="form-label">ISBN</label>
			<textarea type="text" class="form-control" readonly><?= $detail->tujuan_kunjungan ?></textarea>
		</div>

	</div>

</div>

</div>