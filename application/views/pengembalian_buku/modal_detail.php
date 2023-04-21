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
			<label for="emailLarge" class="form-label">Nama Peminjam</label> <span class="badge bg-label-info"><?= $getPeminjam->kelas_jurusan ?></span> 
			<input type="text" class="form-control" value="<?= $getPeminjam->nama ?> / <?= $getPeminjam->kode_anggota ?>" disabled>
		</div>
		<div class="col mb-2">
			<label for="dobLarge" class="form-label">Tanggal Peminjaman</label>
			<input type="text" class="form-control" value="<?= $getPeminjam->tanggal_peminjaman ?> <?= $getPeminjam->jam_peminjaman ?>" disabled>
		</div>
	</div>

	<div class="row g-2">
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">Kondisi Buku</label>
			<h5 class="form-control" readonly>
				<?php if($getPeminjam->kondisi_buku_pinjam == 1) { ?>
					Baik
				<?php } else { ?>
					Rusak
				<?php } ?>
			</h5>
		</div>
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">ISBN</label>
			<input type="text" class="form-control" value="<?= $getBuku->isbn_buku ?>" disabled>
		</div>
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">Kategori Buku</label>
			<input type="text" class="form-control" value="<?= $getPenerbitKategori->nama_kategori ?>" disabled>
		</div>
	</div>

	<div class="row g-2">
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">Judul Buku</label>
			<input type="text" class="form-control" value="<?= $getBuku->judul_buku ?>" disabled>
		</div>
		<div class="col mb-2">
			<label for="emailLarge" class="form-label">Nama Penerbit

				<?php if($getPenerbitKategori->status_penerbit == 1) { ?>
					<span class="badge bg-label-primary">Penerbit Terverifikasi</span>
				<?php } else { ?>
					<span class="badge bg-label-danger">Penerbit Belum Terverifikasi</span>
				<?php } ?>

			</label>
			<h5 class="form-control" readonly><?= $getPenerbitKategori->nama_penerbit ?>
		</h5>
	</div>
</div>

<div class="row g-2">
	<div class="col mb-2">
		Peminjaman Diterima <strong><?= $getAdmin->nama ?></strong> pada tanggal <?= $getPeminjam->tanggal_diterima_peminjaman ?>
	</div>
</div>

<hr>

<div class="row g-2">
	<div class="col mb-2">
		<label for="dobLarge" class="form-label">Tanggal Pengembalian</label>
		<input type="text" class="form-control" value="<?= $detail->tanggal_pengembalian ?> <?= $detail->jam_pengembalian ?>" disabled>
	</div>
	<div class="col mb-2">
		<label for="emailLarge" class="form-label">Denda</label>
		<input type="text" class="form-control" value="<?= $detail->nama_denda ?> - <?= rupiah($detail->tarif_denda) ?>" disabled>
	</div>
</div>

<?php if($detail->admin_id == null) { ?>
<?php } else { ?>
	<div class="row g-2">
		<div class="col mb-2">
			Pengembalian Diterima <strong><?= $getAdmin2->nama ?></strong> pada tanggal <?= $detail->tanggal_diterima_pengembalian ?>
		</div>
	</div>
<?php } ?>



</div>

</div>