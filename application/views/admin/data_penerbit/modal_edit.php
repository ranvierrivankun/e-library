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

    <input type="hidden" name="id_penerbit" value="<?= $edit->id_penerbit ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Kode Penerbit</label>
                <input type="text" class="form-control" placeholder="AUTO" value="<?= $edit->kode_penerbit ?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Nama Penerbit</label> (<?= $edit->nama_penerbit ?>)
                <input type="text" name="nama_penerbit" class="form-control" placeholder="Masukan Nama Penerbit jika ingin mengganti">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Status User</label>
                <select class="form-control" name="status_penerbit" required>
                    <option value="<?= $edit->status_penerbit ?>">
                        <?php if($edit->status_penerbit == '1') {?>
                            Default - Terverifikasi
                        <?php } else { ?>
                            Default - Belum Terverifikasi   
                        <?php } ?>
                    </option>
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
    <button type="submit" class="btn btn-primary">Edit Penerbit</button>
</div>

</form>

<script>
/*Proses Edit*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Penerbit?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_penerbit/proses_edit')?>",
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
                            text: "Data Penerbit Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_penerbit').DataTable().ajax.reload(null, false);
                            $('#edit').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 1500,
                    }).then((e)=> {
                     $('#edit').modal('hide');
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