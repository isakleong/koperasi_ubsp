@extends('layout.admin.main')

@section('vendorCSS')
    <style>
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }


        #lottie-loading {
            position: absolute;
            width: 25%;
            height: 25%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endsection

@section('content')
    {{-- @include('sweetalert::alert') --}}
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Daftar Akun / </span> Tambah Akun
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Akun</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="accountNo" name="accountNo"
                                        placeholder="" required
                                        value="{{ old('accountNo') }}" />
                                    <label for="accountNo">Nomor Akun</label>
                                </div>
                                @error('accountNo')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="" required
                                        value="{{ old('name') }}" />
                                    <label for="name">Nama Akun</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="normalBalance">Saldo Normal</label>
                                <select class="form-select" id="normalBalance" aria-label="normalBalance"
                                    name="normalBalance">
                                    <option selected>--- Pilih Saldo Normal ---</option>
                                    <option value="D" {{ old('normalBalance') == 'D' ? 'selected' : '' }}>Debit
                                    </option>
                                    <option value="K" {{ old('normalBalance') == 'K' ? 'selected' : '' }}>Kredit
                                    </option>
                                </select>
                                @error('normalBalance')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="balance" name="balance"
                                        placeholder="" required
                                        value="{{ old('balance') }}" />
                                    <label for="balance">Saldo Awal</label>
                                </div>
                                @error('balance')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="categoryID">Kategori Akun</label>
                                    <select class="choices form-select" id="categoryID" name="categoryID"><option value="" selected disabled>---Pilih Kategori---</option>  
                                      @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ old('categoryID') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categoryID')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3" id="relation" style="display: none;">
                                <div class="form-group">
                                    <label for="accountRelation">Relasi Akun</label>
                                    <select id="accountRelation" class="choices form-select" name="accountRelation">
                                        <option value="" selected disabled>---Pilih Relasi---</option>
                                        <option value="none" {{ old('accountRelation') =='none' ? 'selected' : '' }}>Tidak Ada</option>
                                        <option value="header" {{ old('accountRelation') =='header' ? 'selected' : '' }}>Akun Header</option>
                                        <option value="child" {{ old('accountRelation') =='child' ? 'selected' : '' }}>Sub Akun</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3" id="relationDetail" style="display: none;">
                                <div class="form-group">
                                    <label for="parentID">Detail Relasi:</label>
                                    <select id="parentID" name="parentID" class="choices form-select">
                                        <option value="">---Pilih Akun---</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="" required value="{{ old('description') }}"></textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="active" checked />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Aktif?</label>
                            </div>
                            <div id="overlay">
                                <div id="lottie-loading"></div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Tambah
                                    Akun</button>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>
    <script src="/vendor/lottie/lottie.min.js"></script>

    <script>
        $(document).ready(function() {
          var checkSelectedCategory = $("#categoryID").val();
          if(checkSelectedCategory != null) {
            $('#accountRelation').val('').trigger('change');
          }

            $('#categoryID').change(function() {
              $("#relation").show();
              $("#relationDetail").hide();
              $('#accountRelation').val('').trigger('change');
            });

            $('#accountRelation').change(function() {
                var relation = $(this).val();

                if (relation == 'none' || relation == null) {
                    $("#relationDetail").hide();
                } else {
                    $("#relationDetail").show();

                    var categoryId = $("#categoryID").val();
                    $.ajax({
                        url: '/admin/xxx',
                        type: 'GET',
                        data: {
                            categoryID: categoryId
                        },
                        success: function(data) {
                            console.log(data);
                            var select = $('#parentID');
                            select.empty();
                            $.each(data, function(key, value) {
                                select.append('<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                            
                        }
                    });
                }
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
                    customClass: {
                        confirmButton: "btn btn-primary",
                        denyButton: "btn btn-danger"
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $('.show_confirm').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var item = $('input[name="name"]').val();
                if(item === "") {
                    item = "(Nama Akun Belum Diisi)";
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                        '<p class="mt-2">Apakah Anda yakin ingin menambahkan akun ' + item + '?</p>',
                    confirmButtonText: 'Ya, Tambah',
                    denyButtonText: 'Batal',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        denyButton: "btn btn-danger"
                    },
                    showDenyButton: true,
                    showCloseButton: true,
                    focusConfirm: false,
                    didOpen: () => {
                        var animation = lottie.loadAnimation({
                            container: document.getElementById('lottie-container'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: '/assets/animations/confirm.json',
                            rendererSettings: {
                                preserveAspectRatio: 'xMidYMid slice'
                            }
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('form').submit(function() {
                $(':submit', this).prop('disabled', true);

                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-loading'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/assets/animations/loading.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice'
                    }
                });
                $('#overlay').show();
                $('body, html').css('overflow', 'hidden');
                return true;
            });

            @if ($message = session('errors'))
                Swal.fire({
                    title: 'Error',
                    html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                            '<p class="mt-2">Data kategori akun belum diisi secara lengkap. Silahkan dicek kembali.</p>',
                    showCloseButton: true,
                    focusConfirm: false,
                    didOpen: () => {
                        var animation = lottie.loadAnimation({
                            container: document.getElementById('lottie-container'),
                            renderer: 'svg',
                            loop: true,
                            autoplay: true,
                            path: '/assets/animations/error.json',
                            rendererSettings: {
                                preserveAspectRatio: 'xMidYMid slice'
                            }
                        });
                    }
                });
            @endif
        });
    </script>
@endsection
