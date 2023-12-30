@extends('layout.admin.main')

@section('vendorCSS')
    <link rel="stylesheet" href="/main/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/main/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/main/assets/extensions/toastify-js/src/toastify.css">
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
            <li class="menu-item active">
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
                        <a href="/admin/company" class="menu-link">
                            <div data-i18n="Perfect Scrollbar">Profile UBSP</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/config" class="menu-link">
                            <div data-i18n="Text Divider">Konfigurasi Data</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End of Master Data -->

            <!-- Transaction Data -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">transaksi</span></li>
            <li class="menu-item">
                <a href="/admin/menu/simpanan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                    <div data-i18n="Basic">Simpanan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/tabungan" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Basic">Tabungan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/kredit" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                    <div data-i18n="Basic">Kredit</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/menu/angsuran" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money"></i>
                    <div data-i18n="Basic">Angsuran</div>
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
                    </div>

                    <div class="card-body">
                        <div class="mt-3">
                            <form action="{{ route('admin.user.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            placeholder="" value="{{ old('fname', $user->fname) }}" />
                                        <label for="fname">Nama Depan</label>
                                    </div>
                                    @error('fname')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            placeholder="" value="{{ old('lname', $user->lname) }}" />
                                        <label for="lname">Nama Belakang</label>
                                    </div>
                                    @error('lname')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="birthplace" name="birthplace"
                                            placeholder="" value="{{ old('birthplace', $user->birthplace) }}" />
                                        <label for="birthplace">Tempat Lahir</label>
                                    </div>
                                    @error('birthplace')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control mb-3" id="birthdate" name="birthdate"
                                            value="{{ old('birthdate', $user->birthdate) }}">
                                        <label for="birthdate">Tanggal Lahir</label>
                                    </div>
                                    @error('birthdate')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="" value="{{ old('address', $user->address) }}" />
                                        <label for="address">Alamat Tinggal</label>
                                    </div>
                                    @error('address')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="" value="{{ old('email', $user->email) }}" />
                                        <label for="email">Email</label>
                                    </div>
                                    @error('email')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="workAddress" name="workAddress"
                                            placeholder="" value="{{ old('workAddress', $user->workAddress) }}" />
                                        <label for="workAddress">Alamat Kerja</label>
                                    </div>
                                    @error('workAddress')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="" value="{{ old('phone', $user->phone) }}" />
                                        <label for="phone">No Hp</label>
                                    </div>
                                    @error('phone')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="mothername" name="mothername"
                                            placeholder="" value="{{ old('mothername', $user->mothername) }}" />
                                        <label for="mothername">Nama Ibu Kandung</label>
                                    </div>
                                    @error('mothername')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Foto KTP</label>
                                        @if ($user->ktp != '')
                                            <img style="width: 220px;" src="/{{ $user->ktp }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                        @endif
                                    </div>
                                    @error('ktp')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="file" class="image-resize-filepond" name="ktp"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Foto KK</label>
                                        @if ($user->kk != '')
                                            <img style="width: 220px;" src="/{{ $user->kk }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <img class="img-preview img-fluid mb-3 mt-3 col-4">
                                        @endif
                                    </div>
                                    @error('kk')
                                        <p class="mt-1" style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="file" class="image-preview-filepond" name="kk"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="divider divider-warning">
                                    <div class="divider-text">Data Simpanan Pokok</div>
                                </div>
                                <div class="mb-3">
                                    <label>Simpanan Pokok</label>
                                    <p>{{ $userAccount->balance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Bayar</label>
                                    <p>{{ $transaction['transactionDate'] }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Jenis Pembsayaran</label>
                                    @if ($transaction['method'] == 1)
                                        <p>Transfer</p>
                                    @else
                                        <p>Cash</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="ktp">Bukti Pembayaran</label>
                                        @if ($transaction['image'] != '')
                                            <img style="width: 220px;" src="/{{ $transaction['image'] }}" alt=""
                                                class="img-fluid mb-3 mt-3 col-4 d-block">
                                        @else
                                            <p>-</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="divider divider-warning">
                                    <div class="divider-text"></div>
                                </div>

                                {{-- ubah pembayaran --}}
                                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">Ubah Data Pembayaran</button>
                                <div class="collapse mb-3" id="collapseExample">
                                    <div class="p-3 border">
                                        <label class="">Jenis Pembayaran</label>
                                        @if ($transaction['method'] == 1)
                                            <input type="hidden" name="currentMethod" value="1">
                                        @else
                                            <input type="hidden" name="currentMethod" value="2">
                                        @endif

                                        <div class="form-check mt-3 mb-2">
                                            <input name="method" class="form-check-input" type="radio" value="cash"
                                                id="cash" {{ old('method') == 'cash' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="cash"> Cash </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="method" class="form-check-input" type="radio"
                                                value="transfer" id="transfer"
                                                {{ old('method') == 'transfer' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="transfer"> Transfer </label>
                                        </div>
                                        @error('method')
                                            <p class="mt-1" style="color: red">{{ $message }}</p>
                                        @enderror

                                        <div id="bukti-trf" style="display: none;">
                                            <div class="form-group has-icon-left">
                                                <label for="image">Bukti Pembayaran</label>
                                                <div class="position-relative">
                                                    <input type="file" class="image-exif-filepond" name="simpanan"
                                                        accept="image/*" />
                                                </div>
                                            </div>
                                            @error('simpanan')
                                                <p class="mt-1" style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary show_confirm">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/main/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="/main/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script
        src="/main/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
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

        $(document).ready(function() {
            var selectedValue = $('input[name="method"]:checked').val();

            if (selectedValue == 'transfer') {
                $('#bukti-trf').show();
            } else {
                $('#bukti-trf').hide();
            }

            $('ul.pagination').hide();
            $(function() {
                $('.scrolling-pagination').jscroll({
                    autoTrigger: true,
                    loadingHtml: '<img class="center-block" src="/administrator/assets/img/icons/loading.gif" alt="Loading..." />',
                    padding: 0,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.scrolling-pagination',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
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

                var form = $(this).closest("form");

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

            $('input[type="radio"]').on('change', function() {
                // Get the selected value
                var selectedValue = $('input[name="method"]:checked').val();

                if (selectedValue == 'transfer') {
                    $('#bukti-trf').show();
                } else {
                    $('#bukti-trf').hide();
                }
            });
        });
    </script>

    <script>
        @if ($message = session('errors'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Perubahan data anggota belum diisi secara lengkap',
                // text: '{{ Session::get('errors') }}',
            })
        @endif
    </script>
@endsection
