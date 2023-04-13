<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- Place this tag where you want the button to render. -->

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="<?= base_url('assets/img/foto/') . userdata('foto'); ?>" alt class="w-px-30 h-auto rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" id="topbar_menu">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="<?= base_url('assets/img/foto/') . userdata('foto'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block"><?= userdata('nama'); ?></span>

                <!-- Query untuk Mendapatkan nama Role -->
                <?php
                $id_user = userdata('id_user');
                $role = $this->db->select('*')->from('data_user')->where('id_user', $id_user)->join('role_user', 'id_role=role')->get()->row();
                ?>

                <small class="text-muted"><?= $role->nama_role ?></small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>

        <li>
          <a class="dropdown-item" href="<?= base_url('profile'); ?>">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>

        <li>
          <a href="#" class="dropdown-item change_password" data-id_user="<?= userdata('id_user'); ?>">
            <i class="bx bx-key me-2"></i>
            <span class="align-middle">Change Password</span>
          </a>
        </li>

        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
          </a>
        </li>
      </ul>
    </li>
    <!--/ User -->
  </ul>

</div>
</nav>

<!-- Modal Ganti Password -->
<div class="modal" id="modal_change_password" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Change Password</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div id="isimodal"></div>
    </div>
  </div>
</div>

<!-- Modal Ganti Password -->
<script type="text/javascript">
  $('#topbar_menu').on('click', '.change_password', function(e) {
    e.preventDefault();

    var id_user = $(this).data('id_user');

    $.ajax({
      url: "<?= site_url('home/modal_change_password')?>",
      method: "POST",
      data: {id_user: id_user},

      beforeSend: ()=> {
        Swal.fire({
          title : 'Menunggu',
          html : 'Memproses data',
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },

      success: (data)=> {
        Swal.close();
        $('#modal_change_password').modal('show');
        $('#isimodal').html(data);
      },

      error: (req, status, error)=> {
        Swal.fire({
          icon: 'error',
          title: `Gagal ${req.status}`,
          text: `Silahkan Coba Lagi`,
          timer: 1500
        })
      },
    })

  })
</script>