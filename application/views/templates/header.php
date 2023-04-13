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
class="light-style layout-menu-fixed"
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

  <!-- Jquery -->
  <script src="<?= base_url('/assets'); ?>/plugins/jquery/jquery-3.5.1.js"></script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/template_admin') ?>/assets/img/favicon/favicon.ico" />

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

  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= base_url('assets/template_admin') ?>/assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/template_admin') ?>/assets/js/config.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Sweetalert2 -->
    <ilnk href="<?= base_url(''); ?>assets/plugins/sweetalert2/package/dist/sweetalert2.min.css" rel="stylesheet">

      <!-- Select2 Last -->
      <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/select2_last/dist/css/select2.min.css">
      <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    </head>

    <body>
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <!-- Menu -->

          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="<?= base_url('home'); ?>" class="app-brand-link">
                <span class="app-brand-logo demo">

                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2">E-LIBRARY DIPO</span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item <?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
                <a href="<?= base_url('dashboard'); ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
                </a>
              </li>

              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">MENU</span>
              </li>

              <li class="menu-item <?php if($this->uri->segment(1)=="Library"){echo "active";}?>">
                <a href="<?= base_url('data_user') ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-collection"></i>
                  <div data-i18n="Basic">Library</div>
                </a>
              </li>

              <?php if(userdata('role') == 1) { ?>

               <!-- Menu Administration -->
               <li class="menu-header small text-uppercase"><span class="menu-header-text">Administration</span></li>

               <li class="menu-item <?php if($this->uri->segment(1)=="data_user"){echo "active";}?>">
                <a href="<?= base_url('data_user') ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Basic">Data User</div>
                </a>
              </li>

              <li class="menu-item <?php if($this->uri->segment(1)=="data_buku"){echo "active";}?>">
                <a href="<?= base_url('data_buku') ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-book"></i>
                  <div data-i18n="Basic">Data Buku</div>
                </a>
              </li>

            <?php } else if(userdata('role') == 2) { ?>
            <?php } ?>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->



          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->