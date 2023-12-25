@extends('layout.admin.main')

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
      <li class="menu-item active">
        <a href="/admin/account_category" class="menu-link">
          <i class="menu-icon tf-icons bx bx-category"></i>
          <div data-i18n="Basic">Kategori Akun</div>
        </a>
      </li>
      <li class="menu-item">
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
    <span class="text-muted fw-light">Kategori Akun / </span> Tambah Kategori
  </h4>
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Kategori Akun</h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('admin.account_category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="" oninput=capitalizeName(this) required value="{{old('name')}}"/>
                        <label for="name">Nama Kategori</label>
                    </div>
                    @error('name')
                        <p class="mt-1" style="color: red">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="active" checked />
                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-lg btn-primary show_confirm">Tambah Kategori</button>
                </div>
            </form>
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
    //capitalize input
    function capitalizeName(input) {
        const name = input.value.toLowerCase();
        const words = name.split(' ');
        const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
        input.value = capitalizedWords.join(' ');
    }
    //end of capitalize input

    $(document).ready(function () {
      $('.show_confirm').click(function(event) {
          event.preventDefault();

          var form =  $(this).closest("form");

          Swal.fire({
              title: 'Simpan Data?',
              text: '',
              icon: 'question',
              showDenyButton: true,
              confirmButtonText: 'Ya, simpan',
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
@endsection