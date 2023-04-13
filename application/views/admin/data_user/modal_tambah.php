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

    /*Generate Kode Anggota*/
    $query          = $this->db->query("SELECT max(kode_anggota) as kodeTerakhir FROM data_user")->row_array();
    $urutan         = (int) substr($query['kodeTerakhir'], 3, 3);
    $urutan++;
    $huruf          = "AP";
    $KodeAnggota    = $huruf . sprintf("%03s", $urutan);
    ?>

    <div class="row">
        <div class="col mb-3">
            <label for="nameLarge" class="form-label">Kode Anggota</label>
            <input type="text" name="kode_anggota" class="form-control" placeholder="AUTO" value="<?php echo $KodeAnggota ?>" readonly>
        </div>
    </div>

    <div class="row g-2">
        <div class="col mb-2">
            <label for="emailLarge" class="form-label">NIS</label>
            <input type="number" name="nis" class="form-control" placeholder="Masukan NIS" required>
        </div>
        <div class="col mb-2">
          <label for="dobLarge" class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
      </div>
  </div>

  <div class="row">
    <div class="col mb-3">
        <label for="nameLarge" class="form-label">Kelas - Jurusan</label>
        <select class="form-control user_kelas" name="user_kelas" required>
            <option value=""></option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col mb-3">
        <label for="nameLarge" class="form-label">Alamat</label>
        <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
    </div>
</div>

</div>

<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
    Close
</button>
<button type="submit" class="btn btn-primary">Tambah User</button>
</div>

</form>

<script>
               /*Select Kelas & Jurusan*/
    $(".user_kelas").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#tambah"),
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

/*Proses Tambah User*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah User?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Buat',
            confirmButtonColor : '#1abc9c',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_user/proses_tambah')?>",
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
                            text: "User Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_user').DataTable().ajax.reload(null, false);
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