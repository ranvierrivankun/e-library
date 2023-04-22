<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> Laporan Kunjungan</h4>

  <div class="card">

    <div class="card-header">
      <div class="row">

        <div class="col-lg-6">
        </div>

        <div class="col-lg-3">
          <input type="text" class="range form-control" id="tanggal" placeholder="-- Pilih Tanggal --" value="<?= date('Y-m-d') ?>" readonly>
        </div>

        <div class="btn-group col-lg-3">
          <button type="button" class="btn btn-sm btn-secondary" id="btn-filter" onclick="filter()">
            <i class="fa-solid fa-filter"></i>
            Filter
          </button>
          <form action="<?= site_url('laporan_kunjungan/table_laporan_excel') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <input type="hidden" name="tgl1" class="tgl1x">
            <input type="hidden" name="tgl2" class="tgl2x">

            <button type="submit" class="btn btn-success" id="btn-excel">
              <i class="fas fa-file-excel"></i>
              Export Excel
            </button>
          </form>
        </div>

      </div>
    </div>

    <div class="card-body table-border-style">
      <div class="table-responsive text-nowrap">

        <div id="table_laporan_kunjungan"></div>

      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function filter() {

    var tanggal = $('#tanggal').val();
    var tgl1 = tanggal.substring(0, 10);
    var tgl2 = tanggal.substring(14, 24);

    $('.tgl1x').val(tgl1);
    $('.tgl2x').val(tgl2);

    $.ajax({
      url: "<?= site_url('laporan_kunjungan/table_laporan_kunjungan') ?>",
      method: "POST",
      data: {tgl1, tgl2},

      beforeSend: ()=> {
        $('#btn-filter').html(`<i class='fa fa-spinner fa-spin'></i> Memproses`);
        $('#btn-filter').attr('disabled', true);
        $('#table_laporan_kunjungan').html(`<i class='fa fa-spinner fa-spin'></i> Memproses`);
      },

      success: (data)=> {
        $('#btn-filter').html(`<i class='fa fa-filter'></i> Filter`);
        $('#btn-filter').attr('disabled', false);
        $('#table_laporan_kunjungan').html(data);
      }

    });
  }filter();
</script>
