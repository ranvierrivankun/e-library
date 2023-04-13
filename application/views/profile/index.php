<style type="text/css" media="screen">
  .swal2-container {
    z-index: 1000000;
  }
  .edit-body{
    height: 120;
    overflow-y: auto;
  }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> My Profile</h4>


  <div class="card-body table-border-style">

    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">My Picture</h5>
          </div>

          <img height="200" width="200" src="<?= base_url('assets/img/foto/') . userdata('foto'); ?>" class="rounded mx-auto d-block mb-4" alt="foto">
          
        </div>
      </div>

      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">My Data</h5>
            <small class="text-muted float-end">*Dapat Melakukan Edit Data</small>
          </div>
          <div class="card-body">

            <!-- Query untuk Mendapatkan Data User -->
            <?php
            $id_user = userdata('id_user');

            $admin = $this->db->select('*')->from('data_user')->where('id_user', $id_user)->join('role_user', 'id_role=role')->get()->row();

            $profile = $this->db->select('*')->from('data_user')->where('id_user', $id_user)->join('role_user', 'id_role=role')->join('kelas','id_kelas=user_kelas')->get()->row();
            ?>

            <form method="POST" id="form_edit" enctype="multipart/form-data">

              <?php if(userdata('role') == 1) { ?>

                <input type="hidden" name="id_user" value="<?= $admin->id_user ?>">

                <div class="mb-3">
                  <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                  <div class="input-group input-group-merge">
                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= $admin->nama ?>" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-icon-default-fullname">Ganti Foto</label>
                  <div class="input-group input-group-merge">
                    <input class="form-control" type="file" name="foto" id="formFile">
                  </div>
                </div>

                <button class="btn btn-primary" type="submit">Edit Data</button>
              </form>

            <?php } else if(userdata('role') == 2) { ?>

              <input type="hidden" name="id_user" value="<?= $profile->id_user ?>">

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Kode Anggota</label>
                <div class="input-group input-group-merge">
                  <input type="text" class="form-control" value="<?= $profile->kode_anggota ?>" disabled>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Kelas - Jurusan</label>
                <div class="input-group input-group-merge">
                  <input type="text" class="form-control" value="<?= $profile->kelas_jurusan ?>" disabled>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">NIS</label> (<?= $profile->nis ?>)
                <div class="input-group input-group-merge">
                  <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukan NIS jika ingin mengganti">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                <div class="input-group input-group-merge">
                  <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= $profile->nama ?>" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                <div class="input-group input-group-merge">
                  <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required><?= $profile->alamat ?></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Ganti Foto</label>
                <div class="input-group input-group-merge">
                  <input class="form-control" type="file" name="foto" id="formFile">
                </div>
              </div>

              <button class="btn btn-primary" type="submit">Edit Data</button>
            </form>

          <?php } ?>


        </div>
      </div>
    </div>
  </div>

</div>

</div>

<script>
 /*Proses Edit*/
  $('#form_edit').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: `Konfirmasi`,
      text: `Perbaharui Data?`,
      icon: 'question',
      showCancelButton : true,
      confirmButtonText : 'Perbaharui',
      confirmButtonColor : '#696cff',
      cancelButtonText : 'Tidak',
      reverseButtons : true
    }).then((result)=> {
      if(result.value) {
        $.ajax({
          url: "<?= site_url('profile/proses_edit')?>",
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
                text: "Data Berhasil Diperbaharui!",
                timer: 1500,
              }).then((e)=> {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Gagal",
                text: data.keterangan,
                timer: 1500,
              }).then((e)=> {
                location.reload();
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