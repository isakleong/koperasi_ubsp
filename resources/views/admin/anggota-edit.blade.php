@extends('layout.admin.main')

@section('vendorCSS')
<link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">

<style>
    #loadingFilter {
        display: flex;
        justify-content: center;
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
        <a href="/admin/menu/user" class="menu-link">
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
@include('sweetalert::alert')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Beranda Anggota /</span> Edit Anggota
  </h4>
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Anggota UBSP</h5>

          {{-- <div class="mb-3">
            <form id="filterForm" action="/admin/anggota/edit" method="get">
                {{ csrf_field() }}
                <div class="row">
                    <label for="filterStatus" class="form-label float-end">Filter Status</label>
                    <select id="filterStatus" class="form-select form-select" name="status" value="{{ $request->status }}">
                        <option value="aktif" {{ $request->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ $request->status == 'non-aktif' ? 'selected' : '' }}>Non Aktif</option>
                        <option value="not-verified" {{ $request->status == 'not-verified' ? 'selected' : '' }}>Belum Verifikasi</option>
                        <option value="not-acc" {{ $request->status == 'not-acc' ? 'selected' : '' }}>Belum Disetujui</option>
                    </select>
                </div>
            </form>
          </div> --}}

          {{-- <div class="btn-group float-end">
            <button type="button" class="btn btn-outline-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="javascript:void(0);">Aktif</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Non Aktif</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Belum Verifikasi</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Belum Disetujui</a></li>
            </ul>
          </div> --}}

        </div>
        
        <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-8 col-md-6" float-start">Cari Data</label>
                <form action="" method="get">
                  <div class="input-group input-group-merge mb-4">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" name="keyword" placeholder="Cari anggota..." aria-label="Search..." aria-describedby="basic-addon-search31" />
                    <button class="input-group-text btn btn-primary" id="btnCari">Cari</button>
                  </div>
                </form>
              </div>

              <div class="col-12 col-sm-8 col-md-6">
                <div class="input-group input-group-merge mb-4">
                  <form id="filterForm" action="/admin/anggota/edit" method="get">
                    {{ csrf_field() }}
                    <div class="row">
                        <label for="filterStatus" class="form-label float-end">Filter Status</label>
                        <select id="filterStatus" class="form-select form-select" name="status" value="{{ $request->status }}">
                            <option value="aktif" {{ $request->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ $request->status == 'non-aktif' ? 'selected' : '' }}>Non Aktif</option>
                            <option value="not-verified" {{ $request->status == 'not-verified' ? 'selected' : '' }}>Belum Verifikasi</option>
                            <option value="not-acc" {{ $request->status == 'not-acc' ? 'selected' : '' }}>Belum Disetujui</option>
                        </select>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div id="loadingFilter" style="display: none;">
              <img class="mb-5" src="/administrator/assets/img/icons/loading.gif" alt="Loading..." />
            </div>
            
            <div class="scrolling-pagination" id="mainData">
              @foreach ($users as $item)
                  @php
                      $borderClass = '';

                      // Check the status and set the border class accordingly
                      if ($item->status == 3) {
                          $borderClass = 'border-danger';
                      } elseif ($item->status == 2) {
                          $borderClass = 'border-success';
                      } elseif ($item->status == 1) {
                          $borderClass = 'border-warning';
                      }
                      elseif ($item->status == 0) {
                          $borderClass = 'border-info';
                      }
                  @endphp
                  <div class="card shadow-lg bg-transparent border {{ $borderClass }} mb-3">
                      <div class="card-body">
                          <h5 class="card-title">{{ $item->fname.' '.$item->lname }}</h5>
                          <input type="hidden" id="memberId" value="{{ $item->memberId }}">
                          <div class="mt-3">
                          <a href="{{ route('admin.user.edit', $item->id) }}" type="button" class="btn btn-primary">Edit Data</a>
                          </div>
                      </div>
                  </div>
              @endforeach
              {{ $users->withQueryString()->links() }}          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->    
@endsection

@section('vendorJS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="/main/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
<script src="/main/assets/extensions/filepond/filepond.js"></script>
<script src="/main/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="/main/assets/static/js/pages/filepond.js"></script>

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
      // $('ul.pagination').hide();
      // $(function() {
      //     $('.scrolling-pagination').jscroll({
      //         autoTrigger: true,
      //         loadingHtml: '<img class="center-block" src="/administrator/assets/img/icons/loading.gif" alt="Loading..." />',
      //         padding: 0,
      //         nextSelector: '.pagination li.active + li a',
      //         contentSelector: 'div.scrolling-pagination',
      //         callback: function() {
      //             $('ul.pagination').remove();
      //         }
      //     });
      // });

      $('select').on('change', function(e) {
        e.preventDefault();

        var selectedStatus = $(this).val();

        // Disable the select and filter while loading
        $(this).prop('disabled', true);
        $("#btnCari").prop('disabled', true);

        $('#mainData').html("");

        $('#loadingFilter').show();
        
        setTimeout(function() {
            $.ajax({
                url: '/admin/user',
                type: 'GET',
                data: { status: selectedStatus },
                success: function(response) {
                    $('#loadingFilter').hide();
                    $('#mainData').html(response); //update the data with filtered result
                    $("#filterStatus").prop('disabled', false);
                    $("#btnCari").prop('disabled', false);
                    // history.pushState({}, '', '/admin/user?status=' + selectedStatus);
                },
                error: function(xhr) {
                    console.log('AJAX error:', xhr.responseText);
                    $('#loadingFilter').hide();
                    $("#filterStatus").prop('disabled', false);
                    $("#btnCari").prop('disabled', false);
                }
            });
        }, 800);
      });

      $('#openModalButton').on('click', function() {
        // Perform AJAX request before opening the modal
        var memberId = $('#memberId').val();
        var urlPath = '/admin/anggota/edit/' + memberId;
        alert(memberId);
        $.ajax({
          url: urlPath,
          type: 'GET',
          success: function(response) {
            // Assuming the response is successful, you can open the modal here
            $('#modalData').modal('show');
          },
          error: function(xhr, status, error) {
            // Handle error if the AJAX request fails
            console.error(xhr.responseText);
          }
        });
      });

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

      $('input[type="radio"]').on('change', function () {
          // Get the selected value
          var selectedValue = $('input[name="method"]:checked').val();
          
          if(selectedValue == 'transfer') {
              $('#bukti-trf').show();
          } else {
              $('#bukti-trf').hide();
          }
      });
    });
</script>
@endsection