<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold"><span class="text-muted fw-light"></span> Kunjungan Saya</h4>

  <div class="card">

    <div class="card-header">
      <div class="row">

        <div class="col-lg-10">
        </div>

        <div class="btn-group col-lg-2">
         <button class="btn btn-dark" onclick="reload_table_kunjungan()">
          Refresh 
        </button>
      </div>

    </div>
  </div>

  <div class="card-body table-border-style">
    <div class="table-responsive text-nowrap">
      <table id="table_kunjungan" class="table table-hover">
       <thead>
         <tr>
          <th>Tanggal</th>
          <th>Tujuan</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

</div>

</div>

<script type="text/javascript">
     /* Table Kunjungan */
  function table_kunjungan() {

    $(document).ready(function() {

      var table_kunjungan = $('#table_kunjungan').DataTable({ 
        destroy: true,
        ordering: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        ajax: {
          url: "<?= site_url('kunjungan/table_kunjungan')?>",
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
  }table_kunjungan();

      /*Reload Table*/
  function reload_table_kunjungan()
  {
    table_kunjungan();
    /*$('#status').val('');
    $('#tanggal_filter').val('');*/
  }
</script>