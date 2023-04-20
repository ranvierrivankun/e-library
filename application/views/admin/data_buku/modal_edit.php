<style type="text/css" media="screen">
	.swal2-container {
		z-index: 1000000;
	}
	.edit-body{
		height: 120;
		overflow-y: auto;
	}
</style>

<form method="POST" id="form_edit" enctype="multipart/form-data">

	<input type="hidden" name="id_buku" value="<?= $edit->id_buku ?>">

	<div class="modal-body">

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">ISBN</label>(<?= $edit->isbn_buku ?>)
				<input type="text" name="isbn_buku" class="form-control" placeholder="Masukan ISBN jika ingin mengganti">
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Judul Buku</label>
				<input type="text" name="judul_buku" class="form-control" placeholder="Masukan Judul Buku" value="<?= $edit->judul_buku ?>" required>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="nameLarge" class="form-label">Nama Pengarang</label>
				<input type="text" name="pengarang_buku" class="form-control" placeholder="Masukan Nama Pengarang" value="<?= $edit->pengarang_buku ?>" required>
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Tahun Terbit</label>
				<input type="number" name="tahun_buku" class="form-control" placeholder="Masukan Tahun Terbit" value="<?= $edit->tahun_buku ?>" required>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Penerbit Buku</label>
				<select class="form-control penerbit_buku" name="penerbit_buku" required>
					<option value="<?= $edit->penerbit_buku ?>"><?= $edit->nama_penerbit ?></option></select>
				</select>
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Kategori Buku</label>
				<select class="form-control kategori_buku" name="kategori_buku" required>
					<option value="<?= $edit->kategori_buku ?>"><?= $edit->nama_kategori ?></option></select>
				</select>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Buku Baik</label>
				<input type="number" name="buku_baik" class="form-control" placeholder="Masukan Jumlah Buku Baik" value="<?= $edit->buku_baik ?>" required>
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Buku Rusak</label>
				<input type="number" name="buku_rusak" class="form-control" placeholder="Masukan Jumlah Buku Rusak" value="<?= $edit->buku_rusak ?>" required>
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
			Close
		</button>
		<button type="submit" class="btn btn-primary">Edit Buku</button>
	</div>

</form>

<script>
	          /*Select Penerbit*/
	$(".penerbit_buku").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#edit"),
		placeholder: 'Pilih Penerbit Buku',
		ajax: { 
			url: "<?= site_url('data_buku/select_penerbit_buku')?>",
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});

	           /*Select Kategori*/
	$(".kategori_buku").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#edit"),
		placeholder: 'Pilih Kategori Buku',
		ajax: { 
			url: "<?= site_url('data_buku/select_kategori_buku')?>",
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					searchTerm: params.term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});

/*Proses Edit*/
	$('#form_edit').on('submit', function(e) {
		e.preventDefault();

		Swal.fire({
			title: `Konfirmasi`,
			text: `Perbaharui Data Buku?`,
			icon: 'question',
			showCancelButton : true,
			confirmButtonText : 'Perbaharui',
			confirmButtonColor : '#696cff',
			cancelButtonText : 'Tidak',
			reverseButtons : true
		}).then((result)=> {
			if(result.value) {
				$.ajax({
					url: "<?= site_url('data_buku/proses_edit')?>",
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
								text: "Data Buku Berhasil Diperbaharui!",
								timer: 1500,
							}).then((e)=> {
								$('#table_data_buku').DataTable().ajax.reload(null, false);
								$('#edit').modal('hide');
							});
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal",
								text: data.keterangan,
								timer: 1500,
							}).then((e)=> {
                     /*$('#edit').modal('hide');*/
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