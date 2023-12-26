@extends('layout.admin.main')

@section('vendorCSS')
<style>
  .account-table td {
      border: 1px solid #ddd; /* Add your desired border style */
  }

  .account-table td:first-child {
      width: 200px; /* Adjust the width of the first column as needed */
  }
</style>
    
@endsection

@section('navbar')
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo align-items-center">
            <img width="60" src="/main/assets/static/images/logo/UBSP-logos_transparent.png" alt="Logo">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Dashboards">Dashboard</div>
        </a>
      </li>
      <!-- End of Dashboards -->

      <!-- Master Data -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">master data</span></li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-group"></i>
          <div data-i18n="Basic">Anggota</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/account_category" class="menu-link">
          <i class="menu-icon tf-icons bx bx-category"></i>
          <div data-i18n="Basic">Kategori Akun</div>
        </a>
      </li>
      <li class="menu-item active">
        <a href="/admin/account" class="menu-link">
          <i class="menu-icon tf-icons bx bx-archive"></i>
          <div data-i18n="Basic">Daftar Akun</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div data-i18n="Extended UI">Pengaturan</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
              <div data-i18n="Perfect Scrollbar">Profile UBSP</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="extended-ui-text-divider.html" class="menu-link">
              <div data-i18n="Text Divider">Konfigurasi Data</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- End of Master Data -->

      <!-- Transaction Data -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">transaksi</span></li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-donate-heart"></i>
          <div data-i18n="Basic">Simpanan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-wallet"></i>
          <div data-i18n="Basic">Tabungan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
          <div data-i18n="Basic">Kredit</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div data-i18n="Basic">Angsuran</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-chevrons-right"></i>
          <div data-i18n="Basic">Pemasukan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-chevrons-left"></i>
          <div data-i18n="Basic">Pengeluaran</div>
        </a>
      </li>
      <!-- End of Transaction Data -->

      <!-- Report Data -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">laporan</span></li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-open"></i>
          <div data-i18n="Basic">Jurnal Harian</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
          <div data-i18n="Basic">Buku Besar</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-chart"></i>
          <div data-i18n="Basic">Neraca Saldo</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-line-chart"></i>
          <div data-i18n="Basic">Laba Rugi</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-network-chart"></i>
          <div data-i18n="Basic">Neraca</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-coin-stack"></i>
          <div data-i18n="Basic">Hutang</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="/admin/menu/user" class="menu-link">
          <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
          <div data-i18n="Basic">Piutang</div>
        </a>
      </li>
      <!-- End of Transaction Data -->

    </ul>
  </aside>
  <!-- / Menu -->
    
@endsection

@section('content')
@include('sweetalert::alert')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4">
    <span class="fw-light">Daftar Akun</span>
  </h4>
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Daftar Akun</h5>
          <a href="/admin/account/create" class="btn btn-primary">Tambah Data</a>
        </div>
        
        <div class="card-body">
          <!-- Display the hierarchy in a table -->
          <table class="table table-striped" id="table1" style="width: 100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Category ID</th>
                      <!-- Add other columns as needed -->
                      <th>Edit</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($account as $rootNode)
                      @include('admin.partials.account-tree', ['account' => $rootNode])
                  @endforeach
              </tbody>
          </table>

        
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->    
@endsection

@section('vendorJS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/vendor/sweetalert/sweetalert.all.js"></script>

<script>
    $(document).ready(function () {
      $('.show_confirm').click(function(event) {
          event.preventDefault();

          var form =  $(this).closest("form");

          Swal.fire({
              title: 'Hapus Data?',
              text: '',
              icon: 'question',
              showDenyButton: true,
              confirmButtonText: 'Ya, hapus',
              denyButtonText: 'Batal',
          }).then((result) => {
              if (result.isConfirmed) {
                  form.submit();
              } else if (result.isDenied) {
                  // Swal.fire('Changes are not saved', '', 'info');
              }
          });
      });
    });
</script>

<script>
    @if($message = session('errorData'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            // text: '',
            text: '{{Session::get("errorData")}}',
        })
    @endif
</script>
@endsection