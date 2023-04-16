<style type="text/css" media="screen">
	.swal2-container {
		z-index: 1000000;
	}
	.edit-body{
		height: 120;
		overflow-y: auto;
	}
</style>

<form method="POST" id="form_tambah" enctype="multipart/form-data">

	<div class="modal-body">

		<?php

		/*Generate Kode Penerbit*/
		$query          = $this->db->query("SELECT max(kode_penerbit) as kodeTerakhir FROM data_penerbit")->row_array();
		$urutan         = (int) substr($query['kodeTerakhir'], 3, 3);
		$urutan++;
		$huruf          = "P";
		$KodePenerbit    = $huruf . sprintf("%03s", $urutan);
		?>

		<div class="row">
			<div class="col mb-3">
				<label for="nameLarge" class="form-label">Kode Penerbit</label>
				<input type="text" name="kode_penerbit" class="form-control" placeholder="AUTO" value="<?php echo $KodePenerbit ?>" readonly>
			</div>
		</div>

		<div class="row">
			<div class="col mb-3">
				<label for="nameLarge" class="form-label">Nama Penerbit</label>
				<input type="text" name="nama_penerbit" class="form-control" placeholder="Masukan Nama Penerbit" required>
			</div>
		</div>

		<div class="row">
			<div class="col mb-3">
				<label for="nameLarge" class="form-label">Status Penerbit</label>
				<select class="form-control" name="status_penerbit" required>
					<option>-- Pilih Status Penerbit --</option>
					<option value="1">Terverifikasi</option>
					<option value="2">Belum Terverifikasi</option>
				</select>
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
			Close
		</button>
		<button type="submit" class="btn btn-primary">Tambah Penerbit</button>
	</div>

</form>

<script>
/*Proses Tambah Penerbit*/
	$('#form_tambah').on('submit', function(e) {
		e.preventDefault();

		Swal.fire({
			title: `Konfirmasi`,
			text: `Tambah Penerbit?`,
			icon: 'question',
			showCancelButton : true,
			confirmButtonText : 'Buat',
			confirmButtonColor : '#1abc9c',
			cancelButtonText : 'Tidak',
			reverseButtons : true
		}).then((result)=> {
			if(result.value) {
				$.ajax({
					url: "<?= site_url('data_penerbit/proses_tambah')?>",
					method: "POST",
					data: new FormData(this),
					processData: false,
					contentType: false,
					async: true,

					beforeSend: function(){
						Swal.fire({
							title: "Menyimpan",
							text: "Silahkan Tunggu, Proses Memakan Waktu",
							didOpen: () => {
								Swal.showLoading()
							}
						});
					},

					success: function(data){

						if(data.status == true) {
							Swal.fire({
								confirmButtonColor: '#696cff',
								icon: "success",
								title: "Berhasil",
								text: "Penerbit Berhasil ditambah!",
								timer: 1500,
							}).then((e)=> {
								$('#table_data_penerbit').DataTable().ajax.reload(null, false);
								$('#tambah').modal('hide');
							});
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal",
								text: data.keterangan,
								timer: 1500,
							}).then((e)=> {
								$('#tambah').modal('hide');
							});
						}

					},

					error: (req, status, error)=> {
						Swal.fire({
							icon: 'error',
							title: `Gagal ${req.status}`,
							text: `Silahkan Coba Lagi`,
							timer: 1500
						})
					},

				});
				return false;
			}else if (result.dismiss === Swal.DismissReason.cancel){
				Swal.fire({
					confirmButtonColor: '#6e7881',
					icon: 'info',
					text: `Anda Membatalakan`,
					timer: 1500
				})
			}
		})


	});
</script>