<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> Data Kunjungan</h4>

  <div class="card">

    <div class="card-header">
      <div class="row">

        <div class="col-lg-10">
        </div>

        <div class="btn-group col-lg-2">
         <button class="btn btn-dark" onclick="reload_table_data_kunjungan()">
          Refresh 
        </button>
      </div>

    </div>
  </div>

  <div class="card-body table-border-style">
    <div class="table-responsive text-nowrap">
      <table id="table_data_kunjungan" class="table table-hover">
       <thead>
         <tr>
          <th>Aksi</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Tujuan</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

</div>

</div>

<!-- Modal Detail -->
<div class="modal" id="detail" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Detail Kunjungan</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div id="isimodaldetail"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  /*Modal Detail*/
  $('#table_data_kunjungan').on('click', '.detail', function(e) {
    e.preventDefault();

    var id_kunjungan = $(this).data('id_kunjungan');

    $.ajax({
      url: "<?= site_url('data_kunjungan/modal_detail')?>",
      method: "POST",
      data: {id_kunjungan: id_kunjungan},

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
        $('#detail').modal('show');
        $('#isimodaldetail').html(data);
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

     /* Table Kunjungan */
  function table_data_kunjungan() {

    $(document).ready(function() {

      var table_data_kunjungan = $('#table_data_kunjungan').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        ajax: {
          url: "<?= site_url('data_kunjungan/table_data_kunjungan')?>",
          method: "POST",
          data: {}
        },
        "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-lg"></i> Sedang diproses'
        },
        columnDefs: [
        { 
          visible: false,
          orderable: false,
        },
        ],

      });
    });
  }table_data_kunjungan();

      /*Reload Table*/
  function reload_table_data_kunjungan()
  {
    table_data_kunjungan();
    /*$('#status').val('');
    $('#tanggal_filter').val('');*/
  }
</script>