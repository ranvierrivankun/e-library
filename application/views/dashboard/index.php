<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> DASHBOARD</h4>

  <div class="row">

    <?php if(userdata('role') == 1) { ?>

     <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-user"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_user'); ?>">View More</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Pengguna</span>
          <h3 class="card-title mb-2"><?= $totalPengguna ?></h3>
          <div class="row">
            <medium class="">Active <a class="text-success fw-semibold"><?= $totalPenggunaAktif ?></a></medium>
            <medium class="">Non-Aktif <a class="text-danger fw-semibold"><?= $totalPenggunaNonAktif ?></a></medium>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-bookmarks"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_penerbit'); ?>">View More</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Penerbit</span>
          <h3 class="card-title mb-2"><?= $totalPenerbit ?></h3>
          <div class="row">
            <medium class="">Terverifikasi <a class="text-primary fw-semibold"><?= $totalPenerbitTerverifikasi ?></a></medium>
            <medium class="">Belum Terverifikasi <a class="text-danger fw-semibold"><?= $totalPenerbitXTerverifikasi ?></a></medium>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-book-bookmark"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_kategori'); ?>">Lihat Data Kategori</a>
                <a class="dropdown-item" href="<?= base_url('data_buku'); ?>">Lihat Data Buku</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Total Buku</span>

          <h3 class="card-title mb-2"><?= $totalBuku ?></h3>

          <div class="row">
            <medium class="">Kategori Buku <a class="text-primary fw-semibold"><?= $totalKategori ?></a></medium>
            <medium>&nbsp;</medium>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-right-arrow"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_peminjaman'); ?>">Lihat Data Peminjaman</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Peminjaman Buku</span>

          <h3 class="card-title mb-2"><?= $totalPeminjaman ?></h3>

          <div class="row">
            <medium class="">Tertunda <a class="text-danger fw-semibold"><?= $totalPeminjamanTertunda ?></a></medium>
            <medium class="">Diterima <a class="text-primary fw-semibold"><?= $totalPeminjamanDiterima ?></a></medium>
            <medium class="">Dikembalikan <a class="text-info fw-semibold"><?= $totalPeminjamanDikembalikan ?></a></medium>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-left-arrow"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_pengembalian'); ?>">Lihat Data Pengembalian</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Pengembalian Buku</span>

          <h3 class="card-title mb-2"><?= $totalPengembalian ?></h3>

          <div class="row">
            <medium class="">Tertunda <a class="text-danger fw-semibold"><?= $totalPengembalianTertunda ?></a></medium>
            <medium class="">Diterima <a class="text-info fw-semibold"><?= $totalPengembalianDiterima ?></a></medium>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-12 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <i class="display-3 tf-icons bx bx-error-alt"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item" href="<?= base_url('data_pengembalian'); ?>">Lihat Data Pengembalian</a>
                <a class="dropdown-item" href="<?= base_url('data_denda'); ?>">Lihat Data Denda</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Total Denda Pengembalian</span>

          <h3 class="card-title mb-2"><?= rupiah($totalDenda) ?></h3>

          <div class="row">
            <medium class="">Buku Rusak <a class="text-danger fw-semibold"><?= $totalRusak ?></a></medium>
            <medium class="">Buku Hilang <a class="text-warning fw-semibold"><?= $totalHilang ?></a></medium>
          </div>

        </div>
      </div>
    </div>

  <?php } else if(userdata('role') == 2) { ?>

   <div class="col-lg-3 col-md-12 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <i class="display-3 tf-icons bx bx-right-arrow"></i>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
              <a class="dropdown-item" href="<?= base_url('peminjaman_buku'); ?>">Lihat Data Peminjaman</a>
            </div>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Peminjaman Buku</span>

        <h3 class="card-title mb-2"><?= $totalPeminjamanPengguna ?></h3>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-12 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <i class="display-3 tf-icons bx bx-left-arrow"></i>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
              <a class="dropdown-item" href="<?= base_url('pengembalian_buku'); ?>">Lihat Data Pengembalian</a>
            </div>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Pengembalian Buku</span>

        <h3 class="card-title mb-2"><?= $totalPengembalianPengguna ?></h3>
      </div>
    </div>
  </div>

<?php } ?>



</div>

</div>