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

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Pilih Peminjam</label>
				<select class="form-control select_anggota" name="user_id" required>
					<option value=""></option>
				</select>
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Tanggal Peminjaman</label>
				<input type="text" class="form-control" value="<?= date('d F Y') ?>" disabled>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Pilih Buku</label>
				<select class="form-control select_data_buku" name="buku_id" required>
					<option value=""></option>
				</select>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Kondisi Buku</label>
				<select class="form-control" name="kondisi_buku_pinjam" required>
					<option value="">-- Pilih Kondisi Buku --</option>
					<option value="1">Baik</option>
					<option value="2">Rusak</option>
				</select>
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
			Close
		</button>
		<button type="submit" class="btn btn-primary">Tambah Peminjam</button>
	</div>

</form>

<script>
            /*Select Buku*/
	$(".select_data_buku").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#tambah"),
		placeholder: 'Pilih Buku',
		ajax: { 
			url: "<?= site_url('peminjaman_buku/select_data_buku')?>",
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

	           /*Select Anggota*/
	$(".select_anggota").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#tambah"),
		placeholder: 'Pilih Peminjam',
		ajax: { 
			url: "<?= site_url('data_peminjaman/select_anggota')?>",
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

/*Proses Tambah Buku*/
	$('#form_tambah').on('submit', function(e) {
		e.preventDefault();

		Swal.fire({
			title: `Konfirmasi`,
			text: `Pinjami Buku?`,
			icon: 'question',
			showCancelButton : true,
			confirmButtonText : 'Pinjam',
			confirmButtonColor : '#696cff',
			cancelButtonText : 'Tidak',
			reverseButtons : true
		}).then((result)=> {
			if(result.value) {
				$.ajax({
					url: "<?= site_url('data_peminjaman/proses_tambah')?>",
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
								text: "Buku Berhasil dipinjami!",
								timer: 1500,
							}).then((e)=> {
								$('#table_peminjaman_buku').DataTable().ajax.reload(null, false);
								$('#tambah').modal('hide');
							});
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal",
								text: data.keterangan,
								timer: 1500,
							}).then((e)=> {
								/*$('#tambah').modal('hide');*/
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