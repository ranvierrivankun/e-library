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

    <input type="hidden" name="id_kategori" value="<?= $edit->id_kategori ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Nama Kategori</label> (<?= $edit->nama_kategori ?>)
                <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Nama Kategori jika ingin mengganti">
            </div>
        </div>

    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Edit Kategori</button>
</div>

</form>

<script>
/*Proses Edit*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Kategori?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_kategori/proses_edit')?>",
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
                            text: "Data Kategori Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_kategori').DataTable().ajax.reload(null, false);
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