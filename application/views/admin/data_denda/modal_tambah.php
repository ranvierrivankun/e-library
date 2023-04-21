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

		<div class="row">
			<div class="col mb-3">
				<label for="nameLarge" class="form-label">Nama Denda</label>
				<input type="text" name="nama_denda" class="form-control" placeholder="Masukan Nama Denda" required>
			</div>
		</div>

		<div class="row">
			<div class="col mb-3">
				<label for="nameLarge" class="form-label">Tarif Denda</label>
				<input type="number" name="tarif_denda" class="form-control" placeholder="Masukan Tarif Denda" required>
			</div>
		</div>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
			Close
		</button>
		<button type="submit" class="btn btn-primary">Tambah Denda</button>
	</div>

</form>

<script>
/*Proses Tambah Kategori*/
	$('#form_tambah').on('submit', function(e) {
		e.preventDefault();

		Swal.fire({
			title: `Konfirmasi`,
			text: `Tambah Denda?`,
			icon: 'question',
			showCancelButton : true,
			confirmButtonText : 'Tambah',
			confirmButtonColor : '#696cff',
			cancelButtonText : 'Tidak',
			reverseButtons : true
		}).then((result)=> {
			if(result.value) {
				$.ajax({
					url: "<?= site_url('data_denda/proses_tambah')?>",
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
								text: "Denda Berhasil ditambah!",
								timer: 1500,
							}).then((e)=> {
								$('#table_data_denda').DataTable().ajax.reload(null, false);
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