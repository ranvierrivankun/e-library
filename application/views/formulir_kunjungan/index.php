<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
-->
<!-- beautify ignore:start -->
<html
lang="en"
class="light-style customizer-hide"
dir="ltr"
data-theme="theme-default"
data-assets-path="../assets/"
data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title><?= $title ?></title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('/assets/template_login/'); ?>images/img-01.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Sweetalert2 -->
  <ilnk href="<?= base_url(''); ?>assets/plugins/sweetalert2/package/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="<?= base_url('assets/template_admin') ?>/assets/js/config.js"></script>
    </head>

    <body class="">
      <!-- Content -->

      <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
              <div class="card-body">

                <!-- Logo -->
                <div class="app-brand justify-content-center">
                  <img width="100px" class="rounded mx-auto d-block" src="<?= base_url('/assets/template_login/'); ?>images/img-01.png">
                </div>
                <!-- /Logo -->

                <h4 class="mb-2">E-LIBRARY DIPONEGORO 1</h4>
                <p class="mb-4">Formulir Kunjungan</p>

                <form method="POST" id="form_tambah" enctype="multipart/form-data">

                  <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="number" class="form-control" name="nis" placeholder="Masukan NIS" autofocus required/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tujuan Kunjungan</label>
                    <textarea type="text" class="form-control" name="tujuan_kunjungan" placeholder="Masukan Tujuan Kunjungan Anda" required></textarea>
                  </div>

                  <button type="submit" class="btn btn-success d-grid w-100">Kirim</button>

                </form>

              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/libs/jquery/jquery.js"></script>
      <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/libs/popper/popper.js"></script>
      <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/js/bootstrap.js"></script>
      <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

      <!-- Sweetalert2 -->
      <script src="<?= base_url(''); ?>assets/plugins/sweetalert2/package/dist/sweetalert2.all.min.js"></script>

      <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/js/menu.js"></script>
      <!-- endbuild -->

      <!-- Vendors JS -->

      <!-- Main JS -->
      <script src="<?= base_url('assets/template_admin') ?>/assets/js/main.js"></script>

      <!-- Page JS -->

      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
    </html>


    <script>
  /*Proses Tambah Buku*/
      $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: `Konfirmasi`,
          text: `Kirim Formulir?`,
          icon: 'question',
          showCancelButton : true,
          confirmButtonText : 'Kirim',
          confirmButtonColor : '#696cff',
          cancelButtonText : 'Tidak',
          reverseButtons : true
        }).then((result)=> {
          if(result.value) {
            $.ajax({
              url: "<?= site_url('formulir_kunjungan/proses_tambah')?>",
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
                    text: "Formulir Berhasil dikirim!",
                    timer: 1500,
                  }).then((e)=> {
                    window.location.reload();
                  });
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: data.keterangan,
                  }).then((e)=> {
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