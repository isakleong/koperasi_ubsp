@extends('layout.admin.main')

@section('vendorCSS')
<style>
    #customCard {
        border:none;
        border-radius:12px;
        color:#fff;
        background-image: linear-gradient(to right top, #0D41E1, #0C63E7, #0A85ED, #09A6F3, #07C8F9);
    }
    
    #customCardBorder {
        border-top-left-radius:30px !important;
        border-top-right-radius:30px !important;
        border:none;
        border-radius:6px;
        background-color:blue;
        color:#fff;
        background-image: linear-gradient(to right top, #0a33b1, #094eb7, #086abc, #0784c2, #05a1c8);
    }

    .bgCard:hover {
        /* transform: scale(1.02); */
        opacity: 0.75;
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

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">master data</span></li>
      <!-- Cards -->
      <li class="menu-item active">
        <a href="/admin/anggota" class="menu-link">
          <i class="menu-icon tf-icons bx bx-group"></i>
          <div data-i18n="Basic">Anggota</div>
        </a>
      </li>
      
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-copy"></i>
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
      

      <!-- Extended components -->
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-copy"></i>
          <div data-i18n="Extended UI">Extended UI</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
              <div data-i18n="Perfect Scrollbar">Perfect scrollbar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="extended-ui-text-divider.html" class="menu-link">
              <div data-i18n="Text Divider">Text Divider</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>
  <!-- / Menu -->
    
@endsection

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        {{-- <span class="text-muted fw-light">Anggota /</span> Pagination and breadcrumbs --}}
        <span class="fw-light">Beranda Anggota
    </h4>

    <div class="row">
        {{-- kartu --}}
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-6 mb-4 bgCard">
                    <a href="/admin/anggota/create">
                        <div class="container-fluid">
                            <div class="p-3" id="customCard">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="/administrator/assets/img/icons/multiple_user.png" width="50" /> 
                                    <span><i class='bx bxs-message-square-add' style="font-size: 3em;"></i></span>
                                </div>
                                {{-- <div class="px-2 number mt-3 d-flex justify-content-between align-items-center">
                                    <span>Tambah Anggota</span>
                                </div> --}}
                                <div class="p-4 mt-4" id="customCardBorder">
                                    {{-- <div class="d-flex justify-content-between align-items-center">
                                        <span class="cardholder">Tambah Anggota</span>
                                    </div> --}}
                                    <div class="text-center">
                                        <span class="cardholder">Tambah Anggota</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6 mb-4 bgCard">
                    <a href="/admin/anggota/edit">
                        <div class="container-fluid">
                            <div class="p-3" id="customCard">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="/administrator/assets/img/icons/multiple_user.png" width="50" /> 
                                    <span><i class='bx bxs-message-square-edit' style="font-size: 3em;"></i></span>
                                </div>
                                <div class="p-4 mt-4" id="customCardBorder">
                                    <div class="text-center">
                                        <span class="cardholder">Edit Anggota</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->    
@endsection