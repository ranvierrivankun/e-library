<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> Data Denda</h4>

  <div class="card">

    <div class="card-header">
      <div class="row">

        <div class="btn-group col-lg-2">
         <button class="btn btn-info" onclick="modal_tambah()">
          Tambah Denda
        </button>
      </div>

      <div class="col-lg-8">
      </div>

      <div class="btn-group col-lg-2">
       <button class="btn btn-dark" onclick="reload_table_data_denda()">
        Refresh 
      </button>
    </div>

  </div>
</div>

<div class="card-body table-border-style">
  <div class="table-responsive text-nowrap">
    <table id="table_data_denda" class="table table-hover">
     <thead>
       <tr>
        <th width="5%">Aksi</th>
        <th>Nama Denda</th>
        <th>Tarif Denda</th>
      </tr>
    </thead>
  </table>
</div>
</div>

</div>

</div>

<!-- Modal Tambah -->
<div class="modal" id="tambah" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Denda</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div id="isimodaltambah"></div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal" id="edit" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Edit Data Denda</h5>
        <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
        ></button>
      </div>
      <div id="isimodaledit"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
        /*Modal Tambah*/
  function modal_tambah() {
    $.ajax({
      url: "<?= site_url('data_denda/modal_tambah') ?>",
      beforeSend: ()=> {
        Swal.fire({
          title : 'Menunggu',
          html : 'Memproses data',
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },
      success: function(data) {
        Swal.close();
        $('#tambah').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

  /*Modal Edit*/
  $('#table_data_denda').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_denda = $(this).data('id_denda');

    $.ajax({
      url: "<?= site_url('data_denda/modal_edit')?>",
      method: "POST",
      data: {id_denda: id_denda},

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
        $('#edit').modal('show');
        $('#isimodaledit').html(data);
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

    /*Delete Denda*/
  function delete_denda(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Denda?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_denda/delete_denda') ?>",
          data : {
            id: id,
          },
          dataType: "json",
          success: function(response) {
            if(response.sukses){
              Swal.fire({
                icon: 'success',
                confirmButtonColor: '#697a8d',
                title: 'Berhasil',
                timer: 1000,
                text: response.sukses
              });
              reload_table_data_denda();
            }
          }
        })
      }
    })
  }

   /* Table Data Buku */
  function table_data_denda() {

    $(document).ready(function() {

      var table_data_denda = $('#table_data_denda').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        ajax: {
          url: "<?= site_url('data_denda/table_data_denda')?>",
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
  }table_data_denda();

      /*Reload Table*/
  function reload_table_data_denda()
  {
    table_data_denda();
    /*$('#status').val('');
    $('#tanggal_filter').val('');*/
  }
</script>