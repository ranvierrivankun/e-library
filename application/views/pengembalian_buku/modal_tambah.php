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
				<label for="emailLarge" class="form-label">Nama Pengembali</label>
				<input type="text" class="form-control" value="<?= userdata('nama') ?>" disabled>
			</div>
			<div class="col mb-2">
				<label for="dobLarge" class="form-label">Tanggal Pengembalian</label>
				<input type="text" class="form-control" value="<?= date('d F Y') ?>" disabled>
			</div>
		</div>

		<div class="row g-2">
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Pilih Buku yand dipinjam</label>
				<select class="form-control select_peminjaman" name="peminjaman_id" required>
					<option value=""></option>
				</select>
			</div>
			<div class="col mb-2">
				<label for="emailLarge" class="form-label">Pilih Kondisi Buku ketika dikembalikan</label>
				<select class="form-control select_denda" name="denda_id" required>
					<option value=""></option>
				</select>
			</div>
		</div>

		<div class="row g-2">

		</div>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
			Close
		</button>
		<button type="submit" class="btn btn-primary">Kembalikan Buku</button>
	</div>

</form>

<script>
            /*Select Peminjaman*/
	$(".select_peminjaman").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#tambah"),
		placeholder: 'Pilih Buku',
		ajax: { 
			url: "<?= site_url('pengembalian_buku/select_peminjaman')?>",
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

	  /*Select Denda*/
	$(".select_denda").select2({
		theme: 'bootstrap4',
		dropdownParent: $("#tambah"),
		placeholder: 'Pilih Kondisi Buku',
		ajax: { 
			url: "<?= site_url('pengembalian_buku/select_denda')?>",
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
			text: `Kembalikan Buku?`,
			icon: 'question',
			showCancelButton : true,
			confirmButtonText : 'Kembalikan',
			confirmButtonColor : '#696cff',
			cancelButtonText : 'Tidak',
			reverseButtons : true
		}).then((result)=> {
			if(result.value) {
				$.ajax({
					url: "<?= site_url('pengembalian_buku/proses_tambah')?>",
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
								text: "Buku Berhasil dikembalikan!",
								timer: 1500,
							}).then((e)=> {
								$('#table_pengembalian_buku').DataTable().ajax.reload(null, false);
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