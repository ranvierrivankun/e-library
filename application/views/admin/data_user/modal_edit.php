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

    <input type="hidden" name="id_user" value="<?= $edit->id_user ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Kode Anggota</label>
                <input type="text" class="form-control" placeholder="AUTO" value="<?= $edit->kode_anggota ?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Status User</label>
                <select class="form-control" name="status" required>
                    <option value="<?= $edit->status ?>">
                        <?php if($edit->status == '1') {?>
                            Default - Aktif
                        <?php } else { ?>
                            Default - Non-Aktif   
                        <?php } ?>
                    </option>
                    <option value="1">Aktif</option>
                    <option value="2">Non-Aktif</option>
                </select>
            </div>
        </div>

        <div class="row g-2">
            <div class="col mb-2">
                <label for="emailLarge" class="form-label">NIS</label> (<?= $edit->nis ?>)
                <input type="number" name="nis" class="form-control" placeholder="Masukan NIS jika ingin mengganti">
            </div>
            <div class="col mb-2">
              <label for="dobLarge" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" value="<?= $edit->nama ?>" required>
          </div>
      </div>

      <div class="row">
        <div class="col mb-3">
            <label for="nameLarge" class="form-label">Kelas - Jurusan</label>
            <select class="form-control user_kelas" name="user_kelas" required>
                <option value="<?= $edit->user_kelas ?>"><?= $edit->kelas_jurusan ?></option></select>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="nameLarge" class="form-label">Alamat</label>
                <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required><?= $edit->alamat ?></textarea>
            </div>
        </div>

    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Edit User</button>
</div>

</form>

<script>
               /*Select Kelas & Jurusan*/
    $(".user_kelas").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#edit"),
        placeholder: 'Pilih Kelas - Jurusan',
        ajax: { 
            url: "<?= site_url('data_user/select_user_kelas')?>",
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
            text: `Perbaharui Data User?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_user/proses_edit')?>",
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
                            text: "Data User Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_user').DataTable().ajax.reload(null, false);
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