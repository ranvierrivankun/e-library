<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> Data Peminjaman Buku</h4>

  <div class="card">

    <div class="card-header">
      <div class="row">

        <div class="btn-group col-lg-3">
         <button class="btn btn-info" onclick="modal_tambah()">
          Pinjami Buku
        </button>
      </div>

      <div class="col-lg-7">
      </div>

      <div class="btn-group col-lg-2">
       <button class="btn btn-dark" onclick="reload_table_peminjaman_buku()">
        Refresh 
      </button>
    </div>

  </div>
</div>

<div class="card-body table-border-style">
  <div class="table-responsive text-nowrap">
    <table id="table_peminjaman_buku" class="table table-hover">
     <thead>
       <tr>
        <th width="5%">Aksi</th>
        <th>Nama Anggota</th>
        <th>Judul Buku</th>
        <th>Tanggal</th>
        <th>Kondisi Buku</th>
        <th>Status Peminjaman</th>
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
        <h5 class="modal-title" id="exampleModalLabel3">Pinjami Buku</h5>
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

<!-- Modal Detail -->
<div class="modal" id="detail" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Detail Peminjaman Buku</h5>
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
        /*Modal Tambah*/
  function modal_tambah() {
    $.ajax({
      url: "<?= site_url('data_peminjaman/modal_tambah') ?>",
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

  /*Modal Detail*/
  $('#table_peminjaman_buku').on('click', '.detail', function(e) {
    e.preventDefault();

    var id_peminjaman = $(this).data('id_peminjaman');

    $.ajax({
      url: "<?= site_url('peminjaman_buku/modal_detail')?>",
      method: "POST",
      data: {id_peminjaman: id_peminjaman},

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

    /*Delete Peminjaman*/
  function delete_peminjaman(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Peminjaman?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_peminjaman/delete_peminjaman') ?>",
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
              reload_table_peminjaman_buku();
            }
          }
        })
      }
    })
  }

    /*Terima Peminjaman*/
  function terima_peminjaman(id)
  {
    Swal.fire({
      title: 'Terima',
      text: "Terima Peminjaman?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#696cff',
      confirmButtonText: 'Terima',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_peminjaman/terima_peminjaman') ?>",
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
              reload_table_peminjaman_buku();
            }
          }
        })
      }
    })
  }

   /* Table Data Buku */
  function table_peminjaman_buku() {

    $(document).ready(function() {

      var table_peminjaman_buku = $('#table_peminjaman_buku').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        ajax: {
          url: "<?= site_url('data_peminjaman/table_peminjaman_buku')?>",
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
  }table_peminjaman_buku();

      /*Reload Table*/
  function reload_table_peminjaman_buku()
  {
    table_peminjaman_buku();
    /*$('#status').val('');
    $('#tanggal_filter').val('');*/
  }
</script>